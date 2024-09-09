@extends('layout.master')
@section('content')

<div class="page-data">
    <div class="table-container">
        <div class="page-title">تعديل اسم القسم</div>
        <div class="employee-form">
            <form action="{{ route('update_department', $department->dept_id) }}" method="post" class="row g-3 needs-validation" novalidate>
                @csrf
                <label for="name">اسم القسم</label>
                <input type="text" name="dept_name" class="form-control" required value="{{ $department->dept_name }}">
                <div class="invalid-feedback">
                    يرجي إدخال اسم القسم
                </div>
                <input type="submit" value="حفظ">
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('assets/dist/js/validate.js') }}"></script>

@endsection
