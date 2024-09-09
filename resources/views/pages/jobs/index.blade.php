@extends('layout.master')

@section('content')
<div class="page-data">
    <div class="table-container">
        <div class="page-title">الوظائف</div>
        <div class="table-responsive">

            <div class="action-bar">
                <div class="button-group">
                    <!-- Add job Button -->
                    <a href="{{ route('jobs.create') }}" class="btn add-button">
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
                            <th>أسم الوظيفه</th>
                            <th>تاريخ الاصدار</th>
                            <th>تعديل</th>
                            <th>حذف</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jobs as $job)
                        <tr>
                            <td>{{ $job->job_id }}</td>
                            <td>{{ $job->job_title }}</td>
                            <td>{{ $job->created_at->format('Y-m-d') }}</td>
                            <td class="edit">
                                <a href="{{ route('jobs.edit', $job->job_id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> تعديل
                                </a>
                            </td>
                            <td class="del">
                                <form action="{{ route('jobs.delete', $job->job_id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من أنك تريد حذف هذا الوظيفة؟');" style="display:inline;">
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

        fetch(`/jobs/search?query=${search_data}`)
            .then(response => response.json())
            .then(data => {
                let resultHtml = '';

                if (data.length > 0) {
                    resultHtml += '<table class="table table-striped table-bordered"><thead><tr><th>الرقم</th><th>أسم الوظيفة</th><th>تاريخ الاصدار</th><th>تعديل</th><th>حذف</th></tr></thead><tbody>';

                    data.forEach(job => {
                        resultHtml += `
                            <tr>
                                <td>${job.job_id}</td>
                                <td>${job.job_title}</td>
                                <td>${new Date(job.created_at).toLocaleDateString()}</td>
                                <td class="edit"><a href="/jobs/${job.job_id}/edit" class="btn btn-warning"><i class="fas fa-edit"></i> تعديل</a></td>
                                <td class="del"><form action="/jobs/${job.job_id}" method="POST" onsubmit="return confirm('هل أنت متأكد من أنك تريد حذف هذه الوظيفة؟');"><input type="hidden" name="_method" value="DELETE">@csrf<button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> حذف</button></form></td>
                            </tr>`;
                    });

                    resultHtml += '</tbody></table>';
                } else {
                    resultHtml = '<p>No jobs found.</p>';
                }

                search_result.innerHTML = resultHtml;
            })
            .catch(error => console.error('Error:', error));
    };
    </script>

@endsection
