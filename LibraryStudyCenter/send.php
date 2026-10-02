<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $name  = htmlspecialchars($_POST['name'] ?? '');
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $tel   = htmlspecialchars($_POST['tel'] ?? '');
    $sub   = htmlspecialchars($_POST['subject'] ?? '');
    $city  = htmlspecialchars($_POST['city'] ?? '');
    $state = htmlspecialchars($_POST['state'] ?? '');
    $text  = htmlspecialchars($_POST['text'] ?? '');

    $mail = new PHPMailer(true);

    try {

       // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output

        $mail->isSMTP();
        $mail->Host       = 'smtp-relay.brevo.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'a729ff001@smtp-brevo.com';                     //SMTP username
        $mail->Password   = 'xsmtpsib-349fdfaa5ceb24cc2a0d013b6e008fde5cfbc54bcbb6c1461b3c4fb952d1ca63-FGy9Qhw3CKEa0t4r';                               //SMTP password
 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
         $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

      $mail->setFrom('himanshukumar54757@gmail.com', 'Himanshu Kumar');
    $mail->addAddress('golu703.k@gmail.com ', 'Kashyap Amit');     //Add a recipient
    
        $mail->isHTML(true);
        $mail->Subject = 'User Inquiries';
$mail->Body = <<<HTML
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>New Inquery Alert</title>
</head>

<body style="margin:0; padding:0; background-color:#f4f4f4; font-family:Arial, sans-serif;">

  <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding:20px 0;">
    <tr>
      <td align="center">

        <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:8px; overflow:hidden;">

          <tr>
            <td style="background:#0f172a; padding:20px; text-align:center; color:#ffffff;">
              <h1 style="margin:0; font-size:22px;">Library Study Center</h1>
              <p style="margin:5px 0 0; font-size:14px;">New Feedback Alert (Admin)</p>
            </td>
          </tr>

          <tr>
            <td style="padding:30px; color:#333333;">
              <p style="font-size:16px;">Hello Admin,</p>

              <p style="font-size:15px; line-height:1.6;">
                New Inquery
              </p>

              <table width="100%" style="background:#f9fafb; padding:15px; border-radius:6px; margin:20px 0;">
                <tr>
                  <td style="font-size:14px; line-height:1.8;">
                    <h1>New Student Inquiry</h1>
                    <p><strong>Name:</strong> {$name}</p>
                    <p><strong>Email:</strong> {$email}</p>
                    <p><strong>Phone:</strong> {$tel}</p>
                    <p><strong>Subject:</strong> {$sub}</p>
                    <p><strong>City:</strong> {$city}</p>
                    <p><strong>State:</strong> {$state}</p>
                    <p><strong>Message:</strong> {$text}</p>
                </td>
                </tr>
              </table>

              

              <p style="margin-top:30px; font-size:15px;">
                Regards,<br>
                <strong>Library Study Center System</strong>
              </p>
            </td>
          </tr>

          <tr>
            <td style="background:#f0f0f0; text-align:center; padding:15px; font-size:12px; color:#777;">
              © {year} Library Study Center. Admin Notification System
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>

</body>
</html>
HTML;
        $mail->send();
        echo 'Message has been sent';

    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
}
?>