<?php
 
namespace Teamtnt\SalesManagement\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
 
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
        if(rand(1,2) == 1 ) {
            info("Spliting to A");
        } else {
            info("Spliting to B");
        }


        $leadJourney = LeadJourney::where('lead_id', $this->leadId)
            ->where('workflow_id', $this->workflowId)
            ->first(); 

        $workflow = Workflow::find($this->workflowId);
        $fsm = $workflow->fsm();

        $enabledTransitions = $fsm->getEnabledTransition($leadJourney);

        info($enabledTransitions);
    }
}