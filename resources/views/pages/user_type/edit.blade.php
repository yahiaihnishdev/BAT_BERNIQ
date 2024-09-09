@extends('layout.master')
@section('content')
    <div class="page-data">
        <div class="table-container">
            <div class="page-title">تعديل نوع مستخدم</div>
            <div class="employee-form">
                <form action="{{ route('user_type.update', $userType->user_type_id) }}" method="post" class="row g-3 needs-validation" novalidate>
                    @csrf
                    @method('PUT')  <!-- This is important to send a PUT request -->
                    <label for="name">نوع المستخدم</label>
                    <input type="text" name="user_type_name" class="form-control" required value="{{ $userType->user_type_name }}">
                    <div class="invalid-feedback">
                        يرجي إدخال نوع المستخدم
                    </div>
                    <input type="submit" value="حفظ" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/dist/js/validate.js') }}"></script>
@endsection
