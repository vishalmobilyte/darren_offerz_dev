<?php
session_start();
include('../inc/db_connection.php');
	
	
if(isset($_POST['content_query'])){

// Add Team in database 


$content_query = $_POST['content_query'];
$client_id = $_SESSION['user_id'];

// print_r($_POST); die;
if($content_query){

 // ---------- Email Send to Invite emails -----------
$to = 'viskumar@betasoftsystems.com';
$subject = "Offerz Client Query";

$message = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<h2>Query Submitted by Client:</h2>
<table>

<tr><td>".$content_query."</td></tr>
</table>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <mailer@betasoftdev.com>' . "\r\n";

if(mail($to,$subject,$message,$headers)){
// Insert in client_queries table to save in database
$sql = "INSERT INTO client_queries (content_query, client_id)
VALUES ('$content_query', $client_id)";

if ($conn->query($sql) === TRUE) {
 //$last_team_id = $conn->insert_id;
 
// print_r($_SESSION); die;
    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
// echo "Email Sent to ".$to."<br/>"; 
}
// --------------- Email sending done here -------------------
}

$conn->close();
// header("location: ".SITE_URL."home.php?msg=success&action=team_added");
echo "success"; die;
}
?>