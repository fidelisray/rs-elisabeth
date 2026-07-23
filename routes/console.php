<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

/*
 * Konfigurasi Cron Job / Task Scheduling
 * --------------------------------------
 * Instruksi:
 * Secara default, dibawah ini di-setting untuk TESTING (berjalan setiap menit).
 * Jika sudah masuk production, uncomment bagian 'Production' dan comment bagian 'Testing'.
 */

// --- TESTING: Berjalan setiap 30 menit (Untuk uji coba agar tidak memberatkan server) ---
Schedule::command('cache:clear')
    ->everyThirtyMinutes()
    ->then(function () {
        Artisan::call('dokter:fetch-all');
    });

// --- PRODUCTION: Berjalan setiap jam 4 pagi ---
// Schedule::command('cache:clear')
//     ->dailyAt('04:00')
//     ->then(function () {
//         Artisan::call('dokter:fetch-all');
//     });
