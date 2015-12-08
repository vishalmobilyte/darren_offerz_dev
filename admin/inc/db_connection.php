<?php
	$DbName      = 'darren_offerz' ; 
    $DbHost      = 'localhost';
    $DbUser      = 'root' ; 
    $DbPassword  = '';
	
	// Create connection
$conn = new mysqli($DbHost, $DbUser, $DbPassword,$DbName);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
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
	// echo SITE_URL; die;
   // $Connection = mysqli_connect($DbHost, $DbUser, $DbPassword,$DbName);
    // mysqli_query("set names 'UTF8'") or die(mysqli_error());
  
	//print_r($Connection); die;
	//$mResult = mysql_query( $fQuery, $this->mConnection);
	?>