<?php

// host, username, password, table
$db = new MysqliDb('localhost', 'username', 'password', 'table');

// password for admin.php login
$_SESSION['password'] = 'password';

// stripe secret key
$stripeKey = "sk_live_XXXXXXXXXXXXXXXXXXXXXXXXX";

// amount in cents
$stripeAmount = 1200;

?> 