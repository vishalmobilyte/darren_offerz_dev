<?php
include('../inc/db_connection.php');
$sel_mem_details = "SELECT *, DATEDIFF(offers.valid_upto, CURDATE()) as days_left FROM offers";

$result = $conn->query($sql2);


	if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()){
	if($row['days_left'] == '0'){
	
	$team_id=$row['team_id'];
	$editable_text=$row['editable_text'];
	

// Get email of team member to whom we will send offer

$sql2 = "SELECT * FROM invites WHERE team_id = ".$team_id;
$result2 = $conn->query($sql2);


	if ($result2->num_rows > 0) {
	while($row2 = $result2->fetch_assoc()){
		$email_to = $row2['email'];

		$to = $email_to;
		$subject = "Offer Details";

		$message = "
		<html>
		<head>
		<title>Offer Detail</title>
		</head>
		<body>
		<h2>Offer Started</h2>
		<table>

		<tr>
		<td>Hi $to ,</td>
		</tr>
		<tr><td>Offer has been started.Below are the details of offer.</td></tr>
		<tr><td>".$editable_text".</td></tr>
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
		// echo "Email Sent to ".$to."<br/>"; 
		}
		// --------------- Email sending done here -------------------

		}
		}
		}
		}
		}
		
		?>