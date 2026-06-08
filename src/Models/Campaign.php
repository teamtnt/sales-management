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
    public function getInitialLeadsOnStage($pipelineId, $stageId, $limit = null, $offset = 0): Collection
    {
        $query = $this->leads()
            ->where('pipeline_id', $pipelineId)
            ->where('pipeline_stage_id', $stageId)
            ->with('contact', 'notes', 'notes.user', 'contact.tags', 'tags', 'activities', 'activities.user', 'nextCallActivity');

        if ($this->name === 'Bestandskunden') {
            // Order by the earliest tag whose name is a valid "dd.mm.yyyy" date,
            // with leads that have no such tag pushed to the end. Done in SQL so
            // the ordering stays correct across paginated requests.
            $minTagDate = $this->earliestTagDateSubquerySql();

            $query->orderByRaw('COALESCE(' . $minTagDate . ', \'9999-12-31\') ASC');
        } else {
            $query->orderByDesc(Contact::select('created_at')
                ->whereColumn(config('sales-management.tablePrefix') . 'leads.contact_id', config('sales-management.tablePrefix') . 'contacts.id')
                ->orderBy('created_at', 'DESC')
                ->limit(1)
            );
        }

        return $query
            ->when($offset, fn ($query) => $query->offset($offset))
            ->limit($limit)->get();
    }

    /**
     * Correlated subquery returning the earliest tag date for a lead, parsing
     * tag names in the "dd.mm.yyyy" format. Non-date tag names yield NULL and
     * are ignored by MIN(), so leads with no date tag resolve to NULL.
     */
    private function earliestTagDateSubquerySql(): string
    {
        $prefix       = config('sales-management.tablePrefix');
        $leadsTable   = $prefix . 'leads';
        $tagsTable    = $prefix . 'tags';
        $leadTagTable = $prefix . 'lead_tag';

        return '(SELECT MIN(STR_TO_DATE(' . $tagsTable . '.name, \'%d.%m.%Y\')) '
            . 'FROM ' . $tagsTable . ' '
            . 'INNER JOIN ' . $leadTagTable . ' ON ' . $leadTagTable . '.tag_id = ' . $tagsTable . '.id '
            . 'WHERE ' . $leadTagTable . '.lead_id = ' . $leadsTable . '.id)';
    }

    public function getLeadsOnStage($pipelineId, $stageId, $limit = null, $offset = 0)
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

            ->when($offset, fn ($query) => $query->offset($offset))
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
