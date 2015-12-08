<?php
require "vendor/autoload.php";
// ini_set('display_errors','-1');
use Abraham\TwitterOAuth\TwitterOAuth;

	session_start();
	include('inc/db_connection.php');
	
	if(isset($_REQUEST['oauth_verifier'])){
	
	$oauth_access_token = $_REQUEST['oauth_token'];
	$oauth_access_token_secret = $_REQUEST['oauth_verifier'];
	$consumer_key = "LEqoRF6gLyLPxIFlGDjze5xd0";
	$consumer_secret = "c0B582T95BFWUUzR2UnOFqWb2RaDQpQ1BH7qPC0aD7w1cf6hVR";
	$connection = new TwitterOAuth($consumer_key, $consumer_secret,$oauth_access_token , $oauth_access_token_secret );
	
	$access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $oauth_access_token_secret));
	$screen_name = $access_token['screen_name'];
	$oauth_token = $access_token['oauth_token'];
	$oauth_secret_token = $access_token['oauth_token_secret'];
	$twitter_id = $access_token['user_id'];
//	print_r($_SESSION);
//	print_r($access_token);
	
	$id = $_SESSION['user_id'];
	$sql = "UPDATE clients SET 
		oauth_token = '$oauth_token', 
		oauth_secret_token = '$oauth_secret_token',
		screen_name = '$screen_name',
		twitter_id = '$twitter_id'
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

	
	}

	?>