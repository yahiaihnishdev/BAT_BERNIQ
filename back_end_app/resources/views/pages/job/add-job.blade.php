@extends('layouts.master')

@section('content')
    <form action="{{ route('jobs.store') }}" method="POST">
        @csrf
        <div>
            <label for="job_title">Job Title:</label>
            <input type="text" id="job_title" name="job_title" placeholder="Enter Job Title" required>
        </div>
        <div>
            <label for="job_active">Active:</label>
            <input type="checkbox" id="job_active" name="job_active" value="1" checked>
        </div>
        <button type="submit">Add Job</button>
    </form>
@endsection
