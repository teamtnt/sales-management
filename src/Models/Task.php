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

    public function getLeadsOnStage($pipelineId, $stageId, $limit = null)
    {
        return $this->leads()
            ->where('pipeline_id', $pipelineId)
            ->where('pipeline_stage_id', $stageId)
            ->with('contact')->limit($limit)->get();

    }

    public function getLeads($limit)
    {
        return $this->leads()->with('contact')->limit(100)->get();
    }

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }
}
