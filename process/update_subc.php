<?php

//print_r($_REQUEST); 
if(isset($_REQUEST['stripeToken'])){
$client_id = $_REQUEST['client_id'];
$stripe_cust_id = GetUserFieldById($client_id,'stripe_cust_id');
$plan_id = GetUserFieldById($client_id,'plan_id');

//$stripe_cust_id = 'cus_7cDwem3czpbNTY';
$token = $_REQUEST['stripeToken'];

$plan_name = 
$customer = \Stripe\Customer::retrieve($stripe_cust_id);
$get_subs_detail = getSubcDetail($client_id);
$get_plan_detail = getPlanDetail($plan_id);

$plan_title = $get_plan_detail['plan_title'];
$plan_name = $get_plan_detail['plan_name'];
$plan_price = $get_plan_detail['price'];

$subc_id = $get_subs_detail['subc_id'];

$subscription = $customer->subscriptions->retrieve($subc_id);
print_r($subscription['status']); //active


/*
//print_r($customer); die('dd');
$customer->description = "Customer for test@example.com";
$customer->source = $token; // obtained with Stripe.js
$customer->subscriptions->create(array("plan" => "corprate"));

$customer->save();
//print_r($customer->subscriptions->data);
//echo "-->".$customer->subscriptions->data[0]->id."--";
$subc_id = $customer->subscriptions->data[0]->id;
$status = $customer->subscriptions->data[0]->status;


//$customer->sources->create(array("source" =>$token));
//print_r($customer); die('--oo--oo--');

// Insert transaction detail in database
$sql="INSERT INTO subscriptions
						SET 
						subc_id='$subc_id',
						status='$status',
						client_id='$client_id'";
$result=mysqli_query($conn,$sql);
		
print_r($customer->subscriptions);

// Update the client table payment status
*/
die('--Response here from stripe--');
}



?>