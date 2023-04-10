<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entries = 10;
        $employees = Employee::with('company')->paginate($entries);
        return view('employees.index', compact('employees'))
            ->with('i', (request()->input('page', 1) - 1) * $entries);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::pluck('name', 'id')->all();
        return view('employees.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $newEmployee = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'company_id' => 'required|exists:companies,id',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required'
        ]);
        Employee::create($newEmployee);
        return redirect()->route('employees.index')
            ->with('message', 'Employee Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return redirect()->route('employees.edit', $employee->id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $companies = Company::pluck('name', 'id')->all();
        return view('employees.edit', compact('companies', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $newEmployee = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'company_id' => 'required|exists:companies,id',
            'email' => 'email|unique:employees,email',
            'phone' => 'required|numeric'
        ]);

        $employee->update($newEmployee);
        return redirect()->route('employees.index')
            ->with('message', 'Employee Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')
            ->with('message', 'Employee Deleted Successfully');
    }
}
