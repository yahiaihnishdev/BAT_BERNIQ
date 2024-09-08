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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handling Personal Information Submission
    if (isset($_POST['save_personal'])) {
        $emp_name = $_POST['emp-name'];
        $emp_num_id = $_POST['emp-num-id'];
        $emp_username = $_POST['emp-username'];
        $emp_password = password_hash($_POST['emp-password'], PASSWORD_DEFAULT);
        $job_id = $_POST['job-id'];
        $dept_id = $_POST['dept-id'];
        $basic_salary = $_POST['basic-salary'];
        $hire_date = $_POST['hire-date'];
        $birth_date = $_POST['birth-date'];
        $emp_gender = $_POST['emp-gender'];
        $nid = $_POST['nid'];
        $nationality = $_POST['nationality'];
        $marital_status = $_POST['marital-status'];

        $stmt = $conn->prepare("INSERT INTO employees (emp_name, emp_num_id, emp_username, emp_password, job_id, dept_id, basic_salary, hire_date, birth_date, emp_gender, nid, nationality, marital_status, created_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$emp_name, $emp_num_id, $emp_username, $emp_password, $job_id, $dept_id, $basic_salary, $hire_date, $birth_date, $emp_gender, $nid, $nationality, $marital_status, $_SESSION['username']]);

        header("location:employee-index.php");
        exit();
    }
}

include "../../../master/sections/admin/start.php";
include "../../../master/sections/admin/links.php";
include "../../../master/sections/admin/mid.php";
?>


<?php include "../emp-menu/menu-emp.php"; ?>

<div class="page-content">
    <!-- Personal Information Form -->
    <div class="page-title">بيانات الشخصية</div>
    <div class="employee-form">
        <form action="#" method="post" class="row g-3 needs-validation" novalidate>
            <div class="col-md-6">
                <label for="emp-name" class="form-label">اسم الموظف</label>
                <input type="text" name="emp-name" id="emp-name" class="form-control" required>
                <div class="invalid-feedback">يرجى إدخال اسم الموظف</div>
            </div>

            <div class="col-md-6">
                <label for="emp-num-id" class="form-label">الرقم الوظيفي</label>
                <input type="text" name="emp-num-id" id="emp-num-id" class="form-control" required>
                <div class="invalid-feedback">يرجى إدخال الرقم الوظيفي</div>
            </div>

            <div class="col-md-6">
                <label for="emp-username" class="form-label">اسم المستخدم</label>
                <input type="text" name="emp-username" id="emp-username" class="form-control" required>
                <div class="invalid-feedback">يرجى إدخال اسم المستخدم</div>
            </div>

            <div class="col-md-6">
                <label for="emp-password" class="form-label">كلمة المرور</label>
                <input type="password" name="emp-password" id="emp-password" class="form-control" required>
                <div class="invalid-feedback">يرجى إدخال كلمة المرور</div>
            </div>

            <div class="col-md-6">
                <label for="job-id" class="form-label">الوظيفة</label>
                <select name="job-id" id="job-id" class="form-select" required>
                    <option value="">إختر وظيفة</option>
                    <!-- Fetch and list job options from the database -->
                    <?php $jobs_table -> data_select(); ?>
                </select>
                <div class="invalid-feedback">يرجى اختيار الوظيفة</div>
            </div>

            <div class="col-md-6">
                <label for="dept-id" class="form-label">القسم</label>
                <select name="dept-id" id="dept-id" class="form-select" required>
                    <option value="">إختر قسم</option>
                    <!-- Fetch and list department options from the database -->
                    <?php $dept_table -> data_select(); ?>
                </select>
                <div class="invalid-feedback">يرجى اختيار القسم</div>
            </div>

            <div class="col-md-6">
                <label for="basic-salary" class="form-label">الراتب الأساسي</label>
                <input type="number" name="basic-salary" id="basic-salary" class="form-control" required>
                <div class="invalid-feedback">يرجى إدخال الراتب الأساسي</div>
            </div>

            <div class="col-md-6">
                <label for="hire-date" class="form-label">تاريخ التوظيف</label>
                <input type="date" name="hire-date" id="hire-date" class="form-control" required>
                <div class="invalid-feedback">يرجى إدخال تاريخ التوظيف</div>
            </div>

            <div class="col-md-6">
                <label for="birth-date" class="form-label">تاريخ الميلاد</label>
                <input type="date" name="birth-date" id="birth-date" class="form-control" required>
                <div class="invalid-feedback">يرجى إدخال تاريخ الميلاد</div>
            </div>

            <div class="col-md-6">
                <label for="emp-gender" class="form-label">الجنس</label>
                <select name="emp-gender" id="emp-gender" class="form-select" required>
                    <option value="ذكر">ذكر</option>
                    <option value="أنثى">أنثى</option>
                </select>
                <div class="invalid-feedback">يرجى اختيار الجنس</div>
            </div>

            <div class="col-md-6">
                <label for="nid" class="form-label">الرقم الوطني</label>
                <input type="text" name="nid" id="nid" class="form-control" required>
                <div class="invalid-feedback">يرجى إدخال الرقم الوطني</div>
            </div>

            <div class="col-md-6">
                <label for="nationality" class="form-label">الجنسية</label>
                <input type="text" name="nationality" id="nationality" class="form-control" required>
                <div class="invalid-feedback">يرجى إدخال الجنسية</div>
            </div>

            <div class="col-md-6">
                <label for="marital-status" class="form-label">الحالة الاجتماعية</label>
                <select name="marital-status" id="marital-status" class="form-select" required>
                    <option value="single">أعزب</option>
                    <option value="married">متزوج</option>
                </select>
                <div class="invalid-feedback">يرجى اختيار الحالة الاجتماعية</div>
            </div>

            <div class="col-12">
                <input type="submit" name="save_personal" value="حفظ" class="btn btn-primary">
            </div>
        </form>
    </div>


</div>
<?php include "../../../master/sections/admin/foot.php"; ?>
<script src="../../../master/assets/dist/js/validate.js"></script>
<?php include "../../../master/sections/admin/end.php"; ?>