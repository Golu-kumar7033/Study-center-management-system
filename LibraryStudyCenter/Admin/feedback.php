<?php
require "../database.php";
require_once  "../Checklogin.php";
require_once "navbar.html";

//feedback
$sid=(int)$_GET['sid'];

$feedback=mysqli_prepare($conn,"SELECT* FROM feedback   WHERE student_id =? ORDER BY created_at ");
mysqli_stmt_bind_param($feedback,"i",$sid);
mysqli_stmt_execute($feedback);
$result=mysqli_stmt_get_result($feedback);
$row=mysqli_fetch_assoc($result);
$seat=$row['seat'];
$membership=$row['membership'];
$enviroment=$row['environment'];
$electronics=$row['electronics'];
$internat=$row['internet'];
$message=$row['message'];
$fd=$row['created_at'];
$or=$row['rating'];



?>

<div class="row">
    <div class="col-md-12">
        <h2 class="p-2 " style="margin-top:30px;"> Student Feedback</h2>

        <div class="card  mb-5 bg-secodary-subtle">
            <div class="card-header  p-3 text-white bg-primary">
                <h4><i class="bi bi-chat-left-dots"></i> Feedback </h4>
            </div>

            <div class="card-body p-3">
                <div class="table-responsive">

                    <table class="table table-seconary table-bordered table-striped table-hover">
                    

                    <tbody>
                        <tr>
                        <th colspan="6" class="text-center">Feedback Details</th>
                        </tr>
                        <tr>
                        <th class="col-6">Seat</th>
                        <td colspan="6"><?=$seat?></td>
                        </tr>
                        <tr>
                        <th class="col-6">Membership</th>
                        <td colspan="6"><?=$membership?></td>
                        </tr>
                        <tr>
                        <th class="col-6">Electronics</th>
                        <td colspan="6"><?=$electronics?></td>
                        </tr>
                        <tr>
                        <th class="col-6">Environment</th>
                        <td colspan="6"><?=$enviroment?></td>
                        </tr>
                        <tr>
                        <th class="col-6">Internet Speed</th>
                        <td colspan="6"><?=$internat?></td>
                        </tr>
                        <tr>
                        <th class="col-6">Message</th>
                        <td colspan="6">
                            <?= !empty($message) ? $message : "NA"; ?>
                        </td>

                        </tr>
                        <tr>
                        <th class="col-6">Over-All-Reting</th>
                        <td colspan="6"><?=$or?></td>
                        </tr>
                    </tbody>

                    </table>

                </div>

            </div>
        </div>
    </div>
</div>

<?php require_once "footer.php"; ?>