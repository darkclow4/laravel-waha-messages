<?php

return [

    /*
    |--------------------------------------------------------------------------
    | WAHA Server URL
    |--------------------------------------------------------------------------
    |
    | The base URL of your WAHA (WhatsApp HTTP API) server instance.
    |
    */

    'url' => env('WAHA_URL', 'http://localhost:3000'),

    /*
    |--------------------------------------------------------------------------
    | API Key
    |--------------------------------------------------------------------------
    |
    | The API key used for authenticating requests to the WAHA server.
    |
    */

    'api_key' => env('WAHA_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Default Session
    |--------------------------------------------------------------------------
    |
    | The default WhatsApp session name to use when no session is specified.
    |
    */

    'session' => env('WAHA_SESSION', 'default'),

    /*
    |--------------------------------------------------------------------------
    | Timeouts
    |--------------------------------------------------------------------------
    |
    | Configure request and connection timeouts in seconds.
    |
    */

    'timeout' => (int) env('WAHA_TIMEOUT', 30),

    'connect_timeout' => (int) env('WAHA_CONNECT_TIMEOUT', 10),

    /*
    |--------------------------------------------------------------------------
    | Retry Configuration
    |--------------------------------------------------------------------------
    |
    | Configure automatic retry behavior for failed requests.
    | - times: number of retry attempts
    | - sleep: milliseconds to wait between retries
    |
    */

    'retry' => [
        'times' => (int) env('WAHA_RETRY_TIMES', 3),
        'sleep' => (int) env('WAHA_RETRY_SLEEP', 100),
    ],

];
