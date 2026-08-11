<?php

use Monolog\Handler\StreamHandler;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Log Channel
    |--------------------------------------------------------------------------
    |
    | New in Laravel 5.6: logging configuration moved out of config/app.php
    | ('log' and 'log_level') into this file, and is now channel-based.
    |
    */

    'default' => env('LOG_CHANNEL', 'stack'),

    /*
    |--------------------------------------------------------------------------
    | Log Channels
    |--------------------------------------------------------------------------
    |
    | Under Docker the 'stderr' channel is the useful one — it surfaces in
    | `docker compose logs app` alongside Apache's output.
    |
    */

    'channels' => [

        'stack' => [
            'driver'   => 'stack',
            'channels' => ['single'],
        ],

        'single' => [
            'driver' => 'single',
            'path'   => storage_path('logs/laravel.log'),
            'level'  => env('LOG_LEVEL', 'debug'),
        ],

        'daily' => [
            'driver' => 'daily',
            'path'   => storage_path('logs/laravel.log'),
            'level'  => env('LOG_LEVEL', 'debug'),
            'days'   => 14,
        ],

        'stderr' => [
            'driver'  => 'monolog',
            'handler' => StreamHandler::class,
            'with'    => [
                'stream' => 'php://stderr',
            ],
        ],

        'syslog' => [
            'driver' => 'syslog',
            'level'  => env('LOG_LEVEL', 'debug'),
        ],

        'errorlog' => [
            'driver' => 'errorlog',
            'level'  => env('LOG_LEVEL', 'debug'),
        ],

    ],

];
