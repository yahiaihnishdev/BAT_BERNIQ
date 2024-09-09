@extends('layout.master')

@section('content')
<div class="page-data">
    <div class="table-container">
        <div class="page-title">العطلات</div>
        <div class="table-responsive">

            <div class="action-bar">
                <div class="button-group">
                    <a href="{{ route('holidays.create') }}" class="btn add-button">
                        <i class="bi bi-plus-circle"></i> إضافة
                    </a>
                    <a href="{{ route('holidays.exportPDF') }}" class="btn btn-secondary">
                        <i class="bi bi-file-earmark-arrow-up"></i> PDF
                    </a>
                    <a href="#" class="btn export-button">
                        <i class="bi bi-file-earmark-arrow-down"></i> تصدير
                    </a>
                </div>

                <!-- Search Box -->
                <div class="search-box">
                    <input type="search" id="search-inp" placeholder="بحث" class="form-control">
                </div>

            </div>

            <!-- Search Result Area -->
            <div id="search-result">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>الرقم</th>
                            <th>أسم العطلة</th>
                            <th>من</th>
                            <th>إلى</th>
                            <th>الأيام</th>
                            <th>تعديل</th>
                            <th>حذف</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($holidays as $holiday)
                        <tr>
                            <td>{{ $holiday->holiday_id }}</td>
                            <td>{{ $holiday->holiday_name }}</td>
                            <td>{{ $holiday->holiday_from->format('Y-m-d') }}</td>
                            <td>{{ $holiday->holiday_to->format('Y-m-d') }}</td>
                            <td>{{ $holiday->days }}</td>
                            <td class="edit">
                                <a href="{{ route('holidays.edit', $holiday->holiday_id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> تعديل
                                </a>
                            </td>
                            <td class="del">
                                <form action="{{ route('holidays.delete', $holiday->holiday_id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من أنك تريد حذف هذا العطلة؟');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-trash"></i> حذف
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for dynamic search -->
<script>
    let search_inp = document.getElementById('search-inp');
    let search_result = document.getElementById('search-result');

    search_inp.onkeyup = function(){
        let search_data = search_inp.value;

        fetch(`/holidays/search?query=${search_data}`)
            .then(response => response.json())
            .then(data => {
                let resultHtml = '';

                if (data.length > 0) {
                    resultHtml += '<table class="table table-striped table-bordered"><thead><tr><th>الرقم</th><th>أسم العطلة</th><th>من</th><th>إلى</th><th>الأيام</th><th>تعديل</th><th>حذف</th></tr></thead><tbody>';

                    data.forEach(holiday => {
                        resultHtml += `
                            <tr>
                                <td>${holiday.holiday_id}</td>
                                <td>${holiday.holiday_name}</td>
                                <td>${new Date(holiday.holiday_from).toLocaleDateString()}</td>
                                <td>${new Date(holiday.holiday_to).toLocaleDateString()}</td>
                                <td>${holiday.days}</td>
                                <td class="edit"><a href="/holidays/${holiday.holiday_id}/edit" class="btn btn-warning"><i class="fas fa-edit"></i> تعديل</a></td>
                                <td class="del"><form action="/holidays/${holiday.holiday_id}" method="POST" onsubmit="return confirm('هل أنت متأكد من أنك تريد حذف هذا العطلة؟');"><input type="hidden" name="_method" value="DELETE">@csrf<button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> حذف</button></form></td>
                            </tr>`;
                    });

                    resultHtml += '</tbody></table>';
                } else {
                    resultHtml = '<p>لا توجد عطلات.</p>';
                }

                search_result.innerHTML = resultHtml;
            })
            .catch(error => console.error('Error:', error));
    };
</script>

@endsection
