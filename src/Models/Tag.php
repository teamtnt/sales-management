<?php

namespace Teamtnt\SalesManagement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table;
    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        $this->table = config('sales-management.tablePrefix').'tags';
        parent::__construct($attributes);
    }

    public function contacts()
    {
        return $this->belongsToMany(Contact::class);
    }
}
