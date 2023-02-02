<?php

namespace Teamtnt\SalesManagement\Http\Controllers;

use Teamtnt\SalesManagement\Http\Requests\TaskRequest;
use Teamtnt\SalesManagement\Models\Contact;
use Teamtnt\SalesManagement\Models\Task;
use Teamtnt\SalesManagement\Models\Lead;

class TaskListController extends Controller
{

    public function index()
    {
        $tasks = Task::all();
        return view('sales-management::tasklist.index', compact('tasks'));
    }

    public function create()
    {
        return view('sales-management::tasklist.create');
    }

    public function store(TaskRequest $taskRequest)
    {

        $task = Task::create($taskRequest->validated());

        $this->createLeadsFromAllContacts($task->id, $task->pipeline_id);

        request()->session()->flash('message', __('Task successfully created!'));

        return redirect()->route('tasklist.index');
    }

    public function show(Task $task)
    {
        return view('sales-management::tasklist.show', compact('task'));
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
}
