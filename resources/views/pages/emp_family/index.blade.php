@extends('layout.emp-master')

@section('content')
    <div class="page-data">
        <div class="table-container">
            <div class="page-title">Family Members of {{ $employee->emp_name }}</div>

            <!-- Action Bar with Buttons and Search/Filter -->
            <div class="action-bar mb-3 d-flex justify-content-between align-items-center">
                <div class="button-group">
                    <a href="{{ route('emp_family.create', ['emp_id' => $employee->emp_id]) }}" class="btn btn-success me-2">
                        <i class="bi bi-plus-circle"></i> Add Family Member
                    </a>
                </div>

                <!-- Search Form -->
                <form action="{{ route('emp_family.index') }}" method="GET" class="d-flex align-items-center">
                    <!-- Hidden Employee ID -->
                    <input type="hidden" name="emp_id" value="{{ $employee->emp_id }}">

                    <!-- Search by Family Member Name -->
                    <input type="text" name="search" placeholder="Search by name" class="form-control me-2"
                        value="{{ request('search') }}">

                    <!-- Submit and Reset Buttons -->
                    <button type="submit" class="btn btn-primary me-2">Search</button>
                    <a href="{{ route('emp_family.index', ['emp_id' => $employee->emp_id]) }}" class="btn btn-secondary">Reset</a>
                </form>
            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Family Members Table -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>Family Member Name</th>
                            <th>Relationship</th>
                            <th>Birth Date</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($emp_family as $member)
                            <tr>
                                <td>{{ $employee->emp_name }}</td>
                                <td>{{ $member->person_name }}</td>
                                <td>{{ ucfirst($member->person_rel) }}</td>
                                <td>{{ \Carbon\Carbon::parse($member->person_birth_date)->format('Y-m-d') }}</td>
                                <td>{{ $member->person_phone ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('emp_family.edit', $member->emp_fam_id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('emp_family.delete', $member->emp_fam_id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No family members found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            <div class="d-flex justify-content-center">
                {{ $emp_family->links() }}
            </div>
        </div>
    </div>
@endsection
