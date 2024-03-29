<?php

namespace Teamtnt\SalesManagement\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Teamtnt\SalesManagement\Models\LeadJourney;
use Teamtnt\SalesManagement\Models\Campaign;
use Teamtnt\SalesManagement\Models\PostmarkEvent;
use Teamtnt\SalesManagement\Models\Workflow;
use Teamtnt\SalesManagement\Models\Message;
use Teamtnt\SalesManagement\Models\Lead;
use Teamtnt\SalesManagement\Mail\CampaignEmail;
use Illuminate\Support\Facades\Mail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $leadId;
    public $workflowId;
    public $mailId;

    public function __construct($leadId, $workflowId, $mailId)
    {
        $this->leadId = $leadId;
        $this->workflowId = $workflowId;
        $this->mailId = $mailId;
    }

    public function handle(): void
    {
        info("Sending mail ID: {$this->mailId} to Lead ID: {$this->leadId}");

        $lead = Lead::find($this->leadId);
        $message = Message::find($this->mailId);

        if ($email = $lead->contact->email) {
            Mail::to($email)->send(new CampaignEmail($message, $lead, $this->workflowId));
            $this->logEvent($email);
            MessageNotOpenedJob::dispatch($this->leadId, $this->workflowId, $this->mailId)
                ->delay(now()->addHours(24));

            info("Sending mail with subject: {$message->subject} to {$lead->contact->email}");
        }

        NextTransitionJob::dispatch($this->leadId, $this->workflowId);
    }

    public function logEvent($email)
    {
        $event = new PostmarkEvent();
        $event->event_type = "Sent";
        $event->message_id = $this->mailId;
        $event->postmark_message_id = "";
        $event->recipient = $email;
        $event->payload = json_encode([]);
        $event->save();
    }
}
