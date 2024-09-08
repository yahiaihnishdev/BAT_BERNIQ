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
    if (isset($_POST['save_docs'])) {
        // Handling Document Upload Submission
        $emp_id = $_POST['emp-id'];
        $document_name = $_POST['document-name'];
        $document_type = $_POST['document-type'];
        $document_active = 1;  // Assuming document is active by default
        $created_at = date('Y-m-d H:i:s');

        // Handling File Upload
        $target_dir = "../uploads/";
        $document_path = $target_dir . basename($_FILES["document-file"]["name"]);
        if (move_uploaded_file($_FILES["document-file"]["tmp_name"], $document_path)) {
            // File uploaded successfully, insert record into the database
            $stmt = $conn->prepare("INSERT INTO emp_document (emp_id, document_name, document_path, document_type, document_active, created_at) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$emp_id, $document_name, $document_path, $document_type, $document_active, $created_at]);

            header("location:employee-index.php");
            exit();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
include "../../../master/sections/admin/start.php";
include "../../../master/sections/admin/links.php";
include "../../../master/sections/admin/mid.php";
?>

<div class="container mt-4">
<?php include "menu-emp.php"; ?>


    <div class="page-content">
        <!-- Document Upload Form -->
        <div class="page-title">المستندات</div>
        <div class="employee-form">
            <form action="#" method="post" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                <div class="col-md-6">
                    <label for="emp-id" class="form-label">رقم الموظف</label>
                    <input type="text" name="emp-id" id="emp-id" class="form-control" required>
                    <div class="invalid-feedback">يرجى إدخال رقم الموظف</div>
                </div>

                <div class="col-md-6">
                    <label for="document-name" class="form-label">اسم المستند</label>
                    <input type="text" name="document-name" id="document-name" class="form-control" required>
                    <div class="invalid-feedback">يرجى إدخال اسم المستند</div>
                </div>

                <div class="col-md-6">
                    <label for="document-type" class="form-label">نوع المستند</label>
                    <input type="text" name="document-type" id="document-type" class="form-control" required>
                    <div class="invalid-feedback">يرجى إدخال نوع المستند</div>
                </div>

                <div class="col-md-6">
                    <label for="document-file" class="form-label">ملف المستند</label>
                    <input type="file" name="document-file" id="document-file" class="form-control" required>
                    <div class="invalid-feedback">يرجى اختيار ملف المستند</div>
                </div>

                <div class="col-12">
                    <input type="submit" name="save_docs" value="حفظ" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>



<?php include "../../../master/sections/admin/foot.php"; ?>
<!-- Custom JS -->
<!-- <script src="../master/assets/dist/js/del-emp-fam.js"></script> -->
<?php include "../../../master/sections/admin/end.php"; ?>