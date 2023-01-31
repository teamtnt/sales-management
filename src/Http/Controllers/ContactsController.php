<?php

namespace Teamtnt\SalesManagement\Http\Controllers;

use App\Models\ArticleLagerLocation;
use App\Models\ArticleQuantityLocationChangelog;
use App\Models\InitialStockSetup;
use Illuminate\Http\Request;
use Teamtnt\SalesManagement\DataTables\ContactDataTable;
use Teamtnt\SalesManagement\Http\Requests\ContactRequest;
use Teamtnt\SalesManagement\Models\Contact;

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
        $parseRow = function ($row) {
            list($salutation, $firstname, $lastname, $jobTitle, $email, $phone, $companyName, $vat, $url, $companyEmail, $address, $postal, $city, $county) = $row;
            Contact::insert([
                'salutation' => trim($salutation),
                'firstname' => trim($firstname),
                'lastname' => trim($lastname),
                'job_title' => trim($jobTitle),
                'email' => trim($email),
                'phone' => trim($phone)
            ]);

        };

        $this->readCSV($request->file('csv'), $skipFirstRow = true, $parseRow);

        request()->session()->flash('message', __('Contact successfully imported!'));

        return redirect()->route('contacts.index');

    }

    public function readCSV($file, $skipFirstRow = true, $callback = null)
    {
        $handle = fopen($file, "r");
        $firstRow = true;

        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                if ($firstRow) {
                    $firstRow = false;
                    continue;
                }
                $lineArray = str_getcsv($line);
                $callback($lineArray);
            }

            fclose($handle);
        }
    }

}

