

@extends('layout.master')
@section('content')
<div class="page-data">
    <div class="table-container">
        <div class="page-title">الوظائف</div> <!-- Changed to Jobs in Arabic -->
        <div class="table-responsive">

            <div class="action-bar">
                <div class="button-group">
                    <!-- Add Job Button -->
                    <a href="{{ route('jobs.create') }}" class="btn add-button">
                        <i class="bi bi-plus-circle"></i> إضافة وظيفة
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
                            <th>معرف الوظيفة</th> <!-- Job ID in Arabic -->
                            <th>اسم الوظيفة</th> <!-- Job Title in Arabic -->
                            <th>نشط</th> <!-- Active in Arabic -->
                            <th>الإجراءات</th> <!-- Actions in Arabic -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jobs as $job)
                        <tr>
                            <td>{{ $job->job_id }}</td>
                            <td>{{ $job->job_title }}</td>
                            <td>{{ $job->job_active ? 'نعم' : 'لا' }}</td> <!-- Yes / No in Arabic -->
                            <td>
                                <a href="{{ route('jobs.edit', $job->job_id) }}" class="btn btn-primary">تعديل</a> <!-- Edit -->
                                <form action="{{ route('jobs.delete', $job->job_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-danger">تعطيل</button> <!-- Deactivate in Arabic -->
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
