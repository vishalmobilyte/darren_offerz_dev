<?php
session_start();
include('../inc/db_connection.php');
	
if(isset($_REQUEST['offer_id'])){

// Add Team in database 


$offer_id = $_REQUEST['offer_id'];
// print_r($_POST); die;
if($offer_id){

$sql = "DELETE FROM offers WHERE id='".$offer_id."'";
if ($conn->query($sql) === TRUE) {

$sql_del = "DELETE FROM user_offers WHERE offer_id='".$offer_id."'";
$conn->query($sql_del);
 //$last_team_id = $conn->insert_id;
 echo "success";
// print_r($_SESSION); die;
    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
// echo "Email Sent to ".$to."<br/>"; 
}
// --------------- Email sending done here -------------------
}// End Foreach


$conn->close();
// header("location: ".SITE_URL."home.php?msg=success&action=team_added");
die;

?>