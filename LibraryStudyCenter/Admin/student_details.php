 <?php
     require "login/chacklogin.php";
     require "../database.php";
 ?>

<?php include("navbar.html"); ?>
<?php
$sid=(int)$_GET['id'];
$stmt=mysqli_prepare($conn,"SELECT* FROM student_info WHERE student_id =?");
mysqli_stmt_bind_param($stmt,"i",$sid);
mysqli_stmt_execute($stmt);
$result=mysqli_stmt_get_result($stmt);
$row=mysqli_fetch_assoc($result);
$name= $row['student_name'];
$email= $row['student_email'];
$phone= "+91-".$row['student_phone'];
$dob= $row['student_dob'];
$gender= $row['student_gender'];
$idtype= $row['identity_type'];
$id= $row['student_id_proof'];
$crossponding_address= $row['corresponding_address'];
$tem_city= $row['tem_city'];
$tem_state= $row['tem_state'];
$tem_pincode= $row['tem_pincode'];
$parmanent_address= $row['permanent_address'];
$p_city= $row['p_city'];
$p_state= $row['p_state'];
$p_pincode= $row['p_pincode'];
$img= $row['student_image'];

$ext = strtolower(pathinfo($id, PATHINFO_EXTENSION));


?>


<main class="student_data " style="margin-top:100px">
    <div class="data ">
        
        <div class="student-card  mb-5">
            <h2>Student Personal Details</h2>

            <div class="table-reponshive">
                <table class="table table-bordered align-middle">

                <tr>
                    <td class="label">Student Name</td>
                    <td colspan="2"><?=$name?></td>

                    <td rowspan="5" width="200" class="text-center">
                        <div class="photo-box">
                            <img src='../ImgUploads/<?=$img?>'width='200' class='rounded' id='studentimg' alt='Student Photo'>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="label">Email</td>
                    <td ><?= $email?></td>
                </tr>

                <tr>
                    <td class="label">Phone NO</td>
                     <td ><?=$phone?></td>
                </tr>

                <tr>
                    <td class="label">Date of Birth</td>
                    <td><?=$dob?></td>
                </tr>

                <tr>
                    <td class="label">Gender</td>
                    <td><?=$gender?></td>
                </tr>

                <tr>
                    <td class="label">Id Proof</td>
                    <td colspan="6" class="d-flex gap-3" >
                        <?=$idtype?>  
                        <a href='../uploads/<?=$id?>' target="_blank" download> View</a>
                    </td>  

                </tr>

                <tr>
                    <td class="label">Local Address</td>
                    <td colspan="4"><?=$crossponding_address?></td>
                </tr>                   

                <tr>
                    <td class="label"> Parmanent Address</td>
                    <td colspan="4">
                        <?=$parmanent_address?>
                    </td>
                </tr>

            </table>
            </div>

        </div>



        
    </div>

</main>

<?php include("footer.php"); ?>

<style>





