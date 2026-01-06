@extends('layouts.inapp')

@section('title', 'Companies')

@section('content')
    <div class="container py-5">
        <form action="{{ route('companies.searchBySector') }}">
            <div class="row">
                <div class="col">Sector</div>
                <div class="col">
                    <select name="sector" class="form-control" onchange="this.form.submit()">
                        <option value="All" {{ isset($sector) && $sector == 'All' ? 'selected' : '' }}>All</option>
                        <option value="Information Technology" {{ isset($sector) && $sector == 'Information Technology' ? 'selected' : '' }}>
                            Information Technology</option>
                        <option value="Construction" {{ isset($sector) && $sector == 'Construction' ? 'selected' : '' }}>
                            Construction</option>
                        <option value="Agriculture" {{ isset($sector) && $sector == 'Agriculture' ? 'selected' : '' }}>
                            Agriculture</option>
                        <option value="Healthcare" {{ isset($sector) && $sector == 'Healthcare' ? 'selected' : '' }}>
                            Healthcare</option>
                        <option value="Finance" {{ isset($sector) && $sector == 'Finance' ? 'selected' : '' }}>
                            Finance
                        </option>
                    </select>
                </div>
            </div>
        </form>

        @if ($companies->isNotEmpty())
            <div class="row g-3 mt-3">
                @foreach ($companies as $company)
                    <a href="{{ $company->company_website }}" target="_blank" class="text-decoration-none">
                        <div class="card bg-primary text-white">
                            <div>
                                <h5 class="card-title text-center">{{ $company->company_name }}</h5>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <p>No Company Registered Yet</p>
        @endif
    </div>

@endsection
