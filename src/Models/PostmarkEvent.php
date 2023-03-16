<?php

namespace Teamtnt\SalesManagement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostmarkEvent extends Model
{
    use HasFactory;

    protected $table;

    public function __construct(array $attributes = [])
    {
        $this->table = config('sales-management.tablePrefix').'postmark_events';
        parent::__construct($attributes);
    }

    public function message() {
        return $this->belongsTo(Message::class);
    }

    public function getPayload($index) {
        $payload = json_decode($this->payload, true);

        if(isset($payload[$index])) {
            return $payload[$index];
        }

        return "";
    }
}
