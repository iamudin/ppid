<?php

namespace App\Core;

#[\AllowDynamicProperties]
class CI3ImageLib
{
    public string $image_library = 'gd2';
    public string $source_image = '';
    public string $new_image = '';
    public int $width = 0;
    public int $height = 0;
    public $quality = '90%';
    public bool $maintain_ratio = true;
    public bool $create_thumb = false;
    public string $thumb_marker = '_thumb';

    protected array $errors = [];

    public function __construct(array $props = [])
    {
        if (!empty($props)) {
            $this->initialize($props);
        }
    }

    public function initialize(array $props = []): self
    {
        $this->errors = [];
        foreach ($props as $key => $val) {
            $this->{$key} = $val;
        }

        return $this;
    }

    public function resize(): bool
    {
        $this->errors = [];

        $source = $this->resolvePath($this->source_image);
        if (!file_exists($source)) {
            $this->errors[] = 'Source image not found: ' . $this->source_image;
            return false;
        }

        $dest = $this->new_image ? $this->resolvePath($this->new_image) : $source;
        $destDir = dirname($dest);
        if (!is_dir($destDir)) {
            @mkdir($destDir, 0777, true);
        }

        $quality = (int) str_replace('%', '', (string) $this->quality);
        if ($quality <= 0 || $quality > 100) {
            $quality = 90;
        }

        try {
            $image = \Config\Services::image();
            $image->withFile($source);

            if ($this->width > 0 || $this->height > 0) {
                $image->resize($this->width, $this->height, $this->maintain_ratio);
            }

            $image->save($dest, $quality);
            return true;
        } catch (\Throwable $e) {
            // GD fallback if Services::image has issues
            return $this->gdResizeFallback($source, $dest, $this->width, $this->height, $quality);
        }
    }

    protected function gdResizeFallback(string $source, string $dest, int $width, int $height, int $quality): bool
    {
        $info = @getimagesize($source);
        if (!$info) {
            $this->errors[] = 'Unable to read image dimensions.';
            return false;
        }

        [$origW, $origH, $type] = $info;

        if ($width <= 0 && $height <= 0) {
            return copy($source, $dest);
        }

        if ($width <= 0) {
            $width = (int) round($origW * ($height / $origH));
        } elseif ($height <= 0) {
            $height = (int) round($origH * ($width / $origW));
        }

        switch ($type) {
            case IMAGETYPE_JPEG:
                $srcImg = @imagecreatefromjpeg($source);
                break;
            case IMAGETYPE_PNG:
                $srcImg = @imagecreatefrompng($source);
                break;
            case IMAGETYPE_GIF:
                $srcImg = @imagecreatefromgif($source);
                break;
            case IMAGETYPE_WEBP:
                $srcImg = @imagecreatefromwebp($source);
                break;
            default:
                $this->errors[] = 'Unsupported image format.';
                return false;
        }

        if (!$srcImg) {
            $this->errors[] = 'Failed to create image resource from source.';
            return false;
        }

        $dstImg = imagecreatetruecolor($width, $height);
        if ($type === IMAGETYPE_PNG || $type === IMAGETYPE_WEBP) {
            imagealphablending($dstImg, false);
            imagesavealpha($dstImg, true);
        }

        imagecopyresampled($dstImg, $srcImg, 0, 0, 0, 0, $width, $height, $origW, $origH);

        $destExt = strtolower(pathinfo($dest, PATHINFO_EXTENSION));
        $saved = false;
        if ($destExt === 'webp' || $type === IMAGETYPE_WEBP) {
            $saved = imagewebp($dstImg, $dest, $quality);
        } else {
            switch ($type) {
                case IMAGETYPE_JPEG:
                    $saved = imagejpeg($dstImg, $dest, $quality);
                    break;
                case IMAGETYPE_PNG:
                    $saved = imagepng($dstImg, $dest, (int) round(9 * (100 - $quality) / 100));
                    break;
                case IMAGETYPE_GIF:
                    $saved = imagegif($dstImg, $dest);
                    break;
                default:
                    $saved = imagewebp($dstImg, $dest, $quality);
                    break;
            }
        }

        imagedestroy($srcImg);
        imagedestroy($dstImg);

        if (!$saved) {
            $this->errors[] = 'Failed to save resized image to destination.';
            return false;
        }

        return true;
    }

    public function display_errors(string $open = '<p>', string $close = '</p>'): string
    {
        if (empty($this->errors)) {
            return '';
        }

        return $open . implode($close . $open, $this->errors) . $close;
    }

    public function clear(): void
    {
        $this->errors = [];
        $this->source_image = '';
        $this->new_image = '';
        $this->width = 0;
        $this->height = 0;
    }

    protected function resolvePath(string $path): string
    {
        $path = trim($path);
        if ($path === '' || str_starts_with($path, '/')) {
            return $path;
        }

        $clean = ltrim($path, './');
        if (file_exists(ROOTPATH . $clean)) {
            return ROOTPATH . $clean;
        }
        if (file_exists(FCPATH . $clean)) {
            return FCPATH . $clean;
        }

        return ROOTPATH . $clean;
    }
}
