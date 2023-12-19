<?php

namespace Teamtnt\SalesManagement\Http\Controllers;

use Teamtnt\SalesManagement\DataTables\CompanyDataTable;
use Teamtnt\SalesManagement\Http\Requests\CompanyRequest;
use Teamtnt\SalesManagement\Models\Company;

class CompanyController extends Controller
{

    /**
     * @param CompanyDataTable $companyDataTable
     * @return mixed
     */
    public function index(CompanyDataTable $companyDataTable)
    {
        return $companyDataTable->render('sales-management::companies.index');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('sales-management::companies.create');
    }

    /**
     * @param CompanyRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CompanyRequest $request)
    {
        Company::create($request->validated());

        request()->session()->flash('message', __('Company successfully created!'));

        return redirect()->route('teamtnt.sales-management.companies.index');
    }

    /**
     * @param Company $company
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Company $company)
    {
        return view('sales-management::companies.edit', compact('company'));
    }

    /**
     * @param CompanyRequest $request
     * @param Company $company
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CompanyRequest $request, Company $company)
    {
        $company->update($request->validated());

        request()->session()->flash('message', __('Company successfully updated!'));

        return redirect()->route('teamtnt.sales-management.companies.index');
    }

    /**
     * @param Company $company
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Company $company)
    {
        $company->delete();

        request()->session()->flash('message', __('Company successfully deleted!'));

        return redirect()->route('teamtnt.sales-management.companies.index');
    }
}
