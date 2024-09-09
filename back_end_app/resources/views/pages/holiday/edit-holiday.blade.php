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

// Handle POST request for updating the holiday
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $holiday_id = filter_input(INPUT_POST, 'holiday-id', FILTER_SANITIZE_NUMBER_INT);
    $holiday_name = filter_input(INPUT_POST, 'holiday-name');
    $holiday_from = filter_input(INPUT_POST, 'holiday-from');
    $holiday_to = filter_input(INPUT_POST, 'holiday-to',);
    $days = filter_input(INPUT_POST, 'days', FILTER_SANITIZE_NUMBER_INT);
    $holiday_active = isset($_POST['holiday-active']) ? 1 : 0; // Checkbox handling

    if ($holiday_id && $holiday_name && $holiday_from && $holiday_to && $days) {
        try {
            $stmt = $conn->prepare("UPDATE holidays SET holiday_name = ?, holiday_from = ?, holiday_to = ?, days = ?, holiday_active = ? WHERE holiday_id = ?");
            $stmt->execute([$holiday_name, $holiday_from, $holiday_to, $days, $holiday_active, $holiday_id]);
            header("location:holiday-index.php?status=success");
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        header("location:holiday-index.php?status=error");
        exit();
    }
}

// Retrieve holiday information for the edit form
$holiday_id = filter_input(INPUT_GET, 'holiday_id', FILTER_SANITIZE_NUMBER_INT);
if ($holiday_id) {
    $stmt = $conn->prepare("SELECT * FROM holidays WHERE holiday_id = ?");
    $stmt->execute([$holiday_id]);
    $holiday_info = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$holiday_info) {
        header("location:holiday-index.php?status=not-found");
        exit();
    }
} else {
    header("location:holiday-index.php?status=error");
    exit();
}

include "../../../master/sections/admin/start.php";
include "../../../master/sections/admin/links.php";
include "../../../master/sections/admin/mid.php"; 
?>

<div class="page-content">
    <div class="table-container">
        <div class="page-title">تعديل عطلة</div>
    <div class="employee-form">
        <form action="#" method="post" class="row g-3 needs-validation" novalidate>
            <input type="hidden" name="holiday-id" value="<?php echo htmlspecialchars($holiday_info['holiday_id']); ?>">
            
            <label for="name">اسم العطلة</label>
            <input type="text" name="holiday-name" class="form-control" required value="<?php echo htmlspecialchars($holiday_info['holiday_name']); ?>">
            <div class="invalid-feedback">يرجى إدخال اسم العطلة</div>

            <label for="holiday-from">من تاريخ</label>
            <input type="date" name="holiday-from" class="form-control" required value="<?php echo htmlspecialchars($holiday_info['holiday_from']); ?>">
            <div class="invalid-feedback">يرجى إدخال تاريخ البدء</div>

            <label for="holiday-to">إلى تاريخ</label>
            <input type="date" name="holiday-to" class="form-control" required value="<?php echo htmlspecialchars($holiday_info['holiday_to']); ?>">
            <div class="invalid-feedback">يرجى إدخال تاريخ الانتهاء</div>

            <label for="days">الأيام</label>
            <input type="number" name="days" class="form-control" required value="<?php echo htmlspecialchars($holiday_info['days']); ?>">
            <div class="invalid-feedback">يرجى إدخال عدد الأيام</div>

            <label for="holiday-active">هل العطلة نشطة؟</label>
            <input type="checkbox" name="holiday-active" class="form-check-input" <?php echo $holiday_info['holiday_active'] ? 'checked' : ''; ?>>

            <input type="submit" value="حفظ" class="btn btn-primary">
        </form>
    </div>
</div>

<?php include "../../../master/sections/admin/foot.php"; ?>
<!-- Custom JS -->
<script src="../../../master/assets/dist/js/validate.js"></script>
<?php include "../../../master/sections/admin/end.php"; ?>
