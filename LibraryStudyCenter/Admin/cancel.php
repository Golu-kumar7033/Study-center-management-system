<?php
require "../database.php";

if (!isset($_GET['id'])) {
    die("Invalid request");
}

$booking_id = (int)$_GET['id'];

$stmt = mysqli_prepare($conn, "DELETE FROM bookings WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $booking_id);

if (mysqli_stmt_execute($stmt)) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
} else {
    echo "Error cancelling booking";
}
?>