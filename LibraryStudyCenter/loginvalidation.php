<?php
session_start();
require "database.php";
require "helper.php";
 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];   
    $password = $_POST['password'];

   
    getstudent($username);
    //var_dump($_SESSION['student_id']);
    

    $sql = "SELECT * FROM login_auth WHERE email_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $username;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_type'] = $user['user_type'];

        if ($user['user_type'] == 1) {
            header("Location: admin/Dashboard.php");
        } elseif ($user['user_type'] == 2) {
            header("Location: student/Dashboard.php");
             user_activity($_SESSION['student_id'],date("Y-m-d h:i A"),null, $_SERVER['HTTP_USER_AGENT'],"login");

        } else {
            header("Location: login/login.php?err=Unauthorized access!");
        }
        exit();
    } else {
        header("Location: login.php?err=Invalid username or password!");
        exit();
    }
}
?>