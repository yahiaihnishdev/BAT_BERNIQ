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
