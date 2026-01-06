@extends('layouts.inapp')

@section('title', 'My Profile')

@section('content')
    @if (auth()->user()->role == 'Applicant')
        <div class="container mt-4">
            <div class="s-body text-center mt-3">
                <h2 class="mb-4">{{ $applicant->user->name }}'s Profile</h2>
            </div>
            <form action="{{ route('applicant.profile.update', ['applicant' => $applicant]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="mb-3">Personal Information</h5>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ $applicant->user->name }}" required>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ $applicant->user->email }}" disabled>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label class="form-label">Phone Number</label>
                                <input type="text" name="phone_number" class="form-control"
                                    value="{{ $applicant->phone_number ?? '' }}">
                                @error('phone_number')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Gender</label>
                                <select name="gender" class="form-control">
                                    <option value="" {{ !isset($applicant->gender) ? 'selected' : '' }}>
                                        Prefer Not to Say</option>
                                    <option value="Male" {{ ($applicant->gender ?? '') == 'Male' ? 'selected' : '' }}>
                                        Male
                                    </option>
                                    <option value="Female" {{ ($applicant->gender ?? '') == 'Female' ? 'selected' : '' }}>
                                        Female</option>
                                </select>
                                @error('gender')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Country</label>
                                <input type="text" name="country" class="form-control"
                                    value="{{ $applicant->country ?? '' }}">
                                @error('country')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">City</label>
                                <input type="text" name="city" class="form-control"
                                    value="{{ $applicant->city ?? '' }}">
                                @error('city')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Educations</label>
                                <input type="text" name="educations" class="form-control"
                                    value="{{ $applicant->educations ?? '' }}"
                                    placeholder="e.g., Degree in Computer Science">
                                @error('educations')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <h5 class="mb-3">Professional Information</h5>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Industry</label>
                                <input type="text" name="industry" class="form-control"
                                    value="{{ $applicant->industry ?? '' }}" placeholder="e.g., Software Development">
                                @error('industry')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Current Position</label>
                                <input type="text" name="current_position" class="form-control"
                                    value="{{ $applicant->current_position ?? '' }}" placeholder="e.g., Backend Developer">
                                @error('current_position')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Experiences</label>
                            <textarea name="experiences" rows="3" class="form-control" placeholder="Describe your work experiences">{{ $applicant->experiences ?? '' }}</textarea>
                            @error('experiences')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Skills</label>
                            <textarea name="skills" rows="3" class="form-control" placeholder="e.g., PHP, Laravel, MySQL, Teamwork">{{ $applicant->skills ?? '' }}</textarea>
                            @error('skills')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    @endif
    @if (auth()->user()->role == 'Admin')
        <div class="container mt-4">
            <div class="s-body text-center mt-3">
                <h2 class="mb-4">{{ $admin->user->name }}'s Profile</h2>
            </div>
            <form action="{{ route('admin.profile.update', ['admin' => $admin]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="mb-3">Personal Information</h5>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ $admin->user->name }}" required>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ $admin->user->email }}" disabled>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label class="form-label">Department</label>
                                <input type="text" name="department" class="form-control"
                                    value="{{ $admin->department ?? '' }}">
                                @error('department')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Position</label>
                                <input type="text" name="position" class="form-control"
                                    value="{{ $admin->position ?? '' }}">
                                @error('position')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <h5 class="mb-3">Company Information</h5>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">Company Name</label>
                                    <input type="text" name="company_name" class="form-control"
                                        value="{{ $admin->company_name }}" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Company Location</label>
                                    <input type="text" name="company_location" class="form-control"
                                        value="{{ $admin->company_location }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <label class="form-label">Company Main Business</label>
                                    <input type="text" name="company_main_business" class="form-control"
                                        value="{{ $admin->company_main_business }}" disabled>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Company Details</label>
                                <textarea name="company_detail" rows="3" class="form-control" placeholder="Describe your company" required>{{ $admin->company_detail ?? '' }}</textarea>
                                @error('company_detail')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Company Website</label>
                                <textarea name="company_website" rows="3" class="form-control" placeholder="e.g., " required>{{ $admin->company_website ?? '' }}</textarea>
                                @error('company_website')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                        </div>
                    </div>
            </form>
        </div>
    @endif
@endsection
