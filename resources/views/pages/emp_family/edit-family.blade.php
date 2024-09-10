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

// Ensure that emp_id and emp_fam_id are set in the URL
if (isset($_GET['emp_id']) && isset($_GET['emp_fam_id'])) {
    $emp_id = $_GET['emp_id'];
    $emp_fam_id = $_GET['emp_fam_id'];
} else {
    die("Error: Missing required parameters.");
}

// Fetching family member information for display in the form
$family_member_info = $conn->prepare("SELECT * FROM emp_family WHERE emp_fam_id = ? AND emp_id = ?");
$family_member_info->execute([$emp_fam_id, $emp_id]);
$family_member_info = $family_member_info->fetch(PDO::FETCH_ASSOC);

// Handle case where no family member information is found
if (!$family_member_info) {
    die("Error: Family member not found.");
}

// Handling form submission to update family member information
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_personal'])) {
    $person_name = $_POST['person_name'];
    $person_rel = $_POST['person_rel'];
    $person_birth_date = $_POST['person_birth_date'];
    $person_age = $_POST['person_age'];
    $person_phone = $_POST['person_phone'];
    $person_active = isset($_POST['person_active']) ? 1 : 0;

    // Update query
    $stmt = $conn->prepare("UPDATE emp_family SET person_name = ?, person_rel = ?, person_birth_date = ?, person_age = ?, person_phone = ?, person_active = ?, updated_at = NOW() WHERE emp_fam_id = ? AND emp_id = ?");
    $stmt->execute([$person_name, $person_rel, $person_birth_date, $person_age, $person_phone, $person_active, $emp_fam_id, $emp_id]);

    header("location:family-index.php");
    exit();
}

include "../../../master/sections/admin/start.php";
include "../../../master/sections/admin/links.php";
include "../../../master/sections/admin/mid.php";
?>

<div class="container mt-4">
    <?php include "../emp-menu/edit-menu-emp.php"; ?>

    <div class="page-content">
        <div class="page-title">تعديل بيانات أفراد العائلة</div>
        <div class="employee-form">
            <form action="edit-family.php?emp_id=<?php echo $emp_id; ?>&emp_fam_id=<?php echo $emp_fam_id; ?>" method="post" class="row g-3 needs-validation" novalidate>

                <div class="col-md-6">
                    <label for="person_name" class="form-label">اسم الفرد</label>
                    <input type="text" name="person_name" id="person_name" class="form-control" value="<?php echo isset($family_member_info['person_name']) ? $family_member_info['person_name'] : ''; ?>" required>
                    <div class="invalid-feedback">يرجى إدخال اسم الفرد</div>
                </div>

                <div class="col-md-6">
                    <label for="person_rel" class="form-label">صلة القرابة</label>
                    <input type="text" name="person_rel" id="person_rel" class="form-control" value="<?php echo isset($family_member_info['person_rel']) ? $family_member_info['person_rel'] : ''; ?>" required>
                    <div class="invalid-feedback">يرجى إدخال صلة القرابة</div>
                </div>

                <div class="col-md-6">
                    <label for="person_birth_date" class="form-label">تاريخ الميلاد</label>
                    <input type="date" name="person_birth_date" id="person_birth_date" class="form-control" value="<?php echo isset($family_member_info['person_birth_date']) ? $family_member_info['person_birth_date'] : ''; ?>" required>
                    <div class="invalid-feedback">يرجى إدخال تاريخ الميلاد</div>
                </div>

                <div class="col-md-6">
                    <label for="person_age" class="form-label">العمر</label>
                    <input type="number" name="person_age" id="person_age" class="form-control" value="<?php echo isset($family_member_info['person_age']) ? $family_member_info['person_age'] : ''; ?>" required>
                    <div class="invalid-feedback">يرجى إدخال العمر</div>
                </div>

                <div class="col-md-6">
                    <label for="person_phone" class="form-label">رقم الهاتف</label>
                    <input type="text" name="person_phone" id="person_phone" class="form-control" value="<?php echo isset($family_member_info['person_phone']) ? $family_member_info['person_phone'] : ''; ?>" required>
                    <div class="invalid-feedback">يرجى إدخال رقم الهاتف</div>
                </div>

                <div class="col-md-6">
                    <label for="person_active" class="form-label">نشط</label>
                    <input type="checkbox" name="person_active" id="person_active" class="form-check-input" <?php echo isset($family_member_info['person_active']) && $family_member_info['person_active'] == 1 ? 'checked' : ''; ?>>
                </div>

                <div class="col-12">
                    <input type="submit" name="save_personal" value="حفظ" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

<?php include "../../../master/sections/admin/foot.php"; ?>
<?php include "../../../master/sections/admin/end.php"; ?>
