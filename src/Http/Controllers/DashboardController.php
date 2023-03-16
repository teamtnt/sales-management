<?php

namespace Teamtnt\SalesManagement\Http\Controllers;

use Teamtnt\SalesManagement\Models\Company;
use Teamtnt\SalesManagement\Models\Contact;
use Teamtnt\SalesManagement\Models\PostmarkEvent;
use Teamtnt\SalesManagement\Models\Deal;
use Teamtnt\SalesManagement\Models\Status;

class DashboardController extends Controller
{

    public function index()
    {
        $events = PostmarkEvent::orderBy('created_at', 'DESC')->paginate(50);

        $contactsCount = Contact::count();
 
        $deliveries = PostmarkEvent::where('event_type', 'Delivery')->count();
        $opens = PostmarkEvent::where('event_type', 'Open')->count();
        $clicks = PostmarkEvent::where('event_type', 'Click')->count();
        $bounces = PostmarkEvent::where('event_type', 'Bounce')->count();
        $spamComplaints = PostmarkEvent::where('event_type', 'SpamComplaint')->count();

        return view('sales-management::dashboard.index', 
            compact('contactsCount','events', 'deliveries', 'opens', 'clicks', 'bounces', 'spamComplaints'));
    }

}

