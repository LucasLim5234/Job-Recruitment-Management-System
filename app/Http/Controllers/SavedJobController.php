<?php

namespace App\Http\Controllers;

use App\Models\SavedJob;
use Illuminate\Http\Request;

class SavedJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $savedJobs = SavedJob::where('applicant_id', auth()->user()->applicant->id)->get();
        return view('saved_jobs.saved_job_index', compact('savedJobs'));
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
        SavedJob::create([
            'applicant_id' => auth()->user()->applicant->id,
            'job_id' => $request['job_id'],
        ]);
        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     */
    public function show(SavedJob $savedJob)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SavedJob $savedJob)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SavedJob $savedJob)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SavedJob $savedJob)
    {
        $savedJob->delete();
        return redirect()->route('index');
    }
}
