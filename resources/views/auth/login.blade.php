@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center align-items-center">
        <div class="col-md-5">
            <div class="card shadow-lg rounded-4 border-0">
                <div class="card-header text-center text-white py-4"
                    style="background: linear-gradient(90deg, #6c5ce7, #00b894);">
                    <h3 class="fw-bold mb-0">Welcome Back</h3>
                    <small class="fw-light">Sign in to continue</small>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control rounded-3" id="email" name="email"
                                value="{{ old('email') }}" placeholder="name@example.com" required>
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
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg rounded-3 shadow-sm">Login</button>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger rounded-3">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </form>
                </div>
                <div class="card-footer bg-light text-center py-3">
                    <small class="d-block mb-1">Forgot Password? <a href="{{ route('password.request') }}"
                            class="text-decoration-none">Reset here</a></small>
                </div>
            </div>
        </div>
    </div>
@endsection
