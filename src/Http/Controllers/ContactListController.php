<?php
namespace Teamtnt\SalesManagement\Http\Controllers;

use Teamtnt\SalesManagement\DataTables\ContactListContactDataTable;
use Teamtnt\SalesManagement\DataTables\ContactListDataTable;
use Teamtnt\SalesManagement\Models\ContactList;
use Teamtnt\SalesManagement\Models\ContactListContact;

class ContactListController extends Controller {

    public function index(ContactListDataTable $contactListDataTable)
    {
        return $contactListDataTable->render('sales-management::contact-list.index');
    }

    public function edit(ContactList $contactList, ContactListContactDataTable $contactDataTable)
    {
        return $contactDataTable
            ->with('contactListId', $contactList->id)
            ->render('sales-management::contact-list.edit', compact('contactList'));
    }

    public function destroy(ContactList $contactList)
    {
        $contactList->delete();

        request()->session()->flash('message', __('List successfully deleted!'));

        return redirect()->route('lists.index');
    }

    public function contactDestroy(ContactListContact $contactListContact)
    {
        $contactListId = $contactListContact->contact_list_id;
        $contactListContact->delete();
        request()->session()->flash('message', __('Contact successfully deleted!'));

        return redirect()->route('lists.edit', $contactListId);
    }

}

