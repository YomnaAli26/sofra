<?php

return [
    'mode' => env('PAYPAL_MODE', 'sandbox'), // Can be 'sandbox' or 'live'
    'client_id' => env('PAYPAL_CLIENT_ID'),
    'secret' => env('PAYPAL_SECRET'),
    'settings' => [
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path('logs/paypal.log'),
        'log.LogLevel' => 'DEBUG', // Available options: DEBUG, INFO, WARNING, ERROR
    ],
];
