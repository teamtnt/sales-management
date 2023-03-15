<?php

namespace Teamtnt\SalesManagement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadNotes extends Model
{
    use HasFactory;

    protected $table;

    public function __construct(array $attributes = [])
    {
        $this->table = config('sales-management.tablePrefix').'lead_notes';
        parent::__construct($attributes);
    }
}
