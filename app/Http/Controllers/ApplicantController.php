<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;

class ApplicantController extends Controller
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
    public function show(Applicant $applicant)
    {
        return view('profiles.profile_show', compact('applicant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Applicant $applicant)
    {
        return view('profiles.profile_edit', compact('applicant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Applicant $applicant)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'gender' => 'nullable|string|in:Male,Female',
            'country' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'educations' => 'nullable|string',
            'industry' => 'nullable|string|max:255',
            'current_position' => 'nullable|string|max:255',
            'experiences' => 'nullable|string',
            'skills' => 'nullable|string',
        ]);

        $applicant->user->update([
            'name' => $validated['name'],
        ]);

        $applicantData = $validated;
        unset($applicantData['name']);

        $applicant->update($applicantData);

        return redirect()->route('applicant.profile.show', ['applicant' => $applicant])
            ->with('success', 'Profile updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Applicant $applicant)
    {
        //
    }
}
