<?php

namespace Teamtnt\SalesManagement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'firstname',
        'lastname',
        'phone',
        'email',
        'salutation'
    ];


    public function __construct(array $attributes = [])
    {
        $this->table = config('sales-management.tablePrefix').'contacts';
        parent::__construct($attributes);
    }
}
