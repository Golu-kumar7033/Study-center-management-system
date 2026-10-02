<?php
require "../database.php";
require "login/chacklogin.php";
require "../helper.php";

function deleteStudent($conn, $student_id)
{
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    // Get student details
    $sql = "SELECT student_image, student_id_proof, student_email 
            FROM student_info 
            WHERE student_id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $student_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 0) {
        return false;
    }

    $student = mysqli_fetch_assoc($result);

    $imagePath = "../Imguploads/" . $student['student_image'];
    $proofPath = "../uploads/" . $student['student_id_proof'];
    $email     = $student['student_email'];

    mysqli_begin_transaction($conn);

    try {

        // Delete from user_activity_logs
        $stmt = mysqli_prepare($conn, "DELETE FROM user_activity_logs WHERE student_id=?");
        mysqli_stmt_bind_param($stmt, "i", $student_id);
        mysqli_stmt_execute($stmt);

        // Delete from bookings
        $stmt = mysqli_prepare($conn, "DELETE FROM bookings WHERE student_id=?");
        mysqli_stmt_bind_param($stmt, "i", $student_id);
        mysqli_stmt_execute($stmt);

        // Delete from login_auth
        $stmt = mysqli_prepare($conn, "DELETE FROM login_auth WHERE email_id=?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);

        // Delete student LAST
        $stmt = mysqli_prepare($conn, "DELETE FROM student_info WHERE student_id=?");
        mysqli_stmt_bind_param($stmt, "i", $student_id);
        mysqli_stmt_execute($stmt);

        mysqli_commit($conn);

        // Delete files after successful commit
        if (!empty($student['student_image']) && file_exists($imagePath)) {
            unlink($imagePath);
        }

        if (!empty($student['student_id_proof']) && file_exists($proofPath)) {
            unlink($proofPath);
        }

        return true;

    } catch (Exception $e) {

        mysqli_rollback($conn);
        die("Database Error: " . $e->getMessage());

    }
}

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    if (isset($_GET['id'])) {

        $student_id = (int)$_GET['id'];
       
        if (deleteStudent($conn, $student_id)) {
            header("Location: student.php?ms=Student Deleted!");
            exit();
        } else {
            echo "Student not found!";
        }
    }
}
?>