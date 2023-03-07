<?php

namespace Teamtnt\SalesManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Teamtnt\SalesManagement\DataTables\WorkflowDataTable;
use Teamtnt\SalesManagement\FSM\StateMachineBuilder;
use Teamtnt\SalesManagement\Http\Requests\WorkflowRequest;
use Teamtnt\SalesManagement\Models\ContactList;
use Teamtnt\SalesManagement\Models\LeadJourney;
use Teamtnt\SalesManagement\Models\Workflow;
use Teamtnt\SalesManagement\Models\Task;
use Symfony\Component\Workflow\Dumper\GraphvizDumper;

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
            ];
        });

        $messages = $task->messages->transform(function ($message) {
            return [
                'argument' => $message->id,
                'action'   => $message::class,
                'title'    => $message->subject,
            ];
        });

        $waitOptions = [
            [
                'argument' => 1,
                'action'   => 'wait',
                'title'    => '1h',
            ],
            [
                'argument' => 2,
                'action'   => 'wait',
                'title'    => '2h',
            ],
            [
                'argument' => 3,
                'action'   => 'wait',
                'title'    => '3h',
            ],
        ];

        return view('sales-management::workflows.create', compact('task', 'contactLists', 'waitOptions', 'messages'));
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
            ];
        });

        $messages = $workflow->task->messages->transform(function ($message) {
            return [
                'argument' => $message->id,
                'action'   => $message::class,
                'title'    => $message->subject,
            ];
        });

        $waitOptions = [
            [
                'argument' => 1,
                'action'   => 'wait',
                'title'    => '1h',
            ],
            [
                'argument' => 2,
                'action'   => 'wait',
                'title'    => '2h',
            ],
            [
                'argument' => 3,
                'action'   => 'wait',
                'title'    => '3h',
            ],
        ];

        return view('sales-management::workflows.edit', compact('workflow', 'task', 'contactLists', 'waitOptions', 'messages'));
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
        $workflow->status = 1;
        $workflow->save();

        request()->session()->flash('message', __('Workflow successfully published!'));

        return redirect()->route('workflows.index', $task);
    }

    public function unpublish(Task $task, Workflow $workflow)
    {
        $workflow->status = 0;
        $workflow->save();

        request()->session()->flash('message', __('Workflow successfully unpublished!'));

        return redirect()->route('workflows.index', $task);
    }

}
