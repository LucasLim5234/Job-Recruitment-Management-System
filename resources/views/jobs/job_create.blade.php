@extends('layouts.inapp')

@section('title', 'Create Job')

@section('content')
    <div class="container py-5">
        <h3 class="mb-4">Post a Job</h3>
        <form action="{{ route('job.store') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="location" class="form-label">Branch Location</label>
                    <input type="text" name="location" value="{{ old('location') }}" class="form-control" id="location"
                        placeholder="Branch location" required>
                    @error('location')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="position" class="form-label">Position</label>
                    <input type="text" name="position" value="{{ old('position') }}" class="form-control" id="position"
                        placeholder="Position" required>
                    @error('position')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="mode" class="form-label">Working Mode</label>
                <select name="mode" id="mode" class="form-select" required>
                    <option value="" selected disabled>Select a working mode</option>
                    <option value="Full time" {{ old('mode') == 'Full time' ? 'selected' : '' }}>Full time</option>
                    <option value="Part time" {{ old('mode') == 'Part time' ? 'selected' : '' }}>Part time</option>
                </select>
                @error('mode')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="min_salary" class="form-label">Minimum Salary (RM)</label>
                    <input type="number" name="min_salary" value="{{ old('min_salary') }}" class="form-control"
                        id="min_salary" min="1" step="1" required>
                    @error('min_salary')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="max_salary" class="form-label">Maximum Salary (RM)</label>
                    <input type="number" name="max_salary" value="{{ old('max_salary') }}" class="form-control"
                        id="max_salary" min="1" step="1">
                    @error('max_salary')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Job Description</label>
                <textarea name="description" id="description" class="form-control" rows="3" placeholder="Describe the job"
                    required>{{ old('description') }}</textarea>
                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="responsibility" class="form-label">Responsibilities</label>
                <textarea name="responsibility" id="responsibility" class="form-control" rows="3"
                    placeholder="Describe the key responsibility" required>{{ old('responsibility') }}</textarea>
                @error('responsibility')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Requirements & Qualifications</label>
                <small class="text-muted"></small>
                <div id="requirements-container">
                    @if (old('requirements'))
                        @foreach (old('requirements') as $index => $requirement)
                            <div class="row mb-2 requirement-row">
                                <div class="col-md-8">
                                    <input type="text" name="requirements[]" class="form-control"
                                        value="{{ $requirement }}" placeholder="Requirement" required>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="weights[]" class="form-control"
                                        value="{{ old('weights')[$index] ?? '' }}" placeholder="Weight" min="1"
                                        required>
                                </div>
                                @if ($index != 0)
                                    <div class="col-md-1">
                                        <button type="button"
                                            class="btn btn-danger btn-sm remove-requirement">&times;</button>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <div class="row mb-2 requirement-row">
                            <div class="col-md-8">
                                <input type="text" name="requirements[]" class="form-control"
                                    placeholder="Requirement" required>
                            </div>
                            <div class="col-md-3">
                                <input type="number" name="weights[]" class="form-control" placeholder="Weight"
                                    min="1" required>
                            </div>
                        </div>
                    @endif
                </div>
                <button type="button" id="add-requirement" class="btn btn-secondary btn-sm mt-2">Add
                    Requirement</button>
                @error('weights')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="benefit" class="form-label">Benefits</label>
                <textarea name="benefit" id="benefit" class="form-control" rows="3" placeholder="Describe what you offer"
                    required>{{ old('benefit') }}</textarea>
                @error('benefit')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create Job</button>
        </form>
    </div>
    <script>
        document.getElementById('add-requirement').addEventListener('click', function() {
            let container = document.getElementById('requirements-container');
            let newRow = document.createElement('div');
            newRow.classList.add('row', 'mb-2', 'requirement-row');
            newRow.innerHTML = `
            <div class="col-md-8">
                <input type="text" name="requirements[]" class="form-control" placeholder="Requirement" required>
            </div>
            <div class="col-md-3">
                <input type="number" name="weights[]" class="form-control" placeholder="Weight" min="1" required>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger btn-sm remove-requirement">&times;</button>
            </div>
        `;
            container.appendChild(newRow);
        });
        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-requirement')) {
                e.target.closest('.requirement-row').remove();
            }
        });
    </script>
@endsection
