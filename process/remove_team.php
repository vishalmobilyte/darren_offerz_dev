<?php
session_start();
include('../inc/db_connection.php');
	
if(isset($_REQUEST['team_id'])){

// Add Team in database 


$team_id = $_REQUEST['team_id'];
// print_r($_POST); die;
if($team_id){
$time= time();
$sql = "UPDATE teams SET is_deleted='$time' WHERE id='".$team_id."'";
if ($conn->query($sql) === TRUE) {


    
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