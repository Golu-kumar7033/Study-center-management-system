<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libro | Studyspace - OTP Verification</title>
    <link rel="icon" type="image/png" href="../imges/logo.png">
    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <style>
         body {
            background-image: url('../imges/otp.jpg');
            background-position: center; /* keeps the image centered */
             background-repeat: no-repeat;
            background-size: cover; 
        }
    </style>
</head>
<body class="bg-text-dark-subtle">
<!-- OTP VERIFICATION FORM -->
<section class="forgetform">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class=" p-4 w-100" style="max-width: 500px;">
            <h3 class="text-center mb-4">OTP Verification</h3>
            <form method="POST" action="verify_otp.php">
                <div class="form-floating mb-3">
                    <input type="text" name="otp" class="form-control" id="floatingOTP" placeholder="Enter OTP" required maxlength="6">
                    <label for="floatingOTP">Enter OTP</label>
                </div>
                <button type="submit" name="verify" class="btn btn-success w-100">Verify</button>
                <div class="text-center mt-3">
                    <a href="login.php">Go Back</a>
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