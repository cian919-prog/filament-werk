<?php

return [
    'default_filesystem_disk' => env('FILAMENT_FILESYSTEM_DISK', 'public'),
    'assets_path' => null,
    'livewire_loading_delay' => 'default',
    'file_generation' => [
        'flags' => [],
    ],
    'system_route_prefix' => 'filament',
    'broadcasting' => [
        'echo' => [
            'broadcaster' => 'reverb',
            'key' => env('VITE_REVERB_APP_KEY'),
            'cluster' => env('VITE_REVERB_APP_CLUSTER'),
            'wsHost' => env('VITE_REVERB_HOST'),
            'wsPort' => env('VITE_REVERB_PORT', 80),
            'wssPort' => env('VITE_REVERB_PORT', 443),
            'authEndpoint' => '/broadcasting/auth',
            'disableStats' => true,
            'encrypted' => true,
        ],
    ],
];
