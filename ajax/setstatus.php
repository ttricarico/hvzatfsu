<?php
	define('hvz', 1);
		include('../php/settings.php');
		include('../php/security.php');
		global $cxn;
			$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);

		$query = "INSERT INTO statusupdates(hvzid, status, posttime, private)
								VALUES('".$_COOKIE['hvzid']."', '".sanitize($_REQUEST['s'])."', '".time()."', '".sanitize($_REQUEST['p'])."')";
		$result = mysqli_query($cxn, $query);
		if(!$result)
		{
		
		}
	mysqli_close($cxn);	
?>