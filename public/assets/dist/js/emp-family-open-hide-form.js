
document.addEventListener('DOMContentLoaded', function() {
    const showFormBtn = document.getElementById('show-form-btn');
    const form = document.getElementById('emp-family-form');

    // Function to get URL parameters
    function getQueryParams() {
        const params = new URLSearchParams(window.location.search);
        return {
            emp_fam_id: params.get('emp_fam_id')
        };
    }

    // Show the form if emp_fam_id is present
    const params = getQueryParams();
    if (params.emp_fam_id) {
        form.style.display = 'block';
        showFormBtn.textContent = 'إخفاء النموذج';
    }

    showFormBtn.addEventListener('click', function() {
        const isFormVisible = form.style.display === 'block';
        form.style.display = isFormVisible ? 'none' : 'block';
        showFormBtn.textContent = isFormVisible ? 'إضافة فرد عائلي' : 'إخفاء النموذج';
    });

    // Handle deletion
    const deleteIcons = document.querySelectorAll('.delete-icon');
    const confirmDel = document.querySelector('.confirm-del');
    const delGo = document.getElementById('del-go');
    const closeMessage = document.getElementById('close-message');
    let currentId = null;

    // deleteIcons.forEach(icon => {
    //     icon.addEventListener('click', function() {
    //         currentId = this.nextElementSibling.value;
    //         confirmDel.style.display = 'block';
    //     });
    // });

    // delGo.addEventListener('click', function() {
    //     if (currentId) {
    //         window.location.href = `delete-family.php?emp_id=<?= $emp_id ?>&emp_fam_id=${currentId}`;
    //     }
    // });

    // closeMessage.addEventListener('click', function() {
    //     confirmDel.style.display = 'none';
    // });
});

