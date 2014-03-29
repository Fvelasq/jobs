<?php 
session_start(); 
require_once('MysqliDb.php');
require_once('credentials.php');
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head> 
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Cryptography Job Board</title>
<meta name="title" content="Cryptography Job Board">
<meta name="title" description="Connecting cryptographers and security experts with tech jobs since March 2014. Find or post a job today.">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href='http://fonts.googleapis.com/css?family=Ubuntu+Mono:400,700,400italic,700italic|Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootswatch/3.1.1/lumen/bootstrap.min.css">
<link rel="stylesheet" href="/css/main.css">

<!--[if lt IE 9]>
<script src="js/vendor/html5-3.6-respond-1.1.0.min.js"></script>
<![endif]-->
</head>
<body id="page-home">
<!--[if lt IE 7]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
<div class="container">
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="/">CryptoJobs<span>.io</span></a>
</div>
<div class="navbar-collapse collapse">
<ul class="nav navbar-nav navbar-right">
<li><a href="//twitter.com/jasonstockman"><i class="fa fa-twitter"></i></a></li>
<li><a href="&#109;&#097;&#105;&#108;&#116;&#111;:&#104;&#101;&#108;&#108;&#111;&#064;&#106;&#097;&#115;&#111;&#110;&#115;&#116;&#111;&#099;&#107;&#109;&#097;&#110;&#046;&#099;&#111;&#109;"><i class="fa fa-envelope"></i></a></li>
</ul>
<a href="/new/" class="navbar-right btn navbar-btn btn-success">POST A JOB</a>
</div><!--/.navbar-collapse -->
</div>
</div>

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
<div class="container text-center">
<h1>CryptoJobs</h1>
<p class="lead">Connecting freelance and full-time cryptographers with tech jobs since March, 2014.</p>
</div>
</div>

<div class="container">
<!-- Example row of columns -->

<?php 
if (isset($_POST['password'])&&($_POST['password']==$_SESSION['password'])) {
	$_SESSION['logged']='true';}
?>
<?php if ($_SESSION['logged']!='true') : ?>
	<div class="row">
	<form class="form col-md-4 col-md-offset-4" action="admin.php" method="post">
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" name="password" class="form-control" id="password" placeholder="Password">
		</div>
		<button type="submit" class="btn btn-primary btn-block">Submit</button>
	</form>
	</div>

<?php else : ?>

<table class="table">
<thead>
<tr>
<th></th>
<th>Date</th>
<th>Title</th>
<th>Coupon</th>
<th></th>
</tr>
</thead>
<tbody id="listings">
<?php
date_default_timezone_set('America/Los_Angeles');
$jobs = $db->get('jobs', 100);
$jobs_table = '';
$index = 1;

if (count($jobs) == 0) {
	echo "<tr><td colspan='5'><div class='alert alert-warning'>No listings.</div></td></tr>";
	exit();
}
foreach ($jobs as $job) {

	if ($job['status']=='0') {
		$jobs_table .= "<tr class='link dead' data-index='".$index."'>";
		$jobs_table .= "<td><i class='fa fa-circle-o'></i></td>";
	}
	else {
		$jobs_table .= "<tr class='link' data-index='".$index."'>";
		$jobs_table .= "<td><i class='fa fa-circle'></i></td>";
	}
	$jobs_table .= "<td>".date("M t", strtotime($job['date']))."</td>";
	$jobs_table .= "<td><strong>".$job['title']."</strong></td>";

	// Admin actions
	$jobs_table .= "<td><form method='post' action='admin_do.php'>";
	$jobs_table .= "<input type='hidden' name='id' value='".$job['id']."'>";
	$jobs_table .= "<button type='submit' value='1' name='activate' class='btn btn-xs btn-success'>Enable</button> ";
	$jobs_table .= "<button type='submit' value='1' name='disable' class='btn btn-xs btn-danger'>Disable</button>";
	$jobs_table .= "</form></td>";

	$jobs_table .= "<td>";
	$jobs_table .= "<code>".$job['payment_id']."</code>";
	$jobs_table .= "</td>";

	$jobs_table .= "</tr>";
	$jobs_table .= "<tr class='nope more' id='row_".$index."'>";
	$jobs_table .= "<td colspan='5'><div class='content'><p>";
	$jobs_table .= "<p>".$job['description']."</p>";
	$jobs_table .= "<p><a href='&#109;&#097;&#105;&#108;&#116;&#111;:".$job['email']."' class='btn btn-success'>Contact</a></p>";
	$jobs_table .= "</div></td>";
	$jobs_table .= "</tr>";

	++$index;

}
echo $jobs_table;
?>
</tbody>

</table>

<?php endif; ?>

<hr>

<footer>
<p>Created with <i class="fa fa-coffee"></i> and <i class="fa fa-heart"></i> in a day by <a href="//twitter.com/jasonstockman">@JasonStockman</a>.</p>
</footer>
</div> <!-- /container -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.0.min.js"><\/script>')</script>

<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

<script src="/js/admin.js"></script>

<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-40216551-2', 'cryptojobs.io');
  ga('send', 'pageview');

</script>
</body>
</html>