<?php

return [
    'name' => env('APP_NAME', 'Laravel Filament Starter'),
    'env' => env('APP_ENV', 'production'),
    'debug' => (bool) env('APP_DEBUG', false),
    'url' => env('APP_URL', 'http://localhost'),
    'timezone' => 'Europe/Amsterdam',
    'locale' => env('APP_LOCALE', 'nl'),
    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),
    // Supported languages: code => label shown in the language switcher.
    // Add a language here AND create lang/<code>/messages.php.
    'locales' => [
        'nl' => '🇳🇱 Nederlands',
        'en' => '🇬🇧 English',
    ],
    'faker_locale' => env('APP_FAKER_LOCALE', 'en_US'),
    'cipher' => 'AES-256-CBC',
    'key' => env('APP_KEY'),
    'previous_keys' => [
        ...array_filter(
            explode(',', (string) env('APP_PREVIOUS_KEYS', ''))
        ),
    ],
    'maintenance' => [
        'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),
        'store' => env('APP_MAINTENANCE_STORE', 'database'),
    ],
];
