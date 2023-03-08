<?php

namespace Teamtnt\SalesManagement\Http\Controllers;

use Illuminate\Http\Request;
use Teamtnt\SalesManagement\Models\LeadJourney;
use Teamtnt\SalesManagement\Models\Task;
use Teamtnt\SalesManagement\Jobs\ApplyTransitionByNameJob;

class PostmarkWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = json_decode($request->getContent(), true);
        $method = 'handle'.$payload['RecordType'];

        if (method_exists($this, $method)) {

            $leadId = $payload['Metadata']['lead_id'];
            $taskId = $payload['Metadata']['task_id'];
            $messageId = $payload['Metadata']['message_id'];
            $task = Task::find($taskId);

            $response = $this->{$method}($payload, $task, $leadId, $messageId);

            return $response;
        }

        return $this->missingMethod($payload);

    }

    public function handleOpen($payload, $task, $leadId, $messageId)
    {
        $transitionName = 'transition.message.opened.'.$messageId;
        $this->applyTransition($task, $transitionName, $leadId);
    }

    public function handleDelivery($payload)
    {
        return;

        $transitionName = 'transition.message.delivery.yes.'.$messageId;
        $this->applyTransition($task, $transitionName, $leadJourney, $leadId);
    }

    public function handleBounce($payload)
    {
        return;

        $transitionName = 'transition.message.bounce.'.$messageId;
        $this->applyTransition($task, $transitionName, $leadJourney, $leadId);
    }

    public function handleSpamComplaint($payload)
    {
        return;

        $transitionName = 'transition.message.spam.complaint.'.$messageId;
        $this->applyTransition($task, $transitionName, $leadJourney, $leadId);
    }

    public function handleLinkClick($payload)
    {
        return;

        $transitionName = 'transition.message.link.click.yes.'.$messageId;
        $this->applyTransition($task, $transitionName, $leadJourney, $leadId);
    }

    public function handleSubscriptionChange($payload)
    {
        return;

        $transitionName = 'transition.message.subscription.change.yes.'.$messageId;
        $this->applyTransition($task, $transitionName, $leadJourney, $leadId);
    }

    public function applyTransition($task, $transitionName, $leadId)
    {
        foreach ($task->publishedWorkflows() as $workflow) {
            ApplyTransitionByNameJob::dispatch($leadId, $workflow->id, $transitionName);
        }
    }

    protected function missingMethod($parameters = [])
    {
        return new Response;
    }
}

