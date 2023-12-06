<?php

namespace Teamtnt\SalesManagement\Http\Controllers;


use Illuminate\Http\Request;
use Carbon\Carbon;
use Teamtnt\SalesManagement\Models\LeadActivity;
use Teamtnt\SalesManagement\Models\LeadNotes;

class LeadActivitiesController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
//            'description' => 'required|string',
            'activity_type' => 'required|string|max:255',
            'lead_id'=>'required|integer'
        ]);

        $leadActivity = LeadActivity::create([
            'lead_id' => $request->get('lead_id'),
            'created_by' => auth()->id(),
            'description' => $request->get('description'),
            'end_date' => $request->get('activity_end_date') ? Carbon::parse($request->get('activity_end_date')) : null,
            'start_date' => $request->get('activity_start_date') ? Carbon::parse($request->get('activity_start_date')) : null,
            'type' => $request->get('activity_type'),
        ]);

        return response()->json(['leadActivity' => $leadActivity->load('user')]);
    }

    /**
     * @param $lead
     * @param $note
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($lead, $note)
    {
        $leadActivity = LeadActivity::where('id', $note)
            ->where('lead_id', $lead)
            ->first();

        $leadActivity->delete();

        return response()->json(200);
    }
}
