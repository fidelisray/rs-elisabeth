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
}