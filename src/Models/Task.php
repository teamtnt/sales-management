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
        'contact_list_id',
        'status',
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

    public function assignees()
    {
        return $this->belongsToMany(config('sales-management.userModel'), config('sales-management.tablePrefix').'task_assignee', 'task_id', 'assignee_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function workflows()
    {
        return $this->hasMany(Workflow::class);
    }
}
