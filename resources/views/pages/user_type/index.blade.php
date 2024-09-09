@extends('layout.master')

@section('content')

<div class="page-data">
    <div class="table-container">
        <div class="page-title">أنواع المستخدمين</div>
        <div class="table-responsive">

            <div class="action-bar">
                <div class="button-group">
                    <!-- Add job Button -->
                    <a href="{{ route('user_type.create') }}" class="btn add-button">
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
    <div class="search-box">
        <input type="search" id="search-inp" placeholder="search">
    </div>
</div>

            <div id="search-result">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>الرقم</th>
                        <th>نوع المستخدم</th>
                        <th>تاريخ الاصدار</th>
                        <th>تعديل</th>
                        <th>حذف</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($userTypes as $userTypes)
                    <tr>
                        <td>{{ $userTypes->user_type_id }}</td>
                        <td>{{ $userTypes->user_type_name }}</td>
                        <td>{{ $userTypes->created_at->format('Y-m-d') }}</td>
                        <td class="edit">
                            <a href="{{ route('user_type.edit', $userTypes->user_type_id) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> تعديل
                            </a>
                        </td>
                        <td class="del">
                            <form action="{{ route('user_type.delete', $userTypes->user_type_id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من أنك تريد حذف هذا نوع المستخدم؟');" style="display:inline;">
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
    <div class="confirm-del h-s">
        <div class="confirm-message">
            <div class="message-show">
                هل انت متاكد من عملية الحذف
                <div class="confirm-btn">
                    <input type="hidden" id="record-id">
                    <span id="del-go">نعم</span>
                    <span id="close-message">لا</span>
                </div>
            </div>

        </div>

    </div>
</div>

<!-- JavaScript for dynamic search -->
<script>
    let search_inp = document.getElementById('search-inp');
    let search_result = document.getElementById('search-result');

    search_inp.onkeyup = function() {
        let search_data = search_inp.value;

        fetch(`/user_type/search?query=${search_data}`)
            .then(response => response.json())
            .then(data => {
                let resultHtml = '';

                if (data.length > 0) {
                    resultHtml += '<table class="table table-striped table-bordered"><thead><tr><th>الرقم</th><th>نوع المستخدم</th><th>تاريخ الاصدار</th><th>تعديل</th><th>حذف</th></tr></thead><tbody>';

                    data.forEach(userType => {
                        resultHtml += `
                            <tr>
                                <td>${userType.user_type_id}</td>
                                <td>${userType.user_type_name}</td>
                                <td>${new Date(userType.created_at).toLocaleDateString()}</td>
                                <td class="edit"><a href="/user_type/${userType.user_type_id}/edit" class="btn btn-warning"><i class="fas fa-edit"></i> تعديل</a></td>
                                <td class="del"><form action="/user_type/${userType.user_type_id}" method="POST" onsubmit="return confirm('هل أنت متأكد من أنك تريد حذف هذا النوع من المستخدم؟');"><input type="hidden" name="_method" value="DELETE">@csrf<button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> حذف</button></form></td>
                            </tr>`;
                    });

                    resultHtml += '</tbody></table>';
                } else {
                    resultHtml = '<p>No user types found.</p>';
                }

                search_result.innerHTML = resultHtml;
            })
            .catch(error => console.error('Error:', error));
    };
</script>

@endsection

