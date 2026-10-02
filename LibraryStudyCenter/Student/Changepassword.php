<?php 
require "../Checklogin.php";


 
$passerr=$cpasserr=$ms=$olderr="";
if(isset($_GET['err']) && $_GET['err'] != ''){
        $olderr= $_GET['err'];
}
if(isset($_GET['passerr']) && $_GET['passerr'] != ''){
        $passerr= $_GET['passerr'];
}
if(isset($_GET['err']) && $_GET['err'] != ''){
        $cpasserr= $_GET['err'];
}
if(isset($_GET['ms']) && $_GET['ms'] != ''){
        $ms= $_GET['ms'];
}
?> 
<?php include("navbar.html"); ?>


    <main class=" d-flex justify-content-center" style="margin-top:100px;">
        <div class="card mt-5 shadow-lg border-0 rounded-4 " style="width: 600px;">
            <h5 class="card-header bg-danger text-white text-center py-4 rounded-top-4 p-3">🔐 Change Password</h5>

            <div class="card-body p-4">
                <form method="POST" action="../setnewpassword.php">
                    
                    <div class="mb-3">
                        <label class="form-label">Old password</label>
                        <input class="form-control input <?=!empty($olderr)?' is-invalid':'' ?>" type="password" name="old_password" required>
                        <span class="text-danger "><?=$olderr?></span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">New password</label>
                        <input class="form-control input <?= !empty($passerr)?'is-invalid':''?>" type="password" name="new_password" required>
                        <span class="text-danger"><?=$passerr?></span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirm password</label>
                        <input class="form-control input <?= !empty($cpasserr)?'is-invalid':''?>" type="password" name="confirm_password" required>
                        <span class="text-danger"><?=$cpasserr?></span>
                    </div>
                    <?php if(!empty($ms)):?>
                        <div class=" text-center alert alert-success" ><?=$ms?></div>
                    <?php endif?>

                    <button type="reset" class="btn btn-secondary">Cancel</button>
                    <button type="submit" name="change_password" class="btn btn-primary">Change Password</button>

                </form>
            </div>
        </div>
    </main>
<?=require_once "footer.html";?>;