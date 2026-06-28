<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\DoctorApiService;

class FetchAllDoctor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-all-doctor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch semua data dokter dari seluruh speciality dan simpan ke cache';

    /**
     * Execute the console command.
     */
    public function handle(DoctorApiService $apiService)
    {
        //
        $this->info('Memulai fetch data dokter...');

        $total = $apiService->fetchAndCacheAllDokter();
        dd($total);

        $this->info("Selesai. Total {$total} entri jadwal dokter berhasil di-cache.");

        return Command::SUCCESS;
    }
}
