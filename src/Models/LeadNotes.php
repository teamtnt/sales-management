<?php

namespace Teamtnt\SalesManagement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadNotes extends Model
{
    use HasFactory;

    protected $table;

    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'timestamp'
    ];

    public function __construct(array $attributes = [])
    {
        $this->table = config('sales-management.tablePrefix') . 'lead_notes';
        parent::__construct($attributes);
    }

    public function user()
    {
        return $this->belongsTo(config('sales-management.userModel'), 'created_by', 'id');
    }
}
