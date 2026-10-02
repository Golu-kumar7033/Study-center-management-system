<?php
require "../checklogin.php";
require "../database.php";

$slot_id = (int) $_GET['slot_id'];

// slot data
$slotQuery = mysqli_query($conn, "SELECT * FROM time_slot WHERE id = $slot_id");
$slot = mysqli_fetch_assoc($slotQuery);

if (!$slot) {
    die("Invalid slot");
}

$start = ($slot['start_time']);
$end   =  ($slot['end_time']);


$user_id = $_SESSION['student_id'] ?? null;

if (!$user_id) {
    echo "<p class='text-center text-danger'>Please login first.</p>";
    exit;
}

// CHECK USER BOOKING FIRST
$userBookingQuery = mysqli_query($conn, "
    SELECT p.plan_name, p.duration_days, s.seat_number
    FROM bookings b
    JOIN plans p ON b.plane_id = p.plan_id
    JOIN seats s ON b.seat_id = s.id
    WHERE b.status = 'Booked'
    AND b.student_id = $user_id
    AND b.slot_id = $slot_id
    LIMIT 1
");

$hasBooking = mysqli_num_rows($userBookingQuery) > 0;


?>

<?php require "navbar.html"; ?>

<h3 class="text-center mb-4 " style="margin-top:100px">
    Seats for Slot: <?= strtoupper($slot['slot_name']); ?>
</h3>

<p class="d-flex justify-content-center gap-5">
    <span class="bg-warning fs-3 p-2 mb-2 text-center rounded">
        <?= $start . " - " . $end ?>
    </span>
</p>

<?php if ($hasBooking): ?>

    <?php $booking = mysqli_fetch_assoc($userBookingQuery); ?>

   <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card border-0 shadow-lg rounded-4">
                
                <!-- Header -->
                <div class="card-header bg-primary text-white text-center rounded-top-4 py-4">
                    <h3 class="mb-0">
                        <i class="bi bi-bookmark-check-fill me-2"></i>
                        Your Seat Booking
                    </h3>
                </div>

                <!-- Body -->
                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center border-bottom py-3">
                        <span class="fw-semibold text-secondary">
                            <i class="bi bi-chair me-2 text-primary"></i>Seat Number
                        </span>
                        <span class="badge bg-success fs-6 px-3 py-2">
                            <?= $booking['seat_number'] ?>
                        </span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center border-bottom py-3">
                        <span class="fw-semibold text-secondary">
                            <i class="bi bi-journal-bookmark me-2 text-primary"></i>Study Plan
                        </span>
                        <span class="fw-bold">
                            <?= $booking['plan_name'] ?>
                        </span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center py-3">
                        <span class="fw-semibold text-secondary">
                            <i class="bi bi-calendar-event me-2 text-primary"></i>Duration
                        </span>
                        <span class="text-primary fw-bold">
                            <?= $booking['duration_days'] ?> Days
                        </span>
                    </div>

                </div>

                <!-- Footer --
                <div class="card-footer bg-light text-center py-3 rounded-bottom-4">
                    <button class="btn btn-primary px-4 rounded-pill">
                        <i class="bi bi-printer me-2"></i>Print Booking
                    </button>
                </div>-->

            </div>
        </div>
    </div>
</div>

<?php else: ?>

<div class="row">

<?php
$seatQuery = mysqli_query($conn, "SELECT * FROM seats WHERE slot_id = $slot_id ORDER BY id ASC");

$bookedSeats = [];
$result = mysqli_query($conn, "SELECT seat_id FROM bookings WHERE slot_id = $slot_id");

while ($row = mysqli_fetch_assoc($result)) {
    $bookedSeats[] = $row['seat_id'];
}

while ($seat = mysqli_fetch_assoc($seatQuery)) {

    $seat_id = $seat['id'];
    $isBooked = in_array($seat_id, $bookedSeats);

    $cardClass = $isBooked
        ? "card seats bg-secondary text-center p-3 disabled"
        : "card seats bg-primary-subtle text-center p-3";

    echo "
        <div class='col-4 col-sm-4 col-md-3 col-lg-1 mb-3'>
            <div id='seat-$seat_id'
                class='$cardClass'
                data-seat-id='$seat_id'>
                <strong>{$seat['seat_number']}</strong>
            </div>
        </div>
    ";
}
?>

</div>

<p class="d-flex justify-content-center">
    <a href="#" id="book" class="btn btn-primary mb-3">
        Book Seat
    </a>
</p>

<?php endif; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {

    let selectedSeat = null;
    let slot_id = <?= $slot_id ?>;

    $(".seats").click(function () {

        if ($(this).hasClass("disabled")) return;

        let seat_id = $(this).data("seat-id");

        if (selectedSeat) {
            selectedSeat.removeClass('bg-warning').addClass('bg-primary-subtle');
        }

        $(this).removeClass('bg-primary-subtle').addClass('bg-warning');
        selectedSeat = $(this);

        $("#book").attr("href", "plane.php?slot_id=" + slot_id + "&seat_id=" + seat_id);
    });

});
</script>

<?php require_once "footer.html"; ?>