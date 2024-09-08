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
    // Handling the Update of Employee Information
    if (isset($_POST['save_personal'])) {
        $emp_id = $_POST['emp-id'];
        $emp_name = $_POST['emp-name'];
        $emp_num_id = $_POST['emp-num-id'];
        $emp_username = $_POST['emp-username'];
        $job_id = $_POST['job-id'];
        $dept_id = $_POST['dept-id'];
        $basic_salary = $_POST['basic-salary'];
        $hire_date = $_POST['hire-date'];
        $birth_date = $_POST['birth-date'];
        $emp_gender = $_POST['emp-gender'];
        $nid = $_POST['nid'];
        $nationality = $_POST['nationality'];
        $marital_status = $_POST['marital-status'];

        // Update query
        $stmt = $conn->prepare("UPDATE employees SET emp_name = ?, emp_num_id = ?, emp_username = ?, job_id = ?, dept_id = ?, basic_salary = ?, hire_date = ?, birth_date = ?, emp_gender = ?, nid = ?, nationality = ?, marital_status = ? WHERE emp_id = ?");
        $stmt->execute([$emp_name, $emp_num_id, $emp_username, $job_id, $dept_id, $basic_salary, $hire_date, $birth_date, $emp_gender, $nid, $nationality, $marital_status, $emp_id]);
        
        header("location:employee-index.php");
        exit();
    }
}

$emp_id = $_GET['emp_id'];
$employee_info = $conn->query("SELECT * FROM employees WHERE emp_id = $emp_id")->fetch(PDO::FETCH_ASSOC);

include "../../../master/sections/admin/start.php";
include "../../../master/sections/admin/links.php";
include "../../../master/sections/admin/mid.php";
?>
<div class="container mt-4">

<?php include "../emp-menu/edit-menu-emp.php"; ?>


<div class="page-content">
    <!-- Employee Edit Form -->
    <div class="page-title">تعديل بيانات الموظف</div>
    <div class="employee-form">
        <form action="edit-employee.php?emp_id=<?php echo $emp_id;?>" method="post" class="row g-3 needs-validation" novalidate>
            <input type="text" name="emp-id" value="<?php echo $employee_info['emp_id']; ?>">
            
            <div class="col-md-6">
                <label for="emp-name" class="form-label">اسم الموظف</label>
                <input type="text" name="emp-name" id="emp-name" class="form-control" value="<?php echo $employee_info['emp_name']; ?>" required>
                <div class="invalid-feedback">يرجى إدخال اسم الموظف</div>
            </div>

            <div class="col-md-6">
                <label for="emp-num-id" class="form-label">الرقم الوظيفي</label>
                <input type="text" name="emp-num-id" id="emp-num-id" class="form-control" value="<?php echo $employee_info['emp_num_id']; ?>" required>
                <div class="invalid-feedback">يرجى إدخال الرقم الوظيفي</div>
            </div>

            <div class="col-md-6">
                <label for="emp-username" class="form-label">اسم المستخدم</label>
                <input type="text" name="emp-username" id="emp-username" class="form-control" value="<?php echo $employee_info['emp_username']; ?>" required>
                <div class="invalid-feedback">يرجى إدخال اسم المستخدم</div>
            </div>

            <div class="col-md-6">
                <label for="job-id" class="form-label">الوظيفة</label>
                <select name="job-id" id="job-id" class="form-select" required>
                    <?php
                    $jobs = $conn->query("SELECT job_id, job_title FROM jobs")->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($jobs as $job) {
                        $selected = $job['job_id'] == $employee_info['job_id'] ? 'selected' : '';
                        echo "<option value='{$job['job_id']}' $selected>{$job['job_title']}</option>";
                    }
                    ?>
                </select>
                <div class="invalid-feedback">يرجى اختيار الوظيفة</div>
            </div>

            <div class="col-md-6">
                <label for="dept-id" class="form-label">القسم</label>
                <select name="dept-id" id="dept-id" class="form-select" required>
                    <?php
                    $departments = $conn->query("SELECT dept_id, dept_name FROM departments")->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($departments as $dept) {
                        $selected = $dept['dept_id'] == $employee_info['dept_id'] ? 'selected' : '';
                        echo "<option value='{$dept['dept_id']}' $selected>{$dept['dept_name']}</option>";
                    }
                    ?>
                </select>
                <div class="invalid-feedback">يرجى اختيار القسم</div>
            </div>

            <div class="col-md-6">
                <label for="basic-salary" class="form-label">الراتب الأساسي</label>
                <input type="number" name="basic-salary" id="basic-salary" class="form-control" value="<?php echo $employee_info['basic_salary']; ?>" required>
                <div class="invalid-feedback">يرجى إدخال الراتب الأساسي</div>
            </div>

            <div class="col-md-6">
                <label for="hire-date" class="form-label">تاريخ التوظيف</label>
                <input type="date" name="hire-date" id="hire-date" class="form-control" value="<?php echo $employee_info['hire_date']; ?>" required>
                <div class="invalid-feedback">يرجى إدخال تاريخ التوظيف</div>
            </div>

            <div class="col-md-6">
                <label for="birth-date" class="form-label">تاريخ الميلاد</label>
                <input type="date" name="birth-date" id="birth-date" class="form-control" value="<?php echo $employee_info['birth_date']; ?>" required>
                <div class="invalid-feedback">يرجى إدخال تاريخ الميلاد</div>
            </div>

            <div class="col-md-6">
                <label for="emp-gender" class="form-label">الجنس</label>
                <select name="emp-gender" id="emp-gender" class="form-select" required>
                    <option value="ذكر" <?php echo $employee_info['emp_gender'] == 'ذكر' ? 'selected' : ''; ?>>ذكر</option>
                    <option value="أنثى" <?php echo $employee_info['emp_gender'] == 'أنثى' ? 'selected' : ''; ?>>أنثى</option>
                </select>
                <div class="invalid-feedback">يرجى اختيار الجنس</div>
            </div>

            <div class="col-md-6">
                <label for="nid" class="form-label">الرقم الوطني</label>
                <input type="text" name="nid" id="nid" class="form-control" value="<?php echo $employee_info['nid']; ?>" required>
                <div class="invalid-feedback">يرجى إدخال الرقم الوطني</div>
            </div>

            <div class="col-md-6">
                <label for="nationality" class="form-label">الجنسية</label>
                <input type="text" name="nationality" id="nationality" class="form-control" value="<?php echo $employee_info['nationality']; ?>" required>
                <div class="invalid-feedback">يرجى إدخال الجنسية</div>
            </div>

            <div class="col-md-6">
                <label for="marital-status" class="form-label">الحالة الاجتماعية</label>
                <select name="marital-status" id="marital-status" class="form-select" required>
                    <option value="single" <?php echo $employee_info['marital_status'] == 'single' ? 'selected' : ''; ?>>أعزب</option>
                    <option value="married" <?php echo $employee_info['marital_status'] == 'married' ? 'selected' : ''; ?>>متزوج</option>
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
<!-- Custom JS -->
<script src="../../../master/assets/dist/js/del-employee.js"></script>

</div>
<?php include "../../../master/sections/admin/end.php"; ?>
