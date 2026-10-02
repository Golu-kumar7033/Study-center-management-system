<?php
require "../checklogin.php";
require "../database.php";
require "../helper.php";

if (!isset($_SESSION['student_id'])) {
    die("Unauthorized access");
}

$slot_id = isset($_GET['slot_id']) ? (int)$_GET['slot_id'] : 0;
$seat_id = isset($_GET['seat_id']) ? (int)$_GET['seat_id'] : 0;
$plan_id = isset($_GET['plan_id']) ? (int)$_GET['plan_id'] : 0;

$user_id = $_SESSION['student_id'];
$adminemail=$_SESSION['adminemail'];


if ($slot_id <= 0 || $seat_id <= 0 || $plan_id <= 0) {
    die("Invalid input");
}

// Start transaction (important for race condition prevention)
mysqli_begin_transaction($conn);

try {

    // 1️ Check if user already booked a seat in this slot
    $stmt = mysqli_prepare($conn, 
        "SELECT id FROM bookings WHERE slot_id=? AND student_id=? LIMIT 1"
    );
    mysqli_stmt_bind_param($stmt, "ii", $slot_id, $user_id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($res) > 0) {
        throw new Exception("You have already booked a seat in this slot.");
    }

    // 2️Check if seat is already taken
    $stmt = mysqli_prepare($conn, 
        "SELECT id FROM bookings WHERE seat_id=? AND slot_id=? LIMIT 1"
    );
    mysqli_stmt_bind_param($stmt, "ii", $seat_id, $slot_id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($res) > 0) {
        throw new Exception("This seat is already booked by another user.");
    }

    // 3️ Insert booking
    $stmt = mysqli_prepare($conn, 
        "INSERT INTO bookings (seat_id, slot_id, student_id, plane_id, status) 
         VALUES (?, ?, ?, ?, 'Booked')"
    );
    mysqli_stmt_bind_param($stmt, "iiii", $seat_id, $slot_id, $user_id, $plan_id);

    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception("Booking failed. Please try again.");
    }

    // Commit transaction
    mysqli_commit($conn);

    // Log activity
    user_activity(
        $user_id,
        date("Y-m-d h:i A"),
        null,
        $_SERVER['HTTP_USER_AGENT'],
        "Booked seat"
    );

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
//var_dump($name,$email,$phone,$seat,$plane,$start,$end);
//exit();
   

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
    header("Location: dashboard.php?msg=Booked Successfully");
    exit();
} catch (Exception $e) {

    mysqli_rollback($conn);

    echo $e->getMessage();
}



?>