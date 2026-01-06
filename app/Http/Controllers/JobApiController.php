<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Job::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'admin_id' => 'required|string',
            'location' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'mode' => 'required|string|in:Full time,Part time',
            'salary' => 'required|numeric|min:1',
            'description' => 'required|string',
            'responsibility' => 'required|string',
            'benefit' => 'required|string',
        ]);

        return Job::create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Job::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $job = Job::findOrFail($id);
        $job->update($request->only(['location', 'position', 'mode', 'min_salary', 'max_salary', 'description', 'responsibility', 'benefit', 'requirements']));

        return $job;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $job = Job::findOrFail($id);
        $job->delete();

        return ['message' => 'Job Deleted'];
    }
}

// {
//     "admin_id": "1",
//     "location": "Kuantan",
//     "position": "Software Tester",
//     "mode": "Part time",
//     "salary": "3000",
//     "description": "Test developed software",
//     "responsibility": "Assist senior tester in testing software",
//     "benefit": "30 days annual leave provided"
// }