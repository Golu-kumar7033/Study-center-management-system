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



<?php include("footer.php"); ?>






