@extends('layout.app')

@section('content')
    <form action="{{ route('jobs.search') }}" method="GET">
        <input type="text" name="query" placeholder="Search for jobs...">
        <button type="submit">Search</button>
    </form>

    @if($jobs)
    <table>
        <thead>
            <tr>
                <th>Job ID</th>
                <th>Job Title</th>
                <th>Active</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $job)
            <tr>
                <td>{{ $job->job_id }}</td>
                <td>{{ $job->job_title }}</td>
                <td>{{ $job->job_active ? 'Yes' : 'No' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
@endsection
