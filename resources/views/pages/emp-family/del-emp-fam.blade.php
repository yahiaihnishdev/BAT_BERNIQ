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

$emp_fam_id = $_GET['emp_fam_id'];
$emp_id = $_GET['emp_id'];

$stmt = $conn -> prepare("UPDATE emp_family SET person_active = 0 
WHERE emp_fam_id = $emp_fam_id");

$stmt -> execute([]);

header("location:family-index?emp_id=$emp_id");