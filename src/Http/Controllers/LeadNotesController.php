<?php

namespace Teamtnt\SalesManagement\Http\Controllers;


use http\Client\Response;
use Illuminate\Http\Request;
use Teamtnt\SalesManagement\Models\LeadNotes;

class LeadNotesController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeLeadNote(Request $request)
    {
        $request->validate([
            'note' => 'required|string',
            'note_type' => 'nullable|string|max:255'
        ],[],[
            'note'=>'Note',
            'note_type'=>'Note Type'
        ]);

        $leadNote = new LeadNotes();
        $leadNote->lead_id = $request->get('lead_id');
        $leadNote->created_by = auth()->id();
        $leadNote->note = $request->get('note');
        $leadNote->type = $request->get('note_type');
        $leadNote->save();

        return response()->json(['leadNote' => $leadNote->load('user')]);
    }

    /**
     * @param $lead
     * @param $note
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyLeadNote($lead, $note)
    {
        $leadNote = LeadNotes::where('id', $note)
            ->where('lead_id', $lead)
            ->first();

        $leadNote->delete();

        return response()->json(200);
    }


    /**
     * @param $lead
     * @return mixed
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetchLeadNotes($lead)
    {
        $leadNotes = LeadNotes::where('lead_id', $lead)
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json(['leadNotes' => $leadNotes->load('user')]);
    }
}
