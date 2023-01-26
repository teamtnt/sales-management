<?php

namespace Teamtnt\SalesManagement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table;

    protected $fillable = [
        'name',
        'vat',
        'url',
        'email',
        'address',
        'postal',
        'city',
        'country'
    ];

    public function __construct(array $attributes = [])
    {
        $this->table = config('sales-management.tablePrefix').'companies';
        parent::__construct($attributes);
    }
}
