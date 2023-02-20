<?php

namespace Teamtnt\SalesManagement\Http\Controllers;

use Illuminate\Http\Request;
use Teamtnt\SalesManagement\DataTables\ContactListContactDataTable;
use Teamtnt\SalesManagement\DataTables\ContactListDataTable;
use Teamtnt\SalesManagement\Models\ContactList;
use Teamtnt\SalesManagement\Models\ContactListContact;

class ContactListController extends Controller
{

    public function index(ContactListDataTable $contactListDataTable)
    {
        return $contactListDataTable->render('sales-management::contact-list.index');
    }

    public function edit(ContactList $contactList, ContactListContactDataTable $contactDataTable)
    {
        return $contactDataTable
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

    public function createListFromPipelineStage($taskId, $pipelineStageId)
    {
        return view('sales-management::contact-list.create-list-from-stage', compact('taskId', 'pipelineStageId'));
    }

    public function createListFromPipelineStageStore(Request $request)
    {
        $taskId = request()->get('task_id');;
        $stageId = request()->get('stage_id');

        $contactList = new ContactList;
        $contactList->name = $request->get('new_list', "New list from $taskId stage $stageId");
        $contactList->save();

        createListFromPipelineStage($contactList->id, $taskId, $stageId);

        request()->session()->flash('message', __('List has been successfully created!'));

        return redirect()->route('tasklist.show', $taskId);
    }

}

