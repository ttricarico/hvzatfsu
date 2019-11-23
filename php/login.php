<?php //(c) 2011 Thomas Tricarico
	/***************************
	 *	Function Directory
	 *		playerlogin(void) = logs in player
	 *		checkifbanned($hvzid) = checks $hvzid in banned list
	 *		playerlogout(void) = logs out player
	 *		loginplayer($firstname, $lastname, $hvzid, $adminstatus, $hvzidext) = sets cookies and logs in player
	 ***************************/
	 

	function checkifbanned($hvzid)
	{
		global $cxn;
		
		$query = "SELECT * FROM banned WHERE hvzid='".$hvzid."'";
		$result = mysqli_query($cxn, $query);
	
		$rownum = mysqli_num_rows($result);
		if($rownum != 0)
		{	return true;	}
		else
		{	return false;	}
	}// end function
		
	function registerlogin($hvzid)
	{
		global $cxn;
		$query = "INSERT INTO logins(hvzid, ipaddr, time, useragent)
						VALUES('".$hvzid."','".$_SERVER['REMOTE_ADDR']."','".time()."','".$_SERVER['HTTP_USER_AGENT']."')";
		$result = mysqli_query($cxn, $query);
		mysqli_free_result($result);

		return;
	}
	function playerlogin()
	{
		global $cxn;
			require('security.php');
			
			$email = strtolower(sanitize($_REQUEST['email']));
			$password = sha1($_REQUEST['password']);

			$query = "SELECT * FROM members WHERE email='".$email."' AND password='".$password."' GROUP BY hvzid";
			$result = mysqli_query($cxn, $query);
			if(mysqli_num_rows($result) == 0)
			{
				header('Location: http://'.$_SERVER['SERVER_NAME'].'/reglogin.php?talk=You have supplied incorrect credentials');
				exit;
			}
			$row = mysqli_fetch_assoc($result);
			mysqli_free_result($result);
			
			
			/** Check if banned **/
			if(checkifbanned($row['hvzid']))
			{	
				header('Location: http://'.$_SERVER['SERVER_NAME'].'/index.php?talk=You cannot log in. You have been banned. Is this a mistake? Talk to a moderator');
				exit;
			}
			
			registerlogin($row['hvzid']);	//record login
			
			$hvzid = $row['hvzid'];
			$hvzidext = $row['hvzidext'];
			
			if($row['admin'] == 1)
			{	$adminstatus = true;	}
			else
			{	$adminstatus = false;	}
			
			$lastonline = time();
			$query = "UPADTE members SET lastonline='$lastonline'";
			$result = mysqli_query($cxn, $query);
			
			$cookielength = 0;		//if 'remember' is not checked, set expiration for now
			
			
			loginplayer($row['firstname'], $row['lastname'], $hvzid, $adminstatus, $hvzidext);

			mysqli_close($cxn);
			header('Location: http://'.$_SERVER['SERVER_NAME'].'/');
			return true;
		
	}//end function
	
	function playerlogout()
	{
		global $cxn;
		
		$cookielength = time()-3600;		//set expiration for an hour ago
		
		setcookie('hvzid', '', $cookielength, '/', '.hvzatfsu.com');
		setcookie('hvzidext', '', $cookielength, '/', '.hvzatfsu.com');
		setcookie('firstname', '', $cookielength, '/', '.hvzatfsu.com');
		setcookie('lastname', '', $cookielength, '/', '.hvzatfsu.com');
		setcookie('admin', '', $cookielength, '/', '.hvzatfsu.com');
		setcookie('betatest', true, 0, '/', '.hvzatfsu.com');

		mysqli_close($cxn);
		header('Location: http://'.$_SERVER['SERVER_NAME'].'/?talk=You have been logged out');
		return true;
	}//end function
	
	function loginplayer($firstname, $lastname, $hvzid, $adminstatus, $hvzidext)
	{
		//	This function specifically sets the cookies. This way, we can call this (and only this)
		//	function if we have the rest of the login information somewhere else i.e. register_main()
		$hvzidextput =  $hvzid." &ndash; ".$hvzidext;
		setcookie('hvzid', $hvzid, $cookielength, '/', '.hvzatfsu.com');
		setcookie('hvzidext', $hvzidextput, $cookielength, '/', '.hvzatfsu.com');
		setcookie('admin', $adminstatus, $cookielength, '/', '.hvzatfsu.com');
		setcookie('firstname', $firstname, $cookielength, '/', '.hvzatfsu.com');
		setcookie('lastname', $lastname, $cookielength, '/', '.hvzatfsu.com');

		return;
		
	}//end function
	
?>