@extends('layouts.inapp')

@section('title', 'Applications')

@section('content')
    <div class="container py-5">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if (auth()->user()->role == 'Applicant')
            <h2 class="mb-4">My Applications</h2>
            @if ($applications->isEmpty())
                <div class="alert alert-info">You have not applied to any jobs yet.</div>
            @else
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <strong>Applications Overview</strong>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr class="text-center">
                                        <th>Job Position</th>
                                        <th>Company</th>
                                        <th>Mode</th>
                                        <th>Applied On</th>
                                        <th>Status</th>
                                        <th>Resume</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($applications as $application)
                                        <tr class="text-center">
                                            <td>
                                                <a href="{{ route('job.show', ['job' => $application->job]) }}"
                                                    class="text-dark">
                                                    {{ $application->job->position }}
                                                </a>
                                            </td>
                                            <td>{{ $application->job->admin->company_name }}</td>
                                            <td>{{ $application->job->mode }}</td>
                                            <td>{{ $application->created_at->format('d M Y') }}</td>
                                            <td>
                                                @if ($application->status == 'Applied')
                                                    <span class="badge bg-secondary">{{ $application->status }}</span>
                                                    <form
                                                        action="{{ route('application.destroy', ['application' => $application]) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="badge btn btn-danger btn-sm">&times;</button>
                                                    </form>
                                                @else
                                                    <span
                                                        class="badge {{ $application->status == 'Accepted' ? 'bg-success' : 'bg-danger' }}">
                                                        @if ($application->status == 'Accepted')
                                                            Interview at
                                                            {{ $application->interview_date->format('d M Y H:i') }}
                                                        @else
                                                            {{ $application->status }}
                                                        @endif
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ asset('storage/' . $application->resume) }}" target="_blank"
                                                    class="btn btn-sm btn-outline-primary">View Resume</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        @endif
        @if (auth()->user()->role == 'Admin')
            <h2 class="mb-4">Applications for My Jobs</h2>
            @if ($applications->isEmpty())
                <div class="alert alert-info">No applications received yet.</div>
            @else
                @foreach ($applications->groupBy('job_id') as $jobApplications)
                    @php
                        $job = $jobApplications->first()->job;
                    @endphp
                    <div class="card mb-4 shadow-sm border-0">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <a href="{{ route('job.show', ['job' => $job]) }}" class="text-dark">
                                <strong>{{ $job->position }}</strong> &bull; <small>{{ $job->mode }}</small>
                            </a>
                            <span class="badge bg-light text-dark">{{ $jobApplications->count() }}
                                Application{{ $jobApplications->count() > 1 ? 's' : '' }}</span>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Applicant Name</th>
                                            <th>Score</th>
                                            <th>Resume</th>
                                            <th>Applied On</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jobApplications as $application)
                                            <tr class="text-center {{ $loop->even ? 'bg-light' : '' }}">
                                                <td>
                                                    <a
                                                        href="{{ route('applicant.profile.show', ['applicant' => $application->applicant]) }}">
                                                        {{ $application->applicant->user->name }}
                                                    </a>
                                                </td>
                                                <td>{{ $application->score }} / 100</td>
                                                <td>
                                                    <a href="{{ asset('storage/' . $application->resume) }}"
                                                        target="_blank" class="text-primary">View Resume</a>
                                                </td>
                                                <td>{{ $application->created_at->format('d M Y') }}</td>
                                                <td>
                                                    @if ($application->status == 'Applied')
                                                        <button type="button" class="btn btn-success btn-sm"
                                                            data-bs-toggle="modal" data-bs-target="#scheduleForm"
                                                            data-applicationid="{{ $application->id }}">
                                                            Schedule Interview
                                                        </button>
                                                        <form
                                                            action="{{ route('application.update', ['application' => $application]) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="action" value="reject">
                                                            <button type="submit"
                                                                class="btn btn-sm btn-danger">Reject</button>
                                                        </form>
                                                    @elseif ($application->status == 'Accepted')
                                                        <button class="btn btn-success btn-sm">Interview at
                                                            {{ $application->interview_date->format('d M Y H:i') }}</button>
                                                    @elseif ($application->status == 'Rejected')
                                                        <button class="btn btn-danger btn-sm">Rejected</button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="modal fade" id="scheduleForm" tabindex="-1" aria-labelledby="scheduleFormModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="scheduleFormModalLabel">Schedule an Interview</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="updateScheduleForm" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="interview_date" class="form-label">Interview Date</label>
                                        <input type="datetime-local" id="interview_date" name="interview_date"
                                            class="form-control" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    const scheduleForm = document.getElementById('scheduleForm');
                    const form = document.getElementById('updateScheduleForm');
                    scheduleForm.addEventListener('show.bs.modal', function(event) {
                        const button = event.relatedTarget;
                        const applicationId = button.getAttribute('data-applicationid');
                        form.action = '/application/' + applicationId;
                    });
                </script>
            @endif
        @endif
    </div>
@endsection
