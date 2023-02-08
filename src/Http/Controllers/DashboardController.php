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

        $companiesCount = Company::count();
        $companiesCountLastWeek = Company::where('created_at', '>=', $date)->count();

        $dealsCount = Deal::whereStatus(Status::DEAL_STATUS_CLOSED)->count();
        $dealsCountLastWeek = Deal::whereStatus(Status::DEAL_STATUS_CLOSED)->where('created_at', '>=', $date)->count();

        return view('sales-management::dashboard.index', compact('contactsCount',
            'contactsCountLastWeek',
            'companiesCount',
            'companiesCountLastWeek',
            'dealsCount',
            'dealsCountLastWeek',
        ));
    }

}

