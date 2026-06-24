<?php

return [
    'email' => env('ESERSPOR_ADMIN_EMAIL', 'admin@eserspor.com'),
    'password' => env('ESERSPOR_ADMIN_PASSWORD', 'admin123456'),

    'secondary' => [
        'name' => env('ESERSPOR_SECOND_ADMIN_NAME', 'Eser Spor Admin 2'),
        'email' => env('ESERSPOR_SECOND_ADMIN_EMAIL', 'admin2@eserspor.com'),
        'password' => env('ESERSPOR_SECOND_ADMIN_PASSWORD', 'admin2123456'),
    ],
];
