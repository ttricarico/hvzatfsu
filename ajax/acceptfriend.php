<?php
	define('hvz', 1);
		include('../php/settings.php');
		include('../php/security.php');
		global $cxn;
			$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);

	$query = "UPDATE  friends SET accepted='1' WHERE id='".sanitize($_REQUEST['id'])."'";
	$result = mysqli_query($cxn, $query);
	
	if(!$result)
	{
	
	}
	
	mysqli_close($cxn);
?>