 <?php
    require "../database.php";
     require "login/chacklogin.php";  


        if(isset($_SESSION['user'])){
            $user = "Welcome, " . $_SESSION['user'];
        }

 ?>


<?php 
    include("navbar.html"); 

?>
   <div class="container-fluid " style="margin-top:80px">
     <div class="row header mt-5" >
        <h1><?php echo $user?></h1>
    </div>
   </div>

    <div class="library mt-5">

    <div class="row align-items-center gap-5">

        <!-- Left Side: Button -->
        <div class="col-md-3">
            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Create Library
            </button>


            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Library Detail</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   <form  method="POST" action="library.php">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Library Name</label>
                                <input type="text" class="form-control" name="library_name" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Contact Number</label>
                                <input type="text" class="form-control" name="contact_number">
                            </div>
                            </div>

                            <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea class="form-control" name="address" rows="2" style="resize:none"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label class="form-label">City</label>
                                <input type="text" class="form-control" name="city">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label">State</label>
                                <input type="text" class="form-control" name="state">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label">Country</label>
                                <input type="text" class="form-control" name="country">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label">Pincode</label>
                                <input type="text" class="form-control" name="pincode">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Opening Time</label>
                                <input type="time" class="form-control" name="opening_time">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Closing Time</label>
                                <input type="time" class="form-control" name="closing_time">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Total Seats</label>
                                <input type="number" class="form-control" name="total_seats">
                            </div>

                           
                        </div>

                        <div class="text-end">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>

                    </form>

                </div>

                </div>
            </div>
            </div>
        </div>

        <!-- Right Side: Card --
        <div class="col-md-4">
            <div class="card border-0 shadow p-4" style="border-radius: 12px;">
                
                <div class="d-flex justify-content-between align-items-center">

                    <div class="d-flex align-items-center">
                        <div class="rounded-3 d-flex align-items-center justify-content-center me-3"
                             style="width: 60px; height: 60px; background-color: #46776b;">
                            <i class="bi bi-person-fill fs-3 text-white"></i>
                        </div>

                        <div>
                            <h4 class="fw-bold mb-0">0</h4>
                            <p class="text-muted mb-0">Total Student</p>
                        </div>
                    </div>

                    <a href="Student.php" class="text-primary text-decoration-none">
                        View All <i class="bi bi-arrow-bar-right"></i>
                    </a>

                </div>

            </div>
        </div>-->

    </div>

