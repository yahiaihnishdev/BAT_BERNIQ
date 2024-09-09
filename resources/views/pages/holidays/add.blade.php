@extends('layout.master')
@section('content')

<div class="page-data">
    <div class="page-title">إضافة عطلة</div>
    <div class="employee-form">
        <form action="{{ route('holidays.store') }}" method="post" class="row g-3 needs-validation" novalidate>
            @csrf
            <label for="holiday_name">اسم العطلة</label>
            <input type="text" name="holiday_name" class="form-control" required>
            <div class="invalid-feedback">يرجي إدخال اسم العطلة</div>

            <label for="holiday_from">من</label>
            <input type="date" name="holiday_from" id="holiday_from" class="form-control" required>
            <div class="invalid-feedback">يرجي إدخال تاريخ البدء</div>

            <label for="holiday_to">إلى</label>
            <input type="date" name="holiday_to" id="holiday_to" class="form-control" required>
            <div class="invalid-feedback">يرجي إدخال تاريخ الانتهاء</div>

            <label for="days">عدد الأيام</label>
            <input type="text" id="days" class="form-control" readonly value="0">
            <div class="invalid-feedback">يرجي إدخال عدد الأيام</div>

            <label for="emp_id">رقم الموظف</label>
            <input type="text" name="emp_id" class="form-control" required>
            <div class="invalid-feedback">يرجي إدخال رقم الموظف</div>

            <input type="submit" value="حفظ" class="btn btn-primary">
        </form>
    </div>
</div>

<!-- JavaScript to calculate days -->
<script>
    function calculateDays() {
        const fromDate = new Date(document.getElementById('holiday_from').value);
        const toDate = new Date(document.getElementById('holiday_to').value);

        if (fromDate && toDate && toDate >= fromDate) {
            const timeDiff = toDate - fromDate;
            const daysDiff = timeDiff / (1000 * 3600 * 24) + 1;
            document.getElementById('days').value = daysDiff;
        } else {
            document.getElementById('days').value = 0;
        }
    }

    document.getElementById('holiday_from').addEventListener('change', calculateDays);
    document.getElementById('holiday_to').addEventListener('change', calculateDays);
</script>

@endsection
