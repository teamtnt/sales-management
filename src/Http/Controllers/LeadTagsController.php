<?php

namespace Teamtnt\SalesManagement\Http\Controllers;


use Illuminate\Http\Request;
use Teamtnt\SalesManagement\Models\Lead;

class LeadTagsController extends Controller
{
    public function syncTags(Request $request)
    {
        $lead = Lead::find($request->get('modelId'));
        $lead->tags()->sync($request->get('tags'));

        return response()->json(200);
    }
}
