<?php
    $firstname=$adderr=$lastname=$email=$phone=$gender=$dob=$password=$cpassword=$idtype=$local=$parmanent=$idfile=$studentimg= "";
    $register="";
    if(isset($_GET['fnameerr']) && $_GET['fnameerr'] != ''){
        $firstname= $_GET['fnameerr'];
    }
    if(isset($_GET['lnameerr']) && $_GET['lnameerr'] != ''){
        $lastname= $_GET['lnameerr'];
    }
    if(isset($_GET['adderr']) && $_GET['adderr'] != ''){
        $adderr= $_GET['adderr'];
    }
    if(isset($_GET['emailerr']) && $_GET['emailerr'] != ''){
        $email= $_GET['emailerr'];
    }
    if(isset($_GET['phoneerr']) && $_GET['phoneerr'] != ''){
        $phone= $_GET['phoneerr'];
    }
    if(isset($_GET['gendererr']) && $_GET['gendererr'] != ''){
        $gender= $_GET['gendererr'];
    }
    if(isset($_GET['doberr']) && $_GET['doberr'] != ''){
        $dob= $_GET['doberr'];
    }
    if(isset($_GET['dobformenterr']) && $_GET['dobformenterr'] != ''){
        $dob= $_GET['dobformenterr'];
    }
    if(isset($_GET['passerr']) && $_GET['passerr'] != ''){
        $password= $_GET['passerr'];
    }
    if(isset($_GET['cpasserr']) && $_GET['cpasserr'] != ''){
        $cpassword= $_GET['cpasserr'];
    }
    if(isset($_GET['selectiderr']) && $_GET['selectiderr'] != ''){
        $idtype= $_GET['selectiderr'];
    }
    if(isset($_GET['localerr']) && $_GET['localerr'] != ''){
        $local= $_GET['localerr'];
    }
    if(isset($_GET['paddress']) && $_GET['paddress'] != ''){
        $parmanent= $_GET['paddress'];
    }
    if(isset($_GET['idprooferr']) && $_GET['idprooferr'] != ''){
        $idfile= $_GET['idprooferr'];
    }
    elseif(isset($_GET['fileext']) && $_GET['fileext'] != ''){
        $idfile= $_GET['fileext'];
    }
    elseif(isset($_GET['filesize']) && $_GET['filesize'] != ''){
        $idfile= $_GET['filesize'];
    }
    if(isset($_GET['imgerr']) && $_GET['imgerr'] != ''){
        $studentimg= $_GET['imgerr'];
    }
    elseif(isset($_GET['imgext']) && $_GET['imgext'] != ''){
        $studentimg= $_GET['imgext'];
    }
    elseif(isset($_GET['imgsize']) && $_GET['imgsize'] != ''){
        $studentimg= $_GET['imgsize'];
    }
    elseif(isset($_GET['msg']) && $_GET['msg'] != ''){
        $register= $_GET['msg'];
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Libro | Studyspace</title>
<link rel="icon" type="image/png" href="../imges/logo.png">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .input {
    padding: 10px;
    border-radius: 5px;
}
    .card{
        width: 90vw;
        background: rgba(145, 196, 247, 0.21);
        border: 1px solid rgba(255, 255, 255, 0.2);
    } 
    label{
        color:black;
    }
</style>
</head>
<body class="bg-light">
<section class="register">
    <div class="d-flex align-items-center justify-content-center mb-3 gap-3">
        <img src="../imges/logo.png" alt="logo/png" width="100px" class="rounded mt-3">
        <h2 class="text-warning">Libro Study Center</h2>
    </div>

    <main class="container-fluid mt-4 d-flex justify-content-center">
        <div class="card shadow p-3">
            <div class="card-header text-center">
                <h3>Student Registration</h3>
            </div>

            <div class="card-body">
                

                <form action="Validations.php" method="POST" enctype="multipart/form-data">    

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="fname" class="form-label">First Name</label>
                            <input type="text" name="firstname"class="form-control input <?= !empty($firstname) ? 'is-invalid' : '' ?>"  required>
                            <span class="text-danger "><?=$firstname?></span>
                        </div>
                        <div class="col-md-4">
                            <label for="lname" class="form-label">Last Name</label>
                            <input type="text" name="lastname" class="form-control input <?= !empty($lastname) ? 'is-invalid' : '' ?>" id="lname" required>
                            <span class="text-danger"><?=$lastname?></span>

                        </div>
                        <div class="col-md-4">
                            <label for="email" class="form-label">Email</label>                      
                            <input type="email" name="email" class="form-control input <?= !empty($email) ? 'is-invalid' : '' ?>" id="email" required>
                            <span class="text-danger"><?=$email?></span>

                        </div>
                    </div>

                    <div class="row mb-3">
                       
                        <div class="col-md-4">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="tel" name="phone" class="form-control input <?= !empty($phone) ? 'is-invalid' : '' ?>" id="phone" maxlength="10"  required>
                            <span class="text-danger"><?=$phone?></span>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="pass" class="form-label">Password</label>
                            <input type="password" name="password" id="pass" class="form-control input <?= !empty($password) ? 'is-invalid' : '' ?>" " required>
                            <span class="text-danger"><?=$password?></span>

                        </div>

                        <div class="col-md-4">
                            <label for="cpass" class="form-label">Confirm Password</label>
                            <input type="password" name="cpassword" id="cpass" class="form-control input <?= !empty($cpassword) ? 'is-invalid' : '' ?>" required>
                            <span class="text-danger"><?=$cpassword?></span>

                        </div>

                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-control input <?= !empty($gender) ? 'is-invalid' : '' ?>" name="gender" id="gender" required>
                                <option value="" selected>Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                            <span class="text-danger"><?=$gender?></span>

                        </div>
                        <div class="col-md-4">
                            <label for="dob" class="form-label">DOB</label>
                            <input type="date" name="dob" class="form-control input <?= !empty($dob) ? 'is-invalid' : '' ?>" id="dob" required>
                             <span class="text-danger"><?=$dob?></span>
       
                        </div>
                        <div class="col-md-4">
                            <label for="idtype" class="form-label">Identity Proof</label>
                            <select class="form-control input <?= !empty($idtype) ? 'is-invalid' : '' ?>" name="Idtype" id="idtype" required>
                                <option value="" selected>Select Identity Type</option>
                                <option value="Aadhar Card">Aadhar Card</option>
                                <option value="Voter Id Card">Voter Id Card</option>
                                <option value="Driving Licence">Driving Licence</option>
                            </select>
                            <span class="text-danger"><?=$idtype?></span>

                        </div>
                    </div>

                    <div class="row mb-3">
                        
                        <div class="col-md-4">
                            <label for="idproof" class="form-label">Upload ID Proof (PDF)</label>
                            <input type="file" name="idproof" id="idproof" class="form-control input <?= !empty($idfile) ? 'is-invalid' : '' ?>" accept=".pdf" required>
                            <span class="text-danger"><?=$idfile?></span>                            
                        </div>

                         <div class="col-md-4">
                            <label for="studentimg" class="form-label">Student Photo (JPG, PNG)</label>
                            <input type="file" name="studentimg" id="studentimg" class="form-control input <?= !empty($studentimg) ? 'is-invalid' : '' ?>" accept=".jpg,.jpeg,.png" required>
                            <span class="text-danger"><?=$studentimg?></span>

                        </div>
                    </div>
<!--address-->      <div class="mb-4 mt-2 ">
                        <h5 class="">Local Address</h5>
                    </div>

                    <div class="row mb-3">
                        
                       <div class="col-md-4">
                            <label for="tem_state" class="form-label">State</label>
                            <select class="form-control input <?= !empty($state) ? 'is-invalid' : '' ?>" name="tem_state" id="tem_state" required>
                               <option value="">Select State</option>
                                <option value="Andhra Pradesh">Andhra Pradesh</option>
                                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                <option value="Assam">Assam</option>
                                <option value="Bihar">Bihar</option>
                                <option value="Chhattisgarh">Chhattisgarh</option>
                                <option value="Goa">Goa</option>
                                <option value="Gujarat">Gujarat</option>
                                <option value="Haryana">Haryana</option>
                                <option value="Himachal Pradesh">Himachal Pradesh</option>
                                <option value="Jharkhand">Jharkhand</option>
                                <option value="Karnataka">Karnataka</option>
                                <option value="Kerala">Kerala</option>
                                <option value="Madhya Pradesh">Madhya Pradesh</option>
                                <option value="Maharashtra">Maharashtra</option>
                                <option value="Manipur">Manipur</option>
                                <option value="Meghalaya">Meghalaya</option>
                                <option value="Mizoram">Mizoram</option>
                                <option value="Nagaland">Nagaland</option>
                                <option value="Odisha">Odisha</option>
                                <option value="Punjab">Punjab</option>
                                <option value="Rajasthan">Rajasthan</option>
                                <option value="Sikkim">Sikkim</option>
                                <option value="Tamil Nadu">Tamil Nadu</option>
                                <option value="Telangana">Telangana</option>
                                <option value="Tripura">Tripura</option>
                                <option value="Uttar Pradesh">Uttar Pradesh</option>
                                <option value="Uttarakhand">Uttarakhand</option>
                                <option value="West Bengal">West Bengal</option>
                            </select>

                        </div>
                        <div class="col-md-4">
                            <label for="tem_city" class="form-label">City     </label>
                             <input type="text" class="form-control input" name="tem_city" id="tem_city">

                        </div>
                         <div class="col-md-4">
                            <label for="temp_pin" class="form-label">Pincode     </label>
                             <input type="number" class="form-control input" name="temp_pin" id="temp_pin">

                        </div>
                        <div class="col-md-8">
                            <label for="address1" class="form-label"> Address</label>
                            <textarea class="form-control input <?= !empty($local) ? 'is-invalid' : '' ?>" name="address1" id="address1" rows="3" style="resize:none" required></textarea>
                            <span class="text-danger"><?=$local?></span>
                        </div>                      
                    </div>
                    
                   <div class="mb-3 form-check d-flex align-items-center">
                        <input class="form-check-input me-2" id="ch" type="checkbox" name="check">
                        <label class="form-check-label" for="ch">Same As Local Address</label>
                    </div>

                    <div class="mb-4 mt-2 ">
                        <h5 class="">Parmanen Address</h5>
                    </div>
                    <div class="row  mb-3">
                         
                        <div class="col-md-4">
                            <label for="state" class="form-label">State</label>
                            <select class="form-control input <?= !empty($state) ? 'is-invalid' : '' ?>" name="state" id="state" required>
                               <option value="">Select State</option>
                                <option value="Andhra Pradesh">Andhra Pradesh</option>
                                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                <option value="Assam">Assam</option>
                                <option value="Bihar">Bihar</option>
                                <option value="Chhattisgarh">Chhattisgarh</option>
                                <option value="Goa">Goa</option>
                                <option value="Gujarat">Gujarat</option>
                                <option value="Haryana">Haryana</option>
                                <option value="Himachal Pradesh">Himachal Pradesh</option>
                                <option value="Jharkhand">Jharkhand</option>
                                <option value="Karnataka">Karnataka</option>
                                <option value="Kerala">Kerala</option>
                                <option value="Madhya Pradesh">Madhya Pradesh</option>
                                <option value="Maharashtra">Maharashtra</option>
                                <option value="Manipur">Manipur</option>
                                <option value="Meghalaya">Meghalaya</option>
                                <option value="Mizoram">Mizoram</option>
                                <option value="Nagaland">Nagaland</option>
                                <option value="Odisha">Odisha</option>
                                <option value="Punjab">Punjab</option>
                                <option value="Rajasthan">Rajasthan</option>
                                <option value="Sikkim">Sikkim</option>
                                <option value="Tamil Nadu">Tamil Nadu</option>
                                <option value="Telangana">Telangana</option>
                                <option value="Tripura">Tripura</option>
                                <option value="Uttar Pradesh">Uttar Pradesh</option>
                                <option value="Uttarakhand">Uttarakhand</option>
                                <option value="West Bengal">West Bengal</option>
                            </select>
                            </select>

                        </div> 
                        <div class="col-md-4">
                            <label for="city" class="form-label">City     </label>
                             <input type="text" class="form-control input" name="city" id="city">

                        </div>
                         <div class="col-md-4">
                            <label for="pin" class="form-label">Pincode     </label>
                             <input type="number" class="form-control input" name="pin" id="pin">

                        </div>
                        <div class="col-md-8">
                            <label for="address2" class="form-label"> Address</label>
                            <textarea class="form-control input <?= !empty($parmanent) ? 'is-invalid' : '' ?>" name="address2" id="address2" rows="3" style="resize:none" required></textarea>
                            <span class="text-danger"><?=$parmanent?></span>

                        </div>
                    </div>
                    <?php if(!empty($register)): ?>
                    <div class="alert alert-success" role="alert">
                        <?= htmlspecialchars($register) ?>
                    </div>
                    <?php endif; ?>                    
                    <div class="row mb-3 fs-5 mt-5 d-flex justify-content-center">
                        <button type="submit" class="btn p-2 btn-primary" style="width:400px">
                            Register
                        </button>
                    </div>
                    <div class="text-center">
                        Already have an account? <a href="login.php">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
$(document).ready(function(){

//validation

    $('#ch').on('change', function(){
        if($(this).is(":checked")){
            // Copy values
            $('#address2').val($('#address1').val()).prop('readonly', true);
            $('#state').val($('#tem_state').val()).prop('readonly', true);
            $('#city').val($('#tem_city').val()).prop('readonly', true);
            $('#pin').val($('#temp_pin').val()).prop('readonly', true);
        } else {
            // Clear and re-enable
            $('#address2').val('').prop('readonly', false);
            $('#state').val('').prop('readonly', false);
            $('#city').val('').prop('readonly', false);
            $('#pin').val('').prop('readonly', false);
        }
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>