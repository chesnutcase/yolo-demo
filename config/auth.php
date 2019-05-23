<?php

return [
    /*
    'defaults' => [
        'guard' => 'api',
        'passwords' => 'users',
    ],
    */

    'guards' => [
        'password' => [
            'driver' => 'password-login',
            'provider' => 'users',
        ],
        'api' => [
            'driver' => 'passport',
            'provider' => 'users',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => \App\User::class,
        ],
    ],
];
