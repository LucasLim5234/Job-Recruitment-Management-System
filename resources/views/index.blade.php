@extends('layouts.inapp')

@section('title', 'Job Search')

@section('content')
    <div id="heroCarousel" class="carousel slide mb-4" data-bs-ride="carousel" data-bs-interval="4000">
        <div class="carousel-inner" style="max-height: 320px; overflow: hidden;">
            <div class="carousel-item active">
                <img src="{{ asset('assets/images/home_bg_img_1.jpg') }}" class="d-block w-100 object-fit-cover"
                    style="height:320px;" alt="slide1">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/images/home_bg_img_2.jpg') }}" class="d-block w-100 object-fit-cover"
                    style="height:320px;" alt="slide2">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/images/home_bg_img_3.jpg') }}" class="d-block w-100 object-fit-cover"
                    style="height:320px;" alt="slide3">
            </div>
        </div>
    </div>
    <div class="container mb-4">
        <form action="{{ route('index') }}">
            <div class="row g-2 align-items-end">
                <div class="col-md">
                    <input type="text" class="form-control" name="keywords" value="{{ request('keywords') }}"
                        placeholder="Job Keywords">
                </div>
                <div class="col-md">
                    <input type="text" class="form-control" name="location" value="{{ request('location') }}"
                        placeholder="Location">
                </div>
                <div class="col-md">
                    <select name="position" class="form-select">
                        <option value="All" {{ request('position') == 'All' ? 'selected' : '' }}>All Positions</option>
                        @foreach ($allJobs as $allJob)
                            <option value="{{ $allJob->position }}"
                                {{ request('position') == $allJob->position ? 'selected' : '' }}>
                                {{ $allJob->position }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md">
                    <select name="mode" class="form-select">
                        <option value="All" {{ request('mode') == 'All' ? 'selected' : '' }}>All Modes</option>
                        <option value="Full time" {{ request('mode') == 'Full time' ? 'selected' : '' }}>Full Time</option>
                        <option value="Part time" {{ request('mode') == 'Part time' ? 'selected' : '' }}>Part Time</option>
                    </select>
                </div>
                <div class="col-md-auto">
                    <button type="submit" class="btn btn-primary w-100">Search</button>
                </div>
                <div class="col-md-auto">
                    <a href="{{ route('index') }}" class="btn btn-outline-primary">Show All</a>
                </div>
            </div>
        </form>
    </div>
    @if ($jobs->isNotEmpty())
        <div class="container">
            <div class="row">
                <div class="col-md-4 border-end" style="max-height:80vh; overflow-y:auto;">
                    <div class="list-group list-group-flush">
                        @foreach ($jobs as $job)
                            <button class="list-group-item list-group-item-action py-3 mb-3" data-bs-toggle="list"
                                data-bs-target="#job{{ $job->id }}">
                                <h6 class="fw-bold mb-1">{{ $job->position }}</h6>
                                <small class="text-muted">{{ $job->admin->company_name }}</small>
                                <div class="mt-2 small text-muted">
                                    <i class="fa-solid fa-location-dot" style="color:cornflowerblue"></i>
                                    {{ $job->location }} <br>
                                    <i class="fa-solid fa-dollar-sign" style="color:cornflowerblue"></i>
                                    RM {{ $job->salary }} / month
                                </div>
                                <p class="mt-2 small text-muted"
                                    style="display: -webkit-box; -webkit-line-clamp: 5; -webkit-box-orient: vertical; overflow: hidden;">
                                    {{ $job->description }}
                                </p>
                                <small class="text-muted">
                                    Published on {{ $job->updated_at->format('d M Y') }}
                                </small>
                            </button>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-8" style="max-height:80vh; overflow-y:auto;">
                    <div class="tab-content ps-md-4">
                        @foreach ($jobs as $job)
                            <div class="tab-pane fade" id="job{{ $job->id }}">
                                <div class="card shadow-sm mb-4">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div>
                                                <h4 class="mb-0">{{ $job->position }}</h4>
                                                <span class="text-muted">{{ $job->admin->company_name }}</span>
                                            </div>
                                            @if (auth()->user()->role == 'Applicant')
                                                @php
                                                    $savedJob = $job->savedJobs
                                                        ->where('applicant_id', auth()->user()->applicant->id)
                                                        ->first();
                                                @endphp
                                                @if (!$savedJob)
                                                    <form action="{{ route('savedJob.store') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="job_id" value="{{ $job->id }}">
                                                        <button type="submit" class="btn p-0 border-0"
                                                            title="Save this job">
                                                            <i class="fa-regular fa-bookmark fs-5 text-muted"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <form
                                                        action="{{ route('savedJob.destroy', ['savedJob' => $savedJob]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn p-0 border-0"
                                                            title="Unsave this job">
                                                            <i class="fa-solid fa-bookmark fs-5 text-primary"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="mb-3 text-muted">
                                            <i class="fa-solid fa-location-dot" style="color:cornflowerblue"></i>
                                            {{ $job->location }}<br>
                                            <i class="fa-solid fa-clock" style="color:cornflowerblue"></i>
                                            {{ $job->mode }} <br>
                                            <i class="fa-solid fa-dollar-sign" style="color:cornflowerblue"></i>
                                            RM {{ $job->salary }} per month <br><br>
                                            Published on {{ $job->updated_at->format('d M Y') }}
                                        </div>
                                        <hr>
                                        <h5>About this role</h5>
                                        <p class="mb-4">{{ $job->description }}</p>
                                        <h5>Key Responsibilities</h5>
                                        <p class="mb-4">{{ $job->responsibility }}</p>
                                        <h5>Requirements & Qualifications</h5>
                                        <ul class="mb-4">
                                            @foreach ($job->jobRequirements as $jobRequirement)
                                                <li>{{ $jobRequirement->description }}</li>
                                            @endforeach
                                        </ul>
                                        <h5>Benefits</h5>
                                        <p class="mb-4">{{ $job->benefit }}</p>
                                        <h5>Company Information</h5>
                                        <div class="card bg-light">
                                            <div class="card-body">
                                                <strong>{{ $job->admin->company_name }}</strong>
                                                <p class="mt-2 mb-1">{{ $job->admin->company_main_business }}</p>
                                                <p>{{ $job->admin->company_detail }}</p>
                                                <a href="{{ $job->admin->company_website }}" target="_blank"
                                                    class="btn btn-outline-primary btn-sm">
                                                    More About this Company →
                                                </a>
                                            </div>
                                        </div>
                                        @if (auth()->user()->role == 'Applicant')
                                            @php
                                                $applied = $job->applications->contains(
                                                    'applicant_id',
                                                    auth()->user()->applicant->id,
                                                );
                                            @endphp
                                            <button type="button"
                                                class="btn {{ $applied ? 'btn-secondary' : 'btn-primary' }} mt-5 w-100"
                                                {{ $applied ? 'disabled' : '' }} data-bs-toggle="modal"
                                                data-bs-target="#applicationForm" data-jobid="{{ $job->id }}">
                                                {{ $applied ? 'Applied' : 'Apply Now' }}
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @else
        No Relevant Job
    @endif

    <div class="modal fade" id="applicationForm" tabindex="-1" aria-labelledby="applicationFormModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="applicationFormModalLabel">Application Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('application.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" name="job_id" id="job_id">
                            <label for="resume" class="form-label">Upload Resume (PDF only)</label>
                            <input type="file" class="form-control" id="resume" name="resume" accept=".pdf"
                                required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const applicationForm = document.getElementById('applicationForm');
        applicationForm.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const jobId = button.getAttribute('data-jobid');
            const input = applicationForm.querySelector('#job_id');
            input.value = jobId;
        });
    </script>

@endsection
