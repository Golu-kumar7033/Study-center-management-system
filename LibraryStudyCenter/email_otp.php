<?php
session_start();
require "database.php";
require "helper.php";

if($_SERVER['REQUEST_METHOD']==="POST"){

$email=htmlspecialchars($_POST['email']);
if(!filter_var($email.FILTER_VALIDATE_EMAIL)){
header("Location:forget.php?err=In valide email formet");
exit();

}
getstudent($email);
$name=$_SESSION['student_name'];

//chack in database
$emailchack="SELECT email_id FROM login_auth WHERE email_id=?";
$stmt=mysqli_prepare($conn,$emailchack);
mysqli_stmt_bind_param($stmt,"s",$email);
mysqli_execute($stmt);
$result=mysqli_stmt_get_result($stmt);
if (mysqli_num_rows($result) > 0) {

    $otp = rand(100000, 999999); 
    $expiry = date("Y-m-d H:i:s", strtotime("+5 minutes"));

    $stmt=mysqli_prepare($conn,"UPDATE login_auth SET token=?,token_expiry=?  WHERE Email_id=?");
    mysqli_stmt_bind_param($stmt,"iss",$otp,$expiry,$email);
    mysqli_execute($stmt);

    $_SESSION['email']=$email;
   
    //send otp mail

    $data=[
        "User Name"=>$name,
        "OTP_CODE"=>$otp,
        "Expiry Time"=>$expiry,
        "Year" => date("Y"),
    ];

    //calling mail
    sendmail(
        $email,
        $name,
        "OTP(ONE TIME PASSWORD)",
        "Tamplates/emailvarify.html",
        $data
    );

    header("Location:varify_otp.php?otp=OTP send to your email");
    exit();


}else{
    header("Location:forget.php?err=No email found!");
}


}
?>