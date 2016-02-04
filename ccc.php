<?php

require_once('vendor_old/autoload.php');

$stripe = array(
  "secret_key"      => "sk_test_cmu0gkmiIWbUpW2ySzeO3GID",
  "publishable_key" => "pk_test_bFubBv10bNTCUP6RYvzWryaW"
);

\Stripe\Stripe::setApiKey($stripe['secret_key']);




  $customer = \Stripe\Customer::create(array(
      'email' => 'vishalj12253@example.com'
      
  ));
  echo $customer->id;
  print_r($customer['id']); die('--');
/*
  $charge = \Stripe\Charge::create(array(
      'customer' => $customer->id,
      'amount'   => 5000,
      'currency' => 'usd'
  ));
*/
  echo '<h1>Successfully charged $50.00!</h1>';
?>


