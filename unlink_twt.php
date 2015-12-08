<?php
	session_start();
	include('inc/db_connection.php');
	$id = $_SESSION['user_id'];
	$sql = "UPDATE clients SET 
		oauth_token = '', 
		oauth_secret_token = '',
		screen_name = '',
		twitter_id = ''
		WHERE id='$id'";
		// echo $sql; die;
		if ($conn->query($sql) === TRUE) {
		if(isset($_SESSION['user_role']) && $_SESSION['user_role'] =='2'){
		
		header("location: admin/index.php");
		}
		else{
		header("location: home.php?msg=success");
		}
		// print_r($_SESSION); die;
			echo "Congratulations!! You have been registered successfully!";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
?>