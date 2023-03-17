<?php

// config for Teamtnt/SalesManagement
return [
    'logoPath'    => '',
    'logoLink'    => '/',
    'tablePrefix' => 'sales_management_',
    'middleware'  => ['web', 'auth'],
    'userModel'   => \App\Models\User::class,
    'emails'      => [
        'change.this.email.in.config@example.com' => 'Example',
    ],
];
