<?php

return [
    'base_url' => env('RS_API_BASE_URL'),
    'api_key' => env('RS_API_KEY'),
    'timeout' => env('RS_API_TIMEOUT'),
    'cache_ttl' => [
        'dokter' => 3600,
        'staff' => 3600,
        'jadwal' => 1800,
        'klinik' => 1800,
    ],
];