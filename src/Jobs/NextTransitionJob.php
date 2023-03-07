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
 
class NextTransitionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $leadId;
    public $workflowId;
    public $mailId;
 
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

        if(isset($fsm->getEnabledTransitions($leadJourney)[0])) {
            $transitionName = $fsm->getEnabledTransitions($leadJourney)[0]->getName();
        } else {
            info("We reached the end of the workflow");
            return;
        }
        
        if ($fsm->can($leadJourney, $transitionName)) {
            $fsm->apply($leadJourney, $transitionName);
            $leadJourney->save();

            info("Applying {$transitionName} and changing state to ". $leadJourney->getCurrentPlace());
            
            $transition = $fsm->getEnabledTransition($leadJourney, $transitionName);

            if(isset($fsm->getMetadataStore()->getTransitionMetadata($transition)['action'])) {
                $action = $fsm->getMetadataStore()->getTransitionMetadata($transition)['action'];
                $argument = $fsm->getMetadataStore()->getTransitionMetadata($transition)['argument'];
                $job = new $action($this->leadId, $workflow->id, $argument);
                $job->dispatch($this->leadId, $workflow->id, $argument);
                info("Calling job: {$action} with argument: {$argument}");
            }

        } else {
            info("Coudn't apply transition {transitionName}");
        }
    }
}