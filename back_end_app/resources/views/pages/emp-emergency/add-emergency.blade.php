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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_emergency'])) {
    $emp_id = $_POST['emp_id'];
    $emp_phone = $_POST['emp_phone'];
    $emp_email = $_POST['emp_email'];
    $emp_address = $_POST['emp_address'];
    $emer_call1 = $_POST['emer_call1'];
    $emer_name1 = $_POST['emer_name1'];
    $emer_call2 = $_POST['emer_call2'] ?? null;
    $emer_name2 = $_POST['emer_name2'] ?? null;

    // Insert the new emergency contact into the database
    try {
        $stmt = $conn->prepare("INSERT INTO emp_contacts (emp_id, emp_phone, emp_email, emp_address, emer_call1, emer_name1, emer_call2, emer_name2, created_at) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
        $stmt->execute([$emp_id, $emp_phone, $emp_email, $emp_address, $emer_call1, $emer_name1, $emer_call2, $emer_name2]);
        header("location:emergency-index.php");
        exit();
    } catch (Exception $e) {
        die("Error adding emergency contact: " . $e->getMessage());
    }
}

include "../../../master/sections/admin/start.php";
include "../../../master/sections/admin/links.php";
include "../../../master/sections/admin/mid.php";
?>
    <?php include "../emp-menu/menu-emp.php"; ?>

<div class="container mt-4">

<div class="page-content">
    <div class="form-container">
        <div class="page-title">إضافة جهة اتصال الطوارئ</div>
        <form action="add-emergency.php" method="post" class="row g-3 needs-validation" novalidate>
            <div class="col-md-6">
                <label for="emp_id" class="form-label">رقم الموظف</label>
                <input type="text" name="emp_id" id="emp_id" class="form-control" required>
                <div class="invalid-feedback">يرجى إدخال رقم الموظف</div>
            </div>

            <div class="col-md-6">
                <label for="emp_phone" class="form-label">رقم الهاتف</label>
                <input type="text" name="emp_phone" id="emp_phone" class="form-control" required>
                <div class="invalid-feedback">يرجى إدخال رقم الهاتف</div>
            </div>

            <div class="col-md-6">
                <label for="emp_email" class="form-label">البريد الإلكتروني</label>
                <input type="email" name="emp_email" id="emp_email" class="form-control" required>
                <div class="invalid-feedback">يرجى إدخال البريد الإلكتروني</div>
            </div>

            <div class="col-md-6">
                <label for="emp_address" class="form-label">العنوان</label>
                <input type="text" name="emp_address" id="emp_address" class="form-control" required>
                <div class="invalid-feedback">يرجى إدخال العنوان</div>
            </div>

            <div class="col-md-6">
                <label for="emer_call1" class="form-label">رقم هاتف الطوارئ 1</label>
                <input type="text" name="emer_call1" id="emer_call1" class="form-control" required>
                <div class="invalid-feedback">يرجى إدخال رقم هاتف الطوارئ 1</div>
            </div>

            <div class="col-md-6">
                <label for="emer_name1" class="form-label">اسم جهة الطوارئ 1</label>
                <input type="text" name="emer_name1" id="emer_name1" class="form-control" required>
                <div class="invalid-feedback">يرجى إدخال اسم جهة الطوارئ 1</div>
            </div>

            <div class="col-md-6">
                <label for="emer_call2" class="form-label">رقم هاتف الطوارئ 2 (اختياري)</label>
                <input type="text" name="emer_call2" id="emer_call2" class="form-control">
            </div>

            <div class="col-md-6">
                <label for="emer_name2" class="form-label">اسم جهة الطوارئ 2 (اختياري)</label>
                <input type="text" name="emer_name2" id="emer_name2" class="form-control">
            </div>

            <div class="col-12">
                <input type="submit" name="save_emergency" value="حفظ" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
</div>

<?php include "../../../master/sections/admin/foot.php"; ?>
<?php include "../../../master/sections/admin/end.php"; ?>
