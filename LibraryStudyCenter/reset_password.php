<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libro | Studyspace - Set New Password</title>
    <link rel="icon" type="image/png" href="../images/logo.png">
    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <style>
        body {
            background-image: url('../imges/password.jpg');
            background-size: cover;
            background-position: center;
        } 
        
        .password-toggle {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #495057;
        }
    </style>
</head>
<body>
<section class="newpasswordform">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class=" p-4 w-100 mt-5" style="max-width: 500px;">
            <h3 class="text-center mb-4">Set New Password</h3>
            <form method="POST" action="reset.php">
                <div class="form-floating mb-3 position-relative">
                    <input type="password" name="new_password" class="form-control" id="floatingNewPassword" placeholder="New Password" required>
                    <label for="floatingNewPassword">New Password</label>
                    <i class="fa-solid fa-eye password-toggle" onclick="togglePassword('floatingNewPassword', this)"></i>
                </div>
                <div class="form-floating mb-3 position-relative">
                    <input type="password" name="confirm_password" class="form-control" id="floatingConfirmPassword" placeholder="Confirm Password" required>
                    <label for="floatingConfirmPassword">Confirm Password</label>
                    <i class="fa-solid fa-eye password-toggle" onclick="togglePassword('floatingConfirmPassword', this)"></i>
                </div>
                <button type="submit" name="reset" class="btn btn-success w-100">Reset Password</button>
                <div class="text-center mt-3">
                    <a href="login.php">Back to Login</a>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Bootstrap 5.3.3 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
function togglePassword(inputId, icon) {
    const input = document.getElementById(inputId);
    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}
</script>
</body>
</html>

