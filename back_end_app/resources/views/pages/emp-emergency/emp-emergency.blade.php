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

$emp_id = $_GET['emp_id'];  // Get emp_id from the URL
$emp_con_id = isset($_GET['emp_con_id']) ? $_GET['emp_con_id'] : null;

// Fetch emergency contact details if editing
$emergency_contact = null;
if ($emp_con_id) {
    $stmt = $conn->prepare("SELECT * FROM emp_contacts WHERE emp_con_id = ? AND emp_id = ?");
    $stmt->execute([$emp_con_id, $emp_id]);
    $emergency_contact = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $emp_phone = $_POST['emp_phone'];
    $emp_email = $_POST['emp_email'];
    $emp_address = $_POST['emp_address'];
    $emer_call1 = $_POST['emer_call1'];
    $emer_name1 = $_POST['emer_name1'];
    
    if ($emp_con_id) {
        // Update existing emergency contact record
        $stmt = $conn->prepare("UPDATE emp_contacts SET emp_phone = ?, emp_email = ?, emp_address = ?, emer_call1 = ?, emer_name1 = ?, updated_at = NOW() WHERE emp_con_id = ? AND emp_id = ?");
        $stmt->execute([$emp_phone, $emp_email, $emp_address, $emer_call1, $emer_name1, $emp_con_id, $emp_id]);
    } else {
        // Insert new emergency contact record
        $stmt = $conn->prepare("INSERT INTO emp_contacts (emp_id, emp_phone, emp_email, emp_address, emer_call1, emer_name1, person_active, created_at) VALUES (?, ?, ?, ?, ?, ?, 1, NOW())");
        $stmt->execute([$emp_id, $emp_phone, $emp_email, $emp_address, $emer_call1, $emer_name1]);
    }

    header("Location: emp-emergency.php?emp_id=$emp_id");
    exit();
}

// Fetch existing emergency contacts for the employee
$emergency_info = $conn->query("SELECT * FROM emp_contacts WHERE emp_id = $emp_id")->fetchAll(PDO::FETCH_ASSOC);

include "../../../master/sections/admin/start.php";
include "../../../master/sections/admin/links.php";
include "../../../master/sections/admin/mid.php";
?>
    <?php include "../emp-menu/edit-menu-emp.php"; ?>

<div class="page-content">
    <?php include "menu-emp.php"; ?>

    <!-- Add a button to show the form -->
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="text-center mb-4">
                    <h2 class="page-title"><?= $emp_con_id ? 'تعديل' : 'إضافة' ?> بيانات الطوارئ</h2>
                    <button id="show-form-btn" class="btn btn-primary w-100"><?= $emp_con_id ? 'إخفاء النموذج' : 'إضافة بيانات الطوارئ' ?></button>
                </div>

                <form id="emp-emergency-form" action="emp-emergency.php?emp_id=<?= $emp_id . ($emp_con_id ? "&emp_con_id=$emp_con_id" : '') ?>" method="post" class="row g-3 needs-validation" novalidate style="display: none;">
                    <input type="hidden" id="emp-id" name="emp_id" value="<?= $emp_id; ?>">
                    <!-- Form Fields -->
                    <div class="col-md-6">
                        <label for="emp_phone" class="form-label">رقم الهاتف</label>
                        <input type="text" name="emp_phone" id="emp_phone" class="form-control" required value="<?= htmlspecialchars($emergency_contact['emp_phone'] ?? '') ?>">
                        <div class="invalid-feedback">يرجى إدخال رقم الهاتف</div>
                    </div>
                    <div class="col-md-6">
                        <label for="emp_email" class="form-label">البريد الإلكتروني</label>
                        <input type="email" name="emp_email" id="emp_email" class="form-control" required value="<?= htmlspecialchars($emergency_contact['emp_email'] ?? '') ?>">
                        <div class="invalid-feedback">يرجى إدخال البريد الإلكتروني</div>
                    </div>
                    <div class="col-md-6">
                        <label for="emp_address" class="form-label">العنوان</label>
                        <input type="text" name="emp_address" id="emp_address" class="form-control" required value="<?= htmlspecialchars($emergency_contact['emp_address'] ?? '') ?>">
                        <div class="invalid-feedback">يرجى إدخال العنوان</div>
                    </div>
                    <div class="col-md-6">
                        <label for="emer_call1" class="form-label">رقم هاتف الطوارئ</label>
                        <input type="text" name="emer_call1" id="emer_call1" class="form-control" required value="<?= htmlspecialchars($emergency_contact['emer_call1'] ?? '') ?>">
                        <div class="invalid-feedback">يرجى إدخال رقم هاتف الطوارئ</div>
                    </div>
                    <div class="col-md-6">
                        <label for="emer_name1" class="form-label">اسم جهة الطوارئ</label>
                        <input type="text" name="emer_name1" id="emer_name1" class="form-control" required value="<?= htmlspecialchars($emergency_contact['emer_name1'] ?? '') ?>">
                        <div class="invalid-feedback">يرجى إدخال اسم جهة الطوارئ</div>
                    </div>
                    <div class="col-12">
                        <input type="submit" value="<?= $emp_con_id ? 'تحديث' : 'إضافة' ?>" class="btn btn-success w-100">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Table to display emergency contacts -->
    <div class="container mt-4">
        <div class="page-title">بيانات الطوارئ</div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>رقم الهاتف</th>
                        <th>البريد الإلكتروني</th>
                        <th>العنوان</th>
                        <th>رقم هاتف الطوارئ</th>
                        <th>اسم جهة الطوارئ</th>
                        <th>تعديل</th>
                        <th>حذف</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($emergency_info)): ?>
                        <?php foreach ($emergency_info as $contact): ?>
                            <tr>
                                <td><?= htmlspecialchars($contact['emp_phone']); ?></td>
                                <td><?= htmlspecialchars($contact['emp_email']); ?></td>
                                <td><?= htmlspecialchars($contact['emp_address']); ?></td>
                                <td><?= htmlspecialchars($contact['emer_call1']); ?></td>
                                <td><?= htmlspecialchars($contact['emer_name1']); ?></td>
                                <td class="edit">
                                    <a href="emp-emergency.php?emp_id=<?= $emp_id ?>&emp_con_id=<?= $contact['emp_con_id']; ?>"><i class="fas fa-edit"></i></a>
                                </td>
                                <td class="del">
                                    <input type="hidden" class="emp-con-id" value="<?= $contact['emp_con_id']; ?>">
                                    <i class="fa fa-trash delete-icon"></i>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">لا توجد بيانات</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Deletion confirmation box -->
    <div class="confirm-del h-s" style="display: none;">
        <div class="confirm-message">
            <div class="message-show">
                هل أنت متأكد من عملية الحذف؟
                <div class="confirm-btn">
                    <input type="hidden" id="record-id">
                    <span id="del-go" class="btn btn-primary">نعم</span>
                    <span id="close-message" class="btn btn-secondary">لا</span>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="../../../master/assets/dist/js/emp-emergency-open-hide-form.js"></script>


<?php include "../../../master/sections/admin/foot.php"; ?>
<!-- Custom JS -->
<!-- <script src="../../../master/assets/dist/js/del-emp-fam.js"></script> -->
<?php include "../../../master/sections/admin/end.php"; ?>