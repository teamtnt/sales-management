<?php

namespace Teamtnt\SalesManagement\Http\Controllers;


use Illuminate\Http\Request;
use Carbon\Carbon;
use Teamtnt\SalesManagement\Models\LeadActivity;
use Teamtnt\SalesManagement\Models\LeadNotes;
use Teamtnt\SalesManagement\DataTables\LeadActivityDataTable;

class LeadActivitiesController extends Controller
{
    public function index(LeadActivityDataTable $dataTable)
    {
        return $dataTable->render('sales-management::leadactivity.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'nullable|string',
            'activity_type' => 'required|string|max:255',
            'activity_start_date' => 'required',
            'lead_id'=>'required|integer'
        ],[],[
            'description'=>'Beschreibung',
            'activity_type'=>'Activity Type',
            'activity_start_date'=>'Activity Start Date',
            'lead_id'=>'Lead'
        ]);

        $leadActivity = LeadActivity::create([
            'lead_id' => $request->get('lead_id'),
            'created_by' => auth()->id(),
            'description' => $request->get('description'),
            'start_date' => $request->get('activity_start_date') ? Carbon::parse($request->get('activity_start_date')) : null,
            'end_date' => $request->get('activity_end_date') ? Carbon::parse($request->get('activity_end_date')) : null,
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

    public function toggleStatus(LeadActivity $leadActivity)
    {
        $leadActivity->update(['is_done' => !$leadActivity->is_done]);

        return back();
    }

    /**
     * @param $lead
     * @return mixed
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetchLeadActivities($lead)
    {
        $leadActivities = LeadActivity::where('lead_id', $lead)
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json(['leadActivities' => $leadActivities->load('user')]);
    }
}
