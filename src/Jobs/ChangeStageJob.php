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

class ChangeStageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $leadId;
    public $workflowId;
    public $stageId;

    public function __construct($leadId, $workflowId, $stageId)
    {
        $this->leadId = $leadId;
        $this->workflowId = $workflowId;
        $this->stageId = $stageId;
    }

    public function handle(): void
    {
        $lead = Lead::find($this->leadId);

        if ($email = $lead->contact->email) {
            info("Changing Stage ID to: {$this->stageId}");
            $lead->pipeline_stage_id = $this->stageId;
            $lead->save();
        }

        NextTransitionJob::dispatch($this->leadId, $this->workflowId);
    }
}
