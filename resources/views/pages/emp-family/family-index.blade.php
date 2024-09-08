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
include "../../../master/sections/admin/start.php";
include "../../../master/sections/admin/links.php";
include "../../../master/sections/admin/mid.php";

// Fetch family members from the database
try {
    $stmt = $conn->prepare("SELECT * FROM emp_family");
    $stmt->execute();
    $family_info = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Error fetching family data: " . $e->getMessage());
}
?>
    <?php include "../emp-menu/edit-menu-emp.php"; ?>

<div class="page-content">
    <div class="table-container">
        <div class="page-title">بيانات أفراد العائلة</div>
        <div class="table-responsive">
          
            <div class="action-bar">
                <div class="button-group">
                    <button class="add-button">
                        <a href="add-family.php"><i class="bi bi-plus-circle"></i> إضافة</a>
                    </button>
                    <button class="import-button">
                        <a href="#"><i class="bi bi-file-earmark-arrow-up"></i> استيراد</a>
                    </button>
                    <button class="export-button">
                        <a href="#"><i class="bi bi-file-earmark-arrow-down"></i> تصدير</a>
                    </button>
                </div>
                <div class="search-box">
                    <input type="search" id="search-inp" placeholder="بحث...">
                </div>
            </div>

            <div id="search-result">
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
                                    <a href="edit-family.php?emp_id=<?= $family['emp_id'] ?>&emp_fam_id=<?= $family['emp_fam_id']; ?>"><i class="fas fa-edit"></i></a>
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

<?php include "../../../master/sections/admin/foot.php"; ?>
<!-- Custom JS for deletion and family management -->
<script src="../../../master/assets/dist/js/emp-family-open-hide-form.js"></script>
<script src="../../../master/assets/dist/js/del-emp-fam.js"></script>
<?php include "../../../master/sections/admin/end.php"; ?>
