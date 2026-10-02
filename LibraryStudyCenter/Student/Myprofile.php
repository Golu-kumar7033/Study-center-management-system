<?php 
require "../Checklogin.php";
require "../database.php";
?> 


<?php include("navbar.html"); ?>

    <div class="d-flex justify-content-center " style="margin-top:100px">
        <div class="card profile-card shadow" style="width: 850px;">

            <!-- Header -->
            <div class="profile-header text-center">
                <img src="image/he.png" width="150" id="studentimg" alt="student/Photo">
                <h3 class="mt-3" id="studentname">Loading</h3>
                <a href="Edit_profile.php" class="btn btn-light btn-custom mt-2">
                    <i class="fas fa-user-edit"></i> Edit Profile
                </a>

                <!-- Stats -->
                <div class="stats mt-3">
                    <?php
                        $student_id = $_SESSION['student_id'];
                       
                        $sql=mysqli_query($conn,"SELECT COUNT(*) AS total FROM bookings WHERE student_id=$student_id");
                        $data=mysqli_fetch_assoc($sql);
                        $bookings=$data['total'];

                    ?>
                    <div>
                        <h5><?=$bookings?></h5>
                        <small>Seat Bookings</small>
                    </div>
                    
                </div>
            </div>

            <div class="p-4">

                <!-- About -->
                <h5 class="section-title">About</h5>
                <div class="info-box" id="about-data">
                    Loading
                </div>

                <!-- Seat -->
                               
                <h5 class="section-title">Seat Details</h5>
                <div class="info-box">
                    <p><i class="fas fa-clock text-warning"></i> 
                     <?php
                        $sql = mysqli_query($conn, "
                            SELECT t.start_time, t.end_time 
                            FROM bookings b 
                            JOIN time_slot t ON b.slot_id = t.id 
                            WHERE status = 'Booked' AND student_id=$student_id
                            GROUP BY t.id
                        ");

                        $slot = [];

                        while ($row = mysqli_fetch_assoc($sql)) {

                            $start = date("h:i A", strtotime($row['start_time']));
                            $end   = date("h:i A", strtotime($row['end_time']));

                            $slot[] = $start . " - " . $end;
                        }

                        echo implode(', ', $slot);
                    ?>  </p>
                    <p><i class="fas fa-chair text-info"></i>
                        <?php
                    $sql = mysqli_query($conn, "
                        SELECT s.seat_number 
                        FROM bookings b 
                        JOIN seats s ON b.seat_id = s.id 
                        WHERE status = 'Booked' AND student_id=$student_id
                    ");

                    $bookedsno = [];

                    while ($row = mysqli_fetch_assoc($sql)) {
                        $bookedsno[] = $row['seat_number'];
                    }

                    echo implode(', ', $bookedsno);
                    ?>  
                    </p>
                </div>

                <!-- Plan -->
                                         <h5 class="section-title">Active Plan</h5>

               <?php
                    $sql = mysqli_query($conn, "
                        SELECT p.plan_name, p.duration_days
                        FROM bookings b 
                        JOIN plans p ON b.plane_id = p.plan_id 
                        WHERE status = 'Booked' AND student_id = $student_id
                    ");

                    $plan = [];

                    if(mysqli_num_rows($sql) > 0) {
                        while ($row = mysqli_fetch_assoc($sql)) {
                            $plan[] = $row['plan_name'];
                            $time = $row['duration_days'];
                        }

                        $plans = implode(', ', $plan);
                        ?>
                        <div class="info-box">
                            <h4 class="text-muted">Study Plan: <?= $plans ?></h4>
                            <h5 class="text-muted">Valid: <?= $time ?> Days</h5>
                            <a href="" class="btn btn-warning mt-3 p-2">Renew Plan</a>
                        </div>
                        <?php
                    } else {
                        echo "<p class='text-center'>Plan not found</p>";
                    }
                    ?>


            </div>

        </div>
    </div>

<?php require_once "footer.html";?>
