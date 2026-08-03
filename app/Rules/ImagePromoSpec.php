<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\ValidationRule;
use Closure;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ImagePromoSpec implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Pastikan file yang divalidasi adalah instance dari TemporaryUploadedFile (Livewire)
        if (!($value instanceof TemporaryUploadedFile)) {
            $fail('File tidak valid atau gagal diupload.');
            return;
        }

        // 1. Validasi Ukuran (Maksimal 2 MB = 2048 KB)
        $maxSizeKb = 2048;
        $sizeKb = $value->getSize() / 1024;
        
        if ($sizeKb > $maxSizeKb) {
            $fail('Ukuran file foto maksimal 2 MB.');
            return;
        }

        // 2. Validasi Dimensi dan Rasio
        $path = $value->getRealPath();
        
        if (!$path || !file_exists($path)) {
            $fail('File fisik tidak ditemukan saat diproses.');
            return;
        }

        $info = @getimagesize($path);
        if (!$info) {
            $fail('File yang diupload bukan gambar yang valid.');
            return;
        }

        $width = $info[0];
        $height = $info[1];

        // Mencegah error division by zero
        if ($height === 0) {
            $fail('Dimensi gambar tidak valid.');
            return;
        }

        // Rasio A4 Portrait / Flyer Promo (sekitar 0.70)
        // Gambar referensi adalah 1127 x 1600 (Rasio: 0.704)
        $ratio = $width / $height;

        // Toleransi rasio antara 0.65 sampai 0.85 (Portrait)
        if ($ratio < 0.65 || $ratio > 0.85) {
            $fail("Rasio foto harus Portrait / Flyer (misal: 1127x1600 px). Rasio gambar ini adalah " . round($ratio, 2) . " ($width x $height px).");
            return;
        }
    }
}
