
@extends('layout.master')
@section('content')
    <div class="page-data">
        <div class="table-container">
            <div class="page-title">تعديل اسم الوظيفة</div>
            <div class="employee-form">
                <form action="{{ route('jobs.update', $job->job_id) }}" method="post" class="row g-3 needs-validation"
                    novalidate>
                    @csrf
                    <label for="name">اسم الوظيفة</label>
                    <input type="text" name="job_title" class="form-control" required value="{{ $job->job_title }}">
                    <div class="invalid-feedback">
                        يرجي إدخال اسم الوظيفة
                    </div>
                    <input type="submit" value="حفظ">
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/dist/js/validate.js') }}"></script>
@endsection