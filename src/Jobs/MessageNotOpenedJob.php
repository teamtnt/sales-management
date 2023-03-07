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
 
class MessageNotOpenedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    public $leadId;
    public $workflowId;
    public $mailId;
 
    public function __construct($leadId, $workflowId, $mailId) {
        $this->leadId = $leadId;
        $this->workflowId = $workflowId;
        $this->mailId = $mailId;
    }
 
    public function handle(): void
    {
        $transitionName = "transition.message.not_opened.".$this->mailId;
        ApplyTransitionByNameJob::dispatch($this->leadId, $this->workflowId, $transitionName);
    }
}