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
?>

<div class="page-content">
    <div class="table-container">
        <div class="page-title">العطل</div>
        <div class="table-responsive">
    
            <div class="action-bar">
                <div class="button-group">
                    <button class="add-button">
                        <a href="add-holiday"><i class="bi bi-plus-circle"></i> إضافة</a>
                    </button>
                    <button class="import-button">
                        <a href="#"><i class="bi bi-file-earmark-arrow-up"></i> استيراد</a>
                    </button>
                    <button class="export-button">
                        <a href="#"><i class="bi bi-file-earmark-arrow-down"></i> تصدير</a>
                    </button>
                </div>
                <div class="search-box">
                    <input type="search" id="search-inp" placeholder="search">
                </div>
            </div>

            <div id="search-result">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>الرقم</th>
                        <th>أسم العطلة</th>
                        <th>من تاريخ</th>
                        <th>إلى تاريخ</th>
                        <th>الأيام</th>
                        <th>تعديل</th>
                        <th>حذف</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch active holidays from the database
                    $records = $conn->query("SELECT * FROM holidays WHERE holiday_active = 1");
                    while ($row = $records->fetch()):
                    ?>
                    <tr>
                        <td><?php echo $row['holiday_id']; ?></td>
                        <td><?php echo $row['holiday_name']; ?></td>
                        <td><?php echo $row['holiday_from']; ?></td>
                        <td><?php echo $row['holiday_to']; ?></td>
                        <td><?php echo $row['days']; ?></td>
                        <td class="edit">
                            <a href="<?php echo "edit-holiday.php?holiday_id=" . $row['holiday_id']; ?>">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <td class="del">
                            <input type="hidden" value="<?php echo $row['holiday_id']; ?>">
                            <i class="fa fa-trash"></i>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
    <div class="confirm-del h-s">
        <div class="confirm-message">
            <div class="message-show">
                هل انت متأكد من عملية الحذف؟
                <div class="confirm-btn">
                    <input type="hidden" id="record-id">
                    <span id="del-go">نعم</span>
                    <span id="close-message">لا</span>
                </div>
            </div>
        </div>
    </div>
</div>




<?php include "../../../master/sections/admin/foot.php"; ?>
<!-- Custom JS -->
<script src="../../../master/assets/dist/js/search_holiday.js"></script>

<script src="../../../master/assets/dist/js/del-holiday.js"></script>
<?php include "../../../master/sections/admin/end.php"; ?>
