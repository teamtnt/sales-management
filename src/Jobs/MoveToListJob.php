<?php

namespace Teamtnt\SalesManagement\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Teamtnt\SalesManagement\Models\LeadJourney;
use Teamtnt\SalesManagement\Models\Campaign;
use Teamtnt\SalesManagement\Models\Workflow;
use Teamtnt\SalesManagement\Models\Message;
use Teamtnt\SalesManagement\Models\Lead;
use Teamtnt\SalesManagement\Mail\CampaignEmail;
use Illuminate\Support\Facades\Mail;
use Teamtnt\SalesManagement\Models\ContactListContact;

class MoveToListJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $leadId;
    public $workflowId;
    public $listId;

    public function __construct($leadId, $workflowId, $listId)
    {
        $this->leadId = $leadId;
        $this->workflowId = $workflowId;
        $this->listId = $listId;
    }

    public function handle(): void
    {
        $lead = Lead::find($this->leadId);

        if ($email = $lead->contact->email) {
            $contactListContact = new ContactListContact;
            $contactListContact->contact_id = $lead->contact->id;
            $contactListContact->contact_list_id = $this->listId;
            $contactListContact->save();

            info("Moving contact {$lead->contact->email} to List ID: {$this->listId}");
        }

        NextTransitionJob::dispatch($this->leadId, $this->workflowId);
    }
}
