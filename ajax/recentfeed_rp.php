<?php

	define('hvz', 1);
	
	include('../php/settings.php');
		global $cxn;
		$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
	include('../php/security.php');
	
	$query = "UPDATE recent_activity SET noshow='1' WHERE id='".sanitize($_REQUEST['rid'])."'";
	$result = mysqli_query($cxn, $query);
	
	if(!$result)
	{
	
	}
	
	mysqli_close($cxn);
?>