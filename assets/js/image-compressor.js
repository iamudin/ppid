/**
 * Client-Side Image Compressor & WebP Converter
 * Otomatis mengompres resolusi, ukuran (size), dan mengubah format gambar ke .webp
 * sebelum form dikirimkan ke server.
 */
(function () {
    'use strict';

    // Konfigurasi default kompresi
    const CONFIG = {
        maxWidth: 1600,       // Maksimal lebar resolusi (px)
        maxHeight: 1600,      // Maksimal tinggi resolusi (px)
        quality: 0.82,        // Kualitas kompresi WebP (0.1 - 1.0)
        targetMime: 'image/webp',
        imageTypes: ['image/jpeg', 'image/png', 'image/bmp', 'image/gif', 'image/webp']
    };

    /**
     * Format byte ke ukuran yang mudah dibaca (KB / MB)
     */
    function formatBytes(bytes) {
        if (bytes === 0) return '0 B';
        const k = 1024;
        const sizes = ['B', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
    }

    /**
     * Hitung dimensi baru proporsional jika melebihi batas maksimum
     */
    function calculateSize(srcWidth, srcHeight, maxWidth, maxHeight) {
        let width = srcWidth;
        let height = srcHeight;

        if (width > maxWidth || height > maxHeight) {
            const ratio = Math.min(maxWidth / width, maxHeight / height);
            width = Math.round(width * ratio);
            height = Math.round(height * ratio);
        }

        return { width, height };
    }

    /**
     * Kompres dan ubah satu file gambar menjadi WebP via Canvas
     */
    function compressImage(file) {
        return new Promise((resolve, reject) => {
            // Jika bukan tipe gambar yang didukung, kembalikan file asli
            if (!CONFIG.imageTypes.includes(file.type) && !file.name.match(/\.(jpg|jpeg|png|bmp|gif|webp)$/i)) {
                return resolve({ file, compressed: false, originalSize: file.size, newSize: file.size });
            }

            const reader = new FileReader();
            reader.onerror = () => reject(new Error('Gagal membaca file gambar'));
            reader.onload = (e) => {
                const img = new Image();
                img.onerror = () => reject(new Error('Gagal memproses gambar'));
                img.onload = () => {
                    try {
                        const { width, height } = calculateSize(img.width, img.height, CONFIG.maxWidth, CONFIG.maxHeight);
                        const canvas = document.createElement('canvas');
                        canvas.width = width;
                        canvas.height = height;

                        const ctx = canvas.getContext('2d');
                        // Bersihkan canvas dan gambar ulang dengan smoothing maksimal
                        ctx.imageSmoothingEnabled = true;
                        ctx.imageSmoothingQuality = 'high';
                        ctx.drawImage(img, 0, 0, width, height);

                        canvas.toBlob((blob) => {
                            if (!blob) {
                                return resolve({ file, compressed: false, originalSize: file.size, newSize: file.size });
                            }

                            // Ubah ekstensi file ke .webp
                            let baseName = file.name.substring(0, file.name.lastIndexOf('.')) || file.name;
                            const newFileName = baseName + '.webp';

                            // Buat objek File baru bertipe WebP
                            const newFile = new File([blob], newFileName, {
                                type: CONFIG.targetMime,
                                lastModified: Date.now()
                            });

                            resolve({
                                file: newFile,
                                compressed: true,
                                originalSize: file.size,
                                newSize: newFile.size,
                                originalName: file.name,
                                newName: newFileName,
                                width,
                                height
                            });
                        }, CONFIG.targetMime, CONFIG.quality);
                    } catch (err) {
                        reject(err);
                    }
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        });
    }

    /**
     * Tampilkan notifikasi badge status kompresi di bawah input file
     */
    function showCompressionBadge(input, results) {
        let badgeContainer = input.parentElement.querySelector('.webp-compress-info');
        if (!badgeContainer) {
            badgeContainer = document.createElement('div');
            badgeContainer.className = 'webp-compress-info';
            badgeContainer.style.cssText = 'margin-top: 6px; font-size: 12px; line-height: 1.4; transition: all 0.3s ease;';
            input.parentElement.appendChild(badgeContainer);
        }

        const validResults = results.filter(r => r && r.compressed);
        if (validResults.length === 0) {
            badgeContainer.innerHTML = '';
            return;
        }

        let html = '';
        validResults.forEach(r => {
            const hemat = Math.max(0, Math.round(((r.originalSize - r.newSize) / r.originalSize) * 100));
            html += `
                <div style="background-color: #e8f5e9; color: #2e7d32; border: 1px solid #c8e6c9; border-radius: 4px; padding: 6px 10px; margin-bottom: 4px;">
                    <i class="fa fa-check-circle" style="margin-right: 4px;"></i>
                    <strong>✓ Gambar Terkompresi ke WebP:</strong> 
                    <code>${r.newName}</code> (${r.width}x${r.height}px)
                    <br>
                    <span style="color: #555;">Ukuran: <strong>${formatBytes(r.originalSize)}</strong> &rarr; <strong>${formatBytes(r.newSize)}</strong></span>
                    ${hemat > 0 ? `<span style="background: #2e7d32; color: #fff; padding: 1px 6px; border-radius: 10px; font-size: 11px; margin-left: 6px;">Hemat ${hemat}%</span>` : ''}
                </div>
            `;
        });

        badgeContainer.innerHTML = html;
    }

    /**
     * Handler ketika input file berubah
     */
    async function handleFileInputChange(event) {
        const input = event.target;
        if (!input || input.type !== 'file' || !input.files || input.files.length === 0) {
            return;
        }

        // Hindari loop jika input dimodifikasi oleh DataTransfer kita sendiri
        if (input.dataset.compressing === 'true') {
            return;
        }

        const files = Array.from(input.files);
        const hasImages = files.some(f => CONFIG.imageTypes.includes(f.type) || f.name.match(/\.(jpg|jpeg|png|bmp|gif|webp)$/i));

        if (!hasImages) {
            return;
        }

        try {
            input.dataset.compressing = 'true';

            // Tampilkan loading sementara
            let badgeContainer = input.parentElement.querySelector('.webp-compress-info');
            if (!badgeContainer) {
                badgeContainer = document.createElement('div');
                badgeContainer.className = 'webp-compress-info';
                badgeContainer.style.cssText = 'margin-top: 6px; font-size: 12px;';
                input.parentElement.appendChild(badgeContainer);
            }
            badgeContainer.innerHTML = '<span style="color: #0288d1;"><i class="fa fa-spinner fa-spin"></i> Mengompres resolusi dan mengonversi gambar ke WebP...</span>';

            const compressionPromises = files.map(file => compressImage(file));
            const results = await Promise.all(compressionPromises);

            // Ganti isi FileList pada input file menggunakan DataTransfer
            const dataTransfer = new DataTransfer();
            results.forEach(res => {
                dataTransfer.items.add(res.file);
            });

            input.files = dataTransfer.files;
            showCompressionBadge(input, results);
        } catch (err) {
            console.error('Error saat kompresi WebP client:', err);
        } finally {
            input.dataset.compressing = 'false';
        }
    }

    // Inisialisasi event listener secara delegatif untuk menangani form biasa maupun AJAX/modal
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            document.addEventListener('change', handleFileInputChange, true);
        });
    } else {
        document.addEventListener('change', handleFileInputChange, true);
    }
})();
