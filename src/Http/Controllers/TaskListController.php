<?php
namespace Teamtnt\SalesManagement\Http\Controllers;

class TaskListController extends Controller {

    public function index()
    {
        return view('sales-management::tasklist.index' );
    }

}
