<?php

namespace Teamtnt\SalesManagement\Http\Controllers;


use Illuminate\Http\Request;
use Teamtnt\SalesManagement\Models\Lead;
use Teamtnt\SalesManagement\Models\LeadNotes;

class LeadNotesController extends Controller
{
    public function getLeadNotes()
    {

    }


    public function storeLeadNote(Request $request)
    {
        $leadNote             = new LeadNotes();

        $leadNote->lead_id    = $request->get('lead_id');
        $leadNote->created_by = auth()->id();
        $leadNote->note       = $request->get('note');
        $leadNote->save();

        return response()->json(['leadNote' => $leadNote], 200);

    }

    public function destroyLeadNote(Lead $lead, LeadNotes $leadNote)
    {

        return response()->json(200);
    }
}
