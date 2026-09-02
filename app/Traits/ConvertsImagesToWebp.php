<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

/**
 * Trait ConvertsImagesToWebp
 *
 * Secara otomatis mengkonversi file gambar yang baru di-upload (JPG/PNG)
 * menjadi format WebP yang teroptimasi setelah data model disimpan.
 *
 * Cara pakai:
 * 1. Tambahkan `use ConvertsImagesToWebp;` pada Model Eloquent.
 * 2. Implementasikan method `getWebpFields()` yang me-return array berisi
 *    nama-nama kolom yang menyimpan path gambar.
 *    Contoh: return ['image_path']; atau return ['thumbnail'];
 *
 * Trait ini menangani dua hal sekaligus:
 * a) Konversi file fisik di storage dari .jpg/.png menjadi .webp
 * b) Update kolom path di database agar menunjuk ke file .webp yang baru
 *    (mencegah gambar broken di frontend)
 */
trait ConvertsImagesToWebp
{
    /**
     * Kualitas output WebP (0-100).
     * 82 adalah sweet spot antara kualitas visual & ukuran file.
     */
    protected int $webpQuality = 82;

    /**
     * Daftarkan hook konversi WebP saat model diinisialisasi.
     */
    public static function bootConvertsImagesToWebp(): void
    {
        static::saved(function (self $model) {
            $model->convertFieldsToWebp();
        });
    }

    /**
     * Kembalikan array nama kolom yang menyimpan path gambar.
     * Wajib diimplementasikan di setiap Model yang menggunakan Trait ini.
     *
     * @return array<int, string>
     */
    abstract protected function getWebpFields(): array;

    /**
     * Proses konversi untuk seluruh kolom gambar yang didaftarkan.
     */
    protected function convertFieldsToWebp(): void
    {
        $needsUpdate = false;
        $updates     = [];

        foreach ($this->getWebpFields() as $field) {
            $currentPath = $this->getRawOriginal($field) ?? $this->getAttribute($field);

            if (empty($currentPath)) {
                continue;
            }

            // Lewati jika sudah berformat .webp
            if (str_ends_with(strtolower($currentPath), '.webp')) {
                continue;
            }

            $disk     = 'public';
            $fullPath = Storage::disk($disk)->path($currentPath);

            // Lewati jika file fisik tidak ditemukan di storage
            if (! file_exists($fullPath)) {
                continue;
            }

            $webpPath = $this->convertToWebp($fullPath, $currentPath);

            if ($webpPath && $webpPath !== $currentPath) {
                // Hapus file asli (.jpg/.png) setelah konversi berhasil
                Storage::disk($disk)->delete($currentPath);

                $updates[$field] = $webpPath;
                $needsUpdate     = true;
            }
        }

        // Update kolom path di database (tanpa memicu event saved() lagi)
        if ($needsUpdate) {
            $this->updateQuietly($updates);
        }
    }

    /**
     * Lakukan konversi file gambar ke format WebP menggunakan Intervention Image.
     *
     * @param  string  $fullPath    Path absolut file asli di server.
     * @param  string  $storagePath Path relatif file di storage (misal: "room-facilities/abc.jpg").
     * @return string|null          Path relatif file WebP yang baru, atau null jika gagal.
     */
    protected function convertToWebp(string $fullPath, string $storagePath): ?string
    {
        try {
            $manager = new ImageManager(new Driver());
            $image   = $manager->decodePath($fullPath);

            // Ganti ekstensi file menjadi .webp
            $webpStoragePath = preg_replace('/\.(jpe?g|png|gif|bmp)$/i', '.webp', $storagePath);
            $webpFullPath    = Storage::disk('public')->path($webpStoragePath);

            // Pastikan direktori tujuan ada
            $webpDir = dirname($webpFullPath);
            if (! is_dir($webpDir)) {
                mkdir($webpDir, 0755, true);
            }

            // Encode dan simpan sebagai WebP (Intervention v4 membaca format dari ekstensi file)
            $image->save($webpFullPath, $this->webpQuality);

            return $webpStoragePath;
        } catch (\Throwable $e) {
            // Log error tanpa menghentikan proses simpan data
            \Illuminate\Support\Facades\Log::warning("ConvertsImagesToWebp: Gagal mengkonversi gambar.", [
                'model' => static::class,
                'path'  => $storagePath,
                'error' => $e->getMessage(),
            ]);

            return null;
        }
    }
}
