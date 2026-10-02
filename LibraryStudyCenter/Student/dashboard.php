<?php 
require "../Checklogin.php";
require "../helper.php";

$email= $_SESSION['user'];

$student = getstudent($email);

if($student){
    $student= "Hello ". $student['student_name'];
} else {
    $student= "User not found";
}
?> 
    <?= include("navbar.html");?>

        <h2 class="fs-2 bg-secondary-subtle rounded p-5" style="margin-top:80px"> <?php echo $student?></h2>
    
        <div class="row g-3 mb-5" style="margin-top:80px;">
            <!-- Card 1 -->
             <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow p-4" style="border-radius: 12px;">
                    <div class="d-flex align-items-center justify-content-between">

                        <!-- Left Side -->
                        <div class="d-flex  gap-2 align-items-center">
                            <div class="rounded-3 d-flex align-items-center justify-content-center me-3"
                                style="width: 60px;">
                                <img src="image/he.png" width="80px" alt="he/svg">
                            </div>
                            <div>
                                <p class="text-muted mb-0">My Profile</p>
                            </div>
                        </div>
                     
                        <div>                                                
                            <a href="Myprofile.php" class="text-primary  text-decoration-none">
                            View
                            <i class="bi bi-arrow-bar-right"></i>

                            </a>           
                        </div>
                                        
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow p-4" style="border-radius: 12px;">
                    <div class="d-flex align-items-center justify-content-between">

                        <!-- Left Side -->
                        
                        <div class="d-flex gap-3 align-items-center">
                            <div class="rounded-3 d-flex align-items-center justify-content-center me-3"
                                style="width: 60px;">
                                <img src="image/seat.svg" width="80px" alt="seat/svg">
                            </div>
                            <div>
                                <h4 class="fw-bold mb-0 text-dark"></h4>
                                <p class="text-muted mb-0">Book Seat</p>
                            </div>
                        </div>
                     
                        <div>                                                
                            <a href="Seat_Slot_bookin.php" class="text-primary  text-decoration-none">
                            View 
                            <i class="bi bi-arrow-bar-right"></i>

                            </a>           
                        </div>
                                        
                    </div>
                </div>
            </div>

           
             <!-- plan card 4 -->
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow p-4" style="border-radius: 12px;">
                    <div class="d-flex align-items-center justify-content-between">

                        <!-- Left Side -->
                        <div class="d-flex  gap-3 align-items-center">
                            <div class="rounded-3 d-flex align-items-center justify-content-center me-3"
                                style="width: 60px;">
                                <img src="image/complaint.svg" width="80px" alt="clock/svg">
                            </div>
                            <div>
                                <h4 class="fw-bold mb-0 text-dark"></h4>
                                <p class="text-muted mb-0 ">Complaints</p>
                            </div>
                        </div>
                     
                        <div>                                                
                            <a href="my-complaint.php" class="text-primary  text-decoration-none">
                            View 
                            <i class="bi bi-arrow-bar-right"></i>
                            </a>           
                        </div>
                                        
                    </div>
                </div>
            </div>
                                     

        </div> 
    
<?=require "footer.html";?>