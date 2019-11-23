<?php
	if(!defined('hvz'))
	{	die('Access Denied...');	}
	
	function sanitize($s)
	{
		global $cxn;
		
		$s = strip_tags($s);
		$s = stripslashes($s);
		$s = mysqli_real_escape_string($cxn, $s);
		$s = htmlentities($s);
		
		return $s;
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
	
	function cleanInput($input) {

		  $search = array(
			'@<script[^>]*?>.*?</script>@si',   // Strip out javascript
			'@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
			'@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
			'@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
		  );
		
			$output = preg_replace($search, '', $input);
			return $output;
	}

?>