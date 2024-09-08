<?php
session_start();
$user_type = $_SESSION['usertype'];
session_unset();
session_destroy();
if( $user_type == 'admin' ){
    header("location:../../log");
}
elseif( $user_type == 'instructor' ){
    header("location:../../ins-log");
}
elseif( $user_type == 'client' ){
    header("location:../../client-log");
}
elseif($user_type == 'hr'){
    header("location:../../hr-log");
}
else{
    header("location:../../acc-log");
}