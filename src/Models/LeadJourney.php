<?php

namespace Teamtnt\SalesManagement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadJourney extends Model
{
    use HasFactory;

    protected $table;

    public function __construct(array $attributes = [])
    {
        $this->table = config('sales-management.tablePrefix').'lead_journeys';
        parent::__construct($attributes);
    }

    public function getCurrentPlace()
    {
        return $this->current_place;
    }

    public function setCurrentPlace($marking, array $context = [])
    {
        $this->current_place = $marking;
    }
}
