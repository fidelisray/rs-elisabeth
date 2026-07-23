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

    // protected const TOKEN_CACHE_KEY = null;
    protected const TOKEN_CACHE_KEY = 'hospital_api_token';

    public function __construct()
    {
        $this->baseUrl = config('rsapi.base_url');
        $this->apiKey  = config('rsapi.api_key');
        $this->timeout = config('rsapi.timeout');
    }

    /**
     * Ambil token yang valid.
     * Jika token di cache masih ada → pakai itu.
     * Jika tidak ada / expired → generate baru dari API.
     */
    protected function getValidToken(): string
    {
        // Coba ambil dari cache dulu
        $cachedToken = Cache::get(self::TOKEN_CACHE_KEY);

        if ($cachedToken != null) {
            return $cachedToken;
        } else {
            // Tidak ada di cache → generate baru
            return $this->generateNewToken();
        }

    }

    /**
     * Hit endpoint auth untuk mendapatkan token baru,
     * lalu simpan ke cache.
     */
    protected function generateNewToken(): string
    {
        $authEndpoint = config('rsapi.auth.endpoint');
        $buffer       = config('rsapi.token_ttl_buffer', 60);

        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
            ])
            ->timeout($this->timeout)
            ->post($this->baseUrl . $authEndpoint, [
                'username' => config('rsapi.auth.username'),
                'password' => config('rsapi.auth.password'),
            ]);

            // cek token yang berhasil di-generate
            // dd($response->json());

            if ($response->successful()) {
                $data = $response->json();

                
                // Sesuaikan key ini dengan response auth API kamu
                // Setelah dd($response->json()) kamu tahu struktur pastinya
                // $token     = $data['token']      ?? $data['access_token'] ?? null;
                $token = $data['X-Token'] ?? null;
                
                // dd($token);
                
                if (!$token) {
                    Log::error('X-Token tidak ditemukan di response', [
                        'response' => $data
                    ]);
                    return $this->apiKey;
                }
                        
                // if (!$token) {
                //     Log::error('Token tidak ditemukan di response auth', [
                //         'response' => $data
                //     ]);
                //     // Fallback ke api_key statis dari .env
                //     return $this->apiKey;
                // }
                                
                // Simpan ke cache dengan TTL dikurangi buffer
                // Contoh: expires_in = 300 detik, buffer = 60 detik
                // Maka cache selama 240 detik → token pasti masih valid saat dipakai
                $expiresIn = 300; // default 5 menit
                $cacheTtl = max(1, $expiresIn - $buffer);

                Cache::put(self::TOKEN_CACHE_KEY, $token, $cacheTtl);

                Log::info('Token baru berhasil di-generate', [
                    'expires_in' => $expiresIn,
                    'cached_for' => $cacheTtl . ' detik',
                ]);

                return $token;
            }

            Log::error('Gagal generate token baru', [
                'status'   => $response->status(),
                'response' => $response->body(),
            ]);

            // Fallback ke api_key statis
            return $this->apiKey;

        } catch (\Exception $e) {
            Log::error('Exception saat generate token', [
                'error' => $e->getMessage()
            ]);

            return $this->apiKey;
        }
    }

    /**
     * Paksa invalidate token di cache dan generate baru.
     * Dipanggil ketika response API mengembalikan 401 Unauthorized.
     */
    protected function refreshToken(): string
    {
        Cache::forget(self::TOKEN_CACHE_KEY);
        return $this->generateNewToken();
    }

    // =========================================================
    // HTTP CLIENT
    // =========================================================

    protected function apiRequest(): \Illuminate\Http\Client\PendingRequest
    {   
        $token = $this->getValidToken();

        // dd($token);

        return Http::withHeaders([
            // 'Authorization' => 'Bearer ' . $this->apiKey,
            'X-Token' => $token,
            'Accept'  => 'application/json',
        ])->timeout($this->timeout);
    }

    /**
     * Wrapper request dengan auto-retry jika token expired (401).
     * Mencoba maksimal 2 kali:
     *   Percobaan 1 → pakai token dari cache
     *   Percobaan 2 → generate token baru lalu coba lagi
     */
    protected function requestWithRetry(string $method, string $endpoint, array $params = []): array
    {
        $maxRetry = 2;

        for ($attempt = 1; $attempt <= $maxRetry; $attempt++) {
            try {
                $request = $this->apiRequest();

                $response = match(strtoupper($method)) {
                    'GET'  => $request->get($this->baseUrl . $endpoint, $params),
                    'POST' => $request->post($this->baseUrl . $endpoint, $params),
                    default => $request->get($this->baseUrl . $endpoint, $params),
                };

                // dd($response);
                // Sukses → kembalikan data
                if ($response->successful()) {
                    return $response->json() ?? [];
                }

                // 401 Unauthorized → token expired, refresh dan coba lagi
                if ($response->status() === 401 && $attempt < $maxRetry) {
                    Log::warning("Token expired (401), mencoba refresh token... [attempt {$attempt}]");
                    $this->refreshToken();
                    continue; // lanjut ke iterasi berikutnya (attempt 2)
                }

                // Error lain (404, 500, dll)
                Log::warning('API request gagal', [
                    'endpoint' => $endpoint,
                    'status'   => $response->status(),
                    'attempt'  => $attempt,
                ]);

                return [];

            } catch (\Exception $e) {
                Log::error('Exception pada API request', [
                    'endpoint' => $endpoint,
                    'attempt'  => $attempt,
                    'error'    => $e->getMessage(),
                ]);

                if ($attempt >= $maxRetry) {
                    return [];
                }
            }
        }

        return [];
    }

    /**
     * Ambil daftar promoitions, 
     * setup cache 
     */
    public function getPromotionsList(string $category): array
    {
        $cacheKey = 'promotions_' . md5(serialize($category));
        $ttl      = config('rsapi.cache_ttl.promotions');

        return Cache::remember($cacheKey, $ttl, function () use ($category) {
            try {
                $response = $this->apiRequest()
                    ->withBody(json_encode([
                        "category" => $category
                    ]), 'application/json')
                    ->get("{$this->baseUrl}/ads");

                // Dump struktur response, lalu stop eksekusi
                // dd($response->json());

                if ($response->successful()) {
                    return $response->json('Data', []);
                }

                Log::warning('API promotions gagal', [
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
    
    public function getGlosarium(array $filters = []): array
    {
        $cacheKey = 'glosarium_';
        $ttl      = config('rsapi.cache_ttl.glosarium');

        return Cache::remember($cacheKey, $ttl, function () use ($filters) {
            $response = $this->requestWithRetry('GET', '/glossarium');

            $data = $response['Data'] ?? [];

            usort($data, fn($a, $b) => strcasecmp($a['istilah'], $b['istilah']));

            return $data ?? [];
        });
    }

    /**
     * Paksa refresh cache kamus medis (dipanggil manual / via Artisan).
     */
    public function refreshGlossaryCache(): array
    {
        // 1. Coba ambil data baru langsung dari API (bypass cache)
        try {
            $response = $this->requestWithRetry('GET', '/glossarium');
            $data = $response['Data'] ?? [];

            // 2. Jika data berhasil ditarik dan TIDAK kosong, timpa cache lama
            if (!empty($data)) {
                usort($data, fn($a, $b) => strcasecmp($a['istilah'], $b['istilah']));
                
                $ttl = config('rsapi.cache_ttl.glosarium');
                Cache::put('glosarium_', $data, $ttl);
                
                Log::info('Glossary cache refreshed successfully with fresh API data.');
                return $data;
            }
        } catch (\Exception $e) {
            Log::error('Failed to connect to API during glossary cache refresh: ' . $e->getMessage());
        }

        // 3. Jika API gagal / kosong, jangan hapus cache lama!
        Log::warning('Failed to refresh glossary cache: API offline or returned empty. Keeping old cache.');
        
        // Kembalikan cache lama yang masih ada agar command tidak error
        return Cache::get('glosarium_') ?? [];
    }


    /**
     * Filter glossary berdasarkan huruf awal.
     * Proses di PHP, tidak perlu request API lagi.
     */
    public function getGlossaryByLetter(string $letter): array
    {
        $all = $this->getGlosarium();

        if ($letter === 'ALL') {
            return $all;
        }

        return array_values(
            array_filter($all, fn($item) =>
                strtoupper(substr($item['istilah'], 0, 1)) === strtoupper($letter)
            )
        );
    }

    /**
     * Ambil glossary dikelompokkan berdasarkan 2 huruf pertama.
     * Memanfaatkan getGlossaryByLetter() yang sudah ada.
     */
    public function getGlossaryGrouped(string $letter = 'ALL'): array
    {
        $items   = $this->getGlossaryByLetter($letter); // pakai method lama
        $grouped = [];

        foreach ($items as $item) {
            $prefix            = strtoupper(substr($item['istilah'], 0, 2));
            $grouped[$prefix][] = $item;
        }

        ksort($grouped); // urutkan prefix-nya (Ba, Bi, Bu, dst)
        return $grouped;
    }


    /**
     * Ambil Articles
     */
    public function getArticles(string $category = 'artikel'): array
    {
        $cacheKey = "elisanews_";
        $ttl      = config('rsapi.cache_ttl.jadwal');

        return Cache::remember($cacheKey, $ttl, function () use ($category) {
            try {
                $response = $this->apiRequest()
                    ->withBody(json_encode([
                        "category" => $category
                    ]), 'application/json')
                    ->get("{$this->baseUrl}/articles");

                return $response->successful()
                    ? $response->json('Data', [])
                    : [];
            } catch (\Exception $e) {
                Log::error('Gagal ambil jadwal dokter', [
                    // 'dokter_id' => $dokterId,
                    'error'     => $e->getMessage(),
                ]);
                return [];
            }
        });
    }
}