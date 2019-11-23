<?php
	$pageto = $_REQUEST['lnk'];
	$pageto = str_replace('http://', '', $pageto);
	session_start();
	header("Location: http://$pageto");
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
	define('hvz', 1);

	require('php/security.php');
	require('php/settings.php');
	
	
	$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
	if(!isset($_COOKIE['hvzid']))
	{	$cookie = 'NOTLOGD';	}
	else
	{	$cookie = $_COOKIE['hvzid'];	}
	
	if($_SERVER['HTTP_REFERER'] == '')
	{	$pagefrom = 'Not Tracked';	}
	else
	{	$pagefrom = $_SERVER['HTTP_REFERER'];	}
	
	$query = "INSERT INTO outsidelinks(hvzid, sid, referrer, outto, datetime)
				VALUES('".$cookie."', '".session_id()."', '".$pagefrom."', '".$pageto."', '".time()."')";
	$result = mysqli_query($cxn, $query);
	
	mysqli_close($cxn);
	
	exit;
?>