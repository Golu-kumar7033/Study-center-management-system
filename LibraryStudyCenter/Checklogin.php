<?php
session_start();
if(!array_key_exists('user',$_SESSION)){
    header("Location:../login.php");
}


?>