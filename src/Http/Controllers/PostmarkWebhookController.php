<?php

namespace Teamtnt\SalesManagement\Http\Controllers;

use Illuminate\Http\Request;
use Teamtnt\SalesManagement\Models\LeadJourney;
use Teamtnt\SalesManagement\Models\Task;


class PostmarkWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = json_decode($request->getContent(), true);
        $method = 'handle'.$payload['RecordType'];

        if (method_exists($this, $method)) {
            $response = $this->{$method}($payload);

            return $response;
        }

        return $this->missingMethod($payload);

    }

    public function handleDelivery()
    {
        dd("handling delivery");
    }

    public function handleBounce()
    {
        dd("handling bounce");
    }

    public function handleSpamComplaint()
    {
        dd("handling spam complaint");
    }

    public function handleOpen($payload)
    {
        $leadId = $payload['Metadata']['lead_id'];
        $taskId = $payload['Metadata']['task_id'];
        $messageId = $payload['Metadata']['message_id'];

        $task = Task::find($taskId);
        $leadJourney = LeadJourney::where('lead_id', $leadId)->where('task_id', $taskId)->first();

        $transitionName = 'transition.opened.yes.'.$messageId;

        foreach ($task->publishedWorkflows() as $workflow) {
            $fsm = $workflow->fsm();
            if ($fsm->can($leadJourney, $transitionName)) {
                $action = $fsm->getMetadataStore()
                    ->getTransitionMetadata($transitionName)['action'];
                $argument = $fsm->getMetadataStore()
                    ->getTransitionMetadata($transitionName)['argument'];

                $job = new $action($leadId, $argument);
                $job->dispatch();
                
                $fsm->apply($leadJourney, 'transition.opened.yes.'.$messageId);
            }
        }
    }

    public function handleLinkClick()
    {
        dd("handling link click");
    }

    public function handleSubscriptionChange()
    {
        dd("handling subscription change");
    }

    protected function missingMethod($parameters = [])
    {
        return new Response;
    }
}

