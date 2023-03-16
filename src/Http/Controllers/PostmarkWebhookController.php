<?php

namespace Teamtnt\SalesManagement\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Teamtnt\SalesManagement\Models\PostmarkEvent;
use Teamtnt\SalesManagement\Models\LeadJourney;
use Teamtnt\SalesManagement\Models\Campaign;
use Teamtnt\SalesManagement\Jobs\ApplyTransitionByNameJob;

class PostmarkWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = json_decode($request->getContent(), true);
        $method = 'handle'.$payload['RecordType'];

        $this->savePostmarkEvent($payload);

        if (method_exists($this, $method)) {

            if(!isset($payload['Metadata']['lead_id'])) {
                return new Response;
            }

            $leadId = $payload['Metadata']['lead_id'];
            $campaignId = $payload['Metadata']['campaign_id'];
            $messageId = $payload['Metadata']['message_id'];
            $campaign = Campaign::find($campaignId);

            $response = $this->{$method}($payload, $campaign, $leadId, $messageId);

            return $response;
        }

        return $this->missingMethod($payload);

    }

    public function handleOpen($payload, $campaign, $leadId, $messageId)
    {
        if(!$campaign) {
            return new Response;
        }

        $transitionName = 'transition.message.opened.'.$messageId;
        $this->applyTransition($campaign, $transitionName, $leadId);
    }

    public function handleDelivery($payload)
    {
        return;

        $transitionName = 'transition.message.delivery.yes.'.$messageId;
        $this->applyTransition($campaign, $transitionName, $leadJourney, $leadId);
    }

    public function handleBounce($payload)
    {
        return;

        $transitionName = 'transition.message.bounce.'.$messageId;
        $this->applyTransition($campaign, $transitionName, $leadJourney, $leadId);
    }

    public function handleSpamComplaint($payload)
    {
        return;

        $transitionName = 'transition.message.spam.complaint.'.$messageId;
        $this->applyTransition($campaign, $transitionName, $leadJourney, $leadId);
    }

    public function handleLinkClick($payload)
    {
        return;

        $transitionName = 'transition.message.link.click.yes.'.$messageId;
        $this->applyTransition($campaign, $transitionName, $leadJourney, $leadId);
    }

    public function handleSubscriptionChange($payload)
    {
        return;

        $transitionName = 'transition.message.subscription.change.yes.'.$messageId;
        $this->applyTransition($campaign, $transitionName, $leadJourney, $leadId);
    }

    public function applyTransition($campaign, $transitionName, $leadId)
    {
        foreach ($campaign->publishedWorkflows() as $workflow) {
            ApplyTransitionByNameJob::dispatch($leadId, $workflow->id, $transitionName);
        }
    }

    protected function missingMethod($parameters = [])
    {
        return new Response;
    }

    public function savePostmarkEvent($payload) {

        $recipient = "";

        if( isset($payload['Recipient']) ) {
            $recipient = $payload['Recipient'];
        } elseif (isset($payload['Email'])) {
            $recipient = $payload['Email'];
        } 

        $event = new PostmarkEvent();
        $event->event_type = $payload['RecordType']; 

        if(isset($payload['Metadata']['message_id'])) {
            $event->message_id = $payload['Metadata']['message_id'];
        }
        $event->postmark_message_id = $payload['MessageID'];
        $event->recipient = $recipient;
        $event->payload = json_encode($payload);
        $event->save();
    }
}

