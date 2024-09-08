@extends('layout.master')

@section('content')
<div class="container">
    <h1>All Jobs</h1>
    <a href="{{ route('jobs.create') }}" class="btn btn-primary mb-3">Add New Job</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Job Title</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $job)
            <tr>
                <td>{{ $job->job_title }}</td>
                <td>
                    <a href="{{ route('jobs.edit', $job->job_id) }}" class="btn btn-warning">Edit</a> <!-- Pass job_id instead of id -->
                    <form action="{{ route('jobs.delete', $job->job_id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection
