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
$emp_fam_id = isset($_GET['emp_fam_id']) ? $_GET['emp_fam_id'] : null;

// Fetch family member details if editing
$family_member = null;
if ($emp_fam_id) {
    $stmt = $conn->prepare("SELECT * FROM emp_family WHERE emp_fam_id = ? AND emp_id = ?");
    $stmt->execute([$emp_fam_id, $emp_id]);
    $family_member = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle family information submission (add/edit)
    $person_name = $_POST['person_name'];
    $person_rel = $_POST['person_rel'];
    $person_birth_date = $_POST['person_birth_date'];
    $person_age = $_POST['person_age'];
    $person_phone = $_POST['person_phone'];
    $person_active = isset($_POST['person_active']) ? 1 : 0;

    if ($emp_fam_id) {
        // Update existing family member record
        $stmt = $conn->prepare("UPDATE emp_family SET person_name = ?, person_rel = ?, person_birth_date = ?, person_age = ?, person_phone = ?, person_active = ?, updated_at = NOW() WHERE emp_fam_id = ? AND emp_id = ?");
        $stmt->execute([$person_name, $person_rel, $person_birth_date, $person_age, $person_phone, $person_active, $emp_fam_id, $emp_id]);
    } else {
        // Insert new family member record
        $stmt = $conn->prepare("INSERT INTO emp_family (emp_id, person_name, person_rel, person_birth_date, person_age, person_phone, person_active, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
        $stmt->execute([$emp_id, $person_name, $person_rel, $person_birth_date, $person_age, $person_phone, $person_active]);
    }

    header("Location: emp-family.php?emp_id=$emp_id");
    exit();
}

// Fetch existing family members for the employee
$family_info = $conn->query("SELECT * FROM emp_family WHERE emp_id = $emp_id")->fetchAll(PDO::FETCH_ASSOC);

include "../../../master/sections/admin/start.php";
include "../../../master/sections/admin/links.php";
include "../../../master/sections/admin/mid.php";
?>
    <?php include "menu-emp.php"; ?>

<div class="page-content">

    <!-- Add a button to show the form -->
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="text-center mb-4">
                    <h2 class="page-title"><?= $emp_fam_id ? 'تعديل' : 'إضافة' ?> بيانات عائلية</h2>
                    <button id="show-form-btn" class="btn btn-primary w-100"><?= $emp_fam_id ? 'إخفاء النموذج' : 'إضافة فرد عائلي' ?></button>
                </div>

                <form id="emp-family-form" action="emp-family.php?emp_id=<?= $emp_id . ($emp_fam_id ? "&emp_fam_id=$emp_fam_id" : '') ?>" method="post" class="row g-3 needs-validation" novalidate style="display: none;">
                    <input type="hidden" id="emp-id" name="emp_id" value="<?= $emp_id; ?>">
                    <!-- Form Fields -->
                    <div class="col-12">
                        <label for="person_name" class="form-label">اسم فرد العائلة</label>
                        <input type="text" name="person_name" id="person_name" class="form-control" required value="<?= htmlspecialchars($family_member['person_name'] ?? '') ?>">
                        <div class="invalid-feedback">يرجى إدخال اسم فرد العائلة</div>
                    </div>
                    <div class="col-12">
                        <label for="person_rel" class="form-label">العلاقة</label>
                        <input type="text" name="person_rel" id="person_rel" class="form-control" required value="<?= htmlspecialchars($family_member['person_rel'] ?? '') ?>">
                        <div class="invalid-feedback">يرجى إدخال العلاقة</div>
                    </div>

                    <div class="col-12">
                        <label for="person_birth_date" class="form-label">تاريخ الميلاد</label>
                        <input type="date" name="person_birth_date" id="person_birth_date" class="form-control" required value="<?= htmlspecialchars($family_member['person_birth_date'] ?? '') ?>">
                        <div class="invalid-feedback">يرجى إدخال تاريخ الميلاد</div>
                    </div>
                    <div class="col-12">
                        <label for="person_age" class="form-label">العمر</label>
                        <input type="number" name="person_age" id="person_age" class="form-control" required value="<?= htmlspecialchars($family_member['person_age'] ?? '') ?>">
                        <div class="invalid-feedback">يرجى إدخال العمر</div>
                    </div>
                    <div class="col-12">
                        <label for="person_phone" class="form-label">رقم الهاتف</label>
                        <input type="tel" name="person_phone" id="person_phone" class="form-control" required value="<?= htmlspecialchars($family_member['person_phone'] ?? '') ?>">
                        <div class="invalid-feedback">يرجى إدخال رقم الهاتف</div>
                    </div>
                    <div class="col-12">
                        <label for="person_active" class="form-label">نشط</label>
                        <div class="form-check">
                            <input type="checkbox" name="person_active" id="person_active" class="form-check-input" <?= isset($family_member['person_active']) && $family_member['person_active'] ? 'checked' : '' ?>>
                            <label for="person_active" class="form-check-label">نشط</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" value="<?= $emp_fam_id ? 'تحديث' : 'إضافة' ?>" class="btn btn-success w-100">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Table to display family members -->
    <div class="table-container mt-4">
        <div class="page-title">بيانات عائلية</div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>اسم فرد العائلة</th>
                        <th>العلاقة</th>
                        <th>تاريخ الميلاد</th>
                        <th>العمر</th>
                        <th>رقم الهاتف</th>
                        <th>نشط</th>
                        <th>تعديل</th>
                        <th>حذف</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($family_info)): ?>
                        <?php foreach ($family_info as $family): ?>
                            <tr>
                                <td><?= htmlspecialchars($family['person_name']); ?></td>
                                <td><?= htmlspecialchars($family['person_rel']); ?></td>
                                <td><?= htmlspecialchars($family['person_birth_date']); ?></td>
                                <td><?= htmlspecialchars($family['person_age']); ?></td>
                                <td><?= htmlspecialchars($family['person_phone']); ?></td>
                                <td><?= $family['person_active'] ? 'نعم' : 'لا'; ?></td>
                                <td class="edit">
                                    <a href="emp-family.php?emp_id=<?= $emp_id ?>&emp_fam_id=<?= $family['emp_fam_id']; ?>"><i class="fas fa-edit"></i></a>
                                </td>
                                <td class="del">
                                    <input type="hidden" class="emp-fam-id" value="<?= $family['emp_fam_id']; ?>">
                                    <i class="fa fa-trash delete-icon"></i>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center">لا توجد بيانات</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Deletion confirmation box -->
<div class="confirm-del h-s">
    <div class="confirm-message">
        <div class="message-show">
            هل انت متأكد من عملية الحذف؟
            <div class="confirm-btn">
                <input type="hidden" id="record-id">
                <span id="del-go" class="btn btn-primary">نعم</span>
                <span id="close-message" class="btn btn-secondary">لا</span>
            </div>
        </div>
    </div>
</div>
</div>
<script src="../../../master/assets/dist/js/emp-family-open-hide-form.js"></script>


<?php include "../../../master/sections/admin/foot.php"; ?>
<!-- Custom JS -->
<script src="../../../master/assets/dist/js/del-emp-fam.js"></script>
<?php include "../../../master/sections/admin/end.php"; ?>