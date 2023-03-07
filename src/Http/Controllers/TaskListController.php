<?php

namespace Teamtnt\SalesManagement\Http\Controllers;

use Teamtnt\SalesManagement\DataTables\TaskListDataTable;
use Teamtnt\SalesManagement\Http\Requests\TaskRequest;
use Teamtnt\SalesManagement\Models\Contact;
use Teamtnt\SalesManagement\Models\Deal;
use Teamtnt\SalesManagement\Models\Task;
use Teamtnt\SalesManagement\Models\Lead;
use Illuminate\Http\Request;
use Teamtnt\SalesManagement\Jobs\ApplyTransitionByNameJob;

class TaskListController extends Controller
{
    public function index(TaskListDataTable $taskListDataTable)
    {
        return $taskListDataTable->render('sales-management::tasklist.index');
    }

    public function create()
    {
        return view('sales-management::tasklist.create');
    }

    public function store(TaskRequest $taskRequest)
    {
        $task = Task::create($taskRequest->validated());
        $task->assignees()->sync($taskRequest->get('assignees'));
        $this->createLeadsFromAllContacts($task->id, $task->pipeline_id);

        request()->session()->flash('message', __('Task successfully created!'));

        return redirect()->route('tasklist.index');
    }

    public function edit(Task $task)
    {
        return view('sales-management::tasklist.edit', compact('task'));
    }

    public function update(TaskRequest $taskRequest, Task $task)
    {
        $task->update($taskRequest->validated());
        $task->assignees()->sync($taskRequest->get('assignees'));
        request()->session()->flash('message', __('Task successfully updated!'));

        return redirect()->route('tasklist.index');
    }

    public function show(Task $task)
    {
        return view('sales-management::tasklist.show', compact('task'));
    }

    public function stageChange(Request $request)
    {
        $leadId = $request->lead_id;
        $lead = Lead::where('id', $leadId)
            ->where('pipeline_id', $request->pipeline_id)
            ->where('pipeline_stage_id', $request->source_stage_id ?? 0)
            ->first();

        if (!$lead) {
            return;
        }

        $lead->pipeline_stage_id = $request->target_stage_id;
        $lead->save();

        foreach ($lead->task->publishedWorkflows() as $workflow) {
            ApplyTransitionByNameJob::dispatch($leadId, $workflow->id, "stage.change.".$lead->pipeline_stage_id);
        }
    }

    public function createLeadsFromAllContacts($task_id, $pipeline_id)
    {
        $leadsTableName = (new Lead)->getTable();

        $select = Contact::select(["id", \DB::raw("{$task_id} as task_id"), \DB::raw("{$pipeline_id} as pipeline_id"), \DB::raw("0 as pipeline_stage_id")]);
        $bindings = $select->getBindings();

        $insertQuery = "INSERT into {$leadsTableName} (contact_id, task_id, pipeline_id, pipeline_stage_id) "
            .$select->toSql();

        \DB::insert($insertQuery, $bindings);
    }

    public function destroy(Task $task)
    {
        $task->delete();

        request()->session()->flash('message', __('Task successfully deleted!'));

        return redirect()->route('tasklist.index');
    }
}
