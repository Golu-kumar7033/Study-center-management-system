<?php
session_start();
    require "../database.php";
//require "../Checklogin.php";

    $user=$_SESSION['user'];

    $sql= "SELECT student_name, student_email,student_phone,student_image,student_gender,permanent_address FROM student_info WHERE student_email= '$user'";
    $result= mysqli_query($conn,$sql);

    $row=mysqli_fetch_assoc($result);

    echo json_encode($row);
?>