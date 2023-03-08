<?php
 
namespace Teamtnt\SalesManagement\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Teamtnt\SalesManagement\Models\LeadJourney;
use Teamtnt\SalesManagement\Models\Task;
use Teamtnt\SalesManagement\Models\Workflow;
use Teamtnt\SalesManagement\Models\Message;
use Teamtnt\SalesManagement\Models\Lead;
use Teamtnt\SalesManagement\Mail\TaskEmail;
use Illuminate\Support\Facades\Mail;

class MoveToListJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $leadId;
    public $workflowId;
    public $listId;
 
    public function __construct($leadId, $workflowId, $listId) {
        $this->leadId = $leadId;
        $this->workflowId = $workflowId;
        $this->listId = $listId;
    }
 
    public function handle(): void
    {
        $lead = Lead::find($this->leadId);

        if ($email = $lead->contact->email) {
            info("Moving contact {$lead->contact->email} to List ID: {$this->listId}");
        }

        NextTransitionJob::dispatch($this->leadId, $this->workflowId);
    }
}