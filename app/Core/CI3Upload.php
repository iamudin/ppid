<?php

namespace App\Core;

#[\AllowDynamicProperties]
class CI3Upload
{
    public string $upload_path = '';
    public string $allowed_types = '';
    public string $file_name = '';
    public int $max_size = 0; // KB
    public int $max_width = 0;
    public int $max_height = 0;
    public bool $overwrite = false;
    public bool $encrypt_name = false;
    public bool $remove_spaces = true;

    // Pengaturan kompresi dan WebP otomatis sisi server
    public bool $auto_webp = true;
    public int $webp_quality = 82; // 1-100
    public int $webp_max_width = 1600;
    public int $webp_max_height = 1600;

    protected array $forbidden_extensions = [
        'php', 'phtml', 'php3', 'php4', 'php5', 'php7', 'php8', 'phps', 'phar', 'pht',
        'sh', 'bash', 'exe', 'cgi', 'pl', 'py', 'jsp', 'asp', 'aspx', 'htaccess', 'htpasswd',
        'svg', 'shtml', 'vbs', 'bat', 'cmd'
    ];

    protected array $upload_data = [];
    protected array $errors = [];

    public function __construct(array $config = [])
    {
        if (!empty($config)) {
            $this->initialize($config);
        }
    }

    public function initialize(array $config = []): self
    {
        $this->errors = [];
        foreach ($config as $key => $val) {
            $this->{$key} = $val;
        }

        // Otomatis izinkan ekstensi webp jika jenis gambar diperbolehkan
        if (!empty($this->allowed_types) && $this->allowed_types !== '*') {
            if (preg_match('/\b(jpg|jpeg|png|gif|bmp)\b/i', $this->allowed_types) && !str_contains(strtolower($this->allowed_types), 'webp')) {
                $this->allowed_types .= '|webp';
            }
        }

        return $this;
    }

