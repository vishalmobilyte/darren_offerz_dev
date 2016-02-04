<?php
if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != ''){
header("location:".SITE_URL."/home.php");
// die('555ee');

} 
if(isset($_POST['submit'])){

$username = $_POST['username'];
$password = $_POST['password']; 
$sql = "SELECT *,DATEDIFF(clients.plan_start_date, CURDATE()) as days_left FROM clients WHERE (username='$username' AND password='$password')  OR (email='$username' AND password='$password') LIMIT 1";

$result = $conn->query($sql);
if ($result->num_rows > 0) {

$row = $result->fetch_assoc();
//print_r($row); die;
$client_id = $row['id'];


$days_left = (int)$row['days_left']; 
// echo $days_left; 
if($days_left < 0 ){
	$_SESSION['flash_msg'] = "Sorry Your Trail Period has been expired!";
// TRAIL PERIOD IS OVER HERE
	$row2 = array();
	
	$stripe_cust_id = $row['stripe_cust_id'];
	$customer = \Stripe\Customer::retrieve($stripe_cust_id);
	$sql2 = "SELECT * FROM subscriptions WHERE client_id='".$client_id."' LIMIT 1" ;
	$result2 = $conn->query($sql2);
	
	$row2 = $result2->fetch_assoc();
	
	if(count($row2) > 0){
	// Check Status here of the subcription 
	$subc_id = $row2['subc_id'];
	$subscription = $customer->subscriptions->retrieve($subc_id);
	$subc_status = $subscription['status']; //active

	if($subc_status == 'active2'){
	//die('eee');
	$_SESSION['user_id']=$row['id'];
	$_SESSION['flash_msg'] = "Sorry! Your subscription payment was failed.";
	header("location:".SITE_URL."/home.php");
	}
	}
	
	$encode_client_id = base64_encode($row['id']);
	//print_r($_SESSION);die;
	header("location:".SITE_URL."/stripe_pay.php?msg=failed&id=$encode_client_id");
	}
	else{
	
	$_SESSION['user_id']=$row['id'];
	header("location:".SITE_URL."/home.php");
	}
$conn->close();

}
else{
//die('eee');
$_SESSION['flash_msg'] = "Invalid Username/Password!";
header("location:".SITE_URL."/login.php?msg=failed");

//echo "Sorry! Invalid credentials.";
}
}

// print_r($_SESSION); 

//require_once('inc/header.php');

?>