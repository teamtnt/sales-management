<?php

namespace Teamtnt\SalesManagement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadActivity extends Model
{
    use HasFactory;

    const ACTIVITY_TYPE_CALL = 'Call';
    protected $table;

    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'timestamp',
    ];

    protected $dates = [
        'start_date',
        'end_date',
    ];

    public function __construct(array $attributes = [])
    {
        $this->table = config('sales-management.tablePrefix') . 'lead_activities';
        parent::__construct($attributes);
    }

    public function user()
    {
        return $this->belongsTo(config('sales-management.userModel'), 'created_by', 'id');
    }
}
