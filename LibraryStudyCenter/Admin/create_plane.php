<?php
require "../database.php";
require "login/chacklogin.php";

if($_SERVER['REQUEST_METHOD'] === "POST"){

    $pname   = $_POST['pname'];
    $price   = $_POST['price'];
    $duration= $_POST['ptime']; // days
    $fetures = $_POST['feture'];

   /* $sdate = date("Y-m-d H:i:s");

    $edate = date("Y-m-d H:i:s", strtotime("+$duration days"));*/

    $sql = "INSERT INTO plans(plan_name,amount,duration_days,features)
            VALUES(?,?,?,?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "siis",
        $pname,
        $price,
        $duration,
        $fetures
    );

    if(mysqli_stmt_execute($stmt)){
        header("Location:membership.php");
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
        error_log(mysqli_stmt_error($stmt));
    }
}
?>