<?php

    require "../database.php";

    if($_SERVER["REQUEST_METHOD"]==="POST"){

        $library_name =$_POST['library_name'];
        $contact_number =$_POST['contact_number'];
        $address =$_POST['address'];
        $city=$_POST['city'];
        $state=$_POST['state'];
        $country=$_POST['country'];
        $pincode=$_POST['pincode'];
        $email=$_POST['email'];
        $opening_time=$_POST['opening_time'];
        $closing_time=$_POST['closing_time'];
        $total_seat=$_POST['total_seats'];

        //sql
        $sql="INSERT INTO Library_info
         ( library_name, contact_number,address,city,state,country,pincode,email,opening_time,closing_time,total_seats)
         VALUES (?,?,?,?,?,?,?,?,?,?,?)";

         $stmt=mysqli_prepare($conn,$sql);

         mysqli_stmt_bind_param(
            $stmt,"sssssssssss",
            $library_name,
            $contact_number,
            $address,
            $city,
            $state,
            $country,
            $pincode,
            $email,
            $opening_time,
            $closing_time,
            $total_seat
         );
         if(mysqli_stmt_execute($stmt)){
            header("Location:dashboard.php");
         }else{
            echo "error". mysqli_stmt_error($stmt);
         }

        mysqli_stmt_close($stmt);




    }

?>