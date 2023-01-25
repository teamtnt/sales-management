<?php
namespace Teamtnt\SalesManagement\Http\Controllers;

use Teamtnt\SalesManagement\DataTables\ContactDataTable;
use Teamtnt\SalesManagement\Models\Contact;

class ContactsController extends Controller {

    public function index(ContactDataTable $contactDataTable)
    {
        return $contactDataTable->render('sales-management::contacts.index');
    }

    public function create()
    {
        return view('sales-management::contacts.create');
    }

    public function store()
    {

    }

    public function edit(Contact $contact)
    {
        dd($contact);
        return view('sales-management::contacts.edit', compact('contact'));
    }

    public function update()
    {

    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        request()->session()->flash('message', __('Contact successfully deleted!'));

        return redirect()->route('sales-management::contacts.index');
    }

}

