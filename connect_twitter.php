<?php
require "vendor/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;
$host = $_SERVER['HTTP_HOST'];
	if($host == 'localhost'){
	define('SITE_URL', "http://". $host."/darren_offerz/");
	}
	elseif($host == 'betasoftdev.com'){
	define('SITE_URL', "http://". $host."/offerz/");
	}
	else{
	define('SITE_URL', "http://". $host."/");
	}
	$oauth_access_token = "4024026614-YzNlvVqSSGbG3kNR9Nik4aoyKy9zpCugloyVm8H";
    $oauth_access_token_secret = "zJAhBgxyOQQYICCM1o908EVFAPJKQwWkNM6jkmny3rrP7";
    $consumer_key = "LEqoRF6gLyLPxIFlGDjze5xd0"; // For Offerz-develop app
    $consumer_secret = "c0B582T95BFWUUzR2UnOFqWb2RaDQpQ1BH7qPC0aD7w1cf6hVR";
	// echo SITE_URL; die;
//	$connection = new TwitterOAuth($consumer_key, $consumer_secret,$oauth_access_token,$oauth_access_token_secret);
	$connection = new TwitterOAuth($consumer_key, $consumer_secret);
	// $content = $connection->get("account/verify_credentials");
	// print_r($content ); die('eee');
	//$tweets = $connection->get("friends/ids", array("screen_name" => "vishal_betasoft"));
	// Requesting authentication tokens, the parameter is the URL we will be redirected to
	// $request_token = $connection->post('https://api.twitter.com/oauth/request_token');
	//print_r($tweets ); die('ee');
	// $access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => ""));
	// $request_token = $connection->oauth('http://betasoftdev.com/darren/callback.php');
	 $request_token= $connection->oauth('oauth/request_token', array('oauth_callback' => SITE_URL."callback.php"));
	//print_r($access_token );
	 // die('eteee');
 	//if($connection ->http_code==200){
    // Let's generate the URL and redirect
    	$url = $connection->url("oauth/authorize", array("oauth_token" => $request_token['oauth_token']));
   	
    	header('Location: '. $url);
	//} else {
    // It's a bad idea to kill the script, but we've got to know when there's an error.
   // die('Something wrong happened.');
	// }