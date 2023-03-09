<?php

namespace Teamtnt\SalesManagement\Http\Controllers;

use Teamtnt\SalesManagement\Models\Company;
use Teamtnt\SalesManagement\Models\Contact;
use Teamtnt\SalesManagement\Models\Deal;
use Teamtnt\SalesManagement\Models\Status;

class DashboardController extends Controller
{

    public function index()
    {
        $date = \Carbon\Carbon::today()->subDays(7);

        $contactsCount = Contact::count();
        $contactsCountLastWeek = Contact::where('created_at', '>=', $date)->count();

        $companiesCount = 0;
        $companiesCountLastWeek = 0;

        return view('sales-management::dashboard.index', compact('contactsCount',
            'contactsCountLastWeek',
            'companiesCount',
            'companiesCountLastWeek',
        ));
    }

}

