@extends('layout.master')

@section('content')
<div class="page-data">
    <div class="page-title">Add Employee</div>
    <div class="employee-form">
        <form action="{{ route('employees.store') }}" method="post" class="row g-3 needs-validation" novalidate>
            @csrf

            <!-- Employee Name -->
            <div class="mb-3">
                <label for="emp_name" class="form-label">Employee Name</label>
                <input type="text" name="emp_name" class="form-control @error('emp_name') is-invalid @enderror" value="{{ old('emp_name') }}" required>
                <div class="invalid-feedback">Please provide a valid name.</div>
                @error('emp_name')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Username -->
            <div class="mb-3">
                <label for="emp_username" class="form-label">Username</label>
                <input type="text" name="emp_username" class="form-control @error('emp_username') is-invalid @enderror" value="{{ old('emp_username') }}" required>
                <div class="invalid-feedback">Please provide a valid username.</div>
                @error('emp_username')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="emp_password" class="form-label">Password</label>
                <input type="password" name="emp_password" class="form-control @error('emp_password') is-invalid @enderror" required>
                <div class="invalid-feedback">Please provide a valid password.</div>
                @error('emp_password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <label for="emp_password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" name="emp_password_confirmation" class="form-control" required>
                <div class="invalid-feedback">Please confirm the password.</div>
            </div>

            <!-- Birth Date -->
            <div class="mb-3">
                <label for="birth_date" class="form-label">Birth Date</label>
                <input type="date" name="birth_date" class="form-control @error('birth_date') is-invalid @enderror" value="{{ old('birth_date') }}" required>
                <div class="invalid-feedback">Please provide a valid birth date.</div>
                @error('birth_date')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- NID -->
            <div class="mb-3">
                <label for="nid" class="form-label">NID</label>
                <input type="text" name="nid" class="form-control @error('nid') is-invalid @enderror" value="{{ old('nid') }}" required>
                <div class="invalid-feedback">Please provide a valid NID.</div>
                @error('nid')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Job ID -->
            <div class="mb-3">
                <label for="job_id" class="form-label">Job</label>
                <select name="job_id" class="form-control @error('job_id') is-invalid @enderror" required>
                    <option value="">Select Job</option>
                    @foreach($jobs as $job)
                        <option value="{{ $job->job_id }}">{{ $job->job_title }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">Please select a job.</div>
                @error('job_id')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Department ID -->
            <div class="mb-3">
                <label for="dept_id" class="form-label">Department</label>
                <select name="dept_id" class="form-control @error('dept_id') is-invalid @enderror" required>
                    <option value="">Select Department</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->dept_id }}" {{ old('dept_id') == $department->dept_id ? 'selected' : '' }}>
                            {{ $department->dept_name }}
                        </option>
                    @endforeach
                </select>
                <div class="invalid-feedback">Please select a department.</div>
                @error('dept_id')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Basic Salary -->
            <div class="mb-3">
                <label for="basic_salary" class="form-label">Basic Salary</label>
                <input type="number" name="basic_salary" class="form-control @error('basic_salary') is-invalid @enderror" value="{{ old('basic_salary') }}" required>
                <div class="invalid-feedback">Please provide a valid salary.</div>
                @error('basic_salary')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Hire Date -->
            <div class="mb-3">
                <label for="hire_date" class="form-label">Hire Date</label>
                <input type="date" name="hire_date" class="form-control @error('hire_date') is-invalid @enderror" value="{{ old('hire_date') }}" required>
                <div class="invalid-feedback">Please provide a valid hire date.</div>
                @error('hire_date')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="mb-3">
                <input type="submit" value="Save" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
@endsection
