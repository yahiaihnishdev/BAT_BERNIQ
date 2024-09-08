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

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $holiday_name = $_POST['holiday-name'];
        $holiday_from = $_POST['holiday-from'];
        $holiday_to = $_POST['holiday-to'];
        $days = $_POST['days'];
        $emp_id = $_POST['emp-id']; // Assuming you're assigning this holiday to a specific employee
        
        $stmt = $conn->prepare("INSERT INTO holidays (holiday_name, holiday_from, holiday_to, days, emp_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$holiday_name, $holiday_from, $holiday_to, $days, $emp_id]);

        // Make sure the path to holidays-index.php is correct
        header("location:holiday-index.php"); // or adjust the path like header("location:../holidays-index.php"); if it's in a parent directory
        exit();
    }

    include "../../../master/sections/admin/start.php";
    include "../../../master/sections/admin/links.php";
    include "../../../master/sections/admin/mid.php"; 
?>

<div class="page-content">
    <div class="page-name">إضافة عطلة جديدة</div>
    <div class="employee-form">
        <form action="#" method="post" class="row g-3 needs-validation" novalidate>
            <label for="holiday-name">اسم العطلة</label>
            <input type="text" name="holiday-name" class="form-control" required>
            <div class="invalid-feedback">
                يرجي إدخال اسم العطلة
            </div>

            <label for="holiday-from">من تاريخ</label>
            <input type="date" name="holiday-from" class="form-control" required>
            <div class="invalid-feedback">
                يرجي إدخال تاريخ البداية
            </div>

            <label for="holiday-to">إلى تاريخ</label>
            <input type="date" name="holiday-to" class="form-control" required>
            <div class="invalid-feedback">
                يرجي إدخال تاريخ النهاية
            </div>

            <label for="days">عدد الأيام</label>
            <input type="number" name="days" class="form-control" required>
            <div class="invalid-feedback">
                يرجي إدخال عدد الأيام
            </div>

            <label for="emp-id">معرف الموظف</label>
            <input type="number" name="emp-id" class="form-control" required>
            <div class="invalid-feedback">
                يرجي إدخال معرف الموظف
            </div>

            <input type="submit" value="حفظ">
        </form>
    </div>
</div>

<?php include "../../../master/sections/admin/foot.php"; ?>

<!-- Custom JS -->
<script src="../../../master/assets/dist/js/validate.js"></script>

<?php include "../../../master/sections/admin/end.php"; ?>
