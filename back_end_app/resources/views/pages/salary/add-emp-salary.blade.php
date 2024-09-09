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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $emp_id = $_POST['emp_id'];
    $basic_salary = $_POST['basic_salary'];
    $allowances = $_POST['allowances'];
    $deductions = $_POST['deductions'];
    $taxes = $_POST['taxes'];

    // Insert into employees table
    $conn->prepare("INSERT INTO employees (emp_id, basic_salary) VALUES (?, ?)")
         ->execute([$emp_id, $basic_salary]);

    // Insert allowances
    foreach ($allowances as $type => $amount) {
        $conn->prepare("INSERT INTO emp_allowances (emp_id, allowance_type, allowance_amount) VALUES (?, ?, ?)")
             ->execute([$emp_id, $type, $amount]);
    }

    // Insert deductions
    foreach ($deductions as $type => $amount) {
        $conn->prepare("INSERT INTO emp_deductions (emp_id, deduction_type, deduction_amount) VALUES (?, ?, ?)")
             ->execute([$emp_id, $type, $amount]);
    }

    // Insert taxes
    foreach ($taxes as $type => $rate) {
        $conn->prepare("INSERT INTO emp_taxes (emp_id, tax_type, tax_rate) VALUES (?, ?, ?)")
             ->execute([$emp_id, $type, $rate]);
    }

    header("location:emp-salary-index.php");
    exit();
}

include "../../../master/sections/admin/start.php";
include "../../../master/sections/admin/links.php";
include "../../../master/sections/admin/mid.php";
?>

<div class="page-content">
    <div class="page-title">إضافة راتب موظف</div>
    <div class="employee-form-container">
        <form action="add-emp-salary.php" method="POST" class="employee-form">
            <div class="form-group">
                <label for="emp_id">رقم الموظف</label>
                <input type="number" name="emp_id" id="emp_id" required>
            </div>
            <div class="form-group">
                <label for="basic_salary">الراتب الأساسي</label>
                <input type="number" name="basic_salary" id="basic_salary" step="0.01" required>
            </div>
            <div class="form-group">
                <label>العلاوات</label>
                <div class="allowances-container">
                    <input type="text" name="allowances[example_allowance]" placeholder="مثال: بدل سكن" required>
                    <input type="number" name="allowances[example_amount]" step="0.01" placeholder="المبلغ" required>
                </div>
            </div>
            <div class="form-group">
                <label>الخصومات</label>
                <div class="deductions-container">
                    <input type="text" name="deductions[example_deduction]" placeholder="مثال: تأمين" required>
                    <input type="number" name="deductions[example_amount]" step="0.01" placeholder="المبلغ" required>
                </div>
            </div>
            <div class="form-group">
                <label>الضرائب</label>
                <div class="taxes-container">
                    <input type="text" name="taxes[example_tax]" placeholder="مثال: ضريبة الدخل" required>
                    <input type="number" name="taxes[example_rate]" step="0.01" placeholder="النسبة المئوية" required>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">إضافة</button>
            </div>
        </form>
    </div>
</div>

<?php include "../../../master/sections/admin/end.php"; ?>

<style>
.page-content {
    max-width: 800px;
    margin: auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.page-title {
    text-align: center;
    font-size: 24px;
    margin-bottom: 20px;
    color: #333;
}

.employee-form-container {
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.employee-form .form-group {
    margin-bottom: 15px;
}

.employee-form label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

.employee-form input[type="number"],
.employee-form input[type="text"] {
    width: calc(100% - 10px);
    padding: 8px;
    font-size: 16px;
    border-radius: 4px;
    border: 1px solid #ccc;
}

.allowances-container,
.deductions-container,
.taxes-container {
    display: flex;
    gap: 10px;
    margin-top: 5px;
}

.btn {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

.btn-primary:hover {
    background-color: #0056b3;
}

</style>
