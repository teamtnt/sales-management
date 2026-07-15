<?php

namespace Teamtnt\SalesManagement\Http\Controllers;


use http\Env\Response;
use Illuminate\Http\Request;
use Teamtnt\SalesManagement\Jobs\ApplyTransitionByNameJob;
use Teamtnt\SalesManagement\Models\Campaign;
use Teamtnt\SalesManagement\Models\Contact;
use Teamtnt\SalesManagement\Models\Lead;

class LeadsController extends Controller
{
    public function syncTags(Request $request)
    {
        $lead = Lead::find($request->get('modelId'));
        $lead->tags()->sync($request->get('tags'));

        return response()->json(200);
    }

    public function stageChange(Request $request)
    {
        $contactId = Contact::whereUuid($request->contact_uuid)->first()?->id;
        if (is_null($contactId)) {
            return;
        }
        $lead = Lead::where('contact_id', $contactId)
            ->where('campaign_id', $request->campaign_id)
            ->first();

        if (!$lead) {
            return;
        }

        $lead->pipeline_stage_id = $request->stage_id;
        $lead->save();

        $transitionName = "transition.stage.changed." . $lead->pipeline_stage_id;

        foreach ($lead->campaign->publishedWorkflows() as $workflow) {
            ApplyTransitionByNameJob::dispatch($lead->id, $workflow->id, $transitionName);
        }

        return response()->json(200);
    }

    public function transitionStage(Request $request)
    {
        $contactId = Contact::whereUuid($request->uuid)->first()?->id;
        if (is_null($contactId)) {
            return response()->json(['status' => 'contact_not_found'], 200);
        }

        $closedStageIds = $request->get('closed_stage_ids', []);

        $lead = Lead::where('contact_id', $contactId)
            ->where('campaign_id', $request->campaign_id)
            ->whereNotIn('pipeline_stage_id', $closedStageIds)
            ->first();

        if (!$lead) {
            $lead = Lead::where('contact_id', $contactId)
                ->where('campaign_id', $request->campaign_id)
                ->orderBy('updated_at', 'desc')
                ->first();
        }

        if (!$lead) {
            return response()->json(['status' => 'lead_not_found'], 200);
        }

        if ((int) $lead->pipeline_stage_id !== 0) {
            return response()->json(['status' => 'already_processed'], 200);
        }

        $lead->pipeline_stage_id = 13;
        $lead->save();

        $transitionName = "transition.stage.changed." . $lead->pipeline_stage_id;

        foreach ($lead->campaign->publishedWorkflows() as $workflow) {
            ApplyTransitionByNameJob::dispatch($lead->id, $workflow->id, $transitionName);
        }

        return response()->json(['status' => 'ok'], 200);
    }

    public function moveLead(Request $request)
    {
        $lead = Lead::find($request->lead_id);
        if (!$lead) {
            return response()->json([
                'ignored' => true,
                'reason'  => 'lead_not_found',
            ]);
        }

        $closedStageIds = $request->get('closed_stage_ids', []);

        if (in_array((int) $lead->pipeline_stage_id, $closedStageIds)) {
            $activeLead = Lead::where('campaign_id', $lead->campaign_id)
                ->where('contact_id', $lead->contact_id)
                ->whereNotIn('pipeline_stage_id', $closedStageIds)
                ->first();

            if ($activeLead) {
                $lead = $activeLead;
            }
        }

        $lead->pipeline_stage_id = $request->stage_id;
        $lead->save();

        $transitionName = "transition.stage.changed." . $lead->pipeline_stage_id;

        foreach ($lead->campaign->publishedWorkflows() as $workflow) {
            ApplyTransitionByNameJob::dispatch($lead->id, $workflow->id, $transitionName);
        }

        return response()->json(['ok' => true, 'lead_id' => $lead->id, 'stage_id' => $lead->pipeline_stage_id]);
    }

    public function getLeadData(Campaign $campaign, Lead $lead)
    {
        $lead->load('contact', 'contact.tags', 'tags', 'activities', 'activities.user', 'nextCallActivity');

        $tags = getAllTags();
        $lists = getAllLists();

        return response()->json([
            'lead' => $lead->toArray(),
            'tags' => $tags,
            'lists' => $lists,
        ]);
    }

    public function leadStageChange(Campaign $campaign, Lead $lead, Request $request)
    {
        if (!$lead) {
            return response()->json(404);
        }

        $lead->pipeline_stage_id = request('stage_id');
        $lead->save();

        return response()->json(200);
    }

    public function destroy(Campaign $campaign, Lead $lead)
    {
        $lead->journeys()->delete();
        $lead->delete();

        return response()->json([
            'success' => true,
            'message' => 'Lead deleted successfully'
        ]);
    }

}

