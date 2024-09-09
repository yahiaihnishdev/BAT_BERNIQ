document.addEventListener('DOMContentLoaded', function() {
    const showFormBtn = document.getElementById('show-form-btn');
    const form = document.getElementById('emp-emergency-form');

    showFormBtn.addEventListener('click', function() {
        if (form.style.display === 'none') {
            form.style.display = 'block';
            showFormBtn.textContent = 'إخفاء النموذج';
        } else {
            form.style.display = 'none';
            showFormBtn.textContent = 'إضافة بيانات الطوارئ';
        }
    });

    // Handle delete confirmation
    document.querySelectorAll('.delete-icon').forEach(icon => {
        icon.addEventListener('click', function() {
            const empConId = this.previousElementSibling.value;
            document.getElementById('record-id').value = empConId;
            document.querySelector('.confirm-del').style.display = 'block';
        });
    });

    document.getElementById('del-go').addEventListener('click', function() {
        const empConId = document.getElementById('record-id').value;
        window.location.href = `emp-emergency.php?emp_id=<?= $emp_id ?>&delete_id=${empConId}`;
    });

    document.getElementById('close-message').addEventListener('click', function() {
        document.querySelector('.confirm-del').style.display = 'none';
    });
});
