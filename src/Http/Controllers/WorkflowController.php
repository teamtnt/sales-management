<?php

namespace Teamtnt\SalesManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Teamtnt\SalesManagement\DataTables\WorkflowDataTable;
use Teamtnt\SalesManagement\FSM\StateMachineBuilder;
use Teamtnt\SalesManagement\Http\Requests\WorkflowRequest;
use Teamtnt\SalesManagement\Jobs\ABSplitJob;
use Teamtnt\SalesManagement\Jobs\AddTagJob;
use Teamtnt\SalesManagement\Jobs\ApplyTransitionByNameJob;
use Teamtnt\SalesManagement\Jobs\NextTransitionJob;
use Teamtnt\SalesManagement\Models\ContactList;
use Teamtnt\SalesManagement\Models\LeadJourney;
use Teamtnt\SalesManagement\Models\Tag;
use Teamtnt\SalesManagement\Models\Workflow;
use Teamtnt\SalesManagement\Models\Task;
use Symfony\Component\Workflow\Dumper\GraphvizDumper;
use Teamtnt\SalesManagement\Jobs\SendMailJob;
use Teamtnt\SalesManagement\Jobs\WaitJob;

class WorkflowController extends Controller
{

    /**
     * @param  WorkflowDataTable  $workflowDataTable
     * @return mixed
     */
    public function index(Task $task, WorkflowDataTable $workflowDataTable)
    {
        return $workflowDataTable
            ->with('taskId', $task->id)
            ->render('sales-management::workflows.index', compact('task'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Task $task)
    {
        $contactLists = ContactList::all()->transform(function ($contactList) {
            return [
                'argument' => $contactList->id,
                'action'   => $contactList::class,
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
        $stages = $messages = $messagesOpened = [];
        foreach ($task->messages as $message) {
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
        foreach ($task->pipeline->stages as $stage) {
            $stages[] = [
                'argument' => $stage->id,
                'action'   => 'condition',
                'title'    => $stage->name,
                'type'     => 'condition',
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

        return view('sales-management::workflows.create', compact('task',
            'contactLists', 'waitOptions', 'messages', 'messagesOpened',
            'tags', 'abSplit', 'stages'));
    }

    /**
     * @param  WorkflowRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Task $task, StateMachineBuilder $stateMachineBuilder)
    {
        $workflow = new Workflow;
        $workflow->task_id = $task->id;
        $workflow->name = request()->title;
        $workflow->elements = json_encode(request()->elements);
        $workflow->state_machine_definition = $stateMachineBuilder->buildFromElements(request()->elements, 'workflow');
        $workflow->save();
    }

    /**
     * @param  Workflow  $workflow
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Task $task, Workflow $workflow)
    {
        $contactLists = ContactList::all()->transform(function ($contactList) {
            return [
                'argument' => $contactList->id,
                'action'   => $contactList::class,
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
        $stages = $messages = $messagesOpened = [];
        foreach ($task->messages as $message) {
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
        foreach ($task->pipeline->stages as $stage) {
            $stages[] = [
                'argument' => $stage->id,
                'action'   => 'condition',
                'title'    => $stage->name,
                'type'     => 'condition',
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
            'task', 'contactLists', 'waitOptions', 'messages',
            'tags', 'messagesOpened', 'abSplit', 'stages'));
    }

    /**
     * @param  WorkflowRequest  $request
     * @param  Workflow  $workflow
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Task $task, Workflow $workflow, StateMachineBuilder $stateMachineBuilder)
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
    public function destroy(Task $task, Workflow $workflow)
    {
        $workflow->delete();

        request()->session()->flash('message', __('Workflow successfully deleted!'));

        return redirect()->route('workflows.index', $task);
    }

    public function debug(Task $task, Workflow $workflow)
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

        return view('sales-management::workflows.debug', compact('workflow', 'task', 'dumper'));
    }

    public function publish(Task $task, Workflow $workflow)
    {
        $workflow->status = Workflow::STATUS_PUBLISHED;
        $workflow->save();

        request()->session()->flash('message', __('Workflow successfully published!'));

        return redirect()->route('workflows.index', $task);
    }

    public function unpublish(Task $task, Workflow $workflow)
    {
        $workflow->status = Workflow::STATUS_DRAFT;
        $workflow->save();

        request()->session()->flash('message', __('Workflow successfully unpublished!'));

        return redirect()->route('workflows.index', $task);
    }

}
