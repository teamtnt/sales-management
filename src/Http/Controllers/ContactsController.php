<?php

namespace Teamtnt\SalesManagement\Http\Controllers;

use Illuminate\Http\Request;
use Teamtnt\SalesManagement\DataTables\ContactDataTable;
use Teamtnt\SalesManagement\Http\Requests\ContactRequest;
use Teamtnt\SalesManagement\Http\Requests\CSVImportRequest;
use Teamtnt\SalesManagement\Models\Contact;
use Teamtnt\SalesManagement\Models\ContactList;
use Teamtnt\SalesManagement\Models\Batch;
use Teamtnt\SalesManagement\Models\ContactTemp;
use Maatwebsite\Excel\Facades\Excel;
use Teamtnt\SalesManagement\Imports\ContactsImport;
use DB;

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

    public function importCSVStore(CSVImportRequest $request)
    {
        //Create database table from ContactTemp model
        DB::statement("CREATE TEMPORARY TABLE ".(new ContactTemp)->getTable()." SELECT * FROM ".(new Contact)->getTable()." LIMIT 0");
        Excel::import(new ContactsImport, $request->csv);

        $batch = new Batch();
        if (auth()->check()) {
            $batch->uploader_id = auth()->id();
        }
        $batch->save();

        importTempContactsIntoContacts($batch->id);

        if ($request->get('new_list')) {
            $contactList = new ContactList;
            $contactList->name = $request->get('new_list');
            $contactList->save();

            importContactsToContactList($contactList->id, $batch->id);
        }

        if ($request->get('list')) {
            // get current list name and import
            dd($request->get('list'));
        }


        request()->session()->flash('message', __('Contact successfully imported!'));

        return redirect()->route('contacts.index');
    }
}

