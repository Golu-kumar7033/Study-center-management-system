<?php

require "../database.php";
include("../checklogin.php");
require "../helper.php";

//
if($_SERVER['REQUEST_METHOD']==="POST"){
    
$use_id=$_SESSION['student_id'];

$seat = $_POST['seat'] ?? '';
$membership = $_POST['membership'] ?? '';
$environment = $_POST['environment'] ?? '';
$electronics = $_POST['electronics'] ?? '';
$rating = $_POST['rating'] ?? '';
$message = $_POST['message'] ?? '';
$internet=$_POST['wifi'] ?? '';

if ($seat == '' || $membership == '' || $internet =='' || $environment == '' || $electronics == '' || $rating == '') {
        echo "<script>alert('Please fill all fields'); window.history.back();</script>";
        exit();
    }
}

$feedback="INSERT INTO feedback(student_id,seat,membership,environment,electronics,internet,rating,message)
VALUES(?,?,?,?,?,?,?,?)";

$stmt=mysqli_prepare($conn,$feedback);
mysqli_stmt_bind_param($stmt,"isssssss",
    $use_id,$seat,$membership,$environment,$electronics,$internet,$rating,$message);

    if(mysqli_stmt_execute($stmt)){
        header("Location:feedback.php");
        user_activity($_SESSION['student_id'],date("Y-m-d h:i A"),null, $_SERVER['HTTP_USER_AGENT'],"Submit Feedback");
        
 $data = [
    "User Name" => $name,
    "Booking Date" =>date("d-m-Y"),
    "Start Time"=>$start,
    "End Time"=>$end,
    "Seat"=>$seat,
    "Plan Name"=>$plane,
    "Year" => date("Y")
];
//calling send mail
sendmail(
    $email,
    $name,
    "Booking Confirmation",
    "Tamplates/booking.html",
    $data
);
        exit();
    }
    else{
    echo "<script>alert('Error submitting feedback');</script>";

    }
 mysqli_stmt_close($stmt);
?>