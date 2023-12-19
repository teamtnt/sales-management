<?php

namespace Teamtnt\SalesManagement\Http\Controllers;

use Illuminate\Http\Request;
use Teamtnt\SalesManagement\DataTables\DealDataTable;
use Teamtnt\SalesManagement\Http\Requests\DealRequest;
use Teamtnt\SalesManagement\Models\Deal;

class DealController extends Controller
{

    /**
     * @param DealDataTable $dealDataTable
     * @return mixed
     */
    public function index(DealDataTable $dealDataTable)
    {
        return $dealDataTable->render('sales-management::deals.index');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('sales-management::deals.create');
    }

    /**
     * @param DealRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DealRequest $dealRequest)
    {
        Deal::create($dealRequest->validated());

        request()->session()->flash('message', __('Deal successfully created!'));

        return redirect()->route('teamtnt.sales-management.deals.index');
    }

    /**
     * @param Deal $deal
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Deal $deal)
    {
        return view('sales-management::deals.edit', compact('deal'));
    }

    /**
     * @param DealRequest $request
     * @param Deal $deal
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DealRequest $dealRequest, Deal $deal)
    {
        $deal->update($dealRequest->validated());

        if ($dealRequest->has('deal_stages')) {

            $dealStages = $dealRequest->get('deal_stages');

            $dealStagesExistingIds = $deal->dealStages->pluck('id')->toArray();
            $dealStagesNewIds = array_column($dealStages, 'id');

            $dealStagesIdsToDelete = array_diff($dealStagesExistingIds, $dealStagesNewIds);

            if (!empty($dealStagesIdsToDelete)) {
                $deal->dealStages()->whereIn('id', $dealStagesIdsToDelete)->delete();
            }

            foreach ($dealStages as $dealStage) {
                $deal->dealStages()->updateOrCreate(
                    ['id' => $dealStage['id']],
                    [
                        'name' => $dealStage['name'],
                        'description' => $dealStage['description'],
                        'color' => $dealStage['color'],
                    ]
                );
            }

        }

        request()->session()->flash('message', __('Deal successfully updated!'));

        return redirect()->route('teamtnt.sales-management.deals.index');
    }

    /**
     * @param Deal $deal
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Deal $deal)
    {
        $deal->delete();

        request()->session()->flash('message', __('Deal successfully deleted!'));

        return redirect()->route('teamtnt.sales-management.deals.index');
    }
}
