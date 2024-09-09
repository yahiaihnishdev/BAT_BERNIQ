@extends('layout.master')

@section('content')
    <div class="page-data">
        <div class="table-container">
            <div class="page-title">Employees</div>

            <!-- Action Bar with Buttons and Search/Filter -->
            <div class="action-bar mb-3 d-flex justify-content-between align-items-center">
                <div class="button-group">
                    <a href="{{ route('employees.create') }}" class="btn btn-success me-2">
                        <i class="bi bi-plus-circle"></i> إضافة
                    </a>
                    <a href="{{ route('holidays.exportPDF') }}" class="btn btn-secondary me-2">
                        <i class="bi bi-file-earmark-arrow-up"></i> PDF
                    </a>
                    <a href="{{ route('employees.export') }}" class="btn btn-info">
                        <i class="bi bi-file-earmark-arrow-down"></i> تصدير
                    </a>
                </div>

                <!-- Search and Filter Form -->
                <form action="{{ route('employees.index') }}" method="GET" class="d-flex align-items-center">
                    <!-- Search by Name -->
                    <input type="text" name="search" placeholder="بحث" class="form-control me-2"
                        value="{{ request('search') }}">

                    <!-- Filter by Department -->
                    <select name="dept_id" class="form-control me-2">
                        <option value="">All Departments</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->dept_id }}"
                                {{ request('dept_id') == $department->dept_id ? 'selected' : '' }}>
                                {{ $department->dept_name }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Filter by Job -->
                    <select name="job_id" class="form-control me-2">
                        <option value="">All Jobs</option>
                        @foreach ($jobs as $job)
                            <option value="{{ $job->job_id }}"
                                {{ old('job_id', request('job_id')) == $job->job_id ? 'selected' : '' }}>
                                {{ $job->job_title }}
                            </option>
                        @endforeach
                    </select>


                    <!-- Submit and Reset Buttons -->
                    <button type="submit" class="btn btn-primary me-2">Search</button>
                    <a href="{{ route('employees.index') }}" class="btn btn-secondary">Reset</a>
                </form>
            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Employees Table -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Emp ID</th>
                            <th>Emp Num ID</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Job</th>
                            <th>Department</th>
                            <th>Basic Salary</th>
                            <th>Hire Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employees as $employee)
                            <tr>
                                <td>{{ $employee->emp_id }}</td>
                                <td>{{ $employee->emp_num_id }}</td>
                                <td>{{ $employee->emp_name }}</td>
                                <td>{{ $employee->emp_username }}</td>
                                <td>{{ $employee->job->job_title }}</td>

                                <td>{{ $employee->department->dept_name }}</td>
                                <td>{{ number_format($employee->basic_salary, 2) }}</td>
                                <td>{{ \Carbon\Carbon::parse($employee->hire_date)->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{ route('employees.edit', $employee->emp_id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('employees.delete', $employee->emp_id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this employee?');"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    <!-- Optional: Separate Delete Confirmation Page -->
                                    <!-- <a href="{{ route('employees.showDelete', $employee->emp_id) }}" class="btn btn-danger btn-sm">Delete</a> -->
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No employees found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            <div class="d-flex justify-content-center">
                {{ $employees->links() }}
            </div>
        </div>
    </div>
@endsection
