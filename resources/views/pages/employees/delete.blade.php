@extends('layout.master')

@section('content')
<div class="page-data">
    <div class="page-title">Delete Employee</div>
    <div class="employee-form">
        <p>Are you sure you want to delete employee <strong>{{ $employee->emp_name }}</strong>?</p>

        <form action="{{ route('employees.delete', $employee->emp_id) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
            <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
