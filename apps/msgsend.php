<?php
	include('../php/settings.php');
		$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
		
	$fromhvzid = $_REQUEST['fromhvzid'];
	$tohvzid = $_REQUEST['tohvzid'];
	$subject = $_REQUEST['subject'];
	$msgtext = $_REQUEST['msgtext'];
	
	$subject = strip_tags($subject);
	$msgtext = strip_tags($msgtext);
	$subject = mysqli_escape_string($cxn, $subject);
	$msgtext = mysqli_escape_string($cxn, $msgtext);
	
	$query = "INSERT INTO messages (fromhvzid, tohvzid, subject, msgtext, time)
			VALUES('".$fromhvzid."', '".$tohvzid."', '".$subject.", ".$msgtext.", ".time().")";
	
	$result = mysqli_query($cxn, $query);
	
	mysqli_close($cxn);
	return true;
?>