@extends('layout.emp-master')

@section('content')
<div class="page-data">
    <div class="page-title">Delete Family Member</div>

    <p>Are you sure you want to delete family member <strong>{{ $empFamily->person_name }}</strong>?</p>

    <form action="{{ route('emp_family.delete', $empFamily->emp_fam_id) }}" method="post">
        @csrf
        @method('PUT')
        <button type="submit" class="btn btn-danger">Delete</button>
        <a href="{{ route('emp_family.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
