<?php

// config for Teamtnt/SalesManagement
return [
    'logoPath' => '',
    'logoLink' => '/',
    'tablePrefix' => 'sales_management_',
    'prefix' => '',
    'permission_prefix' => 'sales_management',
    'middleware' => ['web', 'auth'],
    'userModel' => \App\Models\User::class,
    'emails' => [
        'info@primeros.de' => 'Example',
    ],
    'mail' => [
        'name' => 'PRIMEROS',
        'logo' => 'https://app.primeros.de/assets/img/logo.png'
    ],
    'policy' => \Teamtnt\SalesManagement\Policies\SalesManagementPolicy::class,
];
