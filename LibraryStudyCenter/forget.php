<?php
$err=$otp=0;
if(isset($_GET['err'])){
    $err=$_GET['err'];

}
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
            background-image: url('../imges/forget.avif');
            background-repeat: no-repeat;
            background-position: center; /* keeps the image centered */
        }
        
        input[type=email]{
            border :none;
            background: linear-gradient(135deg, #6a7a77, #e2e2ecd3);

        }
    </style>
</head>
<body >
<!-- SIGNUP FORM -->
<section class="forgetform d-flex">
    <div class="container justify-content-center d-flex align-items-center vh-100">
        <div class="   p-4" style="width:500px;">
                             
<?php if(!empty($otp)):?>
    <h5 class="alert p-3 text-center alert-success"><?=$otp?> </h5>  
<?php endif ?> 

            <form method="POST" action="email_otp.php">                
               <div class="form-floating  mt-4 mb-3">
                    <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                    <label for="floatingInput">Email Address </label>
                </div>                
                <button type="submit" name="forgrt" class="btn btn-danger w-100">Forgrt password</button>
                
                <div class="text-center mt-3">
                    <a href="login.php">Go Back</a>
                </div> 
                         
            </form>
             
<?php if(!empty($err)):?>
    <h5 class="alert  text-center alert-danger"><?=$err?> </h5>  
<?php endif ?>   
        </div>
    </div>
</section>                    
<!-- Bootstrap 5.3.3 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>

