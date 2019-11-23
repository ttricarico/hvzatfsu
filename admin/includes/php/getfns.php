<?php
	if(!defined('hvz'))
	{	die("Access Denied...");	}

	//this file holds a crapload of get_something functions
	//most are very small
	
	function get_total_kills()
	{
		global $connection, $hvzid, $username;
		
		$query = "SELECT * FROM kills WHERE z_hvzid='$hvzid'";
		$result = mysqli_query($connection, $query);
		$numrows = mysqli_num_rows($result);
		mysqli_free_result($result);
		return $numrows;
	}
	
	function get_who_killed()
	{
		global $connection, $hvzid, $username;
		$query = "SELECT * FROM kills WHERE z_hvzid='$hvzid'";
		$result = mysqli_query($connection, $query);
		$context['killedwho'] = '';
		$numrows = mysqli_num_rows($result);
		if($numrows <1)
		{
			return 'You have never gotten a kill';
		}
		while($rows = mysqli_fetch_assoc($result))
		{
			$context['killedwho'] .= $row['z_hvzid'].", ";
		}		
		mysqli_free_result($result);
		return $context['killedwho'];

	}
	
	function get_num_games()
	{
		global $connection, $hvzid, $username;
		
		$query = "SELECT * FROM members WHERE hvzid='$hvzid'";
		$result = mysqli_query($connection, $query);
		$rows = mysqli_fetch_assoc($result);
		$games = $rows['gamesplayed'];
		mysqli_free_result($result);
		return $games;

	}
	
	function get_dues_payed()
	{
		global $connection, $hvzid, $username;
		
		$query = "SELECT * FROM paydues WHERE hvzid='$hvzid'";
		
		$result = mysqli_query($connection, $query);
		$numrows = mysqli_num_rows($result);
		mysqli_free_result($result);
		if($numrows == 0)
		{	//return 'You have not payed dues';
			return 'Yes. Dues are paid';}
		
		if($numrows > 0)
		{	return 'Yes. Dues are paid';	}
		
		else
		{	return 'Unable to retrieve information.';	}
	}
	
	function get_dues_receipt()
	{
		global $connection, $hvzid, $username;
		
		$query = "SELECT * FROM paydues WHERE hvzid='$hvzid'";
		$result = mysqli_query($connection, $query);
		$numrows = mysqli_num_rows($result);
		$rows = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		if($numrows == 0)
		{	return 'No Receipt Number';	}
		
		if($numrows > 0)
		{	return $rows['receipt'];	}
		
		else
		{	return 'Unable to retrieve information.';	}
	}
	
	function get_firstname()
	{
		global $connection, $hvzid, $username;
				
		$query = "SELECT * FROM members WHERE hvzid='$hvzid'";
		$result = mysqli_query($connection, $query);
		$rows = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $rows['firstname'];
	}
	
	function get_lastname()
	{
		global $connection, $hvzid, $username;
				
		$query = "SELECT * FROM members WHERE hvzid='$hvzid'";
		$result = mysqli_query($connection, $query);
		$rows = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $rows['lastname'];
	}
	
	function get_phoneno()
	{
		global $connection, $hvzid, $username;
				
		$query = "SELECT * FROM members WHERE hvzid='$hvzid'";
		$result = mysqli_query($connection, $query);
		$rows = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $rows['phone'];
	}
	
	function get_email()
	{
		global $connection, $hvzid, $username;
				
		$query = "SELECT * FROM members WHERE hvzid='$hvzid'";
		$result = mysqli_query($connection, $query);
		$rows = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $rows['email'];
	}
	
	function get_hvzidext()
	{
		global $connection, $hvzid, $username;
				
		$query = "SELECT * FROM members WHERE hvzid='$hvzid'";
		$result = mysqli_query($connection, $query);
		$rows = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		return $rows['hvzidext'];
	}
	
	function get_humanorzombie()
	{
		global $connection, $hvzid, $username;
		$query = "SELECT * FROM members WHERE hvzid='$hvzid'";
		$result = mysqli_query($connection, $query);
		$rows = mysqli_fetch_assoc($result);
			if($rows['oz'] == 1)
			{	mysqli_free_result($result);
				return 'Original Zombie';
			}
			if($rows['admin'] == 1)
			{	mysqli_free_result($result);
				return 'Administrator';
			}
			if($rows['human'] == 1)
			{	mysqli_free_result($result);
				return 'Human';
			}
			if($rows['human'] == 0)
			{	mysqli_free_result($result);
				return 'Zombie';
			}
					
		
	}
	
	function get_banner()
	{
		$num = rand(0,3);
		
		switch($num)
		{
			default:
			case 0:
				$file = '<img src="http://www.'.$_SERVER['SERVER_NAME'].'/images/banners/promo1_w602xh130.jpg" alt="FSU HvZ" />';
			break;
			
			case 1:
				$file = '<img src="http://www.'.$_SERVER['SERVER_NAME'].'/images/banners/promo2_w602xh130.jpg" alt="FSU HvZ" />';
			break;
			
			case 2:
				$file = '<img src="http://www.'.$_SERVER['SERVER_NAME'].'/images/banners/promo3_w602xh130.jpg" alt="FSU HvZ" />';
			break;
			
			case 3:
				$file = '<img src="http://www.'.$_SERVER['SERVER_NAME'].'/images/banners/promo4_w602xh130.jpg" alt="FSU HvZ" />';
			break;
			
		}
		
		return $file;
	} //end function get_banner()
?>