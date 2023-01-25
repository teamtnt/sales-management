<?php
namespace Teamtnt\SalesManagement\Http\Controllers;

use Teamtnt\SalesManagement\DataTables\ContactDataTable;
use Teamtnt\SalesManagement\Http\Requests\ContactRequest;
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

    public function store(ContactRequest $request)
    {
        Contact::create($request->validated());

        request()->session()->flash('message', __('Contact successfully created!'));

        return redirect()->route('contacts.index');
    }

    public function edit(Contact $contact)
    {
        return view('sales-management::contacts.edit', compact('contact'));
    }

    public function update(ContactRequest $request, Contact $contact)
    {

        $contact->update($request->validated());

        request()->session()->flash('message', __('Contact successfully updated!'));

        return redirect()->route('contacts.index');

    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        request()->session()->flash('message', __('Contact successfully deleted!'));

        return redirect()->route('contacts.index');
    }

}

