<?php
	define('hvz', 1);
		include('../php/settings.php');
		include('../php/security.php');
		global $cxn;
			$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
		
		$query = "UPDATE members SET aboutme='".sanitize($_REQUEST['data'])."' WHERE hvzid='".$_COOKIE['hvzid']."'";
		$result = mysqli_query($cxn, $query);
		
		mysqli_close($cxn);

	
?>