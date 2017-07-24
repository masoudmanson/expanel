<?php

return [
    'oracle' => [
        'driver' => 'oracle',
        'host' => env('DB_HOST', '172.16.1.133'),
        'port' => env('DB_PORT', '1521'),
        'database' => env('DB_DATABASE', 'oradb'),
        'username' => env('DB_USERNAME', 'fanex'),
        'password' => env('DB_PASSWORD', 'fanex'),
        'charset' => env('DB_CHARSET', 'AL32UTF8'),
        'prefix' => env('DB_PREFIX', ''),
        'prefix_schema' => env('DB_SCHEMA_PREFIX', ''),
    ],
];
