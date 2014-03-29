<?php 
session_start(); 
require_once('MysqliDb.php');
require_once('credentials.php');
if ($_SESSION['logged']!='true') header('Location: admin.php');
if(isset($_POST['activate']) || isset($_POST['disable'])) {
	require_once('MysqliDb.php');
	require_once('credentials.php');
	if (isset($_POST['activate'])) {
		$data = array('status' => '1');
	}
	else {
		$data = array('status' => '0');
	}
	$db->where('id', (int)$_POST['id']);
	if($db->update('jobs', $data));
	header('Location: admin.php');
}
else {
	header('Location: admin.php');
}
?>