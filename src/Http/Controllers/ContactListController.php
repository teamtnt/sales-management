<?php
namespace Teamtnt\SalesManagement\Http\Controllers;

use Teamtnt\SalesManagement\DataTables\ContactListDataTable;
use Teamtnt\SalesManagement\Models\ContactList;

class ContactListController extends Controller {

    public function index(ContactListDataTable $contactListDataTable)
    {
        return $contactListDataTable->render('sales-management::contact-list.index');
    }

    public function edit(ContactList $contactList)
    {
        return view('sales-management::contact-list.edit', compact('contactList'));
    }

    public function destroy(ContactList $contactList)
    {
        $contactList->delete();

        request()->session()->flash('message', __('List successfully deleted!'));

        return redirect()->route('lists.index');
    }

}

