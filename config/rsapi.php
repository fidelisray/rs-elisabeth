<?php

return [
    'base_url' => env('RS_API_BASE_URL'),
    'api_key' => env('RS_API_KEY'),
    'timeout' => env('RS_API_TIMEOUT'),
    'medin_endpoint' => env('RS_MEDIN_ENDPOINT'),
    'medin_consid' => env('RS_MEDIN_API_CONSID'),
    'medin_secretkey' => env('RS_MEDIN_API_SECRETKEY'),

    // Kredensial untuk generate token
    'auth' => [
        'endpoint' => env('RS_API_AUTH_ENDPOINT'),
        'username' => env('RS_API_USERNAME'),
        'password' => env('RS_API_PASSWORD'),
    ],

    'token_ttl_buffer' => env('RS_API_TOKEN_BUFFER', 60),

    'cache_ttl' => [
        'dokter' => 3600,
        'units' => 3600,
        'specialty' => 3600,
        'dokter_by_speciality' => 3600,
        'staff' => 3600,
        'jadwal' => 1800,
        'klinik' => 1800,
    ],
];