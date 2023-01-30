<?php

namespace Teamtnt\SalesManagement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pipeline extends Model
{
    use HasFactory;

    protected $table;

    protected $fillable = [
        'name',
        'description',
    ];

    public function __construct(array $attributes = [])
    {
        $this->table = config('sales-management.tablePrefix') . 'pipelines';
        parent::__construct($attributes);
    }

    public function pipelineStages()
    {
        return $this->hasMany(PipelineStage::class);
    }
}
