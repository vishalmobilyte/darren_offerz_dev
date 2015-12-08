<?php
ini_set('display_errors','-1');
session_start();
include('../inc/db_connection.php');
	
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

$invite_email = $_POST['invite_emails'];
if($invite_email){
foreach($invite_email as $key=>$email){
 // ---------- Email Send to Invite emails -----------
$to = $email;
$subject = "HTML email";

$message = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<h2>Invitation to Join Offerz App</h2>
<table>

<tr>
<td>Hi $email ,</td>
</tr>
<tr><td>Please follow our app.</td></tr>
</table>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <mailer@betasoftdev.com>' . "\r\n";
// 	$headers .= 'Cc: viskumar@betasoftsystems.com' . "\r\n";

if(mail($to,$subject,$message,$headers)){
$email = $to;
$team_id = $last_team_id;
$sql = "INSERT INTO invites (email, team_id)
VALUES ('$email', $team_id)";

if ($conn->query($sql) === TRUE) {
 //$last_team_id = $conn->insert_id;
 
// print_r($_SESSION); die;
    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
// echo "Email Sent to ".$to."<br/>"; 
}
// --------------- Email sending done here -------------------
}// End Foreach
}

$conn->close();
$_SESSION['flash_msg'] = "Offer Added Successfully!";
header("location: ".SITE_URL."admin/index.php?msg=success&action=offer_added");
}

?>