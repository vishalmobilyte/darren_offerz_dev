<?php
include('../inc/config.php');
// echo SITE_URL; die;
session_destroy(); 
session_start();
$_SESSION['flash_msg'] = "Logged Out Successfully!";
//print_r($_SESSION); die;
header("Location:".SITE_URL."/login.php?msg=success");
?>