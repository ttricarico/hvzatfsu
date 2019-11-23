<?php
	if(!defined('hvz'))
	{	die('Access Denied...');	}
	
	function sanitize($s)
	{
		global $cxn;
		
		$s = strip_tags($s);
		$s = stripslashes($s);
		$s = mysqli_real_escape_string($cxn, $s);
		$str = htmlentities($s);
		
		return $str;
	}
	
	function checkifadmin()
	{
		global $cxn;
		
		if(isset($_COOKIE['hvzid']))
		{
			$query = "SELECT admin FROM members WHERE hvzid='".$_COOKIE['hvzid']."'";	
			$result = mysqli_query($cxn);
			$ifadmin = mysqli_fetch_assoc($result);
			if($ifadmin == 1)
			{	return true;	}
			else
			{	return false;	}
		}
		else
		{	return false;	}
	}
	
?>