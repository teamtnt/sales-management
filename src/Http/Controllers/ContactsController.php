<?php

namespace Teamtnt\SalesManagement\Http\Controllers;

use Illuminate\Http\Request;
use Teamtnt\SalesManagement\DataTables\ContactDataTable;
use Teamtnt\SalesManagement\Http\Requests\ContactRequest;
use Teamtnt\SalesManagement\Http\Requests\CSVImportRequest;
use Teamtnt\SalesManagement\Http\Requests\WebhookImportRequest;
use Teamtnt\SalesManagement\Models\Campaign;
use Teamtnt\SalesManagement\Models\Contact;
use Teamtnt\SalesManagement\Models\ContactList;
use Teamtnt\SalesManagement\Models\Batch;
use Teamtnt\SalesManagement\Models\ContactTemp;
use Maatwebsite\Excel\Facades\Excel;
use Teamtnt\SalesManagement\Imports\ContactsImport;
use DB;
use Teamtnt\SalesManagement\Models\Lead;
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

    public function importWebhook(WebhookImportRequest $request)
    {
        ini_set('max_execution_time', 0);

        //Create database table from ContactTemp model
        DB::statement('SET SESSION sql_require_primary_key=0');
        DB::statement("CREATE TEMPORARY TABLE " . (new ContactTemp)->getTable() . " SELECT * FROM " . (new Contact)->getTable() . " LIMIT 0");

        $importData = [];
        foreach ($request->contacts as $contact) {
            $importData[] = [
                'salutation' => trim($contact['salutation']),
                'firstname' => trim($contact['firstname']),
                'lastname' => trim($contact['lastname']),
                'job_title' => trim($contact['job_title']),
                'email' => trim($contact['email']),
                'phone' => trim($contact['phone']),
                'company_name' => trim($contact['company_name']),
                'vat' => trim($contact['vat']),
                'url' => trim($contact['url']),
                'company_email' => trim($contact['company_email']),
                'address' => trim($contact['address']),
                'postal' => trim($contact['postal']),
                'city' => trim($contact['city']),
                'country' => trim($contact['country']),
                'uuid' => trim($contact['uuid']),
            ];
        }
        ContactTemp::insert($importData);

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
        } elseif ($request->get('campaign_id')) {
            $campaign = Campaign::find($request->get('campaign_id'));
            importContactsToContactList($campaign->contact_list_id, $batch->id);
        }

        return response()->json(200);
    }

    public function addContact(): void
    {
        //wrap in transaction
        DB::beginTransaction();

        try {
            $contact = Contact::create(request()->except('tags', 'campaign_id', 'notes'));
            //if tag does not exist create it
            $tags = request()->get('tags');
            foreach ($tags as $tag) {
                $tag = Tag::firstOrCreate(['name' => $tag]);
                $contact->tags()->attach($tag->id);
            }

            //add contact to list, get list from campaign
            $campaign = Campaign::find(request()->get('campaign_id'));
            $contactList = ContactList::find($campaign->contact_list_id);

            $contactList->contacts()->attach($contact->id);

            //create lead
            $lead = Lead::create([
                'campaign_id' => $campaign->id,
                'contact_id' => $contact->id,
                'pipeline_id' => $campaign->pipeline_id,
                'pipeline_stage_id' => 0
            ]);

            //create notes from request, map keys add to note as text
            $noteKeys = ['additional_info' => 'weitere Informationen', 'number_of_attendees' => 'vorauss. TN-Anzahl', 'preferred_date' => 'Wunschtermin'];

            $notes = request()->get('notes');
            foreach ($notes as $key => $note) {
                $lead->notes()->create(['note' => $noteKeys[$key] . ': ' . $note]);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

    }

}

