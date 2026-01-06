@extends('layouts.inapp')

@section('title', $job->mode . ' ' . $job->position)

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">{{ $job->position }}</h4>
                        <small>{{ $job->location }} | {{ $job->mode }}</small>
                    </div>
                    <div class="card-body">
                        <p><strong>Salary:</strong>
                            RM {{ $job->salary }} Per Month
                        </p>
                        <h5>Description</h5>
                        <p>{{ $job->description }}</p>
                        <h5>Responsibilities</h5>
                        <p>{{ $job->responsibility }}</p>
                        <h5>Requirements & Qualifications</h5>
                        @foreach ($jobRequirements as $jobRequirement)
                            <div class="row">
                                <div class="col">{{ $jobRequirement->description }}</div>
                                <div class="col">{{ $jobRequirement->weight }}%</div>
                            </div>
                        @endforeach
                        <h5 class="mt-3">Benefits</h5>
                        <p>{{ $job->benefit }}</p>

                    </div>
                </div>
                @if (auth()->user()->role == 'Admin')
                    <div class="mt-4 mb-4">
                        <a href="{{ route('job.edit', ['job' => $job]) }}" class="btn btn-secondary w-100">Edit Job</a>
                    </div>
                    <form action="{{ route('job.destroy', $job) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this job?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            Delete Job
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
