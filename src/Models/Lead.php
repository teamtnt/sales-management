<?php

namespace Teamtnt\SalesManagement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $table;
    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        $this->table = config('sales-management.tablePrefix').'leads';
        parent::__construct($attributes);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function notes()
    {
        return $this->hasMany(LeadNotes::class, 'lead_id');
    }
}
