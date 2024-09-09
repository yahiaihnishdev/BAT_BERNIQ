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

$sec_data = $_GET['data'];
?>

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
        // Fetch active jobs from the database
        $records = $conn->query("SELECT * FROM learn_user_types WHERE user_type_active = 1
        AND user_type_name LIKE('%$sec_data%')");
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