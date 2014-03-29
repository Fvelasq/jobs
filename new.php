<?php 
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
<title>Post a Job</title>
<meta name="title" content="Cryptography Job Board">
<meta name="description" description="Post a new job opening in seconds. Instant approval.">
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
<body>
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

<div class="jumbotron">
<div class="container text-center">
<h1>$12 for 30 days</h1>
<p class="lead">Connect with Cryptography Experts.</p>
</div>
</div>

<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<form id="form" class="form" method="post" action="/jobs_save.php">
<div class="form-group">
<label for="new_job_title">Job Title</label>
<input  id="new_job_title" required name="title" class="form-control" type="text">
</div><!--/.form-group-->
<div class="form-group">
<label for="new_job_email">Email</label>
<input  id="new_job_email" required name="email" class="form-control" type="email">
</div><!--/.form-group-->
<div class="form-group">
<label for="new_job_description">Job Description</label>
<textarea  id="new_job_description" required name="description" class="form-control" rows="6"></textarea>
</div><!--/.form-group-->
<p class="form-helper alert alert-info" id="description_helper">Make sure to include a way for people to contact you via email, url or phone.</p>
<div class="form-group">
<label for="new_job_title">Features</label><br>
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-default">
<input type="checkbox" name="features[]" value="0">
<i class="fa fa-plane fa-border"></i> Relocation Costs Covered
</label>
<label class="btn btn-default">
<input type="checkbox" name="features[]" value="1">
<i class="fa fa-dollar fa-border"></i> Equity Offered
</label>
<label class="btn btn-default">
<input type="checkbox" name="features[]" value="2">
<i class="fa fa-github fa-border"></i> Open-Source
</label>
<label class="btn btn-default">
<input type="checkbox" name="features[]" value="3">
<i class="fa fa-heart fa-border"></i> Non-Profit
</label>
</div>          
</div><!--/.form-group-->
<div class="form-group">
<label>Location</label><br>
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-default" id="new_job_location_onsite_btn">
<input type="radio" name="location" value="0">
<i class="fa fa-map-marker fa-border"></i> Onsite
</label>
<label class="btn btn-default" id="new_job_location_remote_btn">
<input type="radio" name="location" value="1">
<i class="fa fa-rss fa-border"></i> Remote
</label>
</div>
<div id="new_job_location_onsite" class="well">
<label for="new_job_location">Onsite Location</label>
<input id="new_job_location" name="location_onsite" class="form-control" type="text">
<p class="help-block">City, State</p>
</div>
</div><!--/.form-group-->
<div class="form-group">
<label for="new_job_title">Type</label><br>
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-default">
<input type="radio" name="type[]" value="0"> Full-time
</label>
<label class="btn btn-default">
<input type="radio" name="type[]" value="1"> Part-time
</label>
<label class="btn btn-default">
<input type="radio" name="type[]" value="2"> Contract
</label>
<label class="btn btn-default">
<input type="radio" name="type[]" value="3"> Freelance
</label>
</div>
</div><!--/.form-group-->
<div class="form-group">
<label for="new_job_promo">Promotional Code</label>
<input  id="new_job_promo" name="promo" class="form-control" type="text">
</div><!--/.form-group-->
<hr>
<div class="form-group text-right well">
<input type="hidden" name="stripe_token" id="stripe_token" />
<script src="https://checkout.stripe.com/checkout.js"></script>
<button type="button" id="payment-button" name="submit" class="btn btn-primary btn-lg"><i class="fa fa-shopping-cart"></i> Pay and Finish</button>
<button type="submit" id="checkout" name="submit" class="btn btn-primary btn-lg"><i class="fa fa-chevron-right"></i> Submit Posting!</button>
</div>
</form>
</div>
</form>
</div><!--/.form-group-->
<hr>
<footer>
<p>Created with <i class="fa fa-coffee"></i> and <i class="fa fa-heart"></i> in a day by <a href="//twitter.com/jasonstockman">@JasonStockman</a>.</p>
</footer>
</div> <!-- /container -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script src="/js/main.js"></script>
<script type="text/javascript">
var handler = StripeCheckout.configure({
	key: 'pk_live_rmIGPrC5j7ZQ01sNUm3sQVO6',
	token: function(token, args) {
		$('#stripe_token').val(token.id);
		$('#checkout').trigger('click');
	}
});
$('#payment-button').on('click', function(e) {
	if ( $('#new_job_promo').val().toLowerCase().trim()!='reddit' ) {
	handler.open({
		name: 'CryptoJobs',
		description: '30 day listing - CryptoJobs.io',
		amount: <?php echo $stripeAmount; ?>
	});
	e.preventDefault();
	}
	else {
		$('#checkout').trigger('click');
	}
});  
</script>
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
