<?php

return [
    'credentials' => storage_path('firebase/credentials.json'),
    'server_key' => env('FCM_SERVER_KEY'),
    'sender_id' => env('FCM_SENDER_ID'),
];
