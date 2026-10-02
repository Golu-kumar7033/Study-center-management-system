<?php
session_start(); 
require_once "../database.php";
require_once "navbar.html";
require "../helper.php";


$sid = (int)$_GET['id'];
$cno = (int)$_GET['cn'];
//$sname=$_SESSION['student_name'];
//var_dump($sname);

/* 🔹 Fetch Seat + Student Name */
$student = mysqli_prepare($conn, "
    SELECT st.seat_number, s.student_name 
    FROM complaints c 
    JOIN bookings b ON c.student_id = b.student_id 
    JOIN seats st ON b.seat_id = st.id  
    JOIN student_info s ON c.student_id = s.student_id
    WHERE c.student_id = ?
");

mysqli_stmt_bind_param($student, "i", $sid);
mysqli_stmt_execute($student);
$result = mysqli_stmt_get_result($student);

$seatRow = mysqli_fetch_assoc($result);

$sno = $seatRow['seat_number'] ?? "No seat found";
$sname=$seatRow['student_name']??"none";
//var_dump($sno,$sname);
//exit();

/* 🔹 Fetch Complaint Details */
$stmt = mysqli_prepare($conn, "SELECT * FROM complaints WHERE student_id=? AND complaint_no=?");
mysqli_stmt_bind_param($stmt, "ii", $sid, $cno);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($complaintRow = mysqli_fetch_assoc($result)) {
    $cn  = $complaintRow['complaint_no'];
    $cty = $complaintRow['category'];
    $cfile = $complaintRow['file'];
    $cdt = $complaintRow['description'];
    $st  = $complaintRow['status'];
    $date = date("Y-m-d h:i A", strtotime($complaintRow['created_at']));

    if ($st == 'pending') {
        $badge = "<span class='badge bg-warning text-dark'>Pending</span>";
    } elseif ($st == 'resolved') {
        $badge = "<span class='badge bg-success'>Resolved</span>";
    } elseif ($st == 'rejected') {
        $badge = "<span class='badge bg-danger'>Rejected</span>";
    } else {
        $badge = "<span class='badge bg-secondary'>" . htmlspecialchars($st) . "</span>";
    }
}
?>

<div class="row" style="margin-top:100px;">
    <div class="col-md-12">
        <h2>#<?=htmlspecialchars($cno)?> Details</h2>

        <div class="card complaint-details">
            <div class="card-header">
                <h4>#<?=htmlspecialchars($cno)?></h4>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped  table-bordered text-center align-middle">
                        <tbody>
                            <tr>
                                <td colspan="6" class="text-center text-primary fs-5">
                                    Complaint Related Info
                                </td>
                            </tr>

                            <tr>
                                <th>Complaint Number</th>
                                <td><?=htmlspecialchars($cno)?></td>

                                <th>Student</th>
                                <td><?=htmlspecialchars($sname)?></td>

                                <th>Seat Number</th>
                                <td><?=htmlspecialchars($sno)?></td>
                            </tr>

                            <tr>
                                <th>Complaint Type</th>
                                <td><?=htmlspecialchars($cty)?></td>

                                <th>File (if any)</th>
                                <td colspan="4">
                                    <?php 
                                    if (!empty($cfile)) {
                                        echo "<a href='../student/Complaintfiles/".htmlspecialchars($cfile)."' class='text-decoration-none'>View File</a>";
                                    } else {
                                        echo "NA";
                                    }
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <th>Complaint Details</th>
                                <td colspan="6"><?=htmlspecialchars($cdt)?></td>
                            </tr>

                            <tr>
                                <th>Registration Date</th>
                                <td><?=htmlspecialchars($date)?></td>

                                <th>Status</th>
                                <td colspan="6"><?=$badge?></td>
                            </tr>
                        </tbody>
                    </table>

                    <button class="btn btn-primary p-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Take Action
                    </button>
                </div>
            </div>
        </div>

<?php
/* 🔹 Update Complaint */
if (isset($_POST['submit'])) {

    $cstatus = $_POST['action'];
    $note = $_POST['solved']; // (optional use later)

    $update = mysqli_prepare($conn, "
        UPDATE complaints 
        SET status=? 
        WHERE student_id=? AND complaint_no=?
    ");

    mysqli_stmt_bind_param($update, "sii", $cstatus, $sid, $cno);

    if (mysqli_stmt_execute($update)) {
        $up="update";
    }
}
?>

<!-- 🔹 Modal -->
<div class="modal fade" id="staticBackdrop" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Take Action</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form method="POST">

                    <div class="mb-3">
                        <select name="action" class="form-control" required>
                            <option value="">Select Action</option>
                            <option value="in_progress">In Process</option>
                            <option value="resolved">Closed</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <textarea class="form-control" name="solved" placeholder="Resolved Note..." rows="5" required></textarea>
                    </div>

                    <div class="modal-footer">
                        <input type="submit" name="submit" class="btn btn-primary">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

</div>
</div>

<?php require_once "footer.php"; ?>