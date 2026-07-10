<?php

namespace Teamtnt\SalesManagement\Http\Controllers;

use Illuminate\Http\Request;
use Teamtnt\SalesManagement\DataTables\CampaignDataTable;
use Teamtnt\SalesManagement\Http\Requests\CampaignRequest;
use Teamtnt\SalesManagement\Jobs\ApplyTransitionByNameJob;
use Teamtnt\SalesManagement\Models\Campaign;
use Teamtnt\SalesManagement\Models\Contact;
use Teamtnt\SalesManagement\Models\Deal;
use Teamtnt\SalesManagement\Models\Lead;

class CampaignController extends Controller
{
    /**
     * Number of leads loaded per stage on the initial page render and per
     * "load more" request. Keeping this small prevents the campaign board from
     * serializing every lead (tens of thousands) into the page at once.
     */
    public const LEADS_PER_PAGE = 20;

    public function index(CampaignDataTable $CampaignDataTable)
    {
        return $CampaignDataTable->render('sales-management::campaign.index');
    }

    public function create()
    {
        return view('sales-management::campaign.create');
    }

    public function store(CampaignRequest $campaignRequest)
    {
        $campaign = Campaign::create($campaignRequest->validated());
        $campaign->assignees()->sync($campaignRequest->get('assignees'));
        createLeadsFromContacts($campaign->id, $campaign->pipeline_id, $campaign->contact_list_id);

        request()->session()->flash('message', __('Campaign successfully created!'));

        return redirect()->route('teamtnt.sales-management.campaign.index');
    }

    public function edit(Campaign $campaign)
    {
        return view('sales-management::campaign.edit', compact('campaign'));
    }

    public function update(CampaignRequest $campaignRequest, Campaign $campaign)
    {
        $campaign->update($campaignRequest->validated());
        $campaign->assignees()->sync($campaignRequest->get('assignees'));
        request()->session()->flash('message', __('Campaign successfully updated!'));

        return redirect()->route('teamtnt.sales-management.campaign.index');
    }

    public function show(Campaign $campaign)
    {

        $stages = $campaign->pipeline->stages;
        $leadsCount = [];
        $leads = [];

        foreach($stages as $stage) {
            $leadsCount[$stage->id] = $campaign->getLeadsOnStageCount($campaign->pipeline_id, $stage->id);
            $leads[$stage->id] = $campaign->getLeadsOnStage($campaign->pipeline_id, $stage->id, self::LEADS_PER_PAGE)->toArray();
        }

        $initialLeads = $campaign->getInitialLeadsOnStage($campaign->pipeline_id, 0, self::LEADS_PER_PAGE)->toArray();
        $initialLeadsCount=$campaign->getLeadsOnStageCount($campaign->pipeline_id, 0);

        $routes = [
            'list' => [
                'newList' => route('teamtnt.sales-management.lists.create.from.stage', [$campaign, ':stageId'])
            ],
            'notes' => [
                'fetch' => route('teamtnt.sales-management.fetch-lead-notes', ':leadId'),
                'store' => route('teamtnt.sales-management.store-lead-note', ':leadId'),
                'delete' => route('teamtnt.sales-management.destroy-lead-note', [':leadId', ':noteId']),
            ],
            'activities' => [
                'fetch' => route('teamtnt.sales-management.fetch-lead-activities', ':leadId'),
                'store' => route('teamtnt.sales-management.store-lead-activity', ':leadId'),
                'delete' => route('teamtnt.sales-management.destroy-lead-activity', [':leadId', ':activityId']),
                'update' => route('teamtnt.sales-management.update-lead-activity', [':leadId', ':activityId']),
            ],
            'contacts' => [
                'edit' => route('teamtnt.sales-management.contacts.edit', ':contactId'),
                'syncTags' => route('teamtnt.sales-management.contacts.sync-tags', ':contactId'),
                'syncLists' => route('teamtnt.sales-management.contacts.sync-lists', ':contactId'),
            ],
            'leads' => [
                'syncTags' => route('teamtnt.sales-management.leads.sync-tags', ':leadId'),
                'leadData' => route('teamtnt.sales-management.lead.data', [$campaign, ':leadId']),
                'leadStageChange' => route('teamtnt.sales-management.lead.stage.change', [$campaign, ':leadId']),
                'destroy' => route('teamtnt.sales-management.lead.destroy', [$campaign, ':leadId']),
            ],
            'messages' => [
                'send' => route('teamtnt.sales-management.send.message', [$campaign, ':leadId']),
            ],
        ];


        return view('sales-management::campaign.show',
            compact('campaign', 'stages',
                'leadsCount', 'leads', 'routes', 'initialLeads', 'initialLeadsCount'))
            ->with('globalSearch', session('globalSearch', ''));
    }

    /**
     * Return a paginated chunk of leads for a single stage so the board can
     * lazy-load additional leads as the user scrolls instead of fetching the
     * entire stage up front.
     */
    public function loadLeads(Request $request, Campaign $campaign, $pipelineID, $stageID)
    {
        $limit  = (int) $request->get('limit', self::LEADS_PER_PAGE);
        $offset = (int) $request->get('offset', 0);

        $methodName = $stageID == 0 ? 'getInitialLeadsOnStage' : 'getLeadsOnStage';
        $leads = $campaign->$methodName($pipelineID, $stageID, $limit, $offset);

        return response()->json(['leads' => $leads]);
    }

    public function stageChange(Request $request)
    {
        $leadId = $request->lead_id;
        $lead   = Lead::where('id', $leadId)
            ->where('pipeline_id', $request->pipeline_id)
            ->where('pipeline_stage_id', $request->source_stage_id ?? 0)
            ->first();

        if (!$lead) {
            return;
        }

        $lead->pipeline_stage_id = $request->target_stage_id;
        $lead->save();

        $transitionName = "transition.stage.changed.".$lead->pipeline_stage_id;

        foreach ($lead->campaign->publishedWorkflows() as $workflow) {
            ApplyTransitionByNameJob::dispatch($leadId, $workflow->id, $transitionName);
        }
    }

    public function destroy(Campaign $campaign)
    {
        $campaign->delete();

        request()->session()->flash('message', __('Campaign successfully deleted!'));

        return redirect()->route('teamtnt.sales-management.campaign.index');
    }
}
