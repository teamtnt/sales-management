<?php

namespace Teamtnt\SalesManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Teamtnt\SalesManagement\DataTables\WorkflowDataTable;
use Teamtnt\SalesManagement\Http\Requests\WorkflowRequest;
use Teamtnt\SalesManagement\Models\Workflow;

class WorkflowController extends Controller
{

    /**
     * @param  WorkflowDataTable  $workflowDataTable
     * @return mixed
     */
    public function index(WorkflowDataTable $workflowDataTable)
    {
        return $workflowDataTable->render('sales-management::workflows.index');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('sales-management::workflows.create');
    }

    /**
     * @param  WorkflowRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(WorkflowRequest $workflowRequest)
    {
        Workflow::create($workflowRequest->validated());

        request()->session()->flash('message', __('Workflow successfully created!'));

        return redirect()->route('workflows.index');
    }

    /**
     * @param  Workflow  $workflow
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Workflow $workflow)
    {
        return view('sales-management::workflows.edit', compact('workflow'));
    }

    /**
     * @param  WorkflowRequest  $request
     * @param  Workflow  $workflow
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(WorkflowRequest $workflowRequest, Workflow $workflow)
    {
        $workflow->update($workflowRequest->validated());

        request()->session()->flash('message', __('Workflow successfully updated!'));

        return redirect()->route('workflows.index');
    }

    /**
     * @param  Workflow  $workflow
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Workflow $workflow)
    {
        $workflow->delete();

        request()->session()->flash('message', __('Workflow successfully deleted!'));

        return redirect()->route('workflows.index');
    }

    public function show(Workflow $workflow)
    {
        return view('sales-management::workflows.show', compact('workflow'));
    }
}
