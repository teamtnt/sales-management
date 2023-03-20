<?php

namespace Teamtnt\SalesManagement\Http\Controllers;


use Illuminate\Http\Request;
use Teamtnt\SalesManagement\Models\Lead;
use Teamtnt\SalesManagement\Models\LeadNotes;

class LeadNotesController extends Controller
{

    public function storeLeadNote(Request $request)
    {

       $request->validate([
            'note' => 'required|string|max:255'
        ]);

        $leadNote             = new LeadNotes();
        $leadNote->lead_id    = $request->get('lead_id');
        $leadNote->created_by = auth()->id();
        $leadNote->note       = $request->get('note');
        $leadNote->save();

        return response()->json(['leadNote' => $leadNote], 200);

    }

    public function destroyLeadNote($lead, $note)
    {
        $leadNote = LeadNotes::where('id', $note)
            ->where('lead_id', $lead)
            ->first();

        $leadNote->delete();

        return response()->json(200);
    }
}
