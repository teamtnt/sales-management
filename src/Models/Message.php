<?php

namespace Teamtnt\SalesManagement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table;

    protected $fillable = [
        'subject',
        'body',
        'from_email',
        'from_name',
    ];

    public function __construct(array $attributes = [])
    {
        $this->table = config('sales-management.tablePrefix').'messages';
        parent::__construct($attributes);
    }

}
