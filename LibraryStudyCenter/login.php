
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
    <title>Libro | Studyspace</title>
    <link rel="icon" type="image/png" href="../imges/logo.png">
    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    <style>
     body {
            background-image: url('../imges/login-bg.jpg');
            background-repeat: no-repeat;
            background-size: cover; /* ensures the image covers the whole page */
            background-position: center; /* keeps the image centered */
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
<!-- login FORM -->
<section class=" loginform">   
    
    <div class="container justify-content-center d-flex align-items-center vh-100">
        <div class="car shadow   p-4" style="width:400px;">
           <div class="d-flex mb-3 align-items-center">
                <img src="../imges/logo.png" alt="Library Study Center Logo" style="width: 20%;">
                <h3 class="ms-3 text-white">Libro Study Center</h3>
            </div>
            <form method="POST" action="loginvalidation.php">                
               <div class="form-floating mb-3">
                    <input type="email" class="form-control <?= !empty($err) ? 'is-invalid' : '' ?>" name="username" id="floatingInput" placeholder="name@example.com" required>
                    <label for="floatingInput">Username </label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control <?= !empty($err) ? 'is-invalid' : '' ?>" name="password" id="floatingPassword" placeholder="Password" required>
                    <label for="floatingPassword">Password</label>
                </div>

                    <?php if(!empty($err)): ?>
                    <div class="alert alert-danger text-center mt-2 mb-2" role="alert">
                        <?= htmlspecialchars($err) ?>
                    </div>
                    <?php endif; ?> 
                
                <button type="submit" name="login" class="btn btn-success w-100">Login</button>
                <div class="text-center mt-4">
                    <p class="text-white">
                        Don't have an account?
                        <a href="Registration.php" class="btn btn-primary btn-sm ms-2">
                            Register
                        </a>
                    </p>

                    <div class="mt-1 text-white">
                        <a href="forget.php" class="me-4  text-danger text-decoration-none">
                            Forgot Password?
                        </a>
                    </div>
                </div>    
            </form>
        </div>
    </div>
   
</section>                      
<!-- Bootstrap 5.3.3 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>