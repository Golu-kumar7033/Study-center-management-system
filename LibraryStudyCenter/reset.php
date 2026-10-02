<?php
session_start();
require "database.php";
require "helper.php";

if($_SERVER['REQUEST_METHOD']==="POST"){

$email=$_SESSION['email'];

//get name
getstudent($email);
$name=$_SESSION['student_name'];
 //var_dump($email,$name);

 $password=$_POST['new_password'];
 $cpassword=$_POST['confirm_password'];
if ($password !== $cpassword) exit(header("Location: Registration.php?cpasserr=Password mismatch"));
$password = password_hash($password, PASSWORD_DEFAULT);



// Prepare SELECT query
$stmt = mysqli_prepare($conn, "SELECT id, user_type FROM login_auth WHERE email_id=?");
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {

    // Prepare UPDATE query
    $stmt2 = mysqli_prepare($conn, "UPDATE login_auth SET password=?, token=NULL, token_expiry=NULL WHERE email_id=?");
    mysqli_stmt_bind_param($stmt2, "si", $password, $email);
    mysqli_stmt_execute($stmt2);

    // Redirect based on usertype
    if ($row['user_type'] == 1) {
        header("Location: admin/login/login.php");
    } 
    else {
        header("Location: login.php");

        //data
        $data=[
            "User Name"=>$name,
            "User Email"=>$email,
            "Year"=>date("Y"),

        ];

//send mail
        sendmail(
        $email,
        $name,
        "PASSWORD RESET",
        "Tamplates/forget.html",
        $data
    );

       
    }

    exit();

}else{
    echo "Invalid request";

}
mysqli_close($conn);

 
}



?>