</div>
   </section>
    <section class="px-3 container"> 
        <div class="row g-3 mb-5 mt-2" id="row">
            <!-- Card 1 -->
             <?php

                $sql = "SELECT COUNT(*) AS TOTAL FROM student_info";

                $stmt = mysqli_prepare($conn, $sql);

                if ($stmt) {
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $row = mysqli_fetch_assoc($result);

                    $total = $row['TOTAL'];
                } else {
                    echo "Error: " . mysqli_error($conn);
                    exit;
                }
                ?>
             <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow p-4" style="border-radius: 12px;">
                    <div class="d-flex align-items-center justify-content-between">

                        <!-- Left Side -->
                        <div class="d-flex align-items-center">
                            <div class="rounded-3 d-flex align-items-center justify-content-center me-3"
                                style="width: 60px; height: 60px; background-color: #46776b;">
                                <i class="bi bi-person-fill fs-1 text-dark"></i>
                            </div>

                            <div>
                                <h4 class="fw-bold text-center mb-0 text-dark">
                                    <?php echo $total; ?>
                                </h4>
                                <p>Total Student</p>
                            </div>
                        </div>

                        <div>
                            <a href="Student.php" class="text-primary text-decoration-none">
                                View All
                                <i class="bi bi-arrow-bar-right"></i>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
           

            <!-- Card 2 -->

             <?php

                $sql = "SELECT COUNT(*) AS TOTAL FROM seats";

                $stmt = mysqli_prepare($conn, $sql);

                if ($stmt) {
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $row = mysqli_fetch_assoc($result);

                    $total = $row['TOTAL'];
                } else {
                    echo "Error: " . mysqli_error($conn);
                    exit;
                }
                ?>
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow p-4" style="border-radius: 12px;">
                    <div class="d-flex align-items-center  justify-content-between">

                        <!-- Left Side -->
                        <div class="d-flex align-items-center ">
                            <div class="rounded-3 d-flex align-items-center justify-content-center me-3"
                                style="width: 60px; height: 60px;  background-color: #46776b;">
                                <i class="fa-solid fa-couch fs-3"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-0 text-dark"><?=$total?></h4>
                                <p class="text-muted mb-0">Total Seat</p>
                            </div>
                        </div>                                        
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
             <?php
                $stmt = mysqli_prepare($conn, "SELECT COUNT(*) AS total FROM bookings WHERE status=?");
                $status = 'Booked';
                mysqli_stmt_bind_param($stmt, "s", $status);

                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                $row = mysqli_fetch_assoc($result);
                $total = $row['total'];

                ?>

            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow p-4" style="border-radius: 12px;">
                    <div class="d-flex align-items-center justify-content-between">

                        <!-- Left Side -->
                        <div class="d-flex align-items-center">
                            <div class="rounded-3 d-flex align-items-center justify-content-center me-3"
                                style="width: 60px; height: 60px;  background-color: #46776b;">
                                <i class="fa-solid fa-couch fs-3"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-0 text-dark"><?=$total?></h4>
                                <p class="text-muted mb-0">Bookings</p>
                            </div>
                        </div>
                        <div>                                                
                            <a href="bookings.php" class="text-primary  text-decoration-none">
                            View All
                            <i class="bi bi-arrow-bar-right"></i>
                            </a>           
                        </div>
                    </div>
                </div>
            </div>
            <!--total slot-->
             <?php

                $sql = "SELECT COUNT(*) AS TOTAL FROM time_slot";

                $stmt = mysqli_prepare($conn, $sql);

                if ($stmt) {
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $row = mysqli_fetch_assoc($result);

                    $total = $row['TOTAL'];
                } else {
                    echo "Error: " . mysqli_error($conn);
                    exit;
                }
                ?>
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow p-4" style="border-radius: 12px;">
                    <div class="d-flex align-items-center justify-content-between">

                        <!-- Left Side -->
                        <div class="d-flex align-items-center">
                            <div class="rounded-3 d-flex align-items-center justify-content-center me-3"
                                style="width: 60px; height: 60px;  background-color: #46776b;">
                               <i class="bi bi-clock fs-2 text-warning"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-0 text-dark"><?=$total?></h4>
                                <p class="text-muted mb-0">Total Slot</p>
                            </div>
                        </div>
                     
                        <div>                                                
                            <a href="Slot.php" class="text-primary  text-decoration-none">
                            View All
                            <i class="bi bi-arrow-bar-right"></i>
                            </a>           
                        </div>
                                        
                    </div>
                </div>
            </div>

            <!-- Card 4  total paymenys ->
             <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow p-4" style="border-radius: 12px;">
                    <div class="d-flex align-items-center justify-content-between">

                        <!-- Left Side ->
                        <div class="d-flex align-items-center">
                            <div class="rounded-3 d-flex align-items-center justify-content-center me-3"
                                style="width: 60px; height: 60px;  background-color: #46776b;">
                                <i class="bi bi-currency-rupee fs-3"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-0 text-dark">0</h4>
                                <p class="text-muted mb-0">Total Revenue</p>
                            </div>
                        </div>
                     
                        <div>                                                
                            <a href="Payments.php" class="text-primary  text-decoration-none">
                            View All
                            <i class="bi bi-arrow-bar-right"></i>
                            </a>           
                        </div>
                                        
                    </div>
                </div>
            </div>-->
           <!--complaint-->

           <?php
                $sql = "SELECT COUNT(*) AS TOTAL FROM complaints WHERE status=?";
                    $status="pending";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt,"s",$status);

                if ($stmt) {
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $row = mysqli_fetch_assoc($result);

                    $total = $row['TOTAL'];
                } else {
                    echo "Error: " . mysqli_error($conn);
                    exit;
                }           ?>
           <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow p-4" style="border-radius: 12px;">
                    <div class="d-flex align-items-center justify-content-between">

                        <!-- Left Side -->
                        <div class="d-flex align-items-center">
                            <div class="rounded-3 d-flex align-items-center justify-content-center me-3"
                                style="width: 60px; height: 60px;  background-color: #46776b;">
                                <i class="fa-solid fa-pen-to-square fs-4"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-0 text-dark"><?=$total?></h4>
                                <p class="text-muted mb-0">Complaints</p>
                            </div>
                        </div>
                     
                        <div>                                                
                            <a href="Complaint.php" class="text-primary  text-decoration-none">
                            View All
                            <i class="bi bi-arrow-bar-right"></i>
                            </a>           
                        </div>
                                        
                    </div>
                </div>
            </div>
            <!-- Card 6 membersships -->
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow p-4" style="border-radius: 12px;">
                    <div class="d-flex align-items-center justify-content-between">
                        <!-- Left Side -->
                        <div class="d-flex align-items-center">
                            <div class="rounded-3 d-flex align-items-center justify-content-center me-3"
                                style="width: 60px; height: 60px;  background-color: #46776b;">
                                    <i class="bi bi-person-vcard fs-3"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-0 text-dark"> <?php
                                    require "../database.php";
                                        $sql = "SELECT COUNT(*) AS TOTAL FROM plans";

                                        $stmt = mysqli_prepare($conn, $sql);

                                        if ($stmt) {
                                            mysqli_stmt_execute($stmt);
                                            $result = mysqli_stmt_get_result($stmt);
                                            $row = mysqli_fetch_assoc($result);

                                            $total = $row['TOTAL'];
                                        } else {
                                            echo "Error: " . mysqli_error($conn);
                                            exit;
                                        }
                                        echo $total;

                                        
                                    ?></h4>
                                <p class="text-muted mb-0"> Total Plans</p>
                            </div>
                        </div>

                        <div>                                                
                            <a href="Membership.php" class="text-primary  text-decoration-none">
                            View All
                            <i class="bi bi-arrow-bar-right"></i>
                            </a>           
                        </div>
                    </div>
                </div>
            </div>
                <!-- Card 7 Plans Exprings ->
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow p-4" style="border-radius: 12px;">
                    <div class="d-flex align-items-center justify-content-between">
                        <!-- Left Side ->
                        <div class="d-flex align-items-center">
                            <div class="rounded-3 d-flex align-items-center justify-content-center me-3"
                                style="width: 60px; height: 60px;  background-color: #46776b;">
                                    <i class="bi bi-credit-card fs-3"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-0 text-dark">0</h4>
                                <p class="text-muted mb-0">Plans Expring</p>
                            </div>
                        </div>

                        <div>                                                
                            <a href="Membership.php" class="text-primary  text-decoration-none">
                            View All
                            <i class="bi bi-arrow-bar-right"></i>
                            </a>           
                        </div>
                    </div>
                </div>
            </div>  -->                                

        </div> 

    <?=require_once "footer.php"?>