<?php

namespace Teamtnt\SalesManagement\Http\Controllers;

use Illuminate\Http\Request;
use Teamtnt\SalesManagement\DataTables\PipelineDataTable;
use Teamtnt\SalesManagement\Http\Requests\PipelineRequest;
use Teamtnt\SalesManagement\Http\Requests\PipelineStageRequest;
use Teamtnt\SalesManagement\Models\Pipeline;
use Teamtnt\SalesManagement\Models\PipelineStage;

class PipelineController extends Controller
{

    /**
     * @param PipelineDataTable $pipelineDataTable
     * @return mixed
     */
    public function index(PipelineDataTable $pipelineDataTable)
    {
        return $pipelineDataTable->render('sales-management::pipelines.index');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('sales-management::pipelines.create');
    }

    /**
     * @param PipelineRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PipelineRequest $pipelineRequest)
    {

        $pipeline = Pipeline::create($pipelineRequest->validated());

//TODO: WIP
        if ($pipelineRequest->get('pipeline_stages')) {

            $pipelineStages = $pipelineRequest->pipeline_stages;

            foreach ($pipelineStages as $stage) {
                PipelineStage::create(array_merge($pipelineRequest->validated(), [
                    'pipeline_id' => $pipeline->id,
                ]));
            }

        }

        request()->session()->flash('message', __('Pipeline successfully created!'));

        return redirect()->route('pipelines.index');
    }

    /**
     * @param Pipeline $pipeline
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Pipeline $pipeline)
    {
        return view('sales-management::pipelines.edit', compact('pipeline'));
    }

    /**
     * @param PipelineRequest $request
     * @param Pipeline $pipeline
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PipelineRequest $request, Pipeline $pipeline)
    {
        $pipeline->update($request->validated());

        request()->session()->flash('message', __('Pipeline successfully updated!'));

        return redirect()->route('pipelines.index');
    }

    /**
     * @param Pipeline $pipeline
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Pipeline $pipeline)
    {
        $pipeline->delete();

        request()->session()->flash('message', __('Pipeline successfully deleted!'));

        return redirect()->route('pipelines.index');
    }
}
