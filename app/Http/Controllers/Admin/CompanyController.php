<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Services\DeleteLogoService;
use App\Services\StoreLogoService;
use App\Services\UpdateLogoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CompanyController extends Controller
{
    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax()) {
            if ($request->has('search') && $request->search != '') {
                $companies = Company::where('name', 'LIKE', "%{$request->search}%")->paginate(10);
            } else {
                $companies = Company::paginate(10);
            }
            return response()->json($companies);
        }
        return view('admin.companies.index');
    }

    public function create(): View
    {
        return view('admin.companies.create');
    }

    public function store(StoreCompanyRequest $request): RedirectResponse
    {
        $logoName = (new StoreLogoService())->execute($request);
        $data = $request->validated();
        $data['logo'] = $logoName;
        Company::create($data);
        session()->flash('success', 'You have added a company successfully');
        return redirect()->route('companies.index');
    }

    public function edit(Company $company): View
    {
        return view('admin.companies.edit', compact('company'));
    }

    public function update(UpdateCompanyRequest $request, Company $company): RedirectResponse
    {
        $data = $request->validated();
        if ($request->has('logo')) {
            $fileName = (new UpdateLogoService())->execute($request, $company->logo);
            $data['logo'] = $fileName;
        }
        $company->update($data);
        session()->flash('success', 'You have update a company successfully');
        return redirect()->route('companies.index');
    }

    public function destroy(Company $company)
    {
        $delete = true;
        try {
            $company->delete();
        } catch (\Exception $e) {
            session()->flash('fail', 'You can not delete this company');
            $delete = false;
        }
        if ($delete) {
            (new DeleteLogoService())->execute($company->logo);
            session()->flash('success', 'You have delete a company successfully');
        }
    }
}
