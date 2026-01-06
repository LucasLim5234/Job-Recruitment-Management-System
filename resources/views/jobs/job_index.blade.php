@extends('layouts.inapp')

@section('title', 'My Posted Jobs')

@section('content')
    <div class="container py-3">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        <div class="mb-4 text-end">
            <a href="{{ route('job.create') }}" class="btn btn-primary">Create a New Job</a>
        </div>
        @if ($jobs->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Branch Location</th>
                            <th>Position</th>
                            <th>Working Mode</th>
                            <th>Salary</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jobs as $job)
                            <tr>
                                <td>{{ $job->location }}</td>
                                <td>{{ $job->position }}</td>
                                <td>{{ $job->mode }}</td>
                                <td>{{ $job->salary }}</td>
                                <td>
                                    <a href="{{ route('job.show', ['job' => $job]) }}" class="btn btn-info btn-sm">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>No Job Posted Yet</p>
        @endif
    </div>
@endsection
