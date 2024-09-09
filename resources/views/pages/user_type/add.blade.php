@extends('layout.master')

@section('content')
<div class="page-data">
    <div class="page-title">إضافة نوع مستخدم</div>
    <div class="employee-form">
        <form action="{{ route('user_type.store') }}" method="post" class="row g-3 needs-validation" novalidate>
            @csrf
            <label for="name">نوع المستخدم</label>
            <input type="text" name="user_type_name" class="form-control" required>
            <div class="invalid-feedback">
                يرجي إدخال نوع المستخدم
            </div>

            <input type="submit" value="حفظ" class="btn btn-primary">
        </form>
    </div>
</div>
@endsection
