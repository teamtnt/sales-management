<?php

namespace Teamtnt\SalesManagement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $table;

    public $timestamps = true;

    protected $fillable = [
        'campaign_id',
        'pipeline_id',
        'pipeline_stage_id',
        'contact_id',
        'preferred_contact_method',
        'preferred_contact_time',
    ];

    const CONTACT_METHOD_EMAIL = 'email';
    const CONTACT_METHOD_PHONE = 'phone';
    const CONTACT_METHOD_EMAIL_AND_PHONE = 'email_and_phone';

    const CONTACT_METHODS = [
        self::CONTACT_METHOD_EMAIL,
        self::CONTACT_METHOD_PHONE,
        self::CONTACT_METHOD_EMAIL_AND_PHONE,
    ];

    public function __construct(array $attributes = [])
    {
        $this->table = config('sales-management.tablePrefix') . 'leads';
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
        return $this->hasMany(LeadNotes::class, 'lead_id')->orderBy('created_at', 'desc');
    }

    public function activities()
    {
        return $this->hasMany(LeadActivity::class, 'lead_id')->orderBy('created_at', 'desc');
    }

    public function pipeline()
    {
        return $this->belongsTo(Pipeline::class);
    }

    public function stage()
    {
        return $this->belongsTo(PipelineStage::class, 'pipeline_stage_id');
    }

    //get next Call activity in the future as a relation
    public function nextCallActivity()
    {
        return $this->hasOne(LeadActivity::class, 'lead_id')
            ->where('type', LeadActivity::ACTIVITY_TYPE_CALL)
            ->whereNotNull('start_date')
            ->orderBy('start_date', 'asc');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, config('sales-management.tablePrefix') . 'lead_tag');
    }

    public function journeys()
    {
        return $this->hasMany(LeadJourney::class, 'lead_id');
    }
}

