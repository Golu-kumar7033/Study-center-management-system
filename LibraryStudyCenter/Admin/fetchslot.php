
<?php
require "../database.php";

$result = mysqli_query($conn, "SELECT * FROM time_slot");

if ($result && mysqli_num_rows($result) > 0) {

    echo "<div class='table-responsive'>";
    echo "<table id='slotTable' class='table table-bordered table-striped text-center' style=' border-radius: 8px; overflow: hidden;'>";
    echo "<thead class='table-dark'>";
    echo "<tr>";
    echo "<th>Slot Name</th>";
    echo "<th>Start Time</th>";
    echo "<th>End Time</th>";
    echo "<th>Total Seats</th>";
    echo "<th>Actions</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    while ($row = mysqli_fetch_assoc($result)) {

        $slot_id = $row['id'];
        $seatQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM seats WHERE slot_id = $slot_id");
        $seatData = mysqli_fetch_assoc($seatQuery);
        $totalSeats = $seatData['total'];
        $start = $row['start_time'];
        $end   = $row['end_time'];

        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['slot_name']) . "</td>";
        echo "<td>" . $start . "</td>";
        echo "<td>" . $end. "</td>";
        echo "<td>" . $totalSeats . "</td>";

        echo "<td>";

        if ($totalSeats == 0) {
            echo "<a href='genrateseats.php?id=" . $slot_id . "' class='btn btn-success btn-sm'>Generate Seat</a> ";
        } else {
            // Show View only if seats exist
            echo "<a href='seats.php?id=" . $slot_id . "' class='btn btn-primary btn-sm mb-3 me-3'>View Seat</a> ";
        }

        echo "<a href='deleteslot.php?id=" . $slot_id . "' class='btn btn-danger btn-sm mb-3' onclick=\"return confirm('Are you sure?')\">Delete</a>";

        echo "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
    echo "</div>";

} else {
    echo "<p class='text-center'>No slots available.</p>";
}
?>


