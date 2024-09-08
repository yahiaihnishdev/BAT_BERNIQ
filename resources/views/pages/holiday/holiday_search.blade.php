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
        // Fetch active jobs from the database
        $records = $conn->query("SELECT * FROM holidays WHERE holiday_active = 1
        AND holiday_name LIKE('%$sec_data%')");
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