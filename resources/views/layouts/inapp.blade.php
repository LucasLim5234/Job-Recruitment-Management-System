<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    @if (auth()->user()->role == 'Applicant')
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
            <div class="container">
                <a class="navbar-brand fw-bold" href="{{ route('index') }}">JobLinker</a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('index') ? 'active' : '' }}"
                                href="{{ route('index') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('application.index') ? 'active' : '' }}"
                                href="{{ route('application.index') }}">Application</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('companies.index') ? 'active' : '' }}"
                                href="{{ route('companies.index') }}">Company</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown">
                                <img src="{{ asset('assets/images/applicant_account_icon.png') }}"
                                    alt="applicant_account_icon" width="40" height="40" class="rounded-circle">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('applicant.profile.show', ['applicant' => auth()->user()->applicant]) }}">
                                        My Profile</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('savedJob.index') }}">
                                        Saved Jobs</a>
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container mt-4">
            @yield('content')
        </div>
    @elseif(auth()->user()->role == 'Admin')
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
            <div class="container">
                <a class="navbar-brand fw-bold" href="{{ route('index') }}">JobLinker</a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('index') ? 'active' : '' }}"
                                href="{{ route('index') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('application.index') ? 'active' : '' }}"
                                href="{{ route('application.index') }}">Application</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('job.index') ? 'active' : '' }}"
                                href="{{ route('job.index') }}">Job Administration</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown">
                                <img src="{{ asset('assets/images/admin_account_icon.png') }}" alt="admin_account_icon"
                                    width="40" height="40" class="rounded-circle">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('admin.profile.show', ['admin' => auth()->user()->admin]) }}">
                                        My Profile</a>
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container mt-4">
            @yield('content')
        </div>
    @endif
    <footer class="mt-3 p-2 text-bg-dark text-center">&copy; 2025 JobLinker. All rights reserved</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/2d6dd57f6b.js" crossorigin="anonymous"></script>
</body>

</html>
