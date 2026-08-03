<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

/**
 * Aturan validasi custom untuk foto ruangan.
 *
 * Syarat:
 *  - Rasio 16:9 (toleransi ±5%)
 *  - Resolusi: salah satu dari 1280×720 atau 1920×1080
 *  - Ukuran file ≤ 1 MB (sudah ditangani ->maxSize(), ini sebagai double-check)
 */
class ImageRoomSpec implements ValidationRule
{
    // Resolusi yang diizinkan (width × height)
    private const ALLOWED_DIMENSIONS = [
        ['width' => 1280, 'height' => 720],
        ['width' => 1920, 'height' => 1080],
    ];

    private const TARGET_RATIO = 16 / 9;  // ≈ 1.7778
    private const RATIO_TOLERANCE = 0.05; // ±5%
    private const MAX_FILE_SIZE = 1024 * 1024; // 1 MB dalam byte

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // $value adalah instance Illuminate\Http\UploadedFile / Livewire TemporaryUploadedFile
        // Keduanya extend SplFileInfo sehingga getRealPath() pasti tersedia.
        if (! ($value instanceof \SplFileInfo)) {
            return; // Biarkan validator lain yang menangani type mismatch
        }

        $path = $value->getRealPath();

        if (! $path || ! file_exists($path)) {
            // File belum ada di temp (edge-case), skip
            return;
        }

        // ── 1. Cek ukuran file ──────────────────────────────────────────
        $sizeInBytes = $value->getSize();
        if ($sizeInBytes > self::MAX_FILE_SIZE) {
            $fail('Ukuran foto tidak boleh melebihi 1 MB. File Anda: ' . round($sizeInBytes / 1024) . ' KB.');
            return;
        }

        // ── 2. Cek dimensi & rasio ──────────────────────────────────────
        $imageInfo = @getimagesize($path);
        if (! $imageInfo) {
            $fail('File yang diunggah bukan gambar yang valid.');
            return;
        }

        [$width, $height] = $imageInfo;

        if ($height === 0) {
            $fail('Gambar memiliki dimensi tidak valid.');
            return;
        }

        // Cek rasio 16:9
        $ratio = $width / $height;
        if (abs($ratio - self::TARGET_RATIO) > self::RATIO_TOLERANCE) {
            $fail(
                "Foto harus memiliki rasio 16:9. " .
                "Dimensi Anda: {$width}×{$height}px " .
                "(rasio " . number_format($ratio, 2) . ":1)."
            );
            return;
        }

        // Cek apakah resolusi masuk dalam whitelist
        $isAllowed = false;
        foreach (self::ALLOWED_DIMENSIONS as $dim) {
            if ($width === $dim['width'] && $height === $dim['height']) {
                $isAllowed = true;
                break;
            }
        }

        if (! $isAllowed) {
            $fail(
                "Resolusi foto tidak sesuai. Gunakan 1280×720 atau 1920×1080 px. " .
                "Dimensi Anda: {$width}×{$height}px."
            );
            return;
        }
    }
}
