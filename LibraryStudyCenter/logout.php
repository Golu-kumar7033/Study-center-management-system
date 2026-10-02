<?php
session_start();
require "helper.php";

$student_id = $_SESSION['student_id'];
//var_dump($student_id);
//exit();

if($student_id){
    user_activity($student_id, null, date("Y-m-d h:i A"), $_SERVER['HTTP_USER_AGENT'], "logout");
}

session_unset();
session_destroy();

header("Location: login.php");
exit();
?>