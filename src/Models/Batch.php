<?php

namespace Teamtnt\SalesManagement\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{

    protected $table;

    public function __construct(array $attributes = [])
    {
        $this->table = config('sales-management.tablePrefix').'batches';
        parent::__construct($attributes);
    }
}
