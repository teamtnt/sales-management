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

        return redirect()->route('campaign.index');
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

        return redirect()->route('campaign.index');
    }

    public function show(Campaign $campaign)
    {
        return view('sales-management::campaign.show', compact('campaign'));
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

        return redirect()->route('campaign.index');
    }
}
