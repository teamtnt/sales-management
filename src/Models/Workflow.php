<?php

namespace Teamtnt\SalesManagement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workflow extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'name',
        'description',
        'elements',
        'status',
    ];

    public function __construct(array $attributes = [])
    {
        $this->table = config('sales-management.tablePrefix').'workflows';
        parent::__construct($attributes);
    }

    public function tasks()
    {
        return $this->belongsTo(Task::class);
    }
}
