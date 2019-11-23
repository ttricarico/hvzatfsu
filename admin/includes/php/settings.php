<?php

	/*	(c) 2009-2010 FSU HvZ
		(c) 2009-2010 Thomas Tricarico
	********/
	
	//Contains specific stuff like webmaster contact, mysql contact, etc.
	
	//if(!defined('hvz', 1))
	//{	die('Access Denied....');	}
	
	//Let's first set some stuff to global.
	global $date, $mysql_host, $mysql_user, $mysql_password, $mysql_database;
	global $admin_name, $admin_phone;
	
	//Date information
	date_default_timezone_set('EST');		//set default time to eastern
	$date = date('m.d.Y', time());
	$time = date('h:i:s a', time());

	
	//mysql connection info.
	$mysql_host = 'pdb2.awardspace.com';
	$mysql_db = 'redmonkey128_hvz';
	$mysql_user = 'redmonkey128_hvz';
	$mysql_password = 'fsuhvz';
	/************php connect script
			$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
	**********/
	
	//Contact info, etc.
	$admin_webmaster_email = "webmaster@hvzatfsu.com";
	$admin_copyright_date = "(c) 2009-2010 HvZ@FSU and others";


	
?>
