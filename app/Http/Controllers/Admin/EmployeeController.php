<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax()) {
            if ($request->has('search') && $request->search != '') {
                $employees = Employee::with('company')->where('first_name', 'LIKE', "%{$request->search}%")
                    ->orWhere('last_name', 'LIKE', "%{$request->search}%")
                    ->paginate(10);
            } else {
                $employees = Employee::with('company')->paginate(10);
            }
            return response()->json($employees);
        }
        return view('admin.employees.index');
    }

    public function create(): View
    {
        $companies = Company::get(['id', 'name']);
        return view('admin.employees.create', compact('companies'));
    }

    public function store(StoreEmployeeRequest $request): RedirectResponse
    {
        Employee::create($request->validated());
        session()->flash('success', 'You have added an employee successfully');
        return redirect()->route('employees.index');
    }

    public function edit(Employee $employee): View
    {
        $companies = Company::get(['id', 'name']);
        return view('admin.employees.edit', compact('companies', 'employee'));
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee): RedirectResponse
    {
        $employee->update($request->validated());
        session()->flash('success', 'You have updated an employee successfully');
        return redirect()->route('employees.index');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        session()->flash('success', 'You have deleted an employee successfully');
    }
}
