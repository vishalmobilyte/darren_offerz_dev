<?php
ini_set('display_errors','-1');
session_start();
include('../inc/db_connection.php');
include('../inc/functions.php');
	
// die('--eeee--');
if(!isset($_SESSION['user_id']) && $_SESSION['user_id'] == ''){

header("Location:".SITE_URL."/login.php");
} 
if(isset($_POST['submit'])){

$client_id = $_SESSION['user_id'];
// Add Team in database 
//print_r($_POST); die;

$offer_id= $_POST['offer_id'];
$editable_text= $_POST['editable_text'];
$not_editable_text= $_POST['not_editable_text'];


if(isset($_POST['image_name']) && !empty($_POST['image_name'])){
$image_name= $_POST['image_name'];
$image_name_update = "image_name='$image_name',";
}
else{
$image_name= "";
$image_name_update = "";
}
$sql = "UPDATE offers SET editable_text = '$editable_text', $image_name_update not_editable_text ='$not_editable_text' WHERE id=$offer_id";
// echo $sql; die;
if ($conn->query($sql) === TRUE) {
 $last_offer_id = $conn->insert_id;
 
// print_r($_SESSION); die;
   
} else {
  //  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
$_SESSION['flash_msg'] = "Offer Updated Successfully!";
header("location: ".SITE_URL."home.php?msg=success&action=offer_updated");
}

?>