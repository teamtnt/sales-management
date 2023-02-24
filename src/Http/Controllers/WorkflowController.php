<?php

namespace Teamtnt\SalesManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Teamtnt\SalesManagement\DataTables\WorkflowDataTable;
use Teamtnt\SalesManagement\Http\Requests\WorkflowRequest;
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
        return view('sales-management::workflows.create', compact('task'));
    }

    /**
     * @param  WorkflowRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Task $task)
    {
        $workflow = new Workflow;
        $workflow->task_id = $task->id;
        $workflow->name = request()->title;
        $workflow->elements = json_encode(request()->elements);
        $workflow->generateStateMachineDefinitionFromElements(request()->elements);

        $workflow->save();
    }

    /**
     * @param  Workflow  $workflow
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Task $task, Workflow $workflow)
    {
        return view('sales-management::workflows.edit', compact('workflow', 'task'));
    }

    /**
     * @param  WorkflowRequest  $request
     * @param  Workflow  $workflow
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Task $task, WorkflowRequest $workflowRequest, Workflow $workflow)
    {
        $workflow->update($workflowRequest->validated());

        request()->session()->flash('message', __('Workflow successfully updated!'));

        return redirect()->route('workflows.index', $task);
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

    public function show(Task $task, Workflow $workflow)
    {
        return view('sales-management::workflows.show', compact('workflow', 'task'));
    }

    public function newWorkflow()
    {
        return view('sales-management::workflow.new');
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

    public function saveElements(Task $task, Workflow $workflow, Request $request)
    {
        $workflow->elements = json_encode($request->elements);
        $workflow->generateStateMachineDefinitionFromElements($request->elements);
        $workflow->save();

        dd($workflow->state_machine_definition);
    }
}
