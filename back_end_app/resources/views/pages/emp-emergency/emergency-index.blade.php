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

// Fetch emergency contacts from the database
try {
    $stmt = $conn->prepare("SELECT * FROM emp_contacts");
    $stmt->execute();
    $emergency_info = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Error fetching emergency contacts: " . $e->getMessage());
}
?>
    <?php include "../emp-menu/edit-menu-emp.php"; ?>

<div class="page-content">
    <div class="table-container">
        <div class="page-title">بيانات الطوارئ</div>
        <div class="table-responsive">

            <div class="action-bar">
                <div class="button-group">
                    <button class="add-button">
                        <a href="add-emergency.php"><i class="bi bi-plus-circle"></i> إضافة</a>
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
                                        <a href="edit-emergency.php?emp_id=<?= $contact['emp_id'] ?>&emp_con_id=<?= $contact['emp_con_id']; ?>"><i class="fas fa-edit"></i></a>
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

<?php include "../../../master/sections/admin/foot.php"; ?>
<!-- Custom JS for deletion -->
<script src="../../../master/assets/dist/js/emp-family-open-hide-form.js"></script>
<script src="../../../master/assets/dist/js/del-emp-fam.js"></script>
<?php include "../../../master/sections/admin/end.php"; ?>
