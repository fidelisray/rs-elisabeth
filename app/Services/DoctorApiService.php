<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class DoctorApiService
{
    /**
     * Create a new class instance.
     */
    protected string $baseUrl;
    protected string $medinEndpoint;
    protected string $apiKey;
    protected int $timeout;

    protected const TOKEN_CACHE_KEY = null;
    // protected const TOKEN_CACHE_KEY = 'hospital_api_token';

    public function __construct()
    {
        $this->baseUrl = config('rsapi.base_url');
        $this->medinEndpoint = config('rsapi.medin_endpoint');
        $this->apiKey = config('rsapi.api_key');
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
        // $token = $this->getValidToken();

        // dd($token);

        date_default_timezone_set('Asia/Jakarta');

        $consid = "123456";
        $secretKey = "0034T2";

        $tStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
        $signature = hash_hmac('sha256', $tStamp . $consid, $secretKey, true);
        $encodedSignature = base64_encode($signature);

        return Http::withHeaders([
            // 'Authorization' => 'Bearer ' . $this->apiKey,
            'X-Cons-ID' => $consid,
            'X-Timestamp' => $tStamp,
            'X-Signature' => $encodedSignature,
            'Accept'  => 'application/json',
        ])->timeout($this->timeout);
    }

    /**
     * Ambil daftar dokter, 
     * setup cache 
     */
    public function getDaftarUnits(array $filters = []): array
    {
        $cacheKey = 'units_' . md5(serialize($filters));
        $ttl      = config('rsapi.cache_ttl.units');

        return Cache::remember($cacheKey, $ttl, function () use ($filters) {
            try {
                $response = $this->apiRequest()
                    ->get("{$this->baseUrl}{$this->medinEndpoint}/api/reference/master/lst_hsu");

                // Dump struktur response, lalu stop eksekusi
                
                if ($response->successful()) {
                    // echo gettype(json_decode($response->json('Data')));
                    // dd(json_decode($response->json('Data')));
                    
                    return json_decode($response->json('Data', []));
                }

                Log::warning('API dokter gagal', [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);
                return [$response->status(), $response->body()];

            } catch (\Exception $e) {
                Log::error('Gagal connect ke API RS', ['error' => $e->getMessage()]);
                return ["Gagal conncect ke API RS -request DaftarUnits"];
            }
        });
    }

    // public function getDaftarDokter(array $filters = []): array
    // {
    //     $cacheKey = 'dokter_' . md5(serialize($filters));
    //     $ttl      = config('rsapi.cache_ttl.dokter');

    //     return Cache::remember($cacheKey, $ttl, function () use ($filters) {
    //         try {
    //             $response = $this->apiRequest()
    //                 ->get("{$this->baseUrl}{$this->medinEndpoint}/api/physician/list/doctor-schedule/PL-02");

    //             // Dump struktur response, lalu stop eksekusi
    //             // dd($response->json());

    //             if ($response->successful()) {
    //                 return $response->json('Data', []);
    //             }

    //             Log::warning('API dokter gagal', [
    //                 'status' => $response->status(),
    //                 'body'   => $response->body(),
    //             ]);
    //             return [];

    //         } catch (\Exception $e) {
    //             Log::error('Gagal connect ke API RS', ['error' => $e->getMessage()]);
    //             return [];
    //         }
    //     });
    // }
    
    public function getDaftarDokterByUnitId(string $id): array
    {
        $cacheKey = 'dokterUnitId_'.$id;
        $ttl      = config('rsapi.cache_ttl.dokter');

        return Cache::remember($cacheKey, $ttl, function () use ($id) {
            try {
                $response = $this->apiRequest()
                    ->get("{$this->baseUrl}{$this->medinEndpoint}/api/physician/list/doctor-schedule/{$id}");

                // Dump struktur response, lalu stop eksekusi
                // dd($response->json());

                if ($response->successful()) {
                    return $response->json('Data', []);
                }

                Log::warning('API dokter gagal', [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);
                return [$response->status(), $response->body()];

            } catch (\Exception $e) {
                Log::error('Gagal connect ke API RS', ['error' => $e->getMessage()]);
                return ["Gagal conncect ke API RS -request DaftarDokterByUnitId"];
            }
        });
    }

    public function getDaftarSpesialisasi(): array
    {
        $cacheKey = 'specialty_';
        $ttl      = config('rsapi.cache_ttl.specialty');

        return Cache::remember($cacheKey, $ttl, function () {
            try {
                $response = $this->apiRequest()
                    ->get("{$this->baseUrl}{$this->medinEndpoint}/api/reference/master/lst_spc");

                // Dump struktur response, lalu stop eksekusi
                // dd(json_decode($response->json('Data')));

                if ($response->successful()) {
                    return json_decode($response->json('Data', []));
                }

                Log::warning('API dokter gagal', [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);
                return [$response->status(), $response->body()];

            } catch (\Exception $e) {
                Log::error('Gagal connect ke API RS', ['error' => $e->getMessage()]);
                return ["Gagal conncect ke API RS -request DaftarDokterByUnitId"];
            }
        });
    }

    public function getDokterBySpesialisasi(string $specialtyCode): array
    {
        $cacheKey = 'specialty_' . $specialtyCode;
        $ttl      = config('rsapi.cache_ttl.specialty');

        return Cache::remember($cacheKey, $ttl, function () use($specialtyCode) {
            try {
                $response = $this->apiRequest()
                    ->get("{$this->baseUrl}{$this->medinEndpoint}/api/paramedicschedule/base/list/specialty/{$specialtyCode}");

                // Dump struktur response, lalu stop eksekusi
                // dd($response->json('Data'));
                // dd(json_decode($response->json('Data')));

                if ($response->successful()) {
                    // dd(json_decode($response->json('Data', [])));

                    $data = json_decode($response->json('Data'));

                    $response_data = [
                        "LeaveSchedule" => $data->LeaveSchedule,
                        "ScheduleByDate" => $data->ScheduleByDate,
                        "ScheduleRoutine" => $data->ScheduleRoutine,
                    ];

                    return $response_data;
                }

                Log::warning('API dokter gagal', [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);
                return [$response->status(), $response->body()];

            } catch (\Exception $e) {
                Log::error('Gagal connect ke API RS', ['error' => $e->getMessage()]);
                return ["Gagal conncect ke API RS -request DaftarDokterByUnitId"];
            }
        });
    }
}
