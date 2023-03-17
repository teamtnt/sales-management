<?php

namespace Teamtnt\SalesManagement\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Teamtnt\SalesManagement\Models\PostmarkEvent;
use Teamtnt\SalesManagement\Models\LeadJourney;
use Teamtnt\SalesManagement\Models\Message;
use Teamtnt\SalesManagement\Models\Campaign;
use Teamtnt\SalesManagement\Jobs\ApplyTransitionByNameJob;
use Teamtnt\SalesManagement\Jobs\LinkNotClickedJob;

class PostmarkWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = json_decode($request->getContent(), true);
        $method = 'handle'.$payload['RecordType'];

        if (method_exists($this, $method)) {

            if(!isset($payload['Metadata']['lead_id'])) {
                return new Response;
            }

            $this->savePostmarkEvent($payload);
            
            $leadId = $payload['Metadata']['lead_id'];
            $campaignId = $payload['Metadata']['campaign_id'];
            $messageId = $payload['Metadata']['message_id'];
            $workflowId = $payload['Metadata']['workflow_id'];
            $campaign = Campaign::find($campaignId);

            //if there is no campaign, we have nothing to do
            if(!$campaign) {
                return new Response;
            }

            $response = $this->{$method}($payload, $campaign, $leadId, $messageId, $workflowId);

            return $response;
        }

        return $this->missingMethod($payload);

    }

    public function handleOpen($payload, $campaign, $leadId, $messageId, $workflowId)
    {
        //at this point we need to triger that the link has not been clicked job
        $message = Message::find($messageId);

        if($message && $payload['FirstOpen'] == true) {
            $links = $message->extractLinks();
            foreach ($links as $link) {
                LinkNotClickedJob::dispatch($leadId, $workflowId, $messageId, $link['url'])
                    ->delay(now()->addHours(24));
            }
        }

        $transitionName = 'transition.message.opened.'.$messageId;
        $this->applyTransition($campaign, $transitionName, $leadId);
    }

    public function handleDelivery($payload, $campaign, $leadId, $messageId, $workflowId)
    {
        return;

        $transitionName = 'transition.message.delivery.yes.'.$messageId;
        $this->applyTransition($campaign, $transitionName, $leadJourney, $leadId);
    }

    public function handleBounce($payload, $campaign, $leadId, $messageId, $workflowId)
    {
        return;

        $transitionName = 'transition.message.bounce.'.$messageId;
        $this->applyTransition($campaign, $transitionName, $leadJourney, $leadId);
    }

    public function handleSpamComplaint($payload, $campaign, $leadId, $messageId, $workflowId)
    {
        return;

        $transitionName = 'transition.message.spam.complaint.'.$messageId;
        $this->applyTransition($campaign, $transitionName, $leadJourney, $leadId);
    }

    public function handleClick($payload, $campaign, $leadId, $messageId, $workflowId)
    {
        $transitionName = 'transition.link.clicked.'.$messageId.".".$payload['OriginalLink'];
        $this->applyTransition($campaign, $transitionName, $leadId);
    }

    public function handleSubscriptionChange($payload, $campaign, $leadId, $messageId, $workflowId)
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

