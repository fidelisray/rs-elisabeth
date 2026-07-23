<?php

namespace App\Console\Commands;

use App\Services\HospitalApiService;
use Illuminate\Console\Command;

class RefreshGlossaryCache extends Command
{
    protected $signature   = 'glossary:refresh';
    protected $description = 'Refresh cache kamus medis dari API';

    public function handle(HospitalApiService $apiService): void
    {
        $this->info('Menghapus cache lama...');
        $items = $apiService->refreshGlossaryCache();

        $this->info("✅ Cache berhasil diperbarui. Total istilah: " . count($items));
    }
}