<?php

namespace Teamtnt\SalesManagement\Http\Controllers;


use http\Env\Response;
use Illuminate\Http\Request;
use Teamtnt\SalesManagement\Jobs\ApplyTransitionByNameJob;
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
}
