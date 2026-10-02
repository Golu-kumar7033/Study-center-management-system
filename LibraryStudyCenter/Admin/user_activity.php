<?php
require "../database.php";
require "login/chacklogin.php";
require "../helper.php";
require_once "navbar.html";
?>

<div class="card rounded " style="margin-top:150px;">
    <div class="table-responsive">
        <h3 class="card-header mb-3">Student Activity Logs</h3>
        <div class="card-body p-3">
        <table class="table table-bordered ">
            <thead>
                <tr>
                    <th>SNO.</th>
                    <th>Student Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

<?php
$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if ($page < 1) {
    $page = 1;
}

$offset = ($page - 1) * $limit;

// Total records
$total_result = mysqli_query($conn, "
    SELECT COUNT(*) as total 
    FROM login_auth l
    JOIN student_info s ON l.email_id = s.student_email
");

$total_row = mysqli_fetch_assoc($total_result);
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $limit);

$result = mysqli_query($conn, "
    SELECT s.student_id, s.student_name 
    FROM login_auth l
    JOIN student_info s ON l.email_id = s.student_email
    LIMIT $limit OFFSET $offset
");

// Serial number
$sno = $offset + 1;

while ($row = mysqli_fetch_assoc($result)) {
?>
    <tr>
        <td><?= $sno++ ?></td>
        <td><?= strtoupper($row['student_name']) ?></td>
<td>
    <a class="btn " href="activity.php?student_id=<?= $row['student_id'] ?>">View</a>
</td>    </tr>
<?php } ?>

            </tbody>
        </table>
    </div>
</div>
<nav>
    <ul class="pagination justify-content-center">

        <?php if ($page > 1): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?= $page-1 ?>">Previous</a>
            </li>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>

        <?php if ($page < $total_pages): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?= $page+1 ?>">Next</a>
            </li>
        <?php endif; ?>

    </ul>
</nav>
</div>
<?php
require "footer.php"?>