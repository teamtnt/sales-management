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
use Teamtnt\SalesManagement\Models\Tag;

class ContactsController extends Controller
{

    /**
     * @param ContactDataTable $contactDataTable
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
        $contact = new Contact();

        return view('sales-management::contacts.create', compact('contact'));
    }

    /**
     * @param ContactRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ContactRequest $request)
    {
        $contact = Contact::create($request->validated());
        $contact->tags()->sync($request->get('tags'));

        request()->session()->flash('message', __('Contact successfully created!'));

        return redirect()->route('contacts.index');
    }

    /**
     * @param Contact $contact
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Contact $contact)
    {
        return view('sales-management::contacts.edit', compact('contact'));
    }

    /**
     * @param ContactRequest $request
     * @param Contact $contact
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ContactRequest $request, Contact $contact)
    {
        $contact->update($request->validated());

        $contact->tags()->sync($request->get('tags'));

        request()->session()->flash('message', __('Contact successfully updated!'));

        return redirect()->route('contacts.index');
    }

    /**
     * @param Contact $contact
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
        ini_set('max_execution_time', 0);

        $delimiter = $this->guessDelimiter($request);
        $encoding = $this->guessEncoding($request);

        //Create database table from ContactTemp model
        DB::statement('SET SESSION sql_require_primary_key=0');
        DB::statement("CREATE TEMPORARY TABLE " . (new ContactTemp)->getTable() . " SELECT * FROM " . (new Contact)->getTable() . " LIMIT 0");
        Excel::import(new ContactsImport($delimiter, $encoding), $request->csv);

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

        if ($request->get('contact_list_id')) {
            importContactsToContactList($request->get('contact_list_id'), $batch->id);
        }

        request()->session()->flash('message', __('Contact successfully imported!'));

        return redirect()->route('contacts.index');
    }

    private function guessEncoding($request)
    {
        $handle = fopen($request->csv, 'r');
        $lines = [];
        for ($i = 0; $i < 10; $i++) {
            $lines[] = fgets($handle);
        }
        fclose($handle);

        $text = implode('', $lines);

        return mb_detect_encoding($text, "auto");
    }


    private function guessDelimiter($request)
    {
        // Read the first line of the file to guess the delimiter
        $handle = fopen($request->csv, 'r');
        $firstLine = fgets($handle);
        fclose($handle);

        $delimiters = array(',', ';', '\t', '|');
        $delimiterCounts = array_fill_keys($delimiters, 0);

        foreach ($delimiters as $delimiter) {
            $delimiterCounts[$delimiter] = substr_count($firstLine, $delimiter);
        }

        arsort($delimiterCounts);
        return key($delimiterCounts);
    }

    public function syncTags(Request $request)
    {
        $contact = Contact::find($request->get('modelId'));
        $contact->tags()->sync($request->get('tags'));

        return response()->json(200);
    }
}

