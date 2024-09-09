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

if( isset($_GET['dept_id']) ){
    $record = $_GET['dept_id'];
    $stmt = $conn -> prepare("UPDATE departments SET department_active = 0
    WHERE dept_id= ?");
    $stmt -> execute([$record]);
    header("location:department-index");
}
else{
    header("location:../out");
}