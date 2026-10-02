
<?php

 $err="";
if(isset($_GET['err']) && $_GET['err'] != ''){
        $err= $_GET['err'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Study Center</title>
    <link rel="icon" type="image/png" href="../../../imges/logo.png">
    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <style>
        body {
            background-image: url('../../../imges/login-bg.jpg');
            background-size: cover;
            background-position: center;
        } 
         /* Text fields */
        input[type="email"],
        input[type="password"] {
            background-color: #ffef;
            color: white;
            border: 1px solid #ddcaca;
            padding: 8px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
<!-- Admin  FORM -->
<section >
    <div class="container justify-content-center d-flex align-items-center vh-100">
        <div class="car shadow   p-4" style="width:500px;">
           <div class="d-flex mb-3 align-items-center">
                <img src="../../../imges/logo.png" alt="Library Study Center Logo" style="width: 20%;">
                <h3 class="ms-3">Library Study Center</h3>
            </div>
            <form method="POST" action="../../loginvalidation.php">                
               <div class="form-floating mb-3">
                    <input type="email" class="form-control <?= !empty($err)?'is-invalid':'' ?>" name="username" id="floatingInput" placeholder="name@example.com" required>
                    <label for="floatingInput">Username </label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control <?= !empty($err)?'is-invalid':'' ?>" name="password" id="floatingPassword" placeholder="Password" required>
                    <label for="floatingPassword">Password</label>
                </div>
                <button type="submit"class="btn btn-success w-100">Login</button>
                <?php if(!empty($err)):?>
                <div class="alert alert-danger text-center mt-2 mb-2"><?=htmlspecialchars($err)?></div>
                <?php endif?>
                <div class="text-center mt-3">
                    <a  class="" href=" ../../forget.php">Forget password</a>
                </div>            
            </form>
        </div>
    </div>
   
</section> 


<!-- Bootstrap 5.3.3 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
