<?php

namespace Teamtnt\SalesManagement\Http\Controllers;

use Teamtnt\SalesManagement\Models\Company;
use Teamtnt\SalesManagement\Models\Contact;
use Teamtnt\SalesManagement\Models\Deal;

class DashboardController extends Controller
{

    public function index()
    {
        $date = \Carbon\Carbon::today()->subDays(7);

        $contactsCount = Contact::count();
        $contactsCountLastWeek = Contact::where('created_at', '>=', $date)->count();

        $companiesCount = Company::count();
        $companiesCountLastWeek = Company::where('created_at', '>=', $date)->count();

        $dealsCount = Deal::count();
        $dealsCountLastWeek = Deal::where('created_at', '>=', $date)->count();

        return view('sales-management::dashboard.index', compact('contactsCount',
            'contactsCountLastWeek',
            'companiesCount',
            'companiesCountLastWeek',
            'dealsCount',
            'dealsCountLastWeek',
        ));
    }

}

