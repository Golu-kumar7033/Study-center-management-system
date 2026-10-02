 <?php
    require "login/chacklogin.php";
    require "../helper.php";
    require "../database.php";
    $sql = mysqli_query($conn, "SELECT student_email FROM student_info");

    if ($sql) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $email=$row['student_email'] ;
        }
    } else {
        echo "Query failed: " . mysqli_error($conn);

    }

    if(isset($_POST['submit'])){

        $title=$_POST['title'];
        $notification=$_POST['notification'];

        $stmt=mysqli_prepare($conn,"INSERT INTO notifications(title,notification) VALUES(?,?)");
        mysqli_stmt_bind_param($stmt,"ss",$title,$notification);
        mysqli_stmt_execute($stmt);

    $data = [
        "notification" => $notification,
        "year" => date("Y"),
    ];

    // Send notification mail
    sendmail(
        $email,                        
        "Student",                     
        "NOTIFICATION ALERT",          
        "Tamplates/notifications.html",
        $data                         
    );


        
    }


 ?>
<?=require_once "navbar.html";?>
 
        <div class="justify-content-center d-flex align-items-center ">  
            <div class="card  p-4 mt-3 w-50">
                <h2>Create Notifications</h2>
                <form method="POST" action =" ">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="title" placeholder="Title" required>
                    </div>  
                    <div class="mb-3">
                        <textarea name="notification" class="form-control" id="text" placeholder="Notification Discription" rows=5 style="resize:none;"required></textarea>
                    </div>
                   
                    <div class="mb-3 text-center">
                        <button class="btn btn-primary " name="submit">Send Notification</button>
                    </div>          
                    
                </form>
            </div>
        </div> 
   <?=require_once "footer.php"?>