<?php

use App\Models\User;

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    */

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        // GUARD KHUSUS UNTUK REDKAR
        'redkar' => [
            'driver' => 'session',
            'provider' => 'redkar',
        ],

        // GUARD KHUSUS UNTUK PEMOHON PUBLIK
        'pemohon' => [
            'driver' => 'session',
            'provider' => 'pemohons',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        // PROVIDER KHUSUS UNTUK REDKAR
        'redkar' => [
            'driver' => 'eloquent',
            'model' => App\Models\PendaftarRedkar::class,
        ],

        // PROVIDER KHUSUS UNTUK PEMOHON PUBLIK
        'pemohons' => [
            'driver' => 'eloquent',
            // Pastikan nama model pemohon Anda sesuai (misal: Pemohon atau PemohonPublik)
            'model' => App\Models\Pemohon::class, 
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];