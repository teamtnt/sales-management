<?php

namespace Teamtnt\SalesManagement\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    const CAMPAIGN_STATUS_NEW = 0;
    const CAMPAIGN_STATUS_IN_PROGRESS = 1;
    const CAMPAIGN_STATUS_CLOSED = 2;

    protected $table;

    protected $fillable = [
        'name',
        'description',
        'pipeline_id',
        'contact_list_id',
        'status',
    ];

    public function __construct(array $attributes = [])
    {
        $this->table = config('sales-management.tablePrefix') . 'campaigns';
        parent::__construct($attributes);
    }

    public function pipeline()
    {
        return $this->belongsTo(Pipeline::class);
    }

    /**
     * Get initial leads on stage sorted by created_at
     *
     * @param $pipelineId
     * @param $stageId
     * @param $limit
     * @return Collection
     */
    public function getInitialLeadsOnStage($pipelineId, $stageId, $limit = null): Collection
    {
        $leads = $this->leads()
            ->where('pipeline_id', $pipelineId)
            ->where('pipeline_stage_id', $stageId)
            ->with('contact', 'notes', 'notes.user', 'contact.tags', 'tags', 'activities', 'activities.user', 'nextCallActivity')
            ->orderByDesc(Contact::select('created_at')
                ->whereColumn(config('sales-management.tablePrefix') . 'leads.contact_id', config('sales-management.tablePrefix') . 'contacts.id')
                ->orderBy('created_at', 'DESC')
                ->limit(1)
            )
            ->limit($limit)->get();

        if($this->name != 'Bestandskunden') return $leads;

        // Sort by tags that are valid dates
        $sortedLeads = $leads->sort(function ($leadA, $leadB) {
            $dateA = $this->getEarliestTagDate($leadA->tags);
            $dateB = $this->getEarliestTagDate($leadB->tags);

            // Handle cases where one or both dates might be null
            if ($dateA === null && $dateB === null) return 0;
            if ($dateA === null) return 1;
            if ($dateB === null) return -1;

            return $dateA <=> $dateB;
        });

        return $sortedLeads->values(); // Re-index the collection
    }

    /**
     * Helper function to get the earliest date from a collection of tags.
     */
    private function getEarliestTagDate($tags)
    {
        // Filter tags to find those that match the date format 'dd.mm.yyyy'
        $dates = $tags->map(function ($tag) {
            return \DateTime::createFromFormat('d.m.Y', $tag->name) ?: null;
        })->filter(); // Filter out null values (non-date strings)

        // Return the earliest date if there are valid dates, or null if none
        return $dates->isNotEmpty() ? $dates->min() : null;
    }

    public function getLeadsOnStage($pipelineId, $stageId, $limit = null)
    {
        return $this->leads()
            ->where('pipeline_id', $pipelineId)
            ->where('pipeline_stage_id', $stageId)
            ->with('contact', 'notes', 'notes.user', 'contact.tags', 'tags', 'activities', 'activities.user', 'nextCallActivity')
            //order by next call activity date asc
            ->orderBy(LeadActivity::select('start_date')
                ->whereColumn(config('sales-management.tablePrefix') . 'lead_activities.lead_id', config('sales-management.tablePrefix') . 'leads.id')
                ->where('type', LeadActivity::ACTIVITY_TYPE_CALL)
                ->orderBy('start_date', 'asc')
                ->limit(1)
            )

            ->limit($limit)->get();
    }

    public function getLeadsOnStageCount($pipelineId, $stageId, $limit = null)
    {
        return $this->leads()
            ->where('pipeline_id', $pipelineId)
            ->where('pipeline_stage_id', $stageId)
            ->limit($limit)
            ->count();
    }

    public function getLeads($limit)
    {
        return $this->leads()->with('contact')->limit(100)->get();
    }

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function assignees()
    {
        return $this->belongsToMany(config('sales-management.userModel'), config('sales-management.tablePrefix') . 'campaign_assignee', 'campaign_id', 'assignee_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function workflows()
    {
        return $this->hasMany(Workflow::class);
    }

    public function contactList()
    {
        return $this->belongsTo(ContactList::class);
    }

    public function publishedWorkflows()
    {
        return $this->workflows()->where('status', Workflow::STATUS_PUBLISHED)->get();
    }

    public static function getCampaignStatusNames()
    {
        return [
            self::CAMPAIGN_STATUS_NEW => __('New'),
            self::CAMPAIGN_STATUS_IN_PROGRESS => __('In progress'),
            self::CAMPAIGN_STATUS_CLOSED => __('Closed'),
        ];
    }
}
