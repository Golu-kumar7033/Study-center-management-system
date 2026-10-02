<?php
require "../database.php";


    $slot_name=$_POST['slot_name'] ;
   echo  $start_time=$_POST['start_time']. $_POST['ampm'];
   echo  $end_time=$_POST['end_time']. $_POST['ampme'];
    


    $sql = "INSERT INTO time_slot (slot_name, start_time, end_time)
            VALUES (?,?,?)";

            $stmt=mysqli_prepare($conn,$sql);

            mysqli_stmt_bind_param(
                $stmt,"sss",
                $slot_name,
                $start_time,
                $end_time
            );

            if(mysqli_stmt_execute($stmt)){
               header("Location: slot.php"); 
 
            }
            else{
                echo "error".mysqli_stmt_error($stmt);
            }
            mysqli_stmt_close();


?>

