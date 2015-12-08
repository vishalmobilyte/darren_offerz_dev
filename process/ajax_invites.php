<?php
session_start();
include('../inc/db_connection.php');
	
if(isset($_POST['team_id'])){

// Add Team in database 


$invite_email = $_POST['invite_emails'];
$team_id = $_POST['team_id'];
// print_r($_POST); die;
if($invite_email){
foreach($invite_email as $key=>$email){
 // ---------- Email Send to Invite emails -----------
$to = $email;
$subject = "Offerz Invitation";

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
$headers .= 'Cc: viskumar@betasoftsystems.com' . "\r\n";

if(mail($to,$subject,$message,$headers)){
$email = $to;
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
// header("location: ".SITE_URL."home.php?msg=success&action=team_added");
echo "success"; die;
}
?>