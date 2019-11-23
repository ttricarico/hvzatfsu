<?php
	define('hvz', 1);
		include('../php/settings.php');
		include('../php/security.php');
		global $cxn;
			$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);

	$query = "INSERT INTO friends(hvzid1, hvzid2, datestamp)
							VALUES('".$_COOKIE['hvzid']."', '".sanitize($_REQUEST['h'])."', '".time()."')";
	$result = mysqli_query($cxn, $query);
	if(!$result)
	{
	
	}
	
	mysqli_close($cxn);
?>