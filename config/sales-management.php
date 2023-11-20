<?php

// config for Teamtnt/SalesManagement
return [
    'logoPath' => '',
    'logoLink' => '/',
    'tablePrefix' => 'sales_management_',
    'prefix' => '',
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
    'waitingTimes' => [
        [
            'label' => '3 days (skip weekends)',
            'hours' => 72,
            'skipWeekends' => true,
            'id' => '72sw', //must have this unique value for state machine naming
        ],
        [
            'label' => '14 days (skip weekends)',
            'hours' => 336,
            'skipWeekends' => true,
            'id' => '336sw',
        ],
    ],
];
