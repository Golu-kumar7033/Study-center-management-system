<?php
     require "login/chacklogin.php";  

require "../database.php";
require "../helper.php";

 $id = (int)$_GET['id'];
 $sql1 = "DELETE FROM bookings WHERE id = ?";
            $stmt1 = mysqli_prepare($conn, $sql1);
            mysqli_stmt_bind_param($stmt1, "i", $id);
           if( mysqli_stmt_execute($stmt1)){
             // Log activity
    

    $sql="
    SELECT 
    s.student_name,
    s.student_email,
    s.student_phone,
    se.seat_number,
    p.plan_name,
    t.start_time,
    t.end_time
FROM bookings b
JOIN student_info s ON b.student_id = s.student_id
JOIN seats se ON b.seat_id = se.id
JOIN plans p ON b.plane_id = p.plan_id
JOIN time_slot t ON b.slot_id=t.id
WHERE b.student_id=?
";
$stmt=mysqli_prepare($conn,$sql);
mysqli_stmt_bind_param($stmt,"i",$user_id);
mysqli_stmt_execute($stmt);
$result=mysqli_stmt_get_result($stmt);
$row=mysqli_fetch_assoc($result);
$name= $row['student_name'];
$email=$row['student_email'];
$phone=$row['student_phone'];
$seat=$row['seat_number'];
$plane=$row['plan_name'];
$start=$row['start_time'];
$end=$row['end_time'];
var_dump($name,$email,$phone,$seat,$plane,$start,$end);
exit();
   

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
    "Booking Cancelled",
    "Tamplates/cancelbooking.html",
    $data
);
            header('Location:bookings.php');
           }
           else{
            echo "Error in Delete";
           }

?>