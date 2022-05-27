<?php

return [
    'name' => 'Sistem PBCT',
    'manifest' => [
        'name' => env('APP_NAME', 'Sistem PBCT'),
        'short_name' => 'Sistem PBCT',
        'start_url' => '/stats',
        'background_color' => '#ffffff',
        'theme_color' => '#18181b',
        'display' => 'standalone',
        'orientation'=> 'portrait-primary',
        'status_bar'=> 'black',
        'icons' => [
            '72x72' => [
                'path' => '/icons/icon-72x72.png',
                'purpose' => 'any'
            ],
            '96x96' => [
                'path' => '/icons/icon-96x96.png',
                'purpose' => 'any'
            ],
            '128x128' => [
                'path' => '/icons/icon-128x128.png',
                'purpose' => 'any'
            ],
            '144x144' => [
                'path' => '/icons/icon-144x144.png',
                'purpose' => 'any'
            ],
            '152x152' => [
                'path' => '/icons/icon-152x152.png',
                'purpose' => 'any'
            ],
            '192x192' => [
                'path' => '/icons/icon-192x192.png',
                'purpose' => 'any'
            ],
            '384x384' => [
                'path' => '/icons/icon-384x384.png',
                'purpose' => 'any'
            ],
            '512x512' => [
                'path' => '/icons/icon-512x512.png',
                'purpose' => 'any'
            ],
        ],
        'splash' => [
            '640x1136' => '/icons/splash-640x1136.png',
            '750x1334' => '/icons/splash-750x1334.png',
            '828x1792' => '/icons/splash-828x1792.png',
            '1125x2436' => '/icons/splash-1125x2436.png',
        ],
        'shortcuts' => [
            [
                'name' => 'Sistem PBCT',
                'description' => 'Sistem Kontrol dan Monitoring Prototype Alat Pembuat Bubuk Cangkang Telur',
                'url' => '/',
                'icons' => [
                    "src" => "/icons/icon-72x72.png",
                    "purpose" => "any"
                ]
            ],
        ],
        'custom' => []
    ]
];
