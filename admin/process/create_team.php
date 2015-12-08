<?php
ini_set('display_errors','-1');
session_start();
include('../inc/db_connection.php');
	
// die('--eeee--');
if(!isset($_SESSION['user_id']) && $_SESSION['user_id'] == ''){

	header("Location:".SITE_URL."/login.php");
} 
if(isset($_POST['submit'])){

	// Add Team in database 
	$team_name= $_POST['team_name'];
	$client_id = $_SESSION['user_id'];
	$sql = "INSERT INTO teams (name, client_id)
	VALUES ('$team_name', $client_id)";

	if ($conn->query($sql) === TRUE) {
		$last_team_id = $conn->insert_id;
	 
	// print_r($_SESSION); die; 
	} else {
	  //  echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$invite_email = $_POST['invite_emails'];
	if($invite_email){

	foreach($invite_email as $key=>$email){
	 // ---------- Email Send to Invite emails -----------
	// -------- Check Email of Mobile App user already exists in db or not --------- -->
		$sql_chk_mbl_email = "SELECT email from clients WHERE email='$email'";
		//echo $sql; die;
		$result = $conn->query($sql_chk_mbl_email);

		if ($result->num_rows > 0) {
		// Email for invitation on app will not be sent in this case
		}
		else{
		send_invite_email($email); // Send email to join app.
		}
		// Insert a record in db that invitation has been sent to this user wheter he exists in db or not
		
		$team_id = $last_team_id;
		$sql = "INSERT INTO invites (email, team_id)
		VALUES ('$email', $team_id)";

		if ($conn->query($sql) === TRUE) {
		 //$last_team_id = $conn->insert_id;

		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
	}// End Foreach
	}

	$conn->close();
	$_SESSION['flash_msg'] = "Team Added Successfully!";
	header("location: ".SITE_URL."admin/index.php?msg=success&action=team_added");
}

	function send_invite_email($email){
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
	//$headers .= 'Cc: viskumar@betasoftsystems.com' . "\r\n";

	mail($to,$subject,$message,$headers);
}

?>