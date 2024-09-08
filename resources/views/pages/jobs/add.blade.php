@extends('layout.master')

@section('content')
<div class="container">
    <h1>Add New Job</h1>
    <form action="{{ route('jobs.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="job_title">Job Title</label>
            <input type="text" class="form-control" id="job_title" name="job_title" placeholder="Enter job title" required>
        </div>
        <div class="form-group">
            <label for="job_active">Is Active?</label>
            <input type="checkbox" id="job_active" name="job_active" checked>
        </div>
        <button type="submit" class="btn btn-primary">Add Job</button>
    </form>
</div>
@endsection