    public function do_upload(string $field = 'userfile'): bool
    {
        $this->errors = [];
        $request = \Config\Services::request();
        $file = ($request instanceof \CodeIgniter\HTTP\IncomingRequest) ? $request->getFile($field) : null;

        if (!$file || !$file->isValid()) {
            // Check native $_FILES as fallback
            if (!isset($_FILES[$field]) || $_FILES[$field]['error'] === UPLOAD_ERR_NO_FILE) {
                $this->errors[] = 'You did not select a file to upload.';
                return false;
            }

            if (isset($_FILES[$field]['error']) && $_FILES[$field]['error'] !== UPLOAD_ERR_OK) {
                $this->errors[] = 'Upload error code: ' . $_FILES[$field]['error'];
                return false;
            }
        }

        $origName = $file ? $file->getClientName() : $_FILES[$field]['name'];
        $tempPath = $file ? $file->getTempName() : $_FILES[$field]['tmp_name'];
        $fileSize = $file ? $file->getSize() : $_FILES[$field]['size'];

        // 1. KEAMANAN: Sanitasi nama file dari Path Traversal dan Karakter Berbahaya
        $origName = str_replace(["\0", '../', '..\\'], '', $origName);
        $clientExt = strtolower(pathinfo($origName, PATHINFO_EXTENSION));

        // 2. KEAMANAN: Blokir mutlak ekstensi executable / web shell (termasuk double extension seperti .php.jpg)
        $nameParts = explode('.', strtolower($origName));
        foreach ($nameParts as $part) {
            if (in_array(trim($part), $this->forbidden_extensions, true)) {
                $this->errors[] = 'Upload ditolak: File terindikasi berisi skrip berbahaya (. ' . htmlspecialchars($part) . ').';
                return false;
            }
        }

        // 3. KEAMANAN: Validasi MIME Asli via finfo (Cegah PHP shell berkedok JPG/PNG)
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $detectedMime = $finfo->file($tempPath);
        if ($detectedMime) {
            $dangerousMimes = ['text/x-php', 'application/x-php', 'text/html', 'application/x-executable', 'application/x-sh'];
            if (in_array(strtolower($detectedMime), $dangerousMimes, true)) {
                $this->errors[] = 'Upload ditolak: Konten file terdeteksi sebagai skrip yang tidak diizinkan.';
                return false;
            }
        }

        // 4. Allowed types check
        if (!empty($this->allowed_types) && $this->allowed_types !== '*') {
            $allowed = array_map('trim', explode('|', strtolower($this->allowed_types)));
            if (!in_array($clientExt, $allowed, true)) {
                $this->errors[] = 'The filetype you are attempting to upload is not allowed.';
                return false;
            }
        }

        // 5. Max size check (KB)
        if ($this->max_size > 0 && ($fileSize / 1024) > $this->max_size) {
            $this->errors[] = 'The file you are attempting to upload is larger than the permitted size.';
            return false;
        }

        // 6. Resolve upload directory
        $targetDir = $this->resolvePath($this->upload_path);
        if (!is_dir($targetDir)) {
            @mkdir($targetDir, 0755, true);
        }

        if (!is_writable($targetDir)) {
            $this->errors[] = 'The upload path does not appear to be writable.';
            return false;
        }

        // 7. Tentukan nama file tujuan
        if (!empty($this->file_name)) {
            $finalName = $this->file_name;
            if (!pathinfo($finalName, PATHINFO_EXTENSION) && $clientExt) {
                $finalName .= '.' . $clientExt;
            }
        } elseif ($this->encrypt_name) {
            $finalName = md5(uniqid(mt_rand(), true)) . '.' . $clientExt;
        } else {
            $finalName = $origName;
            if ($this->remove_spaces) {
                $finalName = preg_replace('/\s+/', '_', $finalName);
            }
        }

        // Bersihkan karakter aneh pada nama file
        $finalName = preg_replace('/[^a-zA-Z0-9_\-\.]/', '_', $finalName);

        // Overwrite check
        $destination = rtrim($targetDir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $finalName;
        if (file_exists($destination) && !$this->overwrite) {
            $ext = pathinfo($finalName, PATHINFO_EXTENSION);
            $base = pathinfo($finalName, PATHINFO_FILENAME);
            $finalName = $base . '_' . time() . ($ext ? '.' . $ext : '');
            $destination = rtrim($targetDir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $finalName;
        }

        // Pindahkan file ke direktori tujuan
        if ($file && $file->isValid()) {
            try {
                $file->move($targetDir, $finalName, $this->overwrite);
            } catch (\Throwable $e) {
                if (!@move_uploaded_file($tempPath, $destination) && !@copy($tempPath, $destination)) {
                    $this->errors[] = 'Failed to move uploaded file: ' . $e->getMessage();
                    return false;
                }
            }
        } else {
            if (!@move_uploaded_file($tempPath, $destination) && !@copy($tempPath, $destination)) {
                $this->errors[] = 'Failed to move uploaded file.';
                return false;
            }
        }

        // Cek info gambar
        $imgInfo = @getimagesize($destination);
        $isImage = ($imgInfo !== false);

        // 8. OPTIMASI & KONVERSI WEBP OTOMATIS SISI SERVER
        if ($isImage && $this->auto_webp) {
            $webpResult = $this->convertToWebp($destination, $targetDir, $finalName, $imgInfo);
            if ($webpResult) {
                $destination = $webpResult['path'];
                $finalName = $webpResult['name'];
                $imgInfo = $webpResult['info'];
                $fileSize = filesize($destination);
                $clientExt = 'webp';
            }
        }

        // Kumpulkan metadata upload
        $fullPath = $destination;
        $currSize = file_exists($fullPath) ? filesize($fullPath) : $fileSize;

        $this->upload_data = [
            'file_name'      => $finalName,
            'file_type'      => $isImage ? 'image/webp' : ($file ? $file->getClientMimeType() : (mime_content_type($fullPath) ?: 'application/octet-stream')),
            'file_path'      => rtrim($targetDir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR,
            'full_path'      => $fullPath,
            'raw_name'       => pathinfo($finalName, PATHINFO_FILENAME),
            'orig_name'      => $origName,
            'client_name'    => $origName,
            'file_ext'       => '.' . pathinfo($finalName, PATHINFO_EXTENSION),
            'file_size'      => round($currSize / 1024, 2),
            'is_image'       => $isImage,
            'image_width'    => $isImage ? $imgInfo[0] : 0,
            'image_height'   => $isImage ? $imgInfo[1] : 0,
            'image_type'     => $isImage ? 'webp' : '',
            'image_size_str' => $isImage ? $imgInfo[3] : '',
        ];

        return true;
    }

    /**
     * Konversi gambar apapun ke format WebP dengan kompresi ukuran dan resolusi
     */
    protected function convertToWebp(string $sourcePath, string $targetDir, string $fileName, array $info): ?array
    {
        [$origW, $origH, $type] = $info;

        switch ($type) {
            case IMAGETYPE_JPEG:
                $srcImg = @imagecreatefromjpeg($sourcePath);
                break;
            case IMAGETYPE_PNG:
                $srcImg = @imagecreatefrompng($sourcePath);
                break;
            case IMAGETYPE_GIF:
                $srcImg = @imagecreatefromgif($sourcePath);
                break;
            case IMAGETYPE_WEBP:
                $srcImg = @imagecreatefromwebp($sourcePath);
                break;
            case IMAGETYPE_BMP:
                $srcImg = @imagecreatefrombmp($sourcePath);
                break;
            default:
                $srcImg = null;
                break;
        }

        if (!$srcImg) {
            return null;
        }

        // Hitung kompresi resolusi jika melebihi batas
        $targetW = $origW;
        $targetH = $origH;
        if ($targetW > $this->webp_max_width || $targetH > $this->webp_max_height) {
            $ratio = min($this->webp_max_width / $targetW, $this->webp_max_height / $targetH);
            $targetW = (int) round($targetW * $ratio);
            $targetH = (int) round($targetH * $ratio);
        }

        $dstImg = imagecreatetruecolor($targetW, $targetH);

        // Pertahankan transparansi PNG / WebP
        imagealphablending($dstImg, false);
        imagesavealpha($dstImg, true);

        imagecopyresampled($dstImg, $srcImg, 0, 0, 0, 0, $targetW, $targetH, $origW, $origH);

        // Tentukan nama file baru dengan ekstensi .webp
        $baseName = pathinfo($fileName, PATHINFO_FILENAME);
        $newFileName = $baseName . '.webp';
        $webpPath = rtrim($targetDir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $newFileName;

        $saved = imagewebp($dstImg, $webpPath, $this->webp_quality);

        imagedestroy($srcImg);
        imagedestroy($dstImg);

        if ($saved) {
            // Hapus file format lama jika ekstensinya berbeda
            if ($sourcePath !== $webpPath && file_exists($sourcePath)) {
                @unlink($sourcePath);
            }

            $newInfo = @getimagesize($webpPath);
            return [
                'path' => $webpPath,
                'name' => $newFileName,
                'info' => $newInfo ?: [$targetW, $targetH, IMAGETYPE_WEBP, 'width="' . $targetW . '" height="' . $targetH . '"']
            ];
        }

        return null;
    }

    public function data(?string $index = null)
    {
        if ($index !== null) {
            return $this->upload_data[$index] ?? null;
        }

        return $this->upload_data;
    }

    public function display_errors(string $open = '<p>', string $close = '</p>'): string
    {
        if (empty($this->errors)) {
            return '';
        }

        return $open . implode($close . $open, $this->errors) . $close;
    }

    protected function resolvePath(string $path): string
    {
        $path = trim($path);
        if ($path === '') {
            return ROOTPATH;
        }

        if (str_starts_with($path, '/')) {
            return $path;
        }

        $clean = ltrim($path, './');

        if (is_dir(ROOTPATH . $clean)) {
            return ROOTPATH . $clean;
        }

        if (is_dir(FCPATH . $clean)) {
            return FCPATH . $clean;
        }

        return ROOTPATH . $clean;
    }
}
