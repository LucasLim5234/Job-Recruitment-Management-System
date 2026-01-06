<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::where('admin_id', auth()->user()->admin->id)->orderByDesc('updated_at')->get();
        return view('jobs.job_index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jobs.job_create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'location' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'mode' => 'required|string|in:Full time,Part time',
            'min_salary' => 'required|numeric|min:1',
            'max_salary' => 'nullable|numeric|min:1|gt:min_salary',
            'description' => 'required|string',
            'responsibility' => 'required|string',
            'benefit' => 'required|string',
            'requirements.*' => 'required|string',
            'weights.*' => 'required|numeric|min:1',
        ]);

        if (array_sum($validated['weights']) !== 100) {
            return back()->withInput()->withErrors([
                'weights' => 'The sum of all weights must be exactly 100',
            ]);
        }

        if (!empty($validated['max_salary'])) {
            $validated['salary'] = $validated['min_salary'] . ' - ' . $validated['max_salary'];
        } else {
            $validated['salary'] = (string) $validated['min_salary'];
        }
        $validated['admin_id'] = auth()->user()->admin->id;
        $job = Job::create($validated);

        foreach ($validated['requirements'] as $index => $requirement) {
            $job->jobRequirements()->create([
                'description' => $requirement,
                'weight' => $validated['weights'][$index],
            ]);
        }

        return redirect()->route('job.index')->with('success', 'Job Posted');
    }


    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        $jobRequirements = $job->jobRequirements;
        return view('jobs.job_show', compact('job', 'jobRequirements'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        $salaryParts = explode(' - ', $job->salary);
        $min_salary = $salaryParts[0] ?? '';
        $max_salary = $salaryParts[1] ?? '';
        $jobRequirements = $job->jobRequirements;
        return view('jobs.job_edit', compact('job', 'min_salary', 'max_salary', 'jobRequirements'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        $validated = $request->validate([
            'location' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'mode' => 'required|string|in:Full time,Part time',
            'min_salary' => 'required|numeric|min:1',
            'max_salary' => 'nullable|numeric|min:1|gt:min_salary',
            'description' => 'required|string',
            'responsibility' => 'required|string',
            'benefit' => 'required|string',
            'requirements.*' => 'required|string',
            'weights.*' => 'required|numeric|min:1',
        ]);

        if (array_sum($validated['weights']) != 100) {
            return back()->withInput()->withErrors([
                'weights' => 'The sum of all weights must be exactly 100',
            ]);
        }

        if (!empty($validated['max_salary'])) {
            $validated['salary'] = $validated['min_salary'] . ' - ' . $validated['max_salary'];
        } else {
            $validated['salary'] = (string) $validated['min_salary'];
        }
        $job->update($validated);

        $job->jobRequirements()->delete();
        foreach ($validated['requirements'] as $index => $requirement) {
            $job->jobRequirements()->create([
                'description' => $requirement,
                'weight' => $validated['weights'][$index],
            ]);
        }

        return redirect()->route('job.show', ['job' => $job])->with('success', 'Job Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        $temp_job = $job->position;
        $job->delete();
        return redirect()->route('job.index')->with('success', 'Job for Position ' . $temp_job . ' Deleted');
    }

    public function home(Request $request)
    {
        $query = Job::query();
        if ($request->filled('keywords')) {
            $query->where(function ($q) use ($request) {
                $q->where('location', 'LIKE', '%' . $request['keywords'] . '%')
                    ->orWhere('position', 'LIKE', '%' . $request['keywords'] . '%')
                    ->orWhere('mode', 'LIKE', '%' . $request['keywords'] . '%')
                    ->orWhere('salary', 'LIKE', '%' . $request['keywords'] . '%')
                    ->orWhere('description', 'LIKE', '%' . $request['keywords'] . '%')
                    ->orWhere('responsibility', 'LIKE', '%' . $request['keywords'] . '%')
                    ->orWhere('benefit', 'LIKE', '%' . $request['keywords'] . '%');
            });
        }
        if ($request->filled('location')) {
            $query->where('location', 'LIKE', '%' . $request['location'] . '%');
        }
        if ($request->filled('position') && $request['position'] != 'All') {
            $query->where('position', $request['position']);
        }
        if ($request->filled('mode') && $request['mode'] != 'All') {
            $query->where('mode', $request['mode']);
        }
        $jobs = $query->orderByDesc('updated_at')->get();
        $allJobs = Job::select('position')->orderBy('position')->distinct()->get();
        return view('index', compact('jobs', 'allJobs'));
    }
}
