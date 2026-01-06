@extends('layouts.inapp')

@section('title', 'Saved Jobs')

@section('content')
    <div class="container py-4">
        <h4 class="text-center mb-3">My Saved Jobs</h4>
        <div class="row g-3">
            @if ($savedJobs->isEmpty())
                <div class="alert alert-info">No job is saved yet.</div>
            @else
                @foreach ($savedJobs as $savedJob)
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="{{ route('job.show', ['job' => $savedJob->job]) }}"
                            class="card w-100 text-start shadow-sm h-100 border-0 text-decoration-none text-dark">
                            <div class="card-body bg-info">
                                <h6 class="fw-bold mb-1">{{ $savedJob->job->position }}</h6>
                                <small class="text-muted">{{ $savedJob->job->admin->company_name }}</small>
                                <div class="mt-2 small text-muted">
                                    <i class="fa-solid fa-location-dot text-primary"></i>
                                    {{ $savedJob->job->location }} <br>
                                    <i class="fa-solid fa-dollar-sign text-primary"></i>
                                    RM {{ $savedJob->job->salary }} / month
                                </div>
                                <p class="mt-2 small text-muted"
                                    style="display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical; overflow: hidden;">
                                    {{ $savedJob->job->description }}
                                </p>
                                <small class="text-muted">
                                    Published on {{ $savedJob->job->updated_at->format('d M Y') }}
                                </small>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
