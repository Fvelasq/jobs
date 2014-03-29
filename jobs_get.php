<?php
date_default_timezone_set('America/Los_Angeles');
require_once('MysqliDb.php');
require_once('credentials.php');
$jobs = $db->get('jobs', 100);
$jobs_table = '';
$index = 1;

if (count($jobs) == 0) {
	echo "<tr><td colspan='5'><div class='alert alert-warning'>No listings.</div></td></tr>";
	exit();
}
foreach ($jobs as $job) {

	if ($job['status']!=0) :

		$features = '';
		$job['features'] = str_pad($job['features'], 4, "0", STR_PAD_LEFT);
		if (substr($job['features'],0,1) == 1)
			$features .= "<i class='fa fa-plane'>&nbsp;</i> ";
		else
			$features .= "<i class='fa fa-plane disabled'>&nbsp;</i> ";
		if (substr($job['features'],1,1) == 1)
			$features .= "<i class='fa fa-dollar'>&nbsp;</i> ";
		else
			$features .= "<i class='fa fa-dollar disabled'>&nbsp;</i> ";
		if (substr($job['features'],2,1) == 1)
			$features .= "<i class='fa fa-github'>&nbsp;</i> ";
		else
			$features .= "<i class='fa fa-github disabled'>&nbsp;</i> ";
		if (substr($job['features'],3,1) == 1)
			$features .= "<i class='fa fa-heart'>&nbsp;</i> ";
		else
			$features .= "<i class='fa fa-heart disabled'>&nbsp;</i> ";

		// types
		$types = '';
		$job['type'] = str_pad($job['type'], 4, "0", STR_PAD_LEFT);
		if (substr($job['type'],0,1) == 1)
			$types .= "<div class='label label-primary'>Full-time</div>";
		else if (substr($job['type'],1,1) == 1)
			$types .= "<div class='label label-info'>Part-time</div>";
		else if (substr($job['type'],2,1) == 1)
			$types .= "<div class='label label-warning'>Contract</div>";
		else if (substr($job['type'],3,1) == 1)
			$types .= "<div class='label label-danger'>Freelance</div>";

		// location
		$location = '';
		if ($job['location'] == 1)
			$location .= "<i class='fa fa-rss'>&nbsp;</i> Anywhere";
		else
			$location .= $job['location'];

		$jobs_table .= "<tr class='link' data-index='".$index."'>";
		$jobs_table .= "<td>".date("M t", strtotime($job['date']))."</td>";
		$jobs_table .= "<td><strong>".$job['title']."</strong></td>";
		$jobs_table .= "<td>".$location."</td>";
		$jobs_table .= "<td>".$types."</td>";
		$jobs_table .= "<td>".$features."</td>";
		$jobs_table .= "</tr>";
		$jobs_table .= "<tr class='nope more' id='row_".$index."'>";
		$jobs_table .= "<td colspan='5'><div class='content'><p>";
		$jobs_table .= "<p>".$job['description']."</p>";
		$jobs_table .= "<p><a href='&#109;&#097;&#105;&#108;&#116;&#111;:".$job['email']."' class='btn btn-success'>Contact</a></p>";
		$jobs_table .= "</div></td>";
		$jobs_table .= "</tr>";

		++$index;

	endif;

}
echo $jobs_table;
?>