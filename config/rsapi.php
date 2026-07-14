<?php

return [
    'base_url' => env('RS_API_BASE_URL'),
    'api_key' => env('RS_API_KEY'),
    'timeout' => env('RS_API_TIMEOUT'),

    // Kredensial untuk generate token
    'auth' => [
        'endpoint' => env('RS_API_AUTH_ENDPOINT'),
        'username' => env('RS_API_USERNAME'),
        'password' => env('RS_API_PASSWORD'),
    ],

    'token_ttl_buffer' => env('RS_API_TOKEN_BUFFER', 60),

    'cache_ttl' => [
        'promotions' => 1800,
        'glosarium' => 86400,
    ],
];