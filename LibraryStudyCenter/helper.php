<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require "vendor/autoload.php";

require "database.php";
date_default_timezone_set("Asia/Kolkata");

$_SESSION['adminemail']="admin1.library@gmail.com";


//email sender for diffrent tamplates and different resiver
function sendmail($toemail, $toname, $subject, $emailtemplate, $data = []) {

    $mail = new PHPMailer(true);

    try {
       // $mail->SMTPDebug = 2;
        //$mail->Debugoutput = 'html';

        $mail->isSMTP();
        $mail->Host       = 'smtp-relay.brevo.com';
        $mail->SMTPAuth   = true;

        $mail->Username   = 'a729ff001@smtp-brevo.com';                     //SMTP username
        $mail->Password   = 'xsmtpsib-349fdfaa5ceb24cc2a0d013b6e008fde5cfbc54bcbb6c1461b3c4fb952d1ca63-FGy9Qhw3CKEa0t4r';                               //SMTP password
 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('himanshukumar54757@gmail.com','Library Study Center');//fixed sender 

        $mail->addAddress($toemail, $toname);

        $mail->isHTML(true);
        $mail->Subject = $subject;

        $fullPath = __DIR__ . '/' .$emailtemplate;
        //var_dump($fullPath);
        //exit();

        if (!file_exists($fullPath)) {
            echo "Template not found: " . $fullPath;
            return false;
        }

        $body = file_get_contents($fullPath);

        foreach ($data as $key => $value) {
            $body = str_replace("{{".$key."}}", $value, $body);
        }

        $mail->Body    = $body;

        if ($mail->send()) {
            echo 'Email has been sent';
            
        } else {
            echo 'Email has been sent';

        }

    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
}






// function user activity
function user_activity($student_id, $login, $logout, $device_info, $activity_type) {

    global $conn;

    $sql = "INSERT INTO user_activity_logs (student_id, login_time, logout_time, device_info, activity) VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        die("Prepare failed: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param( $stmt,"issss", $student_id,$login, $logout,$device_info, $activity_type   );

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}




//function getuser 
function getstudent($email){
    global $conn;

    $user = "SELECT * FROM student_info WHERE student_email = ?";
    $stmt = mysqli_prepare($conn, $user);

    if(!$stmt){
        die("preprartion faild!");
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $results = mysqli_stmt_get_result($stmt);
    if( $results && mysqli_num_rows($results)>0){
        $student = mysqli_fetch_assoc($results);
        $_SESSION['student_id']=$student['student_id'];
        $_SESSION['student_name'] = $student['student_name'];
        $_SESSION['admin_email']="admin1.library@gmail.com";
        return $student;

    }
    return null;


}     

?>