<?php

namespace App\Http\Controllers;

use App\DataTables\CompaniesDataTable;
use App\Mail\NewCompanyNotification;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $entries = 10;
    //     $companies = Company::latest()->paginate($entries);
    //     return view('companies.index', compact('companies'))
    //         ->with('i', (request()->input('page', 1) - 1) * $entries);
    // }
    public function index(CompaniesDataTable $dataTable)
    {
        return $dataTable->render('companies.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $newCompany = $request->validate([
            'name' => 'required|max:255',
            'email' => 'nullable|email',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:min_width=100,min_height=100',
            'website' => 'nullable|url',
        ]);
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public', $filename);
            $newCompany['logo'] = $filename;
        }

        $company = Company::create($newCompany);

        // send email notification
        if ($newCompany['email'])
            Mail::to($newCompany['email'])->send(new NewCompanyNotification($company));

        return redirect()->route('companies.show', $company)
            ->with('message', 'Company Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        $entries = 10;
        $employees = $company->employees()->paginate($entries);
        return view('companies.show', compact('company', 'employees'))
            ->with('i', (request()->input('page', 1) - 1) * $entries);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $updatedCompany = $request->validate([
            'name' => 'required|max:255',
            'email' => 'nullable|email',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:min_width=100,min_height=100',
            'website' => 'nullable|url',
        ]);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public', $filename);
            $updatedCompany['logo'] = $filename;
        }

        $company->update($updatedCompany);
        return redirect()->route('companies.show', $company)
            ->with('message', 'Company Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();
    }
}
