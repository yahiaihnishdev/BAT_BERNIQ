@extends('layout.master')
@section('content')

<div class="page-data">
    <div class="table-container">
        <div class="page-title">الأقسام</div>
        <div class="table-responsive">

            <div class="action-bar">
                <div class="button-group">
                    <!-- Add Department Button -->
                    <a href="{{ route('create_department') }}" class="btn add-button">
                        <i class="bi bi-plus-circle"></i> إضافة
                    </a>
                    <!-- Import Button -->
                    <a href="#" class="btn import-button">
                        <i class="bi bi-file-earmark-arrow-up"></i> استيراد
                    </a>
                    <!-- Export Button -->
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
                            <th>أسم القسم</th>
                            <th>تاريخ الاصدار</th>
                            <th>تعديل</th>
                            <th>حذف</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($departments as $department)
                        <tr>
                            <td>{{ $department->dept_id }}</td>
                            <td>{{ $department->dept_name }}</td>
                            <td>{{ $department->created_at->format('Y-m-d') }}</td>
                            <td class="edit">
                                <a href="{{ route('edit_department', $department->dept_id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> تعديل
                                </a>
                            </td>
                            <td class="del">
                                    <form action="{{ route('delete_department', $department->dept_id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من أنك تريد حذف هذا القسم؟');" style="display:inline;">
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

    fetch(`/search_department?query=${search_data}`)
        .then(response => response.json())
        .then(data => {
            let resultHtml = '';

            if (data.length > 0) {
                resultHtml += '<table class="table table-striped table-bordered"><thead><tr><th>الرقم</th><th>أسم القسم</th><th>تاريخ الاصدار</th><th>تعديل</th><th>حذف</th></tr></thead><tbody>';

                data.forEach(department => {
                    resultHtml += `
                        <tr>
                            <td>${department.dept_id}</td>
                            <td>${department.dept_name}</td>
                            <td>${new Date(department.created_at).toLocaleDateString()}</td>
                            <td class="edit"><a href="/edit_department/${department.dept_id}" class="btn btn-warning"><i class="fas fa-edit"></i> تعديل</a></td>
                            <td class="del"><form action="/delete_department/${department.dept_id}" method="POST" onsubmit="return confirm('هل أنت متأكد من أنك تريد حذف هذا القسم؟');"><button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> حذف</button></form></td>
                        </tr>`;
                });

                resultHtml += '</tbody></table>';
            } else {
                resultHtml = '<p>No departments found.</p>';
            }

            search_result.innerHTML = resultHtml;
        })
        .catch(error => console.error('Error:', error));
};
</script>

@endsection
