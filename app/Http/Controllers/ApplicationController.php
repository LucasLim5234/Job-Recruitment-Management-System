<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\JobRequirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Str;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role == 'Applicant') {
            $applications = Application::where('applicant_id', auth()->user()->applicant->id)->orderByDesc('created_at')->get();
        } elseif (auth()->user()->role == 'Admin') {
            $applications = Application::whereHas('job', function ($query) {
                $query->where('admin_id', auth()->user()->admin->id);
            })->orderByDesc('score')->get();
        }
        return view('applications.application_index', compact('applications'));
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
        $request->validate([
            'resume' => 'required|file|mimes:pdf|max:1024',
        ]);
        $path = $request->file('resume')->store('resumes', 'public');
        $fullPath = storage_path('app/public/' . $path);
        $result = $this->ocrSpaceExtract($fullPath);
        $extractedText = $result['ParsedResults'][0]['ParsedText'];

        $score = 0;
        if (isset($extractedText)) {
            $JobRequirements = JobRequirement::where('job_id', $request['job_id'])->get();
            foreach ($JobRequirements as $JobRequirement) {
                if (Str::contains(strtolower($extractedText), strtolower($JobRequirement->description))) {
                    $score += $JobRequirement->weight;
                }
            }
        }

        Application::create([
            'applicant_id' => auth()->user()->applicant->id,
            'job_id' => $request['job_id'],
            'resume' => $path,
            'score' => $score,
        ]);

        return redirect()->route('application.index')->with('success', 'Application submitted successfully');
    }

    // Extract text from pdf file using OCR Space API
    public function ocrSpaceExtract(string $fullPath)
    {
        $response = Http::attach(
            'file',
            file_get_contents($fullPath),
            basename($fullPath)
        )->post('https://api.ocr.space/parse/image', [
                    'apikey' => config('services.ocrspace.key'),
                    'language' => 'eng',
                    'isOverlayRequired' => 'false',
                    'filetype' => 'PDF'
                ]);

        return $response->json();
    }

    /**
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
    {
        if (isset($request['interview_date'])) {
            $validated = $request->validate(
                [
                    'interview_date' => 'required|date',
                ]
            );
            $validated['status'] = 'Accepted';
            $msg = 'Interview scheduled successfully';
        } else {
            $validated = ['status' => 'Rejected'];
            $msg = 'Application has been rejected';
        }
        $application->update($validated);
        return redirect()->route('application.index')->with('success', $msg);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        $application->delete();
        return redirect()->route('application.index')->with('success', 'Application cancelled successfully');
    }
}
