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
    include "../../../master/sections/admin/start.php";  // Contains the HTML <head> and opening <body> tag
    include "../../../master/sections/admin/links.php";  // Contains the top navigation bar
    include "../../../master/sections/admin/mid.php";  
?>


<div class="page-content">
    <div class="table-container">
        <div class="page-title">أنواع المستخدمين</div>
        <div class="table-responsive">
           
        <div class="action-bar">
    <div class="button-group">
        <button class="add-button">
            <a href="add-user-type"><i class="bi bi-plus-circle"></i> إضافة</a>
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
                        <th>نوع المستخدم</th>
                        <th>تعديل</th>
                        <th>حذف</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $records = $conn -> query("SELECT * FROM learn_user_types
                        WHERE user_type_active = 1");
                        while($row = $records -> fetch()):
                    ?>
                        <tr>
                            <td><?php echo $row['user_type_id'];?></td>
                            <td><?php echo $row['user_type_name'];?></td>
                            <td class="edit">
                                <a href="<?php echo "edit-user-type?user_type_id=".$row['user_type_id'];?>">
                                    
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                            <td class="del">
                                <input type="hidden" value="<?php echo $row['user_type_id'] ;?>">
                                <i class="fa fa-trash"></i>
                            </td>
                        </tr>
                    <?php  endwhile; ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
    <div class="confirm-del h-s">
        <div class="confirm-message">
            <div class="message-show">
                هل انت متاكد من عملية الحذف
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

<!-- custome js -->
<script src="../../../master/assets/dist/js/del.js"></script>
<script src="../../../master/assets/dist/js/search_user-type.js"></script>

<?php include "../../../master/sections/admin/end.php" ?>