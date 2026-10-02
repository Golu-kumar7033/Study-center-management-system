<?php
require "../database.php";

$slot_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$slotStmt = mysqli_prepare($conn, "SELECT * FROM time_slot WHERE id = ?");
mysqli_stmt_bind_param($slotStmt, "i", $slot_id);
mysqli_stmt_execute($slotStmt);
$slotResult = mysqli_stmt_get_result($slotStmt);
$slot = mysqli_fetch_assoc($slotResult);

$start = $slot['start_time'] ?? '';
$end   = $slot['end_time'] ?? '';

$seatQuery = mysqli_query($conn, "SELECT * FROM seats WHERE slot_id = $slot_id ORDER BY id ASC");

// Fetch booked seats
$bookedseat = [];
$booked = mysqli_query($conn, "SELECT seat_id FROM bookings WHERE slot_id = $slot_id");

while ($row = mysqli_fetch_assoc($booked)) {
    $bookedseat[] = $row['seat_id'];
}
?>

<?= require "navbar.html"; ?>

<h3 class="text-center mb-4">
    Seats for Slot: <?= htmlspecialchars($slot['slot_name'] ?? ''); ?>
</h3>

<p class="d-flex justify-content-center gap-5">
    <span class="bg-primary-subtle fs-3 p-2 mb-2 text-center rounded">
        <?= htmlspecialchars($start . " - " . $end); ?>
    </span>
</p>

<div class="row">
<?php
if (mysqli_num_rows($seatQuery) > 0) {
    while ($seat = mysqli_fetch_assoc($seatQuery)) {

        $seat_id = $seat['id'];
        $isBooked = in_array($seat_id, $bookedseat);

        $cardClass = $isBooked
            ? "card bg-secondary text-center p-3 disabled"
            : "card bg-primary-subtle text-center p-3";

        echo "
        <div class='col-4 col-sm-4 col-md-3 col-lg-1 mb-3'>
            <div id='seat-{$seat_id}'
                 class='{$cardClass}'
                 data-seat-id='{$seat_id}'>
                <strong>" . htmlspecialchars($seat['seat_number']) . "</strong>
            </div>
        </div>";
    }
} else {
    echo "<p class='text-center'>No seats found.</p>";
}
?>

<h3 class="mt-3 mb-5 text-center text-warning">Booking detail</h3>

<?php
//  Pagination
$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if ($page < 1) $page = 1;

$offset = ($page - 1) * $limit;

// 
$coutbooking = mysqli_prepare($conn, "SELECT COUNT(*) AS total FROM bookings WHERE slot_id=?");
mysqli_stmt_bind_param($coutbooking, "i", $slot_id);
mysqli_stmt_execute($coutbooking);
$total = mysqli_stmt_get_result($coutbooking);
$totalrow = mysqli_fetch_assoc($total);
$totalbooking = $totalrow['total'];

$totalPages = ceil($totalbooking / $limit);

$sql = "
SELECT 
    b.id AS booking_id,
    s.student_name,
    s.student_email,
    s.student_phone,
    se.seat_number,
    p.plan_name
FROM bookings b
JOIN student_info s ON b.student_id = s.student_id
JOIN seats se ON b.seat_id = se.id
JOIN plans p ON b.plane_id = p.plan_id
WHERE b.slot_id=?
LIMIT $limit OFFSET $offset
";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $slot_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

echo "<table class='table' cellpadding='10'>";
echo "<tr class='table-dark'>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Seat Number</th>
        <th>Plan Name</th>
        <th>Action</th>
      </tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['student_name']) . "</td>";
    echo "<td>" . htmlspecialchars($row['student_email']) . "</td>";
    echo "<td>" . htmlspecialchars($row['student_phone']) . "</td>";
    echo "<td>" . htmlspecialchars($row['seat_number']) . "</td>";
    echo "<td>" . htmlspecialchars($row['plan_name']) . "</td>";
    echo "<td>
        <a class='btn btn-danger' href='cancel.php?id=" . $row['booking_id'] . "' 
           onclick=\"return confirm('Cancel this booking?');\">
           Cancel
        </a>
        <a class='btn btn-primary' href='cancel.php?id=" . $row['booking_id'] . "' 
           onclick=\"return confirm('Cancel this booking?');\">
           View 
        </a>
    </td>";
    
    echo "</tr>";
}

echo "</table>";
?>

<div class="d-flex justify-content-center align-items-center">
    <nav>
        <ul class="pagination justify-content-center">

            <?php if ($page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?id=<?= $slot_id ?>&page=<?= $page-1 ?>">Previous</a>
                </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                    <a class="page-link" href="?id=<?= $slot_id ?>&page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <li class="page-item">
                    <a class="page-link" href="?id=<?= $slot_id ?>&page=<?= $page+1 ?>">Next</a>
                </li>
            <?php endif; ?>

        </ul>
    </nav>
</div>


<p class="d-flex justify-content-center">
    <a href="slot.php" class="btn btn-primary mb-3">Back</a>
</p>

<?= require_once "footer.php" ?>