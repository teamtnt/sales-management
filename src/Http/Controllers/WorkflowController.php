<?php
namespace Teamtnt\SalesManagement\Http\Controllers;

class WorkflowController extends Controller {

    public function index()
    {
        return view('sales-management::workflow.index' );
    }

    public function newWorkflow()
    {
        return view('sales-management::workflow.new' );
    }

}
