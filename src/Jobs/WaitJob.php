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

class WaitJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $leadId;
    public $workflowId;
    public $waitHours;

    public function __construct($leadId, $workflowId, $waitHours)
    {
        $this->leadId = $leadId;
        $this->workflowId = $workflowId;
        $this->waitHours = $waitHours;
    }

    public function handle(): void
    {
        info("Now waiting for {$this->waitHours} hours");

        NextTransitionJob::dispatch($this->leadId, $this->workflowId)
            ->delay($this->addHours());
    }

    private function addHours()
    {
        $date = now();
        if (is_array($this->waitHours)) {
            $date->addHours($this->waitHours['hours']);
            if ($this->waitHours['skipWeekends']) {
                while ($date->isWeekend()) {
                    $date->addDay();
                }
            }

            return $date;
        }

        return $date->addHours($this->waitHours);
    }
}
