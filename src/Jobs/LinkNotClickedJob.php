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

class LinkNotClickedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $leadId;
    public $workflowId;
    public $messageId;
    public $link;

    public function __construct($leadId, $workflowId, $messageId, $link)
    {
        $this->leadId = $leadId;
        $this->workflowId = $workflowId;
        $this->messageId = $messageId;
        $this->link = $link;
    }

    public function handle(): void
    {
        $transitionName = "transition.link.not_clicked.".$this->messageId.".".$this->link;

        ApplyTransitionByNameJob::dispatch($this->leadId, $this->workflowId, $transitionName);
    }
}
