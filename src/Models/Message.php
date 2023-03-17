<?php

namespace Teamtnt\SalesManagement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table;

    protected $fillable = [
        'campaign_id',
        'subject',
        'body',
        'from_email',
        'from_name',
    ];

    public function __construct(array $attributes = [])
    {
        $this->table = config('sales-management.tablePrefix').'messages';
        parent::__construct($attributes);
    }

    public function campaigns()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function extractLinks() {
        $string = $this->body;
        
        $links = array();
        $regex = '/\[(.*?)\]\((https?\:\/\/[^\" ]+)\)/i';
        preg_match_all($regex, $string, $matches);
        for ($i = 0; $i < count($matches[0]); $i++) {
            $links[] = array(
                'text' => $matches[1][$i],
                'url' => $matches[2][$i]
            );
        }
        return $links;
    }
}
