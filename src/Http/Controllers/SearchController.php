<?php

namespace Teamtnt\SalesManagement\Http\Controllers;

use Illuminate\Http\Request;
use Teamtnt\SalesManagement\Models\Campaign;
use Teamtnt\SalesManagement\Models\Lead;


class SearchController extends Controller
{
    public function search(Request $request, Campaign $campaign, $pipelineID, $stageID)
    {
        $query = $request->get('query');

        $methodName = $stageID == 0 ? 'getInitialLeadsOnStage' : 'getLeadsOnStage';

        if (!$request->has('query') or $request->get('query') == '') {
            $leads = $campaign->$methodName($pipelineID, $stageID);
        } else {
            // First, try to find exact matches
            $exactMatches = Lead::with('notes', 'notes.user', 'contact.tags', 'tags', 'activities', 'activities.user', 'nextCallActivity')
                ->whereHas('contact', function ($q) use ($query) {
                    $q->where('lastname', '=', $query)
                        ->orWhere('firstname', '=', $query)
                        ->orWhere('email', '=', $query)
                        ->orWhere('company_name', '=', $query)
                        ->orWhereRaw("CONCAT(firstname, ' ', lastname) = ?", [$query]);
                })
                ->where('pipeline_stage_id', $stageID)
                ->where('pipeline_id', $pipelineID)
                ->get();

            // If we found exact matches, return only those
            if ($exactMatches->isNotEmpty()) {
                $leads = $exactMatches;
            } else {
                // Otherwise, do fuzzy search with LIKE
                $leads = Lead::with('notes', 'notes.user', 'contact.tags', 'tags', 'activities', 'activities.user', 'nextCallActivity')
                    ->whereHas('contact', function ($q) use ($query) {
                        $q->where('lastname', 'LIKE', '%' . $query . '%')
                            ->orWhere('firstname', 'LIKE', '%' . $query . '%')
                            ->orWhere('email', 'LIKE', '%' . $query . '%')
                            ->orWhere('company_name', 'LIKE', '%' . $query . '%')
                            ->orWhereRaw("CONCAT(firstname, ' ', lastname) LIKE ?", ['%' . $query . '%']);
                    })
                    ->where('pipeline_stage_id', $stageID)
                    ->where('pipeline_id', $pipelineID)
                    ->get();

                // find lead contact by fulltext search
                $leadsWithFullText = Lead::with('notes', 'notes.user', 'contact.tags', 'tags', 'activities', 'activities.user', 'nextCallActivity')
                    ->whereHas('contact', function ($q) use ($query) {
                        $q->where(function ($q) use ($query) {
                            $q->whereFullText('lastname', $query)
                                ->orWhereFullText('firstname', $query)
                                ->orWhereFullText('email', $query)
                                ->orWhereFullText('company_name', $query);

                        });
                    })
                    ->where('pipeline_stage_id', $stageID)
                    ->where('pipeline_id', $pipelineID)
                    ->get();

                $leads = $leads->merge($leadsWithFullText);

                //make sure we don't have duplicates
                $leads = $leads->unique('id');
            }
        }

        return response()->json(['searchResults' => $leads]);
    }

    public function searchAll(Request $request, Campaign $campaign, $pipelineID)
    {
        $query = $request->get('query');

        if (!$request->has('query') or $request->get('query') == '') {
            return response()->json(['searchResults' => []]);
        }

        // First, try to find exact matches
        $exactMatches = Lead::with('notes', 'notes.user', 'contact.tags', 'tags', 'activities', 'activities.user', 'nextCallActivity')
            ->whereHas('contact', function ($q) use ($query) {
                $q->where('lastname', '=', $query)
                    ->orWhere('firstname', '=', $query)
                    ->orWhere('email', '=', $query)
                    ->orWhere('company_name', '=', $query)
                    ->orWhereRaw("CONCAT(firstname, ' ', lastname) = ?", [$query]);
            })
            ->where('pipeline_id', $pipelineID)
            ->get();

        // If we found exact matches, return only those
        if ($exactMatches->isNotEmpty()) {
            $allLeads = $exactMatches;
        } else {
            // Otherwise, do fuzzy search
            // Search across all stages
            $leads = Lead::with('notes', 'notes.user', 'contact.tags', 'tags', 'activities', 'activities.user', 'nextCallActivity')
                ->whereHas('contact', function ($q) use ($query) {
                    $q->where('lastname', 'LIKE', '%' . $query . '%')
                        ->orWhere('firstname', 'LIKE', '%' . $query . '%')
                        ->orWhere('email', 'LIKE', '%' . $query . '%')
                        ->orWhere('company_name', 'LIKE', '%' . $query . '%')
                        ->orWhereRaw("CONCAT(firstname, ' ', lastname) LIKE ?", ['%' . $query . '%']);
                })
                ->where('pipeline_id', $pipelineID)
                ->get();

            // Find lead contact by fulltext search
            $leadsWithFullText = Lead::with('notes', 'notes.user', 'contact.tags', 'tags', 'activities', 'activities.user', 'nextCallActivity')
                ->whereHas('contact', function ($q) use ($query) {
                    $q->where(function ($q) use ($query) {
                        $q->whereFullText('lastname', $query)
                            ->orWhereFullText('firstname', $query)
                            ->orWhereFullText('email', $query)
                            ->orWhereFullText('company_name', $query);
                    });
                })
                ->where('pipeline_id', $pipelineID)
                ->get();

            $allLeads = $leads->merge($leadsWithFullText);

            // Make sure we don't have duplicates
            $allLeads = $allLeads->unique('id');
        }

        // Group leads by stage
        $resultsByStage = [];
        
        foreach ($allLeads as $lead) {
            $stageId = $lead->pipeline_stage_id;
            
            if (!isset($resultsByStage[$stageId])) {
                $resultsByStage[$stageId] = [];
            }
            
            $resultsByStage[$stageId][] = $lead;
        }

        return response()->json(['searchResults' => $resultsByStage]);
    }
}
