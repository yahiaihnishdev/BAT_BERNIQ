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
        <div class="page-title">الموظفون</div>
        <div class="table-responsive">
          
            <div class="action-bar">
                <div class="button-group">
                    <button class="add-button">
                        <a href="add-employee"><i class="bi bi-plus-circle"></i> إضافة</a>
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
                        <th>الرقم الوظيفي</th>
                        <th>اسم المستخدم</th>
                        <th>الوظيفة</th>
                        <th>القسم</th>
                        <th>تاريخ التوظيف</th>
                        <th>تعديل</th>
                        <th>حذف</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch active employees from the database
                    $records = $conn->query("SELECT emp_id, emp_name, emp_num_id, emp_username, job_id, dept_id, hire_date FROM employees WHERE emp_active = 1");
                    while ($row = $records->fetch(PDO::FETCH_ASSOC)):
                    ?>
                    <tr>
                        <td><?php echo $row['emp_id']; ?></td>
                        <td><?php echo $row['emp_name']; ?></td>
                        <td><?php echo $row['emp_num_id']; ?></td>
                        <td><?php echo $row['emp_username']; ?></td>
                        <td>
                            <?php
                            // Fetch job title
                            $job = $conn->query("SELECT job_title FROM jobs WHERE job_id = " . $row['job_id'])->fetch(PDO::FETCH_ASSOC);
                            echo $job['job_title'] ?? 'غير محدد';
                            ?>
                        </td>
                        <td>
                            <?php
                            // Fetch department name
                            $dept = $conn->query("SELECT dept_name FROM departments WHERE dept_id = " . $row['dept_id'])->fetch(PDO::FETCH_ASSOC);
                            echo $dept['dept_name'] ?? 'غير محدد';
                            ?>
                        </td>
                        <td><?php echo $row['hire_date']; ?></td>
                        <td class="edit">
                            <a href="<?php echo "edit-employee.php?emp_id=" . $row['emp_id']; ?>">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <td class="del">
                            <input type="hidden" value="<?php echo $row['emp_id']; ?>">
                            <i class="fa fa-trash"></i>
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
                    <span id="del-go">نعم</span>
                    <span id="close-message">لا</span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "../../../master/sections/admin/foot.php"; ?>
<script src="../../../master/assets/dist/js/employee_search.js"></script>
<!-- Custom JS -->
<script src="../../../master/assets/dist/js/del-employee.js"></script>
<?php include "../../../master/sections/admin/end.php"; ?> 
