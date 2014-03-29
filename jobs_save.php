<?php
date_default_timezone_set('America/Los_Angeles');
if (isset($_POST['submit'])) :

	require_once('MysqliDb.php');
	require_once('credentials.php');

	require_once('stripe/lib/Stripe.php');
	Stripe::setApiKey($stripeKey);

	// echo "<pre>";
	// var_dump($_POST);
	// echo "</pre>";

	$features = 0;
	foreach($_POST['features'] as $feature) {
		if ($feature==0) {
			$features += 1000;
		}
		else if ($feature==1) {
			$features += 100;
		}
		else if ($feature==2) {
			$features += 10;
		}
		else if ($feature==3) {
			$features += 1;
		}
	}

	$features = 0;
	foreach($_POST['features'] as $feature) {
		if ($feature==0) {
			$features += 1000;
		}
		else if ($feature==1) {
			$features += 100;
		}
		else if ($feature==2) {
			$features += 10;
		}
		else if ($feature==3) {
			$features += 1;
		}
	}

	$types = 0;
	foreach($_POST['type'] as $type) {
		if ($type==0) {
			$types += 1000;
		}
		else if ($type==1) {
			$types += 100;
		}
		else if ($type==2) {
			$types += 10;
		}
		else if ($type==3) {
			$types += 1;
		}
	}

	// location
	if ($_POST['location']=='0') {
		$_POST['location'] = $_POST['location_onsite'];
	}

	// email
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$email = 'Invalid email';
	}
	else {
		$email = $_POST['email'];
	}

	if (!empty($_POST['stripe_token'])) {
		$charge = Stripe_Charge::create(array(
		  "amount" => $stripeAmount,
		  "currency" => "usd",
		  "card" => $_POST['stripe_token'], // obtained with Stripe.js
		  "description" => "30 day listing on CryptoJobs.io"
		));
		$payment_id = $charge['id'];
	}
	else {
		$payment_id = 'reddit';
	}

	$insertData = array(
		'title' => $_POST['title'],
		'date' => date('Y-m-d H:i:s'),
		'description' => $_POST['description'],
		'expiration' => '0',
		'status' => '0',
		'features' => $features,
		'location' => $_POST['location'],
		'type' => $types,
		'payment_id' => $payment_id,
		'email' => $email		
	);
	$results = $db->insert('jobs', $insertData);

	header('Location: /');

endif;
?>