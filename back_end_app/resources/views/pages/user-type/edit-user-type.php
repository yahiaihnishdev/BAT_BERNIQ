<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:../log.php");
    exit();
} elseif ($_SESSION['usertype'] != 'admin') {
    header("location:out.php");
    exit();
}

include "../../../master/sections/connect.php";



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $type_ID = $_POST['type-id'];
    $type_name = $_POST['type-name'];
    $stmt = $conn->prepare("UPDATE learn_user_types SET user_type_name = ?
        WHERE user_type_id = ?");
    $stmt->execute([$type_name, $type_ID]);
    header("location:user-types");
}
include "../../../master/sections/admin/start.php";  // Contains the HTML <head> and opening <body> tag
include "../../../master/sections/admin/links.php";  // Contains the top navigation bar
include "../../../master/sections/admin/mid.php";

$user_type_id = $_GET['user_type_id'];
$user_type_info = $conn->query("SELECT * FROM learn_user_types
    WHERE user_type_id = $user_type_id")->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="page-content">
    <div class="page-title">تعديل نوع مستخدم</div>
    <div class="employee-form">
        <form action="#" method="post" class="row g-3 needs-validation" novalidate>
            <input type="hidden" name="type-id" value="<?php echo $user_type_id; ?>">
            <label for="name">نوع المستخدم</label>
            <input type="text" name="type-name" class="form-control" required value="<?php echo $user_type_info[0]['user_type_name']; ?>">
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