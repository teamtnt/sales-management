<?php
namespace Teamtnt\SalesManagement\Http\Controllers;

class TaskListController extends Controller {

    public function index()
    {
        return view('sales-management::tasklist.index' );
    }

    public function primjer1() {
        return view('sales-management::tasklist.primjer1');
    }

    public function primjer2() {
        return view('sales-management::tasklist.primjer2');
    }
}
