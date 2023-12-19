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

        if ($pipelineRequest->has('pipeline_stages')) {

            $pipelineStages = $pipelineRequest->get('pipeline_stages');

            foreach ($pipelineStages as $pipelineStage) {
                $pipeline->pipelineStages()->create([
                    'name' => $pipelineStage['name'],
                    'description' => $pipelineStage['description'],
                    'color' => $pipelineStage['color'],
                ]);
            }
        }

        request()->session()->flash('message', __('Pipeline successfully created!'));

        return redirect()->route('teamtnt.sales-management.pipelines.index');
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
    public function update(PipelineRequest $pipelineRequest, Pipeline $pipeline)
    {
        $pipeline->update($pipelineRequest->validated());

        if ($pipelineRequest->has('pipeline_stages')) {

            $pipelineStages = $pipelineRequest->get('pipeline_stages');

            $pipelineStagesExistingIds = $pipeline->pipelineStages->pluck('id')->toArray();
            $pipelineStagesNewIds = array_column($pipelineStages, 'id');

            $pipelineStagesIdsToDelete = array_diff($pipelineStagesExistingIds, $pipelineStagesNewIds);

            if (!empty($pipelineStagesIdsToDelete)) {
                $pipeline->pipelineStages()->whereIn('id', $pipelineStagesIdsToDelete)->delete();
            }

            foreach ($pipelineStages as $pipelineStage) {
                $pipeline->pipelineStages()->updateOrCreate(
                    ['id' => $pipelineStage['id']],
                    [
                        'name' => $pipelineStage['name'],
                        'description' => $pipelineStage['description'],
                        'color' => $pipelineStage['color'],
                    ]
                );
            }

        }

        request()->session()->flash('message', __('Pipeline successfully updated!'));

        return redirect()->route('teamtnt.sales-management.pipelines.index');
    }

    /**
     * @param Pipeline $pipeline
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Pipeline $pipeline)
    {
        $pipeline->delete();

        $pipeline->pipelineStages()->where('pipeline_id', $pipeline->id)->delete();

        request()->session()->flash('message', __('Pipeline successfully deleted!'));

        return redirect()->route('teamtnt.sales-management.pipelines.index');
    }
}
