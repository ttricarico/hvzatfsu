<?php

	define('hvz', 1);
	include('../php/settings.php');
	include('../php/security.php');
	
	$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
	
	$query = "DELETE FROM homecomments WHERE id='".sanitize($_REQUEST['id'])."'";
	$result = mysqli_query($cxn, $query);
	
	
	mysqli_close($cxn);

?>