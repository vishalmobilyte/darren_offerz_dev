<?php
/*
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$host = $_SERVER['HTTP_HOST'];

// print_r($_SERVER); die;
$req_uri = explode('/',$_SERVER['REQUEST_URI']);

	if($host == 'localhost'){
	
	$proj_folder = $req_uri[1];
	}
	elseif($host == 'betasoftdev.com'){
	$proj_folder = $req_uri[1];
	}
	else{
	$proj_folder = '';
	}
	*/
require 'vendor/autoload.php';
// ini_set('display_errors','-1');
use Abraham\TwitterOAuth\TwitterOAuth;

	//session_start();
	//include('../inc/db_connection.php');

	$oauth_access_token = $get_user_data['oauth_token'];
	$oauth_access_token_secret = $get_user_data['oauth_secret_token'];
	$consumer_key = "LEqoRF6gLyLPxIFlGDjze5xd0";
	$consumer_secret = "c0B582T95BFWUUzR2UnOFqWb2RaDQpQ1BH7qPC0aD7w1cf6hVR";
	$connection_tw = new TwitterOAuth($consumer_key, $consumer_secret,$oauth_access_token , $oauth_access_token_secret );
	
	
	function getTweetsCount($screen_name=""){
	global $connection_tw;
	$tweets = $connection_tw->get("statuses/user_timeline",array("screen_name"=>$screen_name,"count"=>5000));
	return count($tweets);
	//print_r($tweets); die('--');
	}
	
	function getFollowersCount($screen_name=""){
	
	global $connection_tw;
	$followers = $connection_tw->get("followers/ids",array("screen_name"=>$screen_name));
	// print_r($followers); die('--');
	return count(@$followers->ids);
	}
	
	function getRetweetsCount($screen_name=""){
	global $connection_tw;
	$followers = $connection_tw->get("statuses/retweets_of_me",array("screen_name"=>$screen_name));
	return count(@$followers);
	//print_r($tweets); die('--');
	}
	function getfavoritesCount($screen_name=""){
	global $connection_tw;
	$followers = $connection_tw->get("favorites/list",array("screen_name"=>$screen_name));
	return count(@$followers);
	//print_r($tweets); die('--');
	}
	
	function getUserTimeline($screen_name=""){
	global $connection_tw;
	//echo $screen_name.'--';
	$obj = $connection_tw->get("statuses/user_timeline",array("screen_name"=>$screen_name,"count"=>'1'));
	//print_r($obj[0]); die;
	return $obj[0];
	//print_r($tweets); die('--');
	}
	
	
	?>