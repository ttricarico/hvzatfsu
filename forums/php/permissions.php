<?php
	if(!defined('hvz'))
	{	die('Access Denied...');	}
	

	function getpermissions()
	{
		global $cxn;
		
		if(!isset($_COOKIE['hvzid']))
		{	
			$_SESSION['permission'] = array('general');
			return;
		}
		$query = "SELECT human, oz, admin FROM members WHERE hvzid='".$_COOKIE['hvzid']."'";
		$result = mysqli_query($cxn, $query);
		$row = mysqli_fetch_assoc($result);
		if($row['admin'] == 1)
		{
			//admin
			$_SESSION['permission'] = array('admin', 'human', 'zombie', 'general');
		}
		elseif($row['oz'] == 1)
		{
			//oz
			$_SESSION['permission'] = array('zombie', 'general');
		}
		elseif($row['human'] == 1)
		{
			//human	
			$_SESSION['permission'] = array('human', 'general');
		}
		elseif($row['human'] == 0)
		{
			//zombie
			$_SESSION['permission'] = array('zombie', 'general');
		}
		else
		{
			//general
			$_SESSION['permission'] = array('general');
		}
		
		return;
	}
?>