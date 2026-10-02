<?php
session_start();
require "database.php";

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_SESSION['user']; 
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validation
    if (empty($old_password)) {
        header("Location:student/ Changepassword.php?err=Old password is required");
        exit();
    }

    if (strlen($new_password) < 8 || 
        !preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[\W_]).{8,}$/', $new_password)) {
        header("Location: student/Changepassword.php?passerr=Password must be at least 8 characters with letters, numbers, and symbols");
        exit();
    }

    if ($new_password !== $confirm_password) {
        header("Location: student/Changepassword.php?cpasserr=Passwords do not match");
        exit();
    }

    // Get current password from DB
    $sql = "SELECT password FROM login_auth WHERE email_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    // Verify old password
    if ($user && password_verify($old_password, $user['password'])) {

        $new = password_hash($new_password, PASSWORD_DEFAULT);

        // Update password
        $update = "UPDATE login_auth SET password=? WHERE email_id=?";
        $stmt = mysqli_prepare($conn, $update);
        mysqli_stmt_bind_param($stmt, "ss", $new, $email);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: student/changepassword.php?ms=Password Changed");
            user_activity($_SESSION['student_id'],date("Y-m-d h:i A"),null, $_SERVER['HTTP_USER_AGENT'],"Student Changed password");

            exit();
        } else {
            header("Location: student/changepassword.php?err=Password change failed!");
            exit();
        }

    } else {
        header("Location: student/changepassword.php?err=Old password is incorrect");
        exit();
    }
}
?>