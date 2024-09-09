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

if (isset($_GET['user_type_id'])) {
    $record = $_GET['user_type_id'];
    $stmt = $conn->prepare("UPDATE learn_user_types SET user_type_active = 0
    WHERE user_type_id = ?");
    $stmt->execute([$record]);
    header("location:user-types");
} else {
    header("location:../out");
}
