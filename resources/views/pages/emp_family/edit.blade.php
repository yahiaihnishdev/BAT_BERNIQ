@extends('layout.emp-master')

@section('content')
<div class="page-data">
    <div class="page-title">Edit Family Member</div>

    <form action="{{ route('emp_family.update', $empFamily->emp_fam_id) }}" method="post" class="row g-3">
        @csrf
        @method('PUT')

        <!-- Hidden Employee ID Field -->
        <input type="hidden" name="emp_id" value="{{ $empFamily->emp_id }}">

        <!-- Family Member Name -->
        <div class="mb-3">
            <label for="person_name" class="form-label">Family Member Name</label>
            <input type="text" name="person_name" class="form-control" value="{{ $empFamily->person_name }}" required>
        </div>

        <!-- Relationship -->
        <div class="mb-3">
            <label for="person_rel" class="form-label">Relationship</label>
            <select name="person_rel" class="form-control" required>
                <option value="mom" {{ $empFamily->person_rel == 'mom' ? 'selected' : '' }}>Mom</option>
                <option value="father" {{ $empFamily->person_rel == 'father' ? 'selected' : '' }}>Father</option>
                <option value="wife" {{ $empFamily->person_rel == 'wife' ? 'selected' : '' }}>Wife</option>
                <option value="children" {{ $empFamily->person_rel == 'children' ? 'selected' : '' }}>Children</option>
            </select>
        </div>

        <!-- Birth Date -->
        <div class="mb-3">
            <label for="person_birth_date" class="form-label">Birth Date</label>
            <input type="date" name="person_birth_date" class="form-control" value="{{ $empFamily->person_birth_date }}" required>
        </div>

        <!-- Phone -->
        <div class="mb-3">
            <label for="person_phone" class="form-label">Phone</label>
            <input type="text" name="person_phone" class="form-control" value="{{ $empFamily->person_phone }}">
        </div>

        <!-- Submit Button -->
        <div class="mb-3">
            <input type="submit" value="Update Family Member" class="btn btn-primary">
        </div>
    </form>
</div>
@endsection
