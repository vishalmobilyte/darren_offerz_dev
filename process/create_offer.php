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
$team_id= $_POST['team_id'];
$editable_text= $_POST['editable_text'];
$not_editable_text= $_POST['not_editable_text'];
$start_date= $_POST['start_date'];
$date_send_on=$_POST['date_send_on'];
$client_id= $client_id;

if(isset($_POST['image_name']) && !empty($_POST['image_name'])){
$image_name= $_POST['image_name'];
}
else{
$image_name= "";
}
$sql = "INSERT INTO offers (team_id, editable_text, not_editable_text, image_name,start_date, date_send_on, client_id)
VALUES ('$team_id', '$editable_text', '$not_editable_text', '$image_name','$start_date','$date_send_on', '$client_id')";
// echo $sql; die;
if ($conn->query($sql) === TRUE) {
 $last_offer_id = $conn->insert_id;
 
// print_r($_SESSION); die;
   
} else {
  //  echo "Error: " . $sql . "<br>" . $conn->error;
}
//print_r($_POST); die;
// GET EMAILS OF USERS OF TEAM


$sql2 = "SELECT * FROM invites WHERE team_id = ".$team_id." AND is_accepted=1";
$result2 = $conn->query($sql2);


if ($result2->num_rows > 0) {
while($row2 = $result2->fetch_assoc()){
$user_id = getIdByEmail($row2['email']);
if(!empty($user_id)){
// Enter a record in Db 
$qry_enter_user_offer = "INSERT INTO user_offers (offer_id, user_id,client_id)
VALUES ('$last_offer_id', '$user_id', '$client_id')"; 
$conn->query($qry_enter_user_offer);

}
}
}

$conn->close();
$_SESSION['flash_msg'] = "Offer Added Successfully!";
header("location: ".SITE_URL."home.php?msg=success&action=offer_added");
}

?>