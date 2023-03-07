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
 
class WaitJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    public $leadId;
    public $workflowId;
    public $waitHours;
 
    public function __construct($leadId, $workflowId, $waitHours) {
        $this->leadId = $leadId;
        $this->workflowId = $workflowId;
        $this->waitHours = $waitHours;
    }
 
    public function handle(): void
    {
        info("Now waiting for {$this->waitHours} hours");

        NextTransitionJob::dispatch($this->leadId, $this->workflowId)
                    ->delay(now()->addHours($this->waitHours));
    }
}