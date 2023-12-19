<?php

namespace Teamtnt\SalesManagement\Http\Controllers;

use Teamtnt\SalesManagement\DataTables\CompanyDataTable;
use Teamtnt\SalesManagement\DataTables\TagDataTable;
use Teamtnt\SalesManagement\Http\Requests\CompanyRequest;
use Teamtnt\SalesManagement\Http\Requests\TagRequest;
use Teamtnt\SalesManagement\Models\Tag;

class TagsController extends Controller
{

    /**
     * @param CompanyDataTable $companyDataTable
     * @return mixed
     */
    public function index(TagDataTable $tagDataTable)
    {
        return $tagDataTable->render('sales-management::tags.index');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('sales-management::tags.create');
    }

    /**
     * @param CompanyRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TagRequest $request)
    {
        Tag::create($request->validated());

        request()->session()->flash('message', __('Tag successfully created!'));

        return redirect()->route('teamtnt.sales-management.tags.index');
    }

    /**
     * @param Tag $tag
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Tag $tag)
    {
        return view('sales-management::tags.edit', compact('tag'));
    }

    /**
     * @param TagRequest $request
     * @param Tag $tag
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TagRequest $request, Tag $tag)
    {
        $tag->update($request->validated());

        request()->session()->flash('message', __('Tag successfully updated!'));

        return redirect()->route('teamtnt.sales-management.tags.index');
    }

    /**
     * @param Tag $tag
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        request()->session()->flash('message', __('Tag successfully deleted!'));

        return redirect()->route('teamtnt.sales-management.tags.index');
    }
}
