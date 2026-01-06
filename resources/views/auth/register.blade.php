@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="card shadow-lg rounded-4 border-0">
                <div class="card-header text-center text-white py-4"
                    style="background: linear-gradient(90deg, #6c5ce7, #00b894);">
                    <h3 class="fw-bold mb-1">Create Account</h3>
                    <small class="fw-light">Sign up to get started</small>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-3" id="name" name="name"
                                value="{{ old('name') }}" placeholder="Full Name" required>
                            <label for="name">Full Name</label>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control rounded-3" id="email" name="email"
                                value="{{ old('email') }}" placeholder="Email" required>
                            <label for="email">Email address</label>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control rounded-3" id="password" name="password"
                                placeholder="Password" required>
                            <label for="password">Password</label>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control rounded-3" id="confirmPassword"
                                name="password_confirmation" placeholder="Confirm Password" required>
                            <label for="confirmPassword">Confirm Password</label>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <input type="text" name="role" value="Applicant" hidden>
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg rounded-3 shadow-sm">Register</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer bg-light text-center py-3">
                    <small>Are you a company admin? <a href="{{ route('adminRegister') }}"
                            class="text-decoration-none">Register as admin here</a></small>
                </div>
            </div>
        </div>
    </div>
@endsection
