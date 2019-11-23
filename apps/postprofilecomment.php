<?php

	include('../php/settings.php');
		$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
		
	$postername = $_POST['postername'];
	$posterhvzid = $_POST['posterhvzid'];
	$commenttext = $_POST['commenttext'];
	$ipaddr = $_POST['ipaddr'];
	$posterhvzid = $_POST['posterhvzid'];
	$profilehvzid = $_POST['profilehvzid'];
	

	$commenttext = strip_tags($commenttext);
	$commenttext = mysqli_real_escape_string($cxn, $commenttext);
	$commenttext = htmlentities($commenttext);
	
	$query = "INSERT INTO profilecomments(profileid, postername, posterhvzid, commenttext, posttime, ipaddr)
								VALUES('".$profilehvzid."', '".$postername."', '".$posterhvzid."', '".$commenttext."', '".time()."', '".$ipaddr."')";
	$result = mysqli_query($cxn, $query);
	
	$query = "UPDATE members SET notifications=notifications+1 WHERE hvzid='".$profilehvzid."'";
	$result = mysqli_query($cxn, $query);
	
	mysqli_close($cxn);
	header('Location: http://'.$_SERVER['SERVER_NAME'].'/profile.php?hvzid='.$profilehvzid);
	exit;
?>
