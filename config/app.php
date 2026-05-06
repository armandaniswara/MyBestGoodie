<?php

// Tambahkan baris ini ke dalam array di config/app.php
// di bagian bawah sebelum penutup array ]

/*
|--------------------------------------------------------------------------
| Konfigurasi Tambahan MyBestGoodie
|--------------------------------------------------------------------------
| Tambahkan baris berikut ke dalam file config/app.php yang sudah ada,
| di dalam array return [...]:
|
|   'whatsapp_number' => env('WHATSAPP_NUMBER', '6281219632138'),
|
*/

return [

    /*
    |----------------------------------------------------------------------
    | Application Name
    |----------------------------------------------------------------------
    */
    'name' => env('APP_NAME', 'My Best Goodie'),

    'env'   => env('APP_ENV', 'production'),
    'debug' => (bool) env('APP_DEBUG', false),
    'url'   => env('APP_URL', 'http://localhost'),

    /*
    |----------------------------------------------------------------------
    | Nomor WhatsApp Bisnis
    |----------------------------------------------------------------------
    | Format: kode negara + nomor tanpa tanda +
    | Contoh: 6281219632138 (Indonesia)
    */
    'whatsapp_number' => env('WHATSAPP_NUMBER', '6281219632138'),

    /*
    |----------------------------------------------------------------------
    | Timezone & Locale
    |----------------------------------------------------------------------
    */
    'timezone' => 'Asia/Jakarta',
    'locale'   => 'id',
    'fallback_locale' => 'en',
    'faker_locale'    => 'id_ID',

    'key'    => env('APP_KEY'),
    'cipher' => 'AES-256-CBC',

    'providers' => [
        // Laravel Framework Service Providers
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,
        App\Providers\AppServiceProvider::class,
    ],

    'aliases' => \Illuminate\Support\Facades\Facade::defaultAliases()->merge([
        // Tambahkan alias custom di sini jika perlu
    ])->toArray(),

];
