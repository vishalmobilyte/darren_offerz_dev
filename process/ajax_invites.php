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
		
		$chk_already_team_member = chkTeamMemAlreadyExists($email,$team_id);
		if($chk_already_team_member < 1){
		
		$get_client_id = getClientIdByTeamId($team_id);
	//	print_r($get_client_id); die;
		$client_id = $get_client_id['client_id'];
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
	

	$sql = "INSERT INTO invites (email, is_accepted, team_id)
	VALUES ('$email','$is_accepted', $team_id)";
	
	if ($conn->query($sql) === TRUE) {
	 //$last_team_id = $conn->insert_id;
	 
	// print_r($_SESSION); die;
		
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

 // ---------- Email Send to Invite emails -----------
if($is_accepted == '1'){

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

// echo "Email Sent to ".$to."<br/>"; 
}
// --------------- Email sending done here -------------------
}
} // End Already exist check
}// End Foreach
}

$conn->close();
// header("location: ".SITE_URL."home.php?msg=success&action=team_added");
echo "success"; die;
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

function getClientIdByTeamId($team_id){
	global $conn;
	 $client_by_team_id_qry = "SELECT * FROM teams WHERE id='$team_id'";
		//echo $sql; die;
	$client_by_team_id_qry_result = $conn->query($client_by_team_id_qry);
	$row = "";
	if ($client_by_team_id_qry_result->num_rows > 0) {
	$row = $client_by_team_id_qry_result->fetch_assoc();
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