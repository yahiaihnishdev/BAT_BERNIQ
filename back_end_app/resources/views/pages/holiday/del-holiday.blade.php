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

if( isset($_GET['holiday_id']) ){
    $record = $_GET['holiday_id'];
    $stmt = $conn -> prepare("UPDATE holidays SET holiday_active = 0
    WHERE holiday_id= ?");
    $stmt -> execute([$record]);
    header("location:holiday-index");
}
else{
    header("location:../out");
}