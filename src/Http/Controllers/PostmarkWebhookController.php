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

    public function handleDelivery($payload)
    {
        $leadId = $payload['Metadata']['lead_id'];
        $taskId = $payload['Metadata']['task_id'];
        $messageId = $payload['Metadata']['message_id'];

        $task = Task::find($taskId);
        $leadJourney = LeadJourney::where('lead_id', $leadId)->where('task_id', $taskId)->first();

        $transitionName = 'transition.delivery.yes.'.$messageId;
        $this->applyTransition($task, $transitionName, $leadJourney, $leadId);
    }

    public function handleBounce($payload)
    {
        $leadId = $payload['Metadata']['lead_id'];
        $taskId = $payload['Metadata']['task_id'];
        $messageId = $payload['Metadata']['message_id'];

        $task = Task::find($taskId);
        $leadJourney = LeadJourney::where('lead_id', $leadId)->where('task_id', $taskId)->first();

        $transitionName = 'transition.bounce.'.$messageId;
        $this->applyTransition($task, $transitionName, $leadJourney, $leadId);
    }

    public function handleSpamComplaint($payload)
    {
        $leadId = $payload['Metadata']['lead_id'];
        $taskId = $payload['Metadata']['task_id'];
        $messageId = $payload['Metadata']['message_id'];

        $task = Task::find($taskId);
        $leadJourney = LeadJourney::where('lead_id', $leadId)->where('task_id', $taskId)->first();

        $transitionName = 'transition.spam.complaint.'.$messageId;
        $this->applyTransition($task, $transitionName, $leadJourney, $leadId);
    }

    public function handleOpen($payload)
    {
        $leadId = $payload['Metadata']['lead_id'];
        $taskId = $payload['Metadata']['task_id'];
        $messageId = $payload['Metadata']['message_id'];

        $task = Task::find($taskId);
        $leadJourney = LeadJourney::where('lead_id', $leadId)->where('task_id', $taskId)->first();

        $transitionName = 'transition.opened.yes.'.$messageId;
        $this->applyTransition($task, $transitionName, $leadJourney, $leadId);

    }

    public function handleLinkClick($payload)
    {
        $leadId = $payload['Metadata']['lead_id'];
        $taskId = $payload['Metadata']['task_id'];
        $messageId = $payload['Metadata']['message_id'];

        $task = Task::find($taskId);
        $leadJourney = LeadJourney::where('lead_id', $leadId)->where('task_id', $taskId)->first();

        $transitionName = 'transition.link.click.yes.'.$messageId;
        $this->applyTransition($task, $transitionName, $leadJourney, $leadId);
    }

    public function handleSubscriptionChange($payload)
    {
        $leadId = $payload['Metadata']['lead_id'];
        $taskId = $payload['Metadata']['task_id'];
        $messageId = $payload['Metadata']['message_id'];

        $task = Task::find($taskId);
        $leadJourney = LeadJourney::where('lead_id', $leadId)->where('task_id', $taskId)->first();

        $transitionName = 'transition.subscription.change.yes.'.$messageId;
        $this->applyTransition($task, $transitionName, $leadJourney, $leadId);
    }

    public function applyTransition($task, $transitionName, $leadJourney, $leadId)
    {
        foreach ($task->publishedWorkflows() as $workflow) {
            $fsm = $workflow->fsm();
            if ($fsm->can($leadJourney, $transitionName)) {
                $action = $fsm->getMetadataStore()
                    ->getTransitionMetadata($transitionName)['action'];
                $argument = $fsm->getMetadataStore()
                    ->getTransitionMetadata($transitionName)['argument'];

                $job = new $action($leadId, $argument);
                $job->dispatch();

                $fsm->apply($leadJourney, $transitionName);
            }
        }
    }

    protected function missingMethod($parameters = [])
    {
        return new Response;
    }
}

