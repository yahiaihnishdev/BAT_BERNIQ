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
    $type_name = $_POST['type-name'];
    $stmt = $conn->prepare("INSERT INTO learn_user_types(user_type_name)
        VALUES(?)");
    $stmt->execute([$type_name]);
    header("location:user-types");
}
include "../../../master/sections/admin/start.php";  // Contains the HTML <head> and opening <body> tag
include "../../../master/sections/admin/links.php";  // Contains the top navigation bar
include "../../../master/sections/admin/mid.php";
?>


<div class="page-content">
    <div class="page-title">إضافة نوع مستخدم</div>
    <div class="employee-form">
        <form action="#" method="post" class="row g-3 needs-validation" novalidate>
            <label for="name">نوع المستخدم</label>
            <input type="text" name="type-name" class="form-control" required>
            <div class="invalid-feedback">
                يرجي إدخال نوع المستخدم
            </div>
            <input type="submit" value="حفظ">
        </form>
    </div>

</div>

<?php include "../../../master/sections/admin/foot.php"; ?>

<!-- custome js -->
<script src="../../../master/assets/dist/js/validate.js"></script>

<?php include "../../../master/sections/admin/end.php" ?>