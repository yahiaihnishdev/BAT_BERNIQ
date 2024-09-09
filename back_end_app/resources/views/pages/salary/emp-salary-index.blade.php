<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:../../log.php");
    exit();
} elseif ($_SESSION['usertype'] != 'admin') {
    header("location:../out.php");
    exit();
}

include "../../../master/sections/connect.php";
include "../../../master/sections/admin/start.php";
include "../../../master/sections/admin/links.php";
include "../../../master/sections/admin/mid.php";
?>

<div class="page-content">
    <div class="table-container">
        <div class="page-title">الرواتب</div>
        <div class="table-responsive">

            <div class="action-bar">
                <div class="button-group">
                    <button class="add-button">
                        <a href="add-emp-salary.php"><i class="bi bi-plus-circle"></i> إضافة</a>
                    </button>
                    <button class="import-button">
                        <a href="#"><i class="bi bi-file-earmark-arrow-up"></i> استيراد</a>
                    </button>
                    <button class="export-button">
                        <a href="#"><i class="bi bi-file-earmark-arrow-down"></i> تصدير</a>
                    </button>
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
                            <th>اسم الموظف</th>
                            <th>الوظيفة</th>
                            <th>القسم</th>
                            <th>الراتب الاساسي</th>
                            <th>الحالة الاجتماعية</th>
                            <th>تعديل</th>
                            <th>حذف</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch employees and their job and department details in one query for performance improvement
                        $query = "SELECT e.emp_id, e.emp_name, e.basic_salary, e.marital_status, j.job_title, d.dept_name 
                                  FROM employees e 
                                  LEFT JOIN jobs j ON e.job_id = j.job_id 
                                  LEFT JOIN departments d ON e.dept_id = d.dept_id";
                        $records = $conn->query($query);
                        while ($row = $records->fetch(PDO::FETCH_ASSOC)):
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['emp_id']); ?></td>
                                <td><?php echo htmlspecialchars($row['emp_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['job_title'] ?? 'غير محدد'); ?></td>
                                <td><?php echo htmlspecialchars($row['dept_name'] ?? 'غير محدد'); ?></td>
                                <td><?php echo htmlspecialchars($row['basic_salary']); ?></td>
                                <td><?php echo htmlspecialchars($row['marital_status']); ?></td>
                                <td class="edit">
                                    <a href="edit-emp-salary.php?emp_id=<?php echo htmlspecialchars($row['emp_id']); ?>">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <td class="del">
                                    <input type="hidden" value="<?php echo htmlspecialchars($row['emp_id']); ?>">
                                    <i class="fa fa-trash" onclick="deleteEmployee(<?php echo htmlspecialchars($row['emp_id']); ?>)"></i>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="confirm-del h-s">
        <div class="confirm-message">
            <div class="message-show">
                هل انت متأكد من عملية الحذف؟
                <div class="confirm-btn">
                    <input type="hidden" id="record-id">
                    <span id="del-go" onclick="confirmDeletion()">نعم</span>
                    <span id="close-message">لا</span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "../../../master/sections/admin/foot.php"; ?>
<script src="../../../master/assets/dist/js/employee_search.js"></script>
<script src="../../../master/assets/dist/js/del-employee.js"></script>
<?php include "../../../master/sections/admin/end.php"; ?>

<script>
// JavaScript function to handle deletion
function deleteEmployee(emp_id) {
    document.getElementById('record-id').value = emp_id;
    document.querySelector('.confirm-del').classList.remove('h-s');
}

function confirmDeletion() {
    var emp_id = document.getElementById('record-id').value;
    window.location.href = "del-emp-salary.php?emp_id=" + emp_id;
}
</script>
