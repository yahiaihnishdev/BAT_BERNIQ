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

// Ensure emp_id is set (retrieved from a form or session, etc.)
// if (isset($_POST['emp_id'])) {
//     $emp_id = $_POST['emp_id']; // This should come from your form or another source
// } else {
//     // Handle missing emp_id (e.g., show an error message or redirect)
//     echo "Error: emp_id is missing.";
//     exit();
// }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handling Personal Information Submission
    if (isset($_POST['save_personal'])) {
        // Extract form data safely
        $person_name = $_POST['person_name'];
        $person_rel = $_POST['person_rel'];
        $person_birth_date = $_POST['person_birth_date'];
        $person_age = $_POST['person_age'];
        $person_phone = $_POST['person_phone'];
        $person_active = isset($_POST['person_active']) ? 1 : 0;

        try {
            // Prepare the SQL statement
            $stmt = $conn->prepare("INSERT INTO emp_family (emp_id, person_name, person_rel, person_birth_date, person_age, person_phone, person_active, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
            // Execute the statement with the values
            $stmt->execute([$emp_id, $person_name, $person_rel, $person_birth_date, $person_age, $person_phone, $person_active]);

            // Redirect to the family index page after successful insertion
            header("location:family-index.php");
            exit();
        } catch (PDOException $e) {
            // Catch any errors and display an error message
            echo "Error: " . $e->getMessage();
        }
    }
}

include "../../../master/sections/admin/start.php";
include "../../../master/sections/admin/links.php";
include "../../../master/sections/admin/mid.php";
?>

<?php include "../emp-menu/menu-emp.php"; ?>

<div class="page-content">
    <!-- Personal Information Form -->
    <div class="page-title">بيانات الشخصية</div>
    <div class="employee-form">
        <form action="#" method="post" class="row g-3 needs-validation" novalidate>
            <!-- Hidden emp_id field -->
            <input type="hidden" name="emp_id" value="<?php echo $emp_id; ?>">

            <!-- Form fields (same as your existing form fields) -->
            <div class="col-md-6">
                <label for="person_name" class="form-label">اسم الموظف</label>
                <input type="text" name="person_name" id="person_name" class="form-control" required>
                <div class="invalid-feedback">يرجى إدخال اسم الموظف</div>
            </div>

            <div class="col-md-6">
                <label for="person_rel" class="form-label">العلاقة</label>
                <input type="text" name="person_rel" id="person_rel" class="form-control" required>
                <div class="invalid-feedback">يرجى إدخال العلاقة</div>
            </div>

            <div class="col-md-6">
                <label for="person_birth_date" class="form-label">تاريخ الميلاد</label>
                <input type="date" name="person_birth_date" id="person_birth_date" class="form-control" required>
                <div class="invalid-feedback">يرجى إدخال تاريخ الميلاد</div>
            </div>

            <div class="col-md-6">
                <label for="person_age" class="form-label">العمر</label>
                <input type="number" name="person_age" id="person_age" class="form-control" required>
                <div class="invalid-feedback">يرجى إدخال العمر</div>
            </div>

            <div class="col-md-6">
                <label for="person_phone" class="form-label">رقم الهاتف</label>
                <input type="text" name="person_phone" id="person_phone" class="form-control" required>
                <div class="invalid-feedback">يرجى إدخال رقم الهاتف</div>
            </div>

            <div class="col-md-6">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="person_active" id="person_active">
                    <label class="form-check-label" for="person_active">نشط</label>
                </div>
            </div>

            <div class="col-12">
                <input type="submit" name="save_personal" value="حفظ" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>

<?php include "../../../master/sections/admin/foot.php"; ?>
<?php include "../../../master/sections/admin/end.php"; ?>
