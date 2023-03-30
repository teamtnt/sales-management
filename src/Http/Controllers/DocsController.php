<?php

namespace Teamtnt\SalesManagement\Http\Controllers;

use Illuminate\Http\Request;

class DocsController extends Controller
{
    public function markdown()
    {
        // Add your logic here for the Markdown page
        return view('sales-management::docs.markdown');
    }

    public function pipelines()
    {
        // Add your logic here for the Pipelines page
        return view('sales-management::docs.pipelines');
    }

    public function workflow()
    {
        // Add your logic here for the Workflow page
        return view('sales-management::docs.workflow');
    }
}
