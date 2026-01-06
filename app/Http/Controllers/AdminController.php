<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        return view('profiles.profile_show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        return view('profiles.profile_edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'department' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'company_detail' => 'required|string',
            'company_website' => 'required|string|max:255',
        ]);

        $admin->user->update([
            'name' => $validated['name'],
        ]);

        $adminData = $validated;
        unset($adminData['name']);

        $admin->update($adminData);

        return redirect()->route('admin.profile.show', ['admin' => $admin])
            ->with('success', 'Profile updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }

    public function companiesIndex()
    {
        $companies = Admin::select('company_name', 'company_detail', 'company_main_business', 'company_website')->get();
        return view('companies.company_index', compact('companies'));
    }

    public function companiesSearchBySector(Request $request)
    {
        $sector = $request['sector'];
        if ($sector != 'All') {
            $companies = Admin::select('company_name', 'company_detail', 'company_main_business', 'company_website')->where('company_main_business', $sector)->get();
        } else {
            $companies = Admin::select('company_name', 'company_detail', 'company_main_business', 'company_website')->get();
        }
        return view('companies.company_index', compact('companies', 'sector'));
    }
}
