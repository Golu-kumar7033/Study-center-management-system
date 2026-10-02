<?php
session_start(); 
require_once "../database.php";
require_once "navbar.html";

$aid = (int) $_GET['student_id'];
?>

<div class="row" style="margin-top:100px;">
    <div class="col-md-12">
        <div class="card complaint-details">
            <div class="card-header">
                <h4>Activity Log for : <?= $aid ?></h4>
            </div>

            <div class="card-body">
                <div class="table-responsive" style="max-height: 400px; overflow:auto;">
                    <table class="table table-striped  table-bordered text-center align-middle">
                        <thead>
                            <tr>
                                <th>SNO.</th>
                                <th>Student Name</th>
                                <th>Login Time</th>
                                <th>Logout Time</th>
                                <th>Activity</th>
                                <th>Device Info</th>

                            </tr>
                        </thead>
                        <tbody>

<?php
$sql="SELECT 
    s.student_name,
    ual.login_time,
    ual.logout_time,
    ual.device_info,
    ual.activity
FROM user_activity_logs ual
INNER JOIN student_info s ON s.student_id = ual.student_id
WHERE ual.student_id = ?
ORDER BY ual.login_time DESC";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("Prepare failed: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "i", $aid);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$sno = 0;

while ($row = mysqli_fetch_assoc($result)) {
    $sno++;
?>
    <tr>
        <td><?= $sno ?></td>
        <td><?= $row['student_name'] ?? 'N/A' ?></td>
        <td><?= date("Y /m /d h:i A", strtotime($row['login_time'] ))?></td>
<td>
<?php
if (!empty($row['logout_time'])) {
    echo date("Y/m/d h:i A", strtotime($row['logout_time']));
} else {
    echo 'N/A';
}
?>
</td>        <td><?= $row['activity'] ?></td>
        <td><?= $row['device_info'] ?></td>

    </tr>
<?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once "footer.php"; ?>