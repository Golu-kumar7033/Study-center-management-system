<?php
session_start();
require "database.php";
require "helper.php";

$otp=0;

if(isset($_GET['otp'])){
    $otp=$_GET['otp'];

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libro | Studyspace</title>
    <link rel="icon" type="image/png" href="../imges/logo.png">
    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <style>
    body {
        background-image: url('../imges/emailotp.jpg');
        background-repeat: no-repeat;
        background-position: center;
        background-size: 50%; 
        }
       
        input {
            background: linear-gradient(135deg, #e8ebea, #e2e2ecd3);
            opacity: 0.5; 
        }
        
        </style>
</head>
<body >

 
                          
<?php if(!empty($otp)):?>
    <h5 class="alert   p-3 text-center alert-success"><?=$otp?> </h5>  
<?php endif ?> 
<section class="forgetform d-flex">
    <div class="container justify-content-center d-flex align-items-center vh-100">
        <div class="   p-4" style="width:500px;">
  
            <form method="POST" action=" ">                
               <div class="form-floating  mt-4 mb-3">
                    <input type="number" name="otp" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                    <label for="floatingInput">Email OTP </label>
                </div>                
                <button type="submit" name="forget" class="btn btn-warning w-100">Varify Email</button>
                         
            </form>
            <?php

if(isset($_POST['forget'])){

    $email = $_SESSION['email'];
    $otp = $_POST['otp'];

    $stmt = mysqli_prepare($conn, "SELECT * FROM login_auth WHERE email_id=? AND token=? AND token_expiry > NOW()");

    mysqli_stmt_bind_param($stmt, "ss", $email, $otp);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) > 0){
        header("Location: reset_password.php");
        exit();
    } else {
        echo "<h5 class='text-danger mt-3  text-center'>Invalid OTP</h5>";
    }
}
?>    
        </div>
        
    </div>
</section>

<!-- Bootstrap 5.3.3 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>