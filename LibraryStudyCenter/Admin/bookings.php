<?php include 'navbar.html';
require "../database.php" ?>



<?php

$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if ($page < 1) {
    $page = 1;
}

$offset = ($page - 1) * $limit;

// Total Records
$countQuery = mysqli_prepare($conn, "SELECT COUNT(*) AS total FROM bookings");
mysqli_stmt_execute($countQuery);
$result = mysqli_stmt_get_result($countQuery);
$totalRow = mysqli_fetch_assoc($result);

$totalBooking = $totalRow['total'];
$totalPages = ceil($totalBooking / $limit);

$limit = (int)$limit;
$offset = (int)$offset;

// Fetch Records
$sql = mysqli_query($conn, " 
 SELECT
        b.id,
        b.payment_status,
        s.student_name,
        s.student_phone,
        se.seat_number,
        sl.slot_name,
        p.plan_name
    FROM bookings b
    INNER JOIN student_info s ON b.student_id = s.student_id
    INNER JOIN seats se ON b.seat_id = se.id
    INNER JOIN time_slot sl ON b.slot_id = sl.id
    INNER JOIN plans p ON b.plane_id = p.plan_id
    ORDER BY b.booking_at DESC
    LIMIT $limit OFFSET $offset"
    );

$sno = $offset;
?>

<div class="bookings " style="margin-top:150px">
    <h2>Bookings</h2>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>S.N</th>
                    <th>Name</th>
                    <th>Slot</th>
                    <th>Seat No</th>
                    <th>Study Plan</th>
                    <th> Plane Fee Status</th>

                    <th>Contact Details</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

            <?php
            if ($sql && mysqli_num_rows($sql) > 0) {

                while ($row = mysqli_fetch_assoc($sql)) {
                    $sno++;
            ?>

                <tr>
                    <td><?php echo $sno; ?></td>

                    <td><?php echo htmlspecialchars($row['student_name']); ?></td>

                    <td><?php echo htmlspecialchars($row['slot_name']); ?></td>

                    <td><?php echo htmlspecialchars($row['seat_number']); ?></td>

                    <td><?php echo htmlspecialchars($row['plan_name']); ?></td>
                    <td >
                   <span class='badge bg-danger'> <?php echo htmlspecialchars($row['payment_status']); ?></span>
                    </td>
                    <td><?php echo htmlspecialchars($row['student_phone']); ?></td>

                    <td>
<a href="cencelbooking.php?id=<?php echo $row['id']; ?>" 
   onclick="return confirm('Are you sure?')" 
   class="btn btn-danger btn-sm">
    Cancel
</a>                       

                        <a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">
                            Update
                        </a>
                    </td>
                </tr>

            <?php
                }
            } else {
            ?>

                <tr>
                    <td colspan="7" class="text-center">
                        No bookings found.
                    </td>
                </tr>

            <?php } ?>

            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <?php if ($totalPages > 1) { ?>
        <nav>
            <ul class="pagination justify-content-center">

                <!-- Previous -->
                <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $page - 1; ?>">
                        Previous
                    </a>
                </li>

                <?php for ($i = 1; $i <= $totalPages; $i++) { ?>

                    <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>">
                            <?php echo $i; ?>
                        </a>
                    </li>

                <?php } ?>

                <!-- Next -->
                <li class="page-item <?php echo ($page >= $totalPages) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $page + 1; ?>">
                        Next
                    </a>
                </li>

            </ul>
        </nav>
    <?php } ?>

</div>
<?php include 'footer.php'; ?>