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
        'is_done' => 'boolean',
        'created_at' => 'datetime',
        'start_date' => 'datetime',
        'end_date' => 'datetime'
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

    public static function getDistinctTypes()
    {
        return self::select('type')->distinct()->pluck('type')->all();
    }

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}
