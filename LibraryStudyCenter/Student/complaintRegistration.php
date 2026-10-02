<?php 
require "../Checklogin.php";
    
     include("navbar.html"); 
?> 

    <div class="d-flex justify-content-center" style="margin-top:50px;">
        <div class="card   mt-5 shadow-lg border-0 rounded-4" style="width: 800px;"> 
            
            <div class="card-header  bg-primary text-white text-center py-4 rounded-top-4 p-3">
                <h2>📝 Complaint Registration</h2>
            </div>  

            <div class="card-body p-4">

                <!-- FORM START -->
                <form  method="POST" action="complaint.php" enctype="multipart/form-data">
                    <?php
                        $ms="";
                        if(isset($_GET['ms']) && $_GET['ms']!=''){
                            $ms=$_GET['ms'];
                        }
                    ?>
                    <!-- Complaint Type -->
                    <div class="mb-3">
                        <label for="complainttype" class="form-label">Complaint Type</label>
                        <select name="complainttype" id="complainttype" class="form-control input" required>
                            <option value="">Select Complaint Type</option>
                            <option value="Booking">Booking Related</option>
                            <option value="Seat">Seat Related</option>
                            <option value="TimeSlot">Time-Slot Related</option>
                            <option value="Fee">Fee Related</option>
                            <option value="Electrical">Electrical</option>
                            <option value="Plumbing">Plumbing</option>
                            <option value="Discipline">Discipline</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <!-- Complaint Text -->
                    <div class="mb-3">
                        <label for="complainttext" class="form-label">Complaint Description</label>
                        <textarea name="complainttext" class="form-control input" id="complainttext" rows="4"  style="resize:none;"required></textarea>
                    </div>

                    <!-- File Upload -->
                    <div class="mb-3 border p-3 rounded">
                        <label for="complaintfile" class="form-label">Upload File (If any)</label>
                        <input type="file" name="complaintfile" class=" input form-control" id="complaintfile">
                    </div>
                    <?php if(!empty($ms)):?>
                        <div class="alert alert-success p-2"><?=$ms?></div>
                    <?php endif;?>
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>
                <!-- FORM END -->

            </div>           

        </div>
    </div>
<?=require_once "footer.html";?>