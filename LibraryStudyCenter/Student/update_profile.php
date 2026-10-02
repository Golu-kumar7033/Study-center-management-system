<?php

session_start();
require "../database.php";
require "../helper.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(!isset($_SESSION['user'])){
        header("Location: login.php");
        exit();
    }

    $user = $_SESSION['user'];

    $name    = trim($_POST['studentname']);
    $email   = trim($_POST['studentemail']);
    $phone   = trim($_POST['studentphone']);
    $address = trim($_POST['studentaddress']);

    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: Edit_profile.php?email=Invalid email");
        exit();
    }

    if(empty($phone)){
        header("Location: Edit_profile.php?phone=Invalid phone");
        exit();
    }

    $stmt = $conn->prepare("SELECT student_image FROM student_info WHERE student_email=?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $oldImage = $row['student_image'] ?? '';

    $newimgName = $oldImage; // default

    if(!empty($_FILES['profile_image']['name'])){

        $img = $_FILES['profile_image']['name'];
        $tmp_name = $_FILES['profile_image']['tmp_name'];
        $size = $_FILES['profile_image']['size'];

        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png'];

        if(!in_array($ext, $allowed)){
            header("Location: Edit_profile.php?type=Invalid file type");
            exit();
        }

        if($size > 2000000){
            header("Location: Edit_profile.php?size=File too large");
            exit();
        }

        $newimgName = uniqid("IMG_", true) . "." . $ext;
        $folder = "../Imguploads/" . $newimgName;

        if(move_uploaded_file($tmp_name, $folder)){

            if(!empty($oldImage) && file_exists("../Imguploads/" . $oldImage)){
                unlink("../Imguploads/" . $oldImage);
            }

        } else {
            header("Location: Edit_profile.php?upload=Upload failed");
            exit();
        }
    }

    $stmt = $conn->prepare("UPDATE student_info 
        SET student_name=?, student_email=?, student_phone=?, student_image=?, permanent_address=? 
        WHERE student_email=?");

    $stmt->bind_param("ssssss", $name, $email, $phone, $newimgName, $address, $user);

    if($stmt->execute()){
        $_SESSION['user'] = $email; // update session if email changed
        header("Location: Edit_profile.php?ms=Profile updated successfully");
            user_activity($_SESSION['student_id'],date("Y-m-d h:i A"),null, $_SERVER['HTTP_USER_AGENT'],"Update profile");

        exit();
    } else {
        header("Location: Edit_profile.php?err=Update failed");
        exit();
    }
}
?>