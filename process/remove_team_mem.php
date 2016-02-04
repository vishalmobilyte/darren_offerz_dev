<?php
session_start();
include('../inc/db_connection.php');
	
if(isset($_REQUEST['team_id'])){

// Add Team in database 


$team_id = $_REQUEST['team_id'];
$user_email = $_REQUEST['user_email'];
// print_r($_POST); die;
if($user_email){

$sql = "DELETE FROM invites WHERE email='".$user_email."' AND team_id='".$team_id."'";
if ($conn->query($sql) === TRUE) {
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