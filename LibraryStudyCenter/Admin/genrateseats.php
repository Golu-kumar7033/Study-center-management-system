<?php
require "../database.php";
session_start();

$slot_id = $_GET['id'];

$_SESSION['slot'] = $slot_id;

// get total seats
$libraryseats = mysqli_query($conn, "SELECT * FROM Library_info");
$result = mysqli_fetch_assoc($libraryseats);

if (!$result) {
    header("Location: slot.php?error=Seats+already+created+for+this+slot");
    exit();
}

$total_seat = $result['total_seats'];
$library_id=$result['library_id'];

// check if seats already exist
$check = mysqli_query($conn, "SELECT COUNT(*) AS count FROM seats WHERE slot_id=$slot_id");
$checkresult = mysqli_fetch_assoc($check);

if ($checkresult['count'] > 0) {
    header("Location: slot.php?error=Seats+already+created+for+this+slot");
    exit();
}

// insert seats
$sql = "INSERT INTO seats(library_id,slot_id, seat_number) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);


for ($i = 1; $i <= $total_seat; $i++) {
    $seat_num = $i;

    mysqli_stmt_bind_param($stmt, "iii",$library_id, $slot_id, $seat_num);
    mysqli_stmt_execute($stmt);
}

header("Location: slot.php");
?>