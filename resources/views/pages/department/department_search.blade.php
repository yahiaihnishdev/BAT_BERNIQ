
@extends('layout.master')
@section('content')

<?php


$sec_data = $_GET['data'];
?>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>الرقم</th>
            <th>أسم القسم</th>
            <th> تاريخ اصدار</th>
            <th>تعديل</th>
            <th>حذف</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Fetch active jobs from the database
        $records = $conn->query("SELECT * FROM departments WHERE department_active = 1
        AND dept_name LIKE('%$sec_data%')");
        while ($row = $records->fetch()):
            ?>
            <tr>
                <td><?php echo $row['dept_id']; ?></td>
                <td><?php echo $row['dept_name']; ?></td>
                <td><?php echo $row['created_at']; ?></td>
                <td class="edit">
                    <a href="<?php echo "edit-department.php?dept_id=" . $row['dept_id']; ?>">
                        <i class="fas fa-edit"></i>
                    </a>
                </td>
                <td class="del">
                    <input type="hidden" value="<?php echo $row['dept_id']; ?>">
                    <i class="fa fa-trash"></i>
                </td>
            </tr>
            <?php endwhile; ?>

    </tbody>
</table>
@endsection
