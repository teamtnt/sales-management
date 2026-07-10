<?php

namespace Teamtnt\SalesManagement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PipelineStage extends Model
{
    use HasFactory;

    protected $table;

    protected $fillable = [
        'pipeline_id',
        'name',
        'description',
        'color',
        'properties'
    ];

    protected $casts = [
        'properties' => 'array'
    ];

    public function __construct(array $attributes = [])
    {
        $this->table = config('sales-management.tablePrefix').'pipeline_stages';
        parent::__construct($attributes);
    }
}
