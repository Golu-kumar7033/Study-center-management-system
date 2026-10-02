<?php
require "../database.php";
include('../Checklogin.php');
require_once "navbar.html";


// Pagination setup
$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if ($page < 1) {
    $page = 1;
}

$offset = ($page - 1) * $limit;

// Get total records
$status="in_progress";
$totalQuery = "SELECT COUNT(*) as total FROM complaints WHERE status=?";
$stmtTotal = mysqli_prepare($conn, $totalQuery);
mysqli_stmt_bind_param($stmtTotal,"s",$status);
mysqli_stmt_execute($stmtTotal);
$resultTotal = mysqli_stmt_get_result($stmtTotal);
$totalRow = mysqli_fetch_assoc($resultTotal);

$totalRecords = $totalRow['total'];
$totalPages = ceil($totalRecords / $limit);

// Main query (LIMIT/OFFSET directly injected safely as integers)
$limit = (int)$limit;
$offset = (int)$offset;

$sql = "SELECT * FROM complaints 
        WHERE status=?       
        ORDER BY created_at DESC 
        LIMIT $limit OFFSET $offset";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt,"s",$status);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<div class="row">
    <div class="col-md-12">
        <h2 class="p-2" style="margin-top:100px;">Students Complaints</h2>

        <div class="card bg-secodary-subtle">
            <div class="card-header">
                <h4>📝 Complaint Details</h4>
            </div>

            <div class="card-body p-3">
                <div class="table-responsive">

                    <table class="table table-striped table-seconary table-bordered text-center align-middle">
                        <thead>
                            <tr>
                                <th>Sno.</th>
                                <th>Complaint Number</th>
                                <th>Complaint Type</th>
                                <th>Status</th>
                                <th>Registered Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            $sno = $offset + 1;

                            while ($row = mysqli_fetch_assoc($result)) {

                                // Safe output
                                $complaint_no = htmlspecialchars($row['complaint_no']);
                                $category = htmlspecialchars($row['category']);
                                $created_at = date("d M Y, h:i A", strtotime($row['created_at']));
                                $status_raw = strtolower($row['status']);
                                $comid=$row['student_id'];

                                // Status badge
                                if ($status_raw == 'pending') {
                                    $badge = "<span class='badge bg-warning text-dark'>Pending</span>";
                                } elseif ($status_raw == 'resolved') {
                                    $badge = "<span class='badge bg-success'>Resolved</span>";
                                } elseif ($status_raw == 'rejected') {
                                    $badge = "<span class='badge bg-danger'>Rejected</span>";
                                } else {
                                    $badge = "<span class='badge bg-secondary'>" . htmlspecialchars($row['status']) . "</span>";
                                }

                                echo "<tr>";
                                echo "<td>{$sno}</td>";
                                echo "<td>{$complaint_no}</td>";
                                echo "<td>{$category}</td>";
                                echo "<td>{$badge}</td>";
                                echo "<td>{$created_at}</td>";

                                echo "<td>
                                        <div class='d-flex flex-wrap gap-1 justify-content-center'>
                                            <a href='complaint_details.php?id={$comid}&cn={$complaint_no}' class='btn btn-info btn-sm'>View</a>
                                            
                                        </div>
                                      </td>";
                                echo "</tr>";

                                $sno++;
                            }

                        } else {
                            echo "<tr>
                                    <td colspan='6' class='text-danger fw-bold'>
                                        No complaints found
                                    </td>
                                  </tr>";
                        }
                        ?>
                        </tbody>
                    </table>

                </div>

                <!-- Pagination -->
                <nav>
                    <ul class="pagination justify-content-center">

                        <?php if ($page > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $page-1 ?>">Previous</a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($page < $totalPages): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $page+1 ?>">Next</a>
                            </li>
                        <?php endif; ?>

                    </ul>
                </nav>

            </div>
        </div>
    </div>
</div>

<?php require_once "footer.php"; ?>