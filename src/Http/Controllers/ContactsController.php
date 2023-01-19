<?php
namespace Teamtnt\SalesManagement\Http\Controllers;

use Teamtnt\SalesManagement\Models\Contact;

class ContactsController extends Controller {

    public function index()
    {
        $contacts = ["first", "second", "third"];
        return view('sales-management::contacts.index', compact('contacts'));
    }

}

