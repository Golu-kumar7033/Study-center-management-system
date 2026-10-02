<?php

require "../database.php";
require "../Checklogin.php";
require "../helper.php";


$user = $_SESSION['student_id'];
$name=$_SESSION['student_name'];
$email=$_SESSION['user'];
//var_dump($user,$name,$email);
//exit();



if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $complaintType = $_POST['complainttype'];
    $complainttext = $_POST['complainttext'];
    $cnumber=mt_rand(100000000,999999999);


    $file = null; // default = no file

    // check if file is uploaded

      if (isset($_FILES['complaintfile']) && $_FILES['complaintfile']['error'] === UPLOAD_ERR_OK) {

    $ext = strtolower(pathinfo($_FILES['complaintfile']['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'pdf'];

    if (in_array($ext, $allowed)) {

        $uploadDir = __DIR__ . '/Complaintfiles/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $file = uniqid() . "." . $ext;

        move_uploaded_file($_FILES['complaintfile']['tmp_name'], $uploadDir . $file);

    } else {
        echo "Invalid file type.";
    }

} else {
    $file = null; 
}

    $sql = "INSERT INTO complaints(student_id,complaint_no, category, file, description) VALUES(?,?,?,?,?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "iisss",
        $user,
        $cnumber,
        $complaintType,
        $file,
        $complainttext
    );

    if (!mysqli_stmt_execute($stmt)) {
        die("error " . mysqli_stmt_error($stmt));
    }

    mysqli_stmt_close($stmt);

    header("Location: complaintregistration.php?ms=Complaint Registered!");
    user_activity($_SESSION['student_id'],date("Y-m-d h:i A"),null, $_SERVER['HTTP_USER_AGENT'],"Student  Registered Complaint");
    $data = [
    "User Name" => $name,
    "Complaint ID" =>$cnumber,
    "Date" => date("d-m-Y"),
    "Complaint Category" => $complaintType,
    "Complaint Subject" => $complainttext,
    "Year" => date("Y")
];
//calling send mail
sendmail(
    $email,
    $name,
    " Complaint Alert",
    "Tamplates/complaint.html",
    $data
);


    exit();
}
?>