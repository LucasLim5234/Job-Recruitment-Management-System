@extends('layouts.inapp')

@section('title', 'My Profile')

@section('content')
    <div class="container mt-5">
        @if (auth()->user()->role == 'Applicant')
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            <div class="row justify-content-center mb-4">
                <div class="col-md-3 text-center">
                    <img src="{{ asset('assets/images/profile_thumbnail.png') }}" alt="avatar"
                        class="rounded-circle img-fluid mb-3" style="width: 150px; height: 150px;">
                    <h4>{{ $applicant->user->name }}'s Profile</h4>
                </div>
                <div class="col-md-8">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-primary text-white">
                            Personal Information
                        </div>
                        <div class="card-body">
                            <div><strong>Phone Number:</strong>
                                {{ $applicant->phone_number ?? '-' }}</div>
                            <div><strong>Gender:</strong>
                                {{ $applicant->gender ?? '-' }}</div>
                            <div><strong>Country:</strong>
                                {{ $applicant->country ?? '-' }}</div>
                            <div><strong>City:</strong> {{ $applicant->city ?? '-' }}
                            </div>
                            <div><strong>Educations:</strong>
                                {{ $applicant->educations ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="card shadow-sm">
                        <div class="card-header bg-success text-white">
                            Professional Information
                        </div>
                        <div class="card-body">
                            <div><strong>Industry:</strong>
                                {{ $applicant->industry ?? '-' }}</div>
                            <div><strong>Current Position:</strong>
                                {{ $applicant->current_position ?? '-' }} </div>
                            <div><strong>Experiences:</strong>
                                {{ $applicant->experiences ?? '-' }} </div>
                            <div><strong>Skills:</strong>
                                {{ $applicant->skills ?? '-' }} </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5 mb-3"><a href="{{ route('applicant.profile.edit', ['applicant' => $applicant]) }}"
                    class="btn btn-secondary">Edit Profile</a></div>
        @elseif (isset($applicant) && $applicant->user_id != auth()->user()->id)
            <div class="row justify-content-center mb-4">
                <div class="col-md-3 text-center">
                    <img src="{{ asset('assets/images/profile_thumbnail.png') }}" alt="avatar"
                        class="rounded-circle img-fluid mb-3" style="width: 150px; height: 150px;">
                    <h4>{{ $applicant->user->name }}'s Profile</h4>
                </div>
                <div class="col-md-8">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-primary text-white">
                            Personal Information
                        </div>
                        <div class="card-body">
                            <div><strong>Phone Number:</strong>
                                {{ $applicant->phone_number ?? '-' }}</div>
                            <div><strong>Gender:</strong>
                                {{ $applicant->gender ?? '-' }}</div>
                            <div><strong>Country:</strong>
                                {{ $applicant->country ?? '-' }}</div>
                            <div><strong>City:</strong> {{ $applicant->city ?? '-' }}
                            </div>
                            <div><strong>Educations:</strong>
                                {{ $applicant->educations ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="card shadow-sm">
                        <div class="card-header bg-success text-white">
                            Professional Information
                        </div>
                        <div class="card-body">
                            <div><strong>Industry:</strong>
                                {{ $applicant->industry ?? '-' }}</div>
                            <div><strong>Current Position:</strong>
                                {{ $applicant->current_position ?? '-' }} </div>
                            <div><strong>Experiences:</strong>
                                {{ $applicant->experiences ?? '-' }} </div>
                            <div><strong>Skills:</strong>
                                {{ $applicant->skills ?? '-' }} </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (auth()->user()->role == 'Admin' && !isset($applicant))
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            <div class="row justify-content-center mb-4">
                <div class="col-md-3 text-center">
                    <img src="{{ asset('assets/images/profile_thumbnail.png') }}" alt="avatar"
                        class="rounded-circle img-fluid mb-3" style="width: 150px; height: 150px;">
                    <h4>{{ $admin->user->name }}'s Profile</h4>
                </div>
                <div class="col-md-8">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-primary text-white">
                            Personal Information
                        </div>
                        <div class="card-body">
                            <div><strong>Department:</strong>
                                {{ $admin->department ?? '-' }}</div>
                            <div><strong>Position:</strong>
                                {{ $admin->position ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="card shadow-sm">
                        <div class="card-header bg-success text-white">
                            Company Information
                        </div>
                        <div class="card-body">
                            <div><strong>Company Name:</strong>
                                {{ $admin->company_name ?? '-' }}</div>
                            <div><strong>Company Location:</strong>
                                {{ $admin->company_location ?? '-' }} </div>
                            <div><strong>Company Main Business:</strong>
                                {{ $admin->company_main_business ?? '-' }} </div>
                            <div><strong>Company Details:</strong>
                                {{ $admin->company_detail ?? '-' }} </div>
                            <div><strong>Company Website:</strong>
                                {{ $admin->company_website ?? '-' }} </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5 mb-3"><a href="{{ route('admin.profile.edit', ['admin' => $admin]) }}"
                    class="btn btn-secondary">Edit Profile</a></div>
        @endif
    </div>
@endsection
