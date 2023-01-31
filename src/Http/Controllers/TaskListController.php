<?php

namespace Teamtnt\SalesManagement\Http\Controllers;

use Teamtnt\SalesManagement\Http\Requests\TaskRequest;
use Teamtnt\SalesManagement\Models\Task;

class TaskListController extends Controller
{

    public function index()
    {
        return view('sales-management::tasklist.index');
    }

    public function create()
    {
        return view('sales-management::tasklist.create');
    }

    public function store(TaskRequest $taskRequest)
    {
        Task::create($taskRequest->validated());

        request()->session()->flash('message', __('Task successfully created!'));

        return redirect()->route('tasklist.index');
    }

    public function primjer1()
    {
        return view('sales-management::tasklist.primjer1');
    }

    public function primjer2()
    {
        return view('sales-management::tasklist.primjer2');
    }
}
