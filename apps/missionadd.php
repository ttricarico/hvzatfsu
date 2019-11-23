<?php

	if(function_exists('ini_set'))//disable session id in url
	{
	   //Use cookies to store the session ID on the client side
	   @ini_set ('session.use_only_cookies', 1);
	   //Enable transparent Session ID support
	   @ini_set ('session.use_trans_sid',    0);
	}	
	
	//header time!
	header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	header ('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
	header ('Cache-Control: no-cache, must-revalidate'); // HTTP/1.1
	header ('Pragma: no-cache'); // HTTP/1.0

	/****MySQL Login***/
	include('../php/settings.php');
		global $cxn;
		$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);

	$day = $_POST['day'];
	$species = $_POST['species'];
	$missiondetails = $_POST['missiondetails'];
	$hvzid = $_POST['hvzid'];
	$currentgame = $_POST['currentgame'];
	
	if($species == 'human')
	{
		$human = 1;	
	}
	if($species == 'zombie')
	{
		$human = 0;
	}
	$query = "INSERT INTO missions (day, missiondetails, human, posterhvzid, currentgame)
							VALUES('".$day."', '".$missiondetails."', '".$human."', '".$hvzid."', '".$currentgame."')";
	$result = mysqli_query($cxn, $query);
	
	mysqli_close($cxn);
	header('Location: http://'.$_SERVER['SERVER_NAME'].'/missions.php?talk=Mission has been added');
?>