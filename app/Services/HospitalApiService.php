<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class HospitalApiService
{
    protected string $baseUrl;
    protected string $apiKey;
    protected int $timeout;

    public function __construct()
    {
        $this->baseUrl = config('rsapi.base_url');
        $this->apiKey  = config('rsapi.api_key');
        $this->timeout = config('rsapi.timeout');
    }

    protected function apiRequest(): \Illuminate\Http\Client\PendingRequest
    {
        return Http::withHeaders([
            // 'Authorization' => 'Bearer ' . $this->apiKey,
            'x-token' => $this->apiKey,
            'Accept'  => 'application/json',
        ])->timeout($this->timeout);
    }

    /**
     * Ambil daftar dokter, 
     * setup cache 
     */
    public function getDaftarDokter(array $filters = []): array
    {
        $cacheKey = 'dokter_' . md5(serialize($filters));
        $ttl      = config('rsapi.cache_ttl.dokter');

        return Cache::remember($cacheKey, $ttl, function () use ($filters) {
            try {
                $response = $this->apiRequest()
                    ->get("{$this->baseUrl}/api/v1/dokter", $filters);

                // Dump struktur response, lalu stop eksekusi
                dd($response->json());

                if ($response->successful()) {
                    return $response->json('data', []);
                }

                Log::warning('API dokter gagal', [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);
                return [];

            } catch (\Exception $e) {
                Log::error('Gagal connect ke API RS', ['error' => $e->getMessage()]);
                return [];
            }
        });
    }
    
    public function getDaftarStaff(array $filters = []): array
    {
        $cacheKey = 'staff_' . md5(serialize($filters));
        $ttl      = config('rsapi.cache_ttl.staff');

        return Cache::remember($cacheKey, $ttl, function () use ($filters) {
            try {
                $response = $this->apiRequest()
                    ->get("{$this->baseUrl}/hr/employee/list");

                // Dump struktur response, lalu stop eksekusi
                dd($response->json());

                if ($response->successful()) {
                    return $response->json('data', []);
                }

                Log::warning('API Staff gagal', [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);
                return [];

            } catch (\Exception $e) {
                Log::error('Gagal connect ke API RS', ['error' => $e->getMessage()]);
                return [];
            }
        });
    }

    /**
     * Ambil jadwal praktek dokter
     */
    public function getJadwalDokter(int $dokterId): array
    {
        $cacheKey = "jadwal_dokter_{$dokterId}";
        $ttl      = config('rsapi.cache_ttl.jadwal');

        return Cache::remember($cacheKey, $ttl, function () use ($dokterId) {
            try {
                $response = $this->apiRequest()
                    ->get("{$this->baseUrl}/api/v1/dokter/{$dokterId}/jadwal");

                return $response->successful()
                    ? $response->json('data', [])
                    : [];

            } catch (\Exception $e) {
                Log::error('Gagal ambil jadwal dokter', [
                    'dokter_id' => $dokterId,
                    'error'     => $e->getMessage(),
                ]);
                return [];
            }
        });
    }
}