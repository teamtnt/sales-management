<?php
 
namespace Teamtnt\SalesManagement\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Teamtnt\SalesManagement\Models\LeadJourney;
use Teamtnt\SalesManagement\Models\Workflow;

class ABSplitJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    public $leadId;
    public $workflowId;

    public function __construct($leadId, $workflowId) {
        $this->leadId = $leadId;
        $this->workflowId = $workflowId;
    }
 
    public function handle(): void
    {
 
        $leadJourney = LeadJourney::where('lead_id', $this->leadId)
            ->where('workflow_id', $this->workflowId)
            ->first(); 

        $workflow = Workflow::find($this->workflowId);
        $fsm = $workflow->fsm();

        $enabledTransitions = $fsm->getEnabledTransitions($leadJourney);

        $transitionName = $enabledTransitions[rand(0,1)]->getName();

        info("Spliting to: {$transitionName}");

        ApplyTransitionByNameJob::dispatch($this->leadId, $this->workflowId, $transitionName);
    }
}