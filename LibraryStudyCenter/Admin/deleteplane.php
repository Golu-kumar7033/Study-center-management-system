<?php
    require "../database.php";

    if($_SERVER['REQUEST_METHOD']==="GET"){        

        if(isset($_GET['id'])){
            $id = $_GET['id'];

            //  plane
            $sql1 = "DELETE FROM plans WHERE plan_id = ?";
            $stmt1 = mysqli_prepare($conn, $sql1);
            mysqli_stmt_bind_param($stmt1, "i", $id);
            mysqli_stmt_execute($stmt1);


            if(mysqli_stmt_execute($stmt1)){
                header("Location: membership.php");
                exit;
            } else {
                echo "error " . mysqli_stmt_error($stmt2);
            }
            mysqli_stmt_close($stmt1);

        }
    }
?>

