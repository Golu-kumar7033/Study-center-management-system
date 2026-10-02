<?php
require "../database.php";
require_once  "../Checklogin.php";
require_once "navbar.html";

//feedback

$limit=5;

$page=isset($_GET['page'])?(int)$_GET['page']:1;

if($page=1){
    $page=1;
}
$offset=($page-1)*$limit;

//count total recored
$stmt=mysqli_prepare($conn,"SELECT COUNT(*) AS total FROM feedback");
mysqli_stmt_execute($stmt);
$totalTotal=mysqli_stmt_get_result($stmt);
$totalrow=mysqli_fetch_assoc($totalTotal);

$totalrecord=$totalrow['total'];
$totalpage=ceil($totalrecord/$limit);

//fetch feedback
$limit=(int)$limit;
$offset=(int)$offset;

$feedback=mysqli_prepare($conn,"SELECT* FROM feedback ORDER BY created_at DESC LIMIT $limit OFFSET $offset");
mysqli_stmt_execute($feedback);
$result=mysqli_stmt_get_result($feedback);
?>

<div class="row">
    <div class="col-md-12">
        <h2 class="p-2" style="margin-top:100px;"> Student Feedback</h2>

        <div class="card bg-secodary-subtle">
            <div class="card-header p-3 bg-primary text-white">
                <h4><i class="bi bi-chat-left-text"></i> Feedback Details</h4>
            </div>

            <div class="card-body p-3">
                <div class="table-responsive">

                    <table class="table table-striped table-seconary table-bordered text-center align-middle">
                        <thead>
                            <tr>
                                <th>Sno.</th>
                                <th>Student Name</th>
                                <th>Seat Number</th>
                                <th>Feedback Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php
                        
                        if (mysqli_num_rows($result) > 0) {
                            $sno = $offset + 1;

                            while ($row = mysqli_fetch_assoc($result)) {

                                // Safe output
                                
                                $feedback_at = date("d M Y, h:i A", strtotime($row['created_at']));
                                $sid=$row['student_id'];

                                
                                echo "<tr>";
                                echo "<td>$sno</td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td>{$feedback_at}</td>";

                                echo "<td>
                                        <div class='d-flex flex-wrap gap-1 justify-content-center'>
                                            <a href='feedback.php?sid={$sid}' class='btn btn-info btn-sm'>View</a>
                                            
                                        </div>
                                      </td>";
                                echo "</tr>";

                                $sno++;
                            }

                        } else {
                            echo "<tr>
                                    <td colspan='6' class='text-danger fw-bold'>
                                        No Feedback found
                                    </td>
                                  </tr>";
                        }
                                                
                      /*  $student = mysqli_prepare($conn, 
                            "SELECT s.seat_number 
                            FROM feedback f 
                            JOIN bookings b ON f.student_id = b.student_id 
                            JOIN seats s ON b.seat_id = s.id 
                            WHERE f.student_id = ?"
                        );

                        mysqli_stmt_bind_param($student, "i", $user);

                        mysqli_stmt_execute($student);

                        $result = mysqli_stmt_get_result($student);
                        $row = mysqli_fetch_assoc($result);


                        if($row){
                            $seat=$row['seat_number'];

                        }
                        else{
                            $seat="NO seat Found";
                        }
*/
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

                        <?php for ($i = 1; $i <= $totalpage; $i++): ?>
                            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($page < $totalpage): ?>
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