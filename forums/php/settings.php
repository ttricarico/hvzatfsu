<?php

	/*	(c) 2009-2010 FSU HvZ
		(c) 2009-2010 Thomas Tricarico
	********/
	
	//Contains specific stuff like webmaster contact, mysql contact, etc.
	
	//Let's first set some stuff to global.
	global $date, $mysql_host, $mysql_user, $mysql_password, $mysql_database;
	global $admin_name, $admin_phone;
	global $hvzatfsu;
	
	//Date information
	date_default_timezone_set('EST');		//set default time to eastern
	$date = date('m.d.Y', time());
	$time = date('h:i:s a', time());

	
	//mysql connection info.
	$mysql_host = 'localhost';
	$mysql_db = 'hvz_db';
	$mysql_user = 'hvz_db';
	$mysql_password = '4LU8bhJ3FWzRZ4k';
	/************php connect script
			$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
	**********/
	
	//Contact info, etc.
	$admin_webmaster_email = "webmaster@hvzatfsu.com";
	$admin_copyright_date = "(c) 2009-2010 HvZ@FSU and others";
	
	//cookie info
	$chvzfsu = 'hvzatfsu';


	
?>
