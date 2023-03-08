<?php

// config for Teamtnt/SalesManagement
return [
    'logoPath'    => '',
    'logoLink'    => '/',
    'tablePrefix' => 'sales_management_',
    'middleware'  => ['web'],
    'userModel'   => \App\Models\User::class,
    'emails'      => [
        'info@primeros.de' => 'Primeros',
        'neki@random.mail' => 'Random',
    ],
];
