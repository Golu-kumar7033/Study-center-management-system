<?php
require_once "database.php";
require "helper.php";

$adminmail=$_SESSION['adminemail'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Inputs
    $firstname = trim($_POST['firstname'] ?? '');
    $lastname  = trim($_POST['lastname'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $phone     = trim($_POST['phone'] ?? '');
    $gender    = trim($_POST['gender'] ?? '');
    $dob       = trim($_POST['dob'] ?? '');
    $password  = $_POST['password'] ?? '';
    $cpassword = $_POST['cpassword'] ?? '';
    $idtype    = trim($_POST['Idtype'] ?? '');
    $localaddress = trim($_POST['address1'] ?? '');
    $parmanentaddress = trim($_POST['address2'] ?? '');
    $tem_state=$_POST['tem_state'];
    $tem_city=$_POST['tem_city'];
    $tem_pin=$_POST['temp_pin'];
    $state=$_POST['state'];
    $city=$_POST['city'];
    $pin=$_POST['pin'];
    

    // --- VALIDATIONs ---
    if (empty($firstname)) exit(header("Location: Registration.php?fnameerr=First name required"));
    if (empty($lastname)) exit(header("Location: Registration.php?lnameerr=Last name required"));
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) exit(header("Location: Registration.php?emailerr=Invalid email"));
    if (!preg_match("/^[0-9]{10}$/", $phone)) exit(header("Location: Registration.php?phoneerr=Invalid phone"));
    if ($password !== $cpassword) exit(header("Location: Registration.php?cpasserr=Password mismatch"));
    if(empty($tem_city) && empty($tem_state)&&empty($tem_pin)&&empty($tem_city) && empty($tem_state)&&empty($tem_pin)){
        header("Location:registration.php? adderr=Fiels requered!");
        exit();
    }

    // --- FILE UPLOADS ---
    // ID Proof
    if ($_FILES['idproof']['error'] === 0) {
        $ext = strtolower(pathinfo($_FILES['idproof']['name'], PATHINFO_EXTENSION));
        if ($ext !== 'pdf') exit(header("Location: Registration.php?fileext=Only PDF allowed"));

        $uploadDir = __DIR__ . '/uploads/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

        $newFileName = uniqid() . ".pdf";
        move_uploaded_file($_FILES['idproof']['tmp_name'], $uploadDir . $newFileName);
    } else {
        exit(header("Location: Registration.php?idprooferr=Upload required"));
    }

    // Image Upload
    if ($_FILES['studentimg']['error'] === 0) {
        $ext = strtolower(pathinfo($_FILES['studentimg']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png'];
        if (!in_array($ext, $allowed)) exit(header("Location: Registration.php?imgext=Invalid image"));

        $uploadDir = __DIR__ . '/Imguploads/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

        $newimgName = uniqid() . "." . $ext;
        move_uploaded_file($_FILES['studentimg']['tmp_name'], $uploadDir . $newimgName);
    } else {
        exit(header("Location: Registration.php?imgerr=Image required"));
    }

    // --- DATABASE INSERT ---
    $name = $firstname . " " . $lastname;
    $passwordhashed = password_hash($password, PASSWORD_DEFAULT);
    $CreateTime = date("Y-m-d H:i:s");

    $sql = "INSERT INTO student_info 
        (student_name, firstname, lastname, student_email, student_phone, student_gender, student_dob, identity_type, student_id_proof, student_image, corresponding_address, tem_city,tem_state,tem_pincode, permanent_address,p_city,p_state,p_pincode, created_at) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?,?,?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "sssssssssssssssssss",
        $name, $firstname, $lastname, $email, $phone,
         $gender, $dob, $idtype,
        $newFileName, $newimgName, $localaddress,
        $tem_city,$tem_state,$tem_pin,
        $parmanentaddress,$city,$state,$pin, $CreateTime
    );

    if (!mysqli_stmt_execute($stmt)) {
        die("Error: " . mysqli_stmt_error($stmt));
    }

    // --- LOGIN AUTH TABLE ---
    $user_type = "2";

    $sql2 = "INSERT INTO login_auth (user_type, email_id, password) VALUES (?, ?, ?)";
    $stmt2 = mysqli_prepare($conn, $sql2);

    mysqli_stmt_bind_param(
        $stmt2,
        "sss",
        $user_type,
        $email,
        $passwordhashed
    );

    if (!mysqli_stmt_execute($stmt2)) {
        die("Error: " . mysqli_stmt_error($stmt2));
    }

    // data
     $data=[
        "Registration Date"=>date("Y:m:d h:m A"),
        "Name"=>$name,
        "Username"=>$email,
        "Year" => date("Y"),
    ];
    //send mail
     sendmail(
        $email,
        $name,
        "REGISTRATION SUCCESSFULL",
        "Tamplates/registration.html",
        $data
    );

    //admin 
   $data=[
        "Registration Date"=>date("Y:m:d h:m A"),
        "Name"=>$name,
        "Username"=>$email,
        "Email"=>$email,
        "Phone"=>$phone,
        "Year" => date("Y"),
    ];
    //send mail
     sendmail(
        $adminmail,
        "Admin",
        " NEW REGISTRATION ALERT",
        "Tamplates/registrationalert.html",
        $data
    );
    header("Location: login.php");
    exit();

    mysqli_stmt_close($stmt);
    mysqli_stmt_close($stmt2);
}
?>