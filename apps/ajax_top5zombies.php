<?php

	include('../php/settings.php');
		$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);	//connect to mysql

	if(!$cxn)
	{
		$z1n = "Unable to retrieve data";
		header('Content-type: text/xml');
	echo"<?xml version=\"1.0\" encoding=\"utf-8\"?>
<top5zombies>
	<zombie position=\"1\">
    	<name>".$z1n."</name>
        <killnum>--</killnum>
        <lastkill>-------</lastkill>    
    </zombie>
	</top5zombies>";
		
	}
		
	//get zombie stats
	$query = "SELECT z_hvzid, firstname, lastname, totalkills, lastkilltime FROM kills2 ORDER BY totalkills DESC LIMIT 5";
	$result = mysqli_query($cxn, $query) or die(mysql_error());


	date_default_timezone_set('America/New_York');		//set default time to eastern
	
	/*** print out the xml file ***/

	header('Content-type: text/xml');
	echo"<?xml version=\"1.0\" encoding=\"utf-8\"?>
<top5zombies>";
		$i = 1;
		//print out xml file
	while($row = mysqli_fetch_array($result))
	{
		echo "<zombie position=\"".$i."\">
    	<name>".$row['firstname']." ".$row['lastname']."</name>
		<hvzid>".$row['z_hvzid']."</hvzid>
        <killnum>".$row['totalkills']."</killnum>
        <lastkill>".date('M d, Y \a\t h:i:s a', $row['lastkilltime'])."</lastkill>    
    </zombie>".PHP_EOL;
		$i++;
	}
    
echo "</top5zombies>";
mysqli_free_result($result);
?>