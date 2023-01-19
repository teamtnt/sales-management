<?php

namespace Teamtnt\SalesManagement\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Teamtnt\SalesManagement\SalesManagement
 */
class SalesManagement extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Teamtnt\SalesManagement\SalesManagement::class;
    }
}
