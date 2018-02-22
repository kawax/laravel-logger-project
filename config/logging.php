<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Log Channel
    |--------------------------------------------------------------------------
    |
    | This option defines the default log channel that gets used when writing
    | messages to the logs. The name specified in this option should match
    | one of the channels defined in the "channels" configuration array.
    |
    */

    'default' => env('LOG_CHANNEL', 'stack'),

    /*
    |--------------------------------------------------------------------------
    | Log Channels
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log channels for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Drivers: "single", "daily", "slack", "syslog",
    |                    "errorlog", "custom", "stack"
    |
    */

    'channels' => [
        'stack' => [
            'driver'   => 'stack',
            'channels' => ['single', 'cwlogs', 'chatwork'],
        ],

        'single' => [
            'driver' => 'single',
            'path'   => storage_path('logs/laravel.log'),
            'level'  => 'debug',
        ],

        'daily' => [
            'driver' => 'daily',
            'path'   => storage_path('logs/laravel.log'),
            'level'  => 'debug',
            'days'   => 7,
        ],

        'slack' => [
            'driver'   => 'slack',
            'url'      => env('LOG_SLACK_WEBHOOK_URL'),
            'username' => 'Laravel Log',
            'emoji'    => ':boom:',
            'level'    => 'critical',
        ],

        'syslog' => [
            'driver' => 'syslog',
            'level'  => 'debug',
        ],

        'errorlog' => [
            'driver' => 'errorlog',
            'level'  => 'debug',
        ],

        'cwlogs' => [
            'driver'    => 'custom',
            'via'       => Revolution\Laravel\Logger\CloudWatchLogs\CloudWatchLogger::class,
            'region'    => env('CWLOGS_REGION'),
            'key'       => env('CWLOGS_KEY'),
            'secret'    => env('CWLOGS_SECRET'),
            'group'     => env('CWLOGS_GROUP'),
            'stream'    => env('CWLOGS_STREAM'),
            'retention' => env('CWLOGS_RETENTION', 14),
            'level'     => 'error',
        ],

        'chatwork' => [
            'driver' => 'custom',
            'via'    => Revolution\Laravel\Logger\ChatWork\ChatWorkLogger::class,
            'token'  => env('CHATWORK_TOKEN'),
            'room'   => env('CHATWORK_ROOM'),
            'level'  => 'emergency',
        ],
    ],
];
