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
            <th>اسم الموظف</th>
            <th>الوظيفة</th>
            <th>القسم</th>
            <th>الراتب الاساسي </th>
            <th>الحالة الاجتماعية</th>
            <th>تعديل</th>
            <th>حذف</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Fetch active jobs from the database
        $records = $conn->query("SELECT emp_id, emp_name, emp_num_id, emp_username,
         job_id, dept_id, hire_date FROM employees WHERE emp_active = 1
        AND emp_name LIKE('%$sec_data%')");
       while ($row = $records->fetch(PDO::FETCH_ASSOC)):
        ?>
        <tr>
            <td><?php echo $row['emp_id']; ?></td>
            <td><?php echo $row['emp_name']; ?></td>
            <td><?php echo $row['emp_num_id']; ?></td>
            <td><?php echo $row['emp_username']; ?></td>
            <td>
                <?php
                // Fetch job title
                $job = $conn->query("SELECT job_title FROM jobs WHERE job_id = " . $row['job_id'])->fetch(PDO::FETCH_ASSOC);
                echo $job['job_title'] ?? 'غير محدد';
                ?>
            </td>
            <td>
                <?php
                // Fetch department name
                $dept = $conn->query("SELECT dept_name FROM departments WHERE dept_id = " . $row['dept_id'])->fetch(PDO::FETCH_ASSOC);
                echo $dept['dept_name'] ?? 'غير محدد';
                ?>
            </td>
            <td><?php echo $row['hire_date']; ?></td>
            <td class="edit">
                <a href="<?php echo "edit-employee.php?emp_id=" . $row['emp_id']; ?>">
                    <i class="fas fa-edit"></i>
                </a>
            </td>
            <td class="del">
                <input type="hidden" value="<?php echo $row['emp_id']; ?>">
                <i class="fa fa-trash"></i>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>