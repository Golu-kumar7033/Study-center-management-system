<?php 
require "../Checklogin.php";
require "usererrorlog.php";

$ms=$err="";
if(isset($_GET['err']) && $_GET['err'] != ''){
        $err= $_GET['err'];
}
if(isset($_GET['ms']) && $_GET['ms'] != ''){
        $ms= $_GET['ms'];
}

?> 
<?php include("navbar.html"); ?>
    <div class="d-flex justify-content-center" style="margin-top:100px;">
        <div class="card profile-card shadow" style="width: 850px;">

            <!-- Header -->
            <div class="profile-header text-center">
                <!-- Image Preview -->
                <img id="studentimg" src="image/he.png" width="150" alt="User Photo" class="mb-2 ">
                <h3 class="mt-2">Edit Profile</h3>
            </div>
            <div class="p-4">
                <form method="POST" action="update_profile.php" enctype="multipart/form-data">  
                    <div>
                        <label class="btn btn-light btn-custom mt-2">
                            <i class="fas fa-upload"></i> Change Photo
                            <input type="file" name="profile_image" id="profile_image" accept="image/*" hidden>                    
                        </label>
                    </div>             
                    <h5 class="section-title">Basic Info</h5>
                    <div class="info-box">
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="studentname" class="form-control" id="name" placeholder="Loading">
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="studentemail" class="form-control" id="email" placeholder="Loading">
                        </div>

                        <div class="mb-3">
                            <label>Phone</label>
                            <input type="text" name="studentphone" class="form-control"  id="phone"placeholder="Loading">
                        </div>

                        <div class="mb-3">
                            <label>Address</label>
                            <textarea name="studentaddress" class="form-control" id="address" placeholder="Loading"></textarea>
                        </div>
                    </div>

                    <!-- Seat -->
                   
                    <?php if(!empty($ms)):?>
                    <div class="alert alert-success" ><?= htmlspecialchars($ms) ?></div>                    
                   <?php endif;?> 
                   <?php if(!empty($err)): ?>
                    <div class="alert alert-danger text-center mt-2 mb-2" role="alert">
                        <?= htmlspecialchars($err) ?>
                    </div>
                    <?php endif; ?>    
                                           
             

                    <!-- Buttons -->
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary btn-custom">
                            Save Changes
                        </button>
                        <a href="myprofile.php" class="btn btn-secondary btn-custom">
                            Cancel
                        </a>
                    </div>

                </form>
            </div>

        </div>
    </div>


<?php require_once "footer.html";?>