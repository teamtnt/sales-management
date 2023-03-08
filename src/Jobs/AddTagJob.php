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

class AddTagJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $leadId;
    public $workflowId;
    public $tagId;
 
    public function __construct($leadId, $workflowId, $tagId) {
        $this->leadId = $leadId;
        $this->workflowId = $workflowId;
        $this->tagId = $tagId;
    }
 
    public function handle(): void
    {
        $lead = Lead::find($this->leadId);

        if ($email = $lead->contact->email) {
            info("Adding tag ID: {$this->tagId} to Contact: {$lead->contact->email}");
        }

        NextTransitionJob::dispatch($this->leadId, $this->workflowId);
    }
}