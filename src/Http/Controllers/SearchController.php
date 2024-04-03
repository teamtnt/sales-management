<?php

namespace Teamtnt\SalesManagement\Http\Controllers;

use Illuminate\Http\Request;
use Teamtnt\SalesManagement\Models\Campaign;
use Teamtnt\SalesManagement\Models\Lead;


class SearchController extends Controller
{
    public function search( Request $request, Campaign $campaign, $pipelineID, $stageID)
    {
        $query = $request->get('query');

        if(!$request->has('query') or $request->get('query') == '')  {
            $leads = $campaign->getLeadsOnStage($pipelineID, $stageID);
        }
        else {
            //try to find a lead by contact last name directly
            $leads = Lead::with('notes', 'notes.user', 'contact.tags', 'tags', 'activities', 'activities.user', 'nextCallActivity')
                ->whereHas('contact', function ($q) use ($query) {
                    $q->where('lastname', 'LIKE', '%' . $query . '%');
                })
                ->where('pipeline_stage_id', $stageID)
                ->where('pipeline_id', $pipelineID)
                ->limit(5)->get();

            // find lead contact by name
            $leadsWithFullText = Lead::with('notes', 'notes.user', 'contact.tags', 'tags', 'activities', 'activities.user', 'nextCallActivity')
                ->whereHas('contact', function ($q) use ($query) {
                    $q->where(function($q) use ($query) {
                        $q->whereFullText('lastname', $query)
                            ->orWhereFullText('firstname', $query)
                            ->orWhereFullText('email', $query)
                            ->orWhere('lastname', 'LIKE', '%' . $query . '%')
                            ->orWhere('firstname', 'LIKE', '%' . $query . '%')
                            ->orWhere('email', 'LIKE', '%' . $query . '%');
                    });
                })
                ->where('pipeline_stage_id', $stageID)
                ->where('pipeline_id', $pipelineID)
                ->limit(10)->get();

            $leads = $leads->merge($leadsWithFullText);

            //make sure we don't have duplicates
            $leads = $leads->unique('id');
        }

        return response()->json(['searchResults' => $leads]);
    }
}
