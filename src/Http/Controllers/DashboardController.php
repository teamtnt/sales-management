<?php
namespace Teamtnt\SalesManagement\Http\Controllers;

use Teamtnt\SalesManagement\DataTables\ContactDataTable;

class DashboardController extends Controller {

    public function index(ContactDataTable $contactDataTable)
    {
        return view('sales-management::dashboard.index');
    }

}

