<?php
    require "../database.php";

    if($_SERVER['REQUEST_METHOD']==="GET"){        

        if(isset($_GET['id'])){
            $id = $_GET['id'];

            //  seats
            $sql1 = "DELETE FROM seats WHERE slot_id = ?";
            $stmt1 = mysqli_prepare($conn, $sql1);
            mysqli_stmt_bind_param($stmt1, "i", $id);
            mysqli_stmt_execute($stmt1);
            mysqli_stmt_close($stmt1);

            //  delete slot
            $sql2 = "DELETE FROM time_slot WHERE id = ?";
            $stmt2 = mysqli_prepare($conn, $sql2);
            mysqli_stmt_bind_param($stmt2, "i", $id);

            if(mysqli_stmt_execute($stmt2)){
                header("Location: slot.php");
                exit;
            } else {
                echo "error " . mysqli_stmt_error($stmt2);
            }

            mysqli_stmt_close($stmt2);
        }
    }
?>

