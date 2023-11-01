@extends('layouts.index')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/styles/home.css') }}">
@endsection

@section('content')
    <div class="grid">
        <a href="{{ route('login', [ 'type' => 'candidate' ]) }}">
            <div class="card">
                <span class="icon"><i class="fa-solid fa-user-doctor" style="color: #ffffff;"></i></span>
                <h4>Job Seeker</h4>
                <p>
                    Build your profile and let recruiters find you.
                    <br>
                    Get job postings delivered right to your email.
                    <br>
                    Find a job and grow your career.
                </p>
            </div>
        </a>
        <a href="{{ route('login', [ 'type' => 'recuiter' ]) }}">
            <div class="card">
                <span class="icon"><i class="fa-solid fa-building" style="color: #ffffff;"></i></span>
                <h4>Recruiter</h4>
                <p>
                    Reach out to millions of jobseekers and hire quickly with our fast and easy job posting services.
                    <br>
                    Increase your productivity by calling candidates directly from the app.
                    <br>
                    Get instant notifications on job applies.
                </p>
            </div>
        </a>
    </div>

@endsection
