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

// Check if emp_id and emp_con_id are set
if (isset($_GET['emp_id']) && isset($_GET['emp_con_id'])) {
    $emp_id = $_GET['emp_id'];
    $emp_con_id = $_GET['emp_con_id'];

    // Fetch existing emergency contact information for the form
    try {
        $stmt = $conn->prepare("SELECT * FROM emp_contacts WHERE emp_con_id = ? AND emp_id = ?");
        $stmt->execute([$emp_con_id, $emp_id]);
        $emergency_info = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$emergency_info) {
            die("Error: Emergency contact not found.");
        }
    } catch (Exception $e) {
        die("Error fetching emergency data: " . $e->getMessage());
    }
} else {
    die("Error: Missing required parameters.");
}

// Handle form submission to update emergency contact information
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_emergency'])) {
    $emp_phone = $_POST['emp_phone'];
    $emp_email = $_POST['emp_email'];
    $emp_address = $_POST['emp_address'];
    $emer_call1 = $_POST['emer_call1'];
    $emer_name1 = $_POST['emer_name1'];
    $emer_call2 = $_POST['emer_call2'] ?? null;
    $emer_name2 = $_POST['emer_name2'] ?? null;

    // Update query
    try {
        $stmt = $conn->prepare("UPDATE emp_contacts SET emp_phone = ?, emp_email = ?, emp_address = ?, emer_call1 = ?, emer_name1 = ?, emer_call2 = ?, emer_name2 = ?, updated_at = NOW() WHERE emp_con_id = ? AND emp_id = ?");
        $stmt->execute([$emp_phone, $emp_email, $emp_address, $emer_call1, $emer_name1, $emer_call2, $emer_name2, $emp_con_id, $emp_id]);
        header("location:emergency-index.php");
        exit();
    } catch (Exception $e) {
        die("Error updating emergency contact: " . $e->getMessage());
    }
}

include "../../../master/sections/admin/start.php";
include "../../../master/sections/admin/links.php";
include "../../../master/sections/admin/mid.php";
?>
    <?php include "../emp-menu/edit-menu-emp.php"; ?>

<div class="page-content">
    <div class="form-container">
        <div class="page-title">تعديل جهة اتصال الطوارئ</div>
        <form action="edit-emergency.php?emp_id=<?php echo htmlspecialchars($emp_id); ?>&emp_con_id=<?php echo htmlspecialchars($emp_con_id); ?>" method="post" class="row g-3 needs-validation" novalidate>
            <div class="col-md-6">
                <label for="emp_phone" class="form-label">رقم الهاتف</label>
                <input type="text" name="emp_phone" id="emp_phone" class="form-control" value="<?php echo htmlspecialchars($emergency_info['emp_phone']); ?>" required>
                <div class="invalid-feedback">يرجى إدخال رقم الهاتف</div>
            </div>

            <div class="col-md-6">
                <label for="emp_email" class="form-label">البريد الإلكتروني</label>
                <input type="email" name="emp_email" id="emp_email" class="form-control" value="<?php echo htmlspecialchars($emergency_info['emp_email']); ?>" required>
                <div class="invalid-feedback">يرجى إدخال البريد الإلكتروني</div>
            </div>

            <div class="col-md-6">
                <label for="emp_address" class="form-label">العنوان</label>
                <input type="text" name="emp_address" id="emp_address" class="form-control" value="<?php echo htmlspecialchars($emergency_info['emp_address']); ?>" required>
                <div class="invalid-feedback">يرجى إدخال العنوان</div>
            </div>

            <div class="col-md-6">
                <label for="emer_call1" class="form-label">رقم هاتف الطوارئ 1</label>
                <input type="text" name="emer_call1" id="emer_call1" class="form-control" value="<?php echo htmlspecialchars($emergency_info['emer_call1']); ?>" required>
                <div class="invalid-feedback">يرجى إدخال رقم هاتف الطوارئ 1</div>
            </div>

            <div class="col-md-6">
                <label for="emer_name1" class="form-label">اسم جهة الطوارئ 1</label>
                <input type="text" name="emer_name1" id="emer_name1" class="form-control" value="<?php echo htmlspecialchars($emergency_info['emer_name1']); ?>" required>
                <div class="invalid-feedback">يرجى إدخال اسم جهة الطوارئ 1</div>
            </div>

            <div class="col-md-6">
                <label for="emer_call2" class="form-label">رقم هاتف الطوارئ 2 (اختياري)</label>
                <input type="text" name="emer_call2" id="emer_call2" class="form-control" value="<?php echo htmlspecialchars($emergency_info['emer_call2']); ?>">
            </div>

            <div class="col-md-6">
                <label for="emer_name2" class="form-label">اسم جهة الطوارئ 2 (اختياري)</label>
                <input type="text" name="emer_name2" id="emer_name2" class="form-control" value="<?php echo htmlspecialchars($emergency_info['emer_name2']); ?>">
            </div>

            <div class="col-12">
                <input type="submit" name="save_emergency" value="حفظ" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>

<?php include "../../../master/sections/admin/foot.php"; ?>
<?php include "../../../master/sections/admin/end.php"; ?>
