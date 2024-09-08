@extends('layout.master')

@section('content')
<div class="container">
    <h1>Edit Job</h1>
    <form action="{{ route('jobs.update', $job->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="job_title">Job Title</label>
            <input type="text" class="form-control" id="job_title" name="job_title" value="{{ $job->job_title }}" required>
        </div>
        <div class="form-group">
            <label for="job_active">Is Active?</label>
            <input type="checkbox" id="job_active" name="job_active" {{ $job->job_active ? 'checked' : '' }}>
        </div>
        <button type="submit" class="btn btn-primary">Update Job</button>
    </form>
</div>
@endsection
