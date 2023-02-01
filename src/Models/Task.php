<?php

namespace Teamtnt\SalesManagement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table;

    protected $fillable = [
        'name',
        'description',
        'pipeline_id',
    ];

    public function __construct(array $attributes = [])
    {
        $this->table = config('sales-management.tablePrefix').'tasks';
        parent::__construct($attributes);
    }

    public function pipeline()
    {
        return $this->belongsTo(Pipeline::class);
    }

    public function getLeads()
    {
        return Contact::limit(100)->get();
    }
}
