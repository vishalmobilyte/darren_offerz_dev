<?php
ini_set('display_errors','-1');
session_start();
include('../inc/db_connection.php');
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
	
	// Check already member of Sponsor/Client or not
	
		$is_accepted = "0";
		$get_user_client_realtion = chkUserClientRel($email, $client_id);
		//print_r($get_user_client_realtion); die;
		if($get_user_client_realtion){
		if($get_user_client_realtion['request_status'] == '1'){
		$is_accepted = "1";
		}
		
		}
		else{
		$user_client_rel_qry = "INSERT INTO users_clients_relation SET user_email= '$email', client_id='$client_id'";
		//echo $sql; die;
		$result = $conn->query($user_client_rel_qry);

	}
	
	 // ---------- Email Send to Invite emails -----------
	// -------- Check Email of Mobile App user already exists in db or not --------- -->
		$sql_chk_mbl_email = "SELECT email from users WHERE email='$email'";
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
		$chk_already_team_member = chkTeamMemAlreadyExists($email,$team_id);
		if($chk_already_team_member < 1){
		
			$sql = "INSERT INTO invites (email,is_accepted, team_id)
			VALUES ('$email', '$is_accepted', $team_id)";

			if ($conn->query($sql) === TRUE) {
			 //$last_team_id = $conn->insert_id;

			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
	}// End Foreach
	}

	$conn->close();
	$_SESSION['flash_msg'] = "Team Added Successfully!";
	header("location: ".SITE_URL."home.php?msg=success&action=team_added");
}

	function send_invite_email($email){
	$to = $email;
	$subject = "Invitation Email- Offerz";

	$message = "
	<html>
	<head>
	<title>Invitation Email- Offerz</title>
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

function chkUserClientRel($user_email,$client_id){
	global $conn;
	$sql = "SELECT * FROM users_clients_relation WHERE user_email='".$user_email."' AND client_id=".$client_id." LIMIT 1" ;
	$result = $conn->query($sql);

	$row = "";
	if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	}
//	print_r($row); die;
	
	return $row;

}

function chkTeamMemAlreadyExists($email,$team_id){
	global $conn;
	 $client_by_team_id_qry = "SELECT id FROM invites WHERE email='$email' AND team_id=$team_id";
		//echo $sql; die;
	$client_by_team_id_qry_result = $conn->query($client_by_team_id_qry);
	$rows = $client_by_team_id_qry_result->num_rows;
//	print_r($row); die;
	
	return $rows;
}
?>