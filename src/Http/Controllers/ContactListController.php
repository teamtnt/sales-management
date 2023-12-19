<?php

namespace Teamtnt\SalesManagement\Http\Controllers;

use Illuminate\Http\Request;
use Teamtnt\SalesManagement\DataTables\AddContactDataTable;
use Teamtnt\SalesManagement\DataTables\ContactListContactDataTable;
use Teamtnt\SalesManagement\DataTables\ContactListDataTable;
use Teamtnt\SalesManagement\Http\Requests\ContactListRequest;
use Teamtnt\SalesManagement\Models\Campaign;
use Teamtnt\SalesManagement\Models\ContactList;
use Teamtnt\SalesManagement\Models\ContactListContact;
use Teamtnt\SalesManagement\Models\Lead;

class ContactListController extends Controller
{

    public function index(ContactListDataTable $contactListDataTable)
    {
        return $contactListDataTable->render('sales-management::contact-list.index');
    }

    public function create()
    {
        return view('sales-management::contact-list.create');
    }

    public function store(ContactListRequest $contactListRequest)
    {
        $contactList = ContactList::create($contactListRequest->validated());

        request()->session()->flash('message', __('List successfully created!'));

        return redirect()->route('teamtnt.sales-management.lists.index');
    }

    public function edit(ContactList $contactList, ContactListContactDataTable $contactDataTable)
    {
        return $contactDataTable
            ->with('contactList', $contactList)
            ->render('sales-management::contact-list.edit', compact('contactList'));
    }

    public function destroy(ContactList $contactList)
    {
        $contactList->delete();

        request()->session()->flash('message', __('List successfully deleted!'));

        return redirect()->route('teamtnt.sales-management.lists.index');
    }

    public function contactDestroy(ContactListContact $contactListContact)
    {
        $contactListId = $contactListContact->contact_list_id;
        $contactListContact->delete();

        // remove leads
        $campaignIds = Campaign::whereContactListId($contactListId)->pluck('id')->toArray();
        Lead::whereIn('campaign_id', $campaignIds)->whereContactId($contactListContact->contact_id)->delete();

        request()->session()->flash('message', __('Contact successfully removed!'));

        return redirect()->route('teamtnt.sales-management.lists.edit', $contactListId);
    }

    public function createListFromPipelineStage($campaignId, $pipelineStageId)
    {
        return view('sales-management::contact-list.create-list-from-stage', compact('campaignId', 'pipelineStageId'));
    }

    public function createListFromPipelineStageStore(Request $request)
    {
        $campaignId = request()->get('campaign_id');;
        $stageId = request()->get('stage_id');

        $contactList = new ContactList;
        $contactList->name = $request->get('new_list', "New list from $campaignId stage $stageId");
        $contactList->save();

        createListFromPipelineStage($contactList->id, $campaignId, $stageId);

        request()->session()->flash('message', __('List has been successfully created!'));

        return redirect()->route('teamtnt.sales-management.campaign.show', $campaignId);
    }

    public function contactAdd(ContactList $contactList)
    {
        $contactList->contacts()->attach(request()->contact_id);
        request()->session()->flash('message', __('Contact has been successfully added to list!'));

        $contactList->campaigns->each(function ($campaign) {
            $campaign->leads()->create([
                'campaign_id' => $campaign->id,
                'pipeline_id' => $campaign->pipeline_id,
                'pipeline_stage_id' => 0,
                'contact_id' => request()->contact_id,
            ]);
        });

        return redirect()->back();
    }

    public function showContactAdd(ContactList $contactList, AddContactDataTable $addContactDataTable)
    {
        return $addContactDataTable->with('contactList', $contactList)
            ->render('sales-management::contact-list-contacts.add', compact('contactList'));
    }
}

