<?php

namespace Teamtnt\SalesManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Teamtnt\SalesManagement\DataTables\WorkflowDataTable;
use Teamtnt\SalesManagement\FSM\StateMachineBuilder;
use Teamtnt\SalesManagement\Http\Requests\WorkflowRequest;
use Teamtnt\SalesManagement\Jobs\ABSplitJob;
use Teamtnt\SalesManagement\Jobs\AddTagJob;
use Teamtnt\SalesManagement\Jobs\MoveToListJob;
use Teamtnt\SalesManagement\Models\ContactList;
use Teamtnt\SalesManagement\Models\Tag;
use Teamtnt\SalesManagement\Models\Workflow;
use Teamtnt\SalesManagement\Models\Campaign;
use Symfony\Component\Workflow\Dumper\GraphvizDumper;
use Teamtnt\SalesManagement\Jobs\SendMailJob;
use Teamtnt\SalesManagement\Jobs\ChangeStageJob;
use Teamtnt\SalesManagement\Jobs\WaitJob;
use Teamtnt\SalesManagement\Jobs\ApplyTransitionByNameJob;

class WorkflowController extends Controller
{

    /**
     * @param  WorkflowDataTable  $workflowDataTable
     * @return mixed
     */
    public function index(Campaign $campaign, WorkflowDataTable $workflowDataTable)
    {
        return $workflowDataTable
            ->with('campaignId', $campaign->id)
            ->render('sales-management::workflows.index', compact('campaign'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Campaign $campaign)
    {
        $workflow = new Workflow;
        $workflow->name = "Untitled Workflow";
        $workflow->campaign_id = $campaign->id;
        $workflow->save();

        return redirect()->route('workflows.edit', [$campaign->id, $workflow->id]);
    }

    /**
     * @param  WorkflowRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Campaign $campaign, StateMachineBuilder $stateMachineBuilder)
    {
        $workflow = new Workflow;
        $workflow->campaign_id = $campaign->id;
        $workflow->name = request()->title;
        $workflow->elements = json_encode(request()->elements);
        $workflow->state_machine_definition = $stateMachineBuilder->buildFromElements(request()->elements, 'workflow');
        $workflow->save();
    }

    /**
     * @param  Workflow  $workflow
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Campaign $campaign, Workflow $workflow)
    {
        $contactLists = ContactList::all()->transform(function ($contactList) {
            return [
                'argument' => $contactList->id,
                'action'   => MoveToListJob::class,
                'title'    => $contactList->name,
                'type'     => 'action',
            ];
        });

        $tags = Tag::all()->transform(function ($tag) {
            return [
                'argument' => $tag->id,
                'action'   => AddTagJob::class,
                'title'    => $tag->name,
                'type'     => 'action',
            ];
        });
        $stages = $stageActions = $messages = $messagesOpened = [];
        foreach ($campaign->messages as $message) {
            $messagesOpened[] = [
                'argument' => $message->id,
                'action'   => 'condition',
                'title'    => $message->subject,
                'type'     => 'condition',
            ];
            $messages[] = [
                'argument' => $message->id,
                'action'   => SendMailJob::class,
                'title'    => $message->subject,
                'type'     => 'action',
            ];
        }
        foreach ($campaign->pipeline->stages as $stage) {
            $stages[] = [
                'argument' => $stage->id,
                'action'   => 'condition',
                'title'    => $stage->name,
                'type'     => 'condition',
            ];
            $stageActions[] = [
                'argument' => $stage->id,
                'action'   => ChangeStageJob::class,
                'title'    => $stage->name,
                'type'     => 'action',
            ];
        }

        $abSplit[] = [
            'argument' => '50/50',
            'action'   => ABSplitJob::class,
            'title'    => '50/50',
            'type'     => 'action',
        ];

        $waitOptions = [
            [
                'argument' => 1,
                'action'   => WaitJob::class,
                'title'    => '1h',
                'type'     => 'action',
            ],
            [
                'argument' => 2,
                'action'   => WaitJob::class,
                'title'    => '2h',
                'type'     => 'action',
            ],
            [
                'argument' => 3,
                'action'   => WaitJob::class,
                'title'    => '3h',
                'type'     => 'action',
            ],
        ];

        return view('sales-management::workflows.edit', compact('workflow',
            'campaign', 'contactLists', 'waitOptions', 'messages',
            'tags', 'messagesOpened', 'abSplit', 'stages', 'stageActions'));
    }

    /**
     * @param  WorkflowRequest  $request
     * @param  Workflow  $workflow
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Campaign $campaign, Workflow $workflow, StateMachineBuilder $stateMachineBuilder)
    {
        $workflow->name = request()->title;
        $workflow->elements = json_encode(request()->elements);
        $workflow->state_machine_definition = $stateMachineBuilder->buildFromElements(request()->elements, 'workflow_'.$workflow->id);
        $workflow->save();
    }

    /**
     * @param  Workflow  $workflow
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Campaign $campaign, Workflow $workflow)
    {
        $workflow->delete();

        request()->session()->flash('message', __('Workflow successfully deleted!'));

        return redirect()->route('workflows.index', $campaign);
    }

    public function debug(Campaign $campaign, Workflow $workflow)
    {
        $fsm = $workflow->fsm();

        /*
            $leadJourney = \Teamtnt\SalesManagement\Models\LeadJourney::find(1);

            if ($fsm->can($leadJourney, 'transition.message.opened')) {
                $fsm->apply($leadJourney, 'transition.message.opened');
                $leadJourney->save();
            }

            dd($leadJourney->getCurrentPlace());
        */
        $dumper = new GraphvizDumper();

        return view('sales-management::workflows.debug', compact('workflow', 'campaign', 'dumper'));
    }

    public function publish(Campaign $campaign, Workflow $workflow)
    {
        $workflow->status = Workflow::STATUS_PUBLISHED;
        $workflow->save();

        request()->session()->flash('message', __('Workflow successfully published!'));

        return redirect()->route('workflows.index', $campaign);
    }

    public function unpublish(Campaign $campaign, Workflow $workflow)
    {
        $workflow->status = Workflow::STATUS_DRAFT;
        $workflow->save();
        $workflow->leadJearneys()->delete();

        request()->session()->flash('message', __('Workflow successfully unpublished!'));

        return redirect()->route('workflows.index', $campaign);
    }

    public function run(Campaign $campaign, Workflow $workflow)
    {
        foreach ($campaign->leads as $lead) {
            ApplyTransitionByNameJob::dispatch($lead->id, $workflow->id, "transition.run.".$workflow->id);
        }

        request()->session()->flash('message', __('Workflow run was successfull!'));

        return redirect()->route('workflows.index', $campaign);
    }

}
