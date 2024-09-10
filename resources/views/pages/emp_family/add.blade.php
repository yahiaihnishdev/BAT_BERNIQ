@extends('layout.emp-master')

@section('content')
<div class="page-data">
    <div class="page-title">Add Family Member for: {{ $employee->emp_name }}</div>

    <form action="{{ route('emp_family.store') }}" method="post" class="row g-3">
        @csrf
        <!-- Hidden input to send employee ID -->
        <input type="hidden" name="emp_id" value="{{ $employee->emp_id }}">

        <!-- Family Member Name -->
        <div class="mb-3">
            <label for="person_name" class="form-label">Family Member Name</label>
            <input type="text" name="person_name" class="form-control" required>
        </div>

        <!-- Relationship -->
        <div class="mb-3">
            <label for="person_rel" class="form-label">Relationship</label>
            <select name="person_rel" class="form-control" required>
                <option value="mom">Mother</option>
                <option value="father">Father</option>
                <option value="wife">Wife</option>
                <option value="children">Children</option>
            </select>
        </div>

        <!-- Birth Date -->
        <div class="mb-3">
            <label for="person_birth_date" class="form-label">Birth Date</label>
            <input type="date" name="person_birth_date" class="form-control" required>
        </div>

        <!-- Phone Number (Optional) -->
        <div class="mb-3">
            <label for="person_phone" class="form-label">Phone Number</label>
            <input type="text" name="person_phone" class="form-control">
        </div>

        <!-- Submit Button -->
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Add Family Member</button>
        </div>
    </form>
</div>
@endsection
