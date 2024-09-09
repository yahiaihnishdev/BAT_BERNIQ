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

$emp_id = $_GET['emp_id'];

// Fetch existing data
$employee = $conn->prepare("SELECT * FROM employees WHERE emp_id = ?");
$employee->execute([$emp_id]);
$employee_data = $employee->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $basic_salary = $_POST['basic_salary'];
    $allowances = $_POST['allowances'];
    $deductions = $_POST['deductions'];
    $taxes = $_POST['taxes'];

    // Update employees table
    $conn->prepare("UPDATE employees SET basic_salary = ? WHERE emp_id = ?")
         ->execute([$basic_salary, $emp_id]);

    // Update allowances (simplified for demonstration)
    $conn->prepare("DELETE FROM emp_allowances WHERE emp_id = ?")->execute([$emp_id]);
    foreach ($allowances as $type => $amount) {
        $conn->prepare("INSERT INTO emp_allowances (emp_id, allowance_type, allowance_amount) VALUES (?, ?, ?)")
             ->execute([$emp_id, $type, $amount]);
    }

    // Update deductions (simplified for demonstration)
    $conn->prepare("DELETE FROM emp_deductions WHERE emp_id = ?")->execute([$emp_id]);
    foreach ($deductions as $type => $amount) {
        $conn->prepare("INSERT INTO emp_deductions (emp_id, deduction_type, deduction_amount) VALUES (?, ?, ?)")
             ->execute([$emp_id, $type, $amount]);
    }

    // Update taxes (simplified for demonstration)
    $conn->prepare("DELETE FROM emp_taxes WHERE emp_id = ?")->execute([$emp_id]);
    foreach ($taxes as $type => $rate) {
        $conn->prepare("INSERT INTO emp_taxes (emp_id, tax_type, tax_rate) VALUES (?, ?, ?)")
             ->execute([$emp_id, $type, $rate]);
    }

    header("location:emp-salary-index.php");
    exit();
}

include "../../../master/sections/admin/start.php";
?>

<div class="main">
    <div class="sidebar">
        <!-- Sidebar Content -->
    </div>
    <div class="page-data">
        <h2 class="page-title">بيانات الراتب و التعويضات للموظف رضوان نافو</h2>
        <div class="card-grid">
            <div class="card">
                <div class="card-header">
                    <h3>بيانات الراتب</h3>
                    <button class="add-button">+</button>
                </div>
                <div class="card-content">
                    <p>اسم البنك: مصرف التجارة والتنمية</p>
                    <p>رقم الحساب: 001546879553</p>
                    <p>مدة العقد: 10 الى 6 سنوات</p>
                    <p>نوع حساب الراتب: حساب جاري مفتوح</p>
                    <p>المسمى الوظيفي: المحاسب المالي</p>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3>الخصم</h3>
                    <button class="add-button">+</button>
                </div>
                <div class="card-content">
                    <p>التأمين: 5.125%</p>
                    <p>التأمين حسب الحركة: 14.35%</p>
                    <p>الضمان: 3%</p>
                    <p>النقابة: 200.000</p>
                    <p>الرعاية القانونية: 200.000</p>
                    <p>الرعاية عن الوالدين: 75.000</p>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3>الحصص الدائمة</h3>
                    <button class="add-button">+</button>
                </div>
                <div class="card-content">
                    <!-- Add permanent compensations here -->
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3>العلاوات الدائمة</h3>
                    <button class="add-button">+</button>
                </div>
                <div class="card-content">
                    <!-- Add permanent allowances here -->
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3>سجل التبديلات</h3>
                    <button class="add-button">+</button>
                </div>
                <div class="card-content">
                    <table>
                        <thead>
                            <tr>
                                <th>الرقم</th>
                                <th>نوع التعديل</th>
                                <th>من</th>
                                <th>الى</th>
                                <th>تاريخ التعديل</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>تعديل الراتب</td>
                                <td>800</td>
                                <td>1000</td>
                                <td>2022/7/20</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>تعديل حساب المصرف</td>
                                <td>001546879553</td>
                                <td>001546878553</td>
                                <td>2022/7/20</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "../../../master/sections/admin/end.php"; ?>
