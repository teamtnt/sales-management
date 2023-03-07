<?php
 
namespace Teamtnt\SalesManagement\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Teamtnt\SalesManagement\Models\LeadJourney;
use Teamtnt\SalesManagement\Models\Lead;
use Teamtnt\SalesManagement\Models\Task;
use Teamtnt\SalesManagement\Models\Workflow;
 
class ApplyTransitionByNameJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $leadId;
    public $workflowId;
    public $transitionName;
 
    public function __construct($leadId, $workflowId, $transitionName) {
        $this->leadId = $leadId;
        $this->workflowId = $workflowId;
        $this->transitionName = $transitionName;
    }
 
    public function handle(): void
    {
        $leadJourney = LeadJourney::where('lead_id', $this->leadId)
            ->where('workflow_id', $this->workflowId)
            ->first(); 

        if(!$leadJourney) {
            $lead = Lead::find($this->leadId); 
            $leadJourney = new LeadJourney;
            $leadJourney->lead_id = $this->leadId;
            $leadJourney->task_id = $lead->task_id;
            $leadJourney->workflow_id = $this->workflowId;
            $leadJourney->save();
        }

        $workflow = Workflow::find($this->workflowId);
        $fsm = $workflow->fsm();

        $transitionName = $this->transitionName;
        
        if ($fsm->can($leadJourney, $transitionName)) {
            $transition = $fsm->getEnabledTransition($leadJourney, $transitionName);
            
            $fsm->apply($leadJourney, $transitionName);
            $leadJourney->save();

            info("Applying {$transitionName} and changing state to ". $leadJourney->getCurrentPlace());
            
            NextTransitionJob::dispatch($this->leadId, $this->workflowId);

        } else {
            info("Coudn't apply transition {$transitionName}");
        }
    }
}