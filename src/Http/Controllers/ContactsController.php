<?php

namespace Teamtnt\SalesManagement\Http\Controllers;

use Illuminate\Http\Request;
use Teamtnt\SalesManagement\DataTables\ContactDataTable;
use Teamtnt\SalesManagement\Http\Requests\ContactRequest;
use Teamtnt\SalesManagement\Models\Contact;
use Maatwebsite\Excel\Facades\Excel;
use Teamtnt\SalesManagement\Imports\ContactsImport;

class ContactsController extends Controller
{

    /**
     * @param  ContactDataTable  $contactDataTable
     * @return mixed
     */
    public function index(ContactDataTable $contactDataTable)
    {
        return $contactDataTable->render('sales-management::contacts.index');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('sales-management::contacts.create');
    }

    /**
     * @param  ContactRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ContactRequest $request)
    {
        Contact::create($request->validated());

        request()->session()->flash('message', __('Contact successfully created!'));

        return redirect()->route('contacts.index');
    }

    /**
     * @param  Contact  $contact
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Contact $contact)
    {
        return view('sales-management::contacts.edit', compact('contact'));
    }

    /**
     * @param  ContactRequest  $request
     * @param  Contact  $contact
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ContactRequest $request, Contact $contact)
    {

        $contact->update($request->validated());

        request()->session()->flash('message', __('Contact successfully updated!'));

        return redirect()->route('contacts.index');

    }

    /**
     * @param  Contact  $contact
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        request()->session()->flash('message', __('Contact successfully deleted!'));

        return redirect()->route('contacts.index');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function importCSV()
    {
        return view('sales-management::contacts.import-csv');
    }

    public function importCSVStore(Request $request)
    {
        Excel::import(new ContactsImport, $request->csv);
        request()->session()->flash('message', __('Contact successfully imported!'));

        return redirect()->route('contacts.index');
    }
}

