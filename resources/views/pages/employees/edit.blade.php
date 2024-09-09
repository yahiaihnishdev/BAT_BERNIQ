@extends('layout.emp-master')

@section('content')
<div class="page-data">
    <div class="page-title">Edit Employee</div>

    <!-- Employee ID Card -->
    <div class="id-card mb-4">
        <div class="id-card-header">
          <img src="{{ $employee->photo_url ?? 'https://via.placeholder.com/80' }}" alt="Employee Photo" class="rounded-circle mb-2" style="width: 80px; height: 80px;">
          <h5>{{ $employee->emp_name }}</h5>
          <p><strong>ID:</strong> {{ $employee->emp_num_id }}</p>
          <p><strong>Job Title:</strong> {{ $employee->job->job_title }}</p>
          <p><strong>Hire Date:</strong> {{ $employee->hire_date }}</p>
        </div>
        <div class="id-card-footer">
          <p><strong>BAT Center</strong></p>
        </div>
    </div>

    <!-- Employee Edit Form -->
    <div class="employee-form">
        <form action="{{ route('employees.update', $employee->emp_id) }}" method="post" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')

            <!-- Employee Number (Read-Only) -->
            <div class="mb-3">
                <label for="emp_num_id" class="form-label">Employee Number</label>
                <input type="text" name="emp_num_id" class="form-control" value="{{ $employee->emp_num_id }}" readonly>
            </div>

            <!-- Employee Name -->
            <div class="mb-3">
                <label for="emp_name" class="form-label">Employee Name</label>
                <input type="text" name="emp_name" class="form-control @error('emp_name') is-invalid @enderror" value="{{ old('emp_name', $employee->emp_name) }}" required>
                <div class="invalid-feedback">Please provide a valid name.</div>
                @error('emp_name')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Username -->
            <div class="mb-3">
                <label for="emp_username" class="form-label">Username</label>
                <input type="text" name="emp_username" class="form-control @error('emp_username') is-invalid @enderror" value="{{ old('emp_username', $employee->emp_username) }}" required>
                <div class="invalid-feedback">Please provide a valid username.</div>
                @error('emp_username')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password (Optional) -->
            <div class="mb-3">
                <label for="emp_password" class="form-label">Password</label>
                <input type="password" name="emp_password" class="form-control @error('emp_password') is-invalid @enderror">
                <div class="invalid-feedback">Please provide a valid password.</div>
                @error('emp_password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
                <small class="form-text text-muted">Leave blank to keep the current password.</small>
            </div>

            <!-- Confirm Password (Optional) -->
            <div class="mb-3">
                <label for="emp_password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" name="emp_password_confirmation" class="form-control">
                <div class="invalid-feedback">Please confirm the password.</div>
            </div>

            <!-- Birth Date -->
            <div class="mb-3">
                <label for="birth_date" class="form-label">Birth Date</label>
                <input type="date" name="birth_date" class="form-control @error('birth_date') is-invalid @enderror" value="{{ old('birth_date', $employee->birth_date) }}" required>
                <div class="invalid-feedback">Please provide a valid birth date.</div>
                @error('birth_date')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- NID -->
            <div class="mb-3">
                <label for="nid" class="form-label">NID</label>
                <input type="text" name="nid" class="form-control @error('nid') is-invalid @enderror" value="{{ old('nid', $employee->nid) }}" required>
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
                        <option value="{{ $job->job_id }}" {{ (old('job_id', $employee->job_id) == $job->job_id) ? 'selected' : '' }}>
                            {{ $job->job_title }}
                        </option>
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
                        <option value="{{ $department->dept_id }}" {{ (old('dept_id', $employee->dept_id) == $department->dept_id) ? 'selected' : '' }}>
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
                <input type="number" name="basic_salary" class="form-control @error('basic_salary') is-invalid @enderror" value="{{ old('basic_salary', $employee->basic_salary) }}" required>
                <div class="invalid-feedback">Please provide a valid salary.</div>
                @error('basic_salary')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Hire Date -->
            <div class="mb-3">
                <label for="hire_date" class="form-label">Hire Date</label>
                <input type="date" name="hire_date" class="form-control @error('hire_date') is-invalid @enderror" value="{{ old('hire_date', $employee->hire_date) }}" required>
                <div class="invalid-feedback">Please provide a valid hire date.</div>
                @error('hire_date')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="mb-3">
                <input type="submit" value="Update" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>

<!-- Custom Styles for Employee Card -->
<style>
    .id-card {
        width: 100%;
        max-width: 400px;
        background: linear-gradient(to bottom right, #c070d4, #4b185e);
        color: white;
        border-radius: 15px;
        padding: 20px;
        margin: 20px auto;
        text-align: center;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        font-family: 'Cairo', sans-serif;
        position: relative;
    }

    .id-card-header {
        padding: 10px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.3);
    }

    .id-card-footer {
        margin-top: 10px;
        padding: 5px;
        border-top: 1px solid rgba(255, 255, 255, 0.3);
    }

    .id-card img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid white;
    }

    .id-card h5 {
        margin: 10px 0;
        font-size: 18px;
    }

    .id-card p {
        margin: 5px 0;
        font-size: 14px;
    }

    .id-card-footer p {
        font-size: 12px;
        color: rgba(255, 255, 255, 0.8);
    }

    /* Flexbox container to center vertically and horizontally */
    .page-data {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        flex-direction: column;
    }
</style>
@endsection
