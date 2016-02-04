<?php
	session_start();
	include('inc/db_connection.php');

	
	//$id = $_SESSION['user_id'];
	$email=$_REQUEST['email'];
	$sql = "SELECT email from clients WHERE email='$email'";
	//echo $sql; die;
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	//$row = $result->fetch_assoc();
	//echo "Email Already Exists";
	echo "false";
	}
	else{
	//echo  "Success";
	echo "true";
	}
	die;
	?>