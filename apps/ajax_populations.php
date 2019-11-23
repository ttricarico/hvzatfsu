<?php

	//mysql connection info.
	$mysql_host = 'localhost';
	$mysql_db = 'hvz_db';
	$mysql_user = 'hvz_db';
	$mysql_password = '4LU8bhJ3FWzRZ4k';

		$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);	//connect to mysql

	if(!$cxn)
	{
		$txt['humanpop'] = "Unable to retrieve data";
		$txt['zombiepop'] = "Probably more than you think.";
		return;
		exit;
	}
		
	//get human population	AND isplaying='1'
	$query = "SELECT * FROM members WHERE human='1' AND admin='0' AND isplaying='1'";
	$result = mysqli_query($cxn,$query);
	$txt['humanpop'] = mysqli_num_rows($result);
	mysqli_free_result($result);				
	
	//get zombie population	AND isplaying='1'
	$query = "SELECT * FROM members WHERE human='0' AND admin='0' AND isplaying='1'";
	$result = mysqli_query($cxn, $query);
	$txt['zombiepop'] = mysqli_num_rows($result);
	mysqli_free_result($result);
	
	$txt['totalpop'] = $txt['humanpop'] + $txt['zombiepop'];
		
	date_default_timezone_set('America/New_York');		//set default time to eastern
	
	/*** print out the xml file ***/

	header('Content-type: text/xml');
	echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>
	<population>
		<human>".$txt['humanpop']."</human>
		<zombie>".$txt['zombiepop']."</zombie>
		<total>".$txt['totalpop']."</total>
		<date>".date('g:i:s a \o\n m.d.Y',time())."</date>
		<indexdate>".date('M d, Y \a\t h:i:s a', time())."</indexdate>
	</population>";
	
	mysqli_close($cxn);
?>