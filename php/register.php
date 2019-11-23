<?php
	## (c) 2011 Thomas Tricarico
	/********  ## register.php ##
	 *	This file holds all the registration functions,
	 *	including registration_main(void) which does all
	 *	the MySQL queries and the final login processes
	 ************************
	 *	Function Directory
	 *		update(void) = resets the password if forgotten
	 *		updatepass($pass) = reencrypts the given password from md5 -> sha1
	 *		user_id_creator(void) = creates the hvzid for the player
	 *		user_id_check($hvzid) = checks the database for the newly created hvzid
	 *		key_gen(void) = returns a unique key that is used for private rss feeds
	 *		checkifregistered($email, $firstname,  $lastname) = checks to see if user is registered
	 *		checkifindb($firstname, $lastname) = checks if name is in the backup database
	 *		getoldhvzid($firstname, $lastname) = gets old hvzid from members_old
	 *		register_main(void) = registers the person in the database and collects information from the forms
	 ********************/
	 
	function update()
	{
		global $cxn;
		
		$password = $_POST['pass'];
		$email=$_POST['email'];
		
		$password = sha1($password);
		
		$query = "UPDATE members SET password='".$password."' WHERE email='".$email."'";
		$result = mysqli_query($cxn, $query);
		header('Location: http://'.$_SERVER['SERVER_NAME'].'/?talk=Password is Updated. Log in again.');
	}//end function
	
	function updatepass($pass)
	{
		global $cxn;
			
			$epass = sha1($pass);
		
		return $epass;
	}//end function
	
	function user_id_creator()	//42,618,442,977 combinations
	{	
		$hvzid = ''; 	//clear out the id
		$i = 0; 		//set the counter to 0
		do{
			$letterdecider = rand(0,2);
			if($letterdecider == 2)
			{
				$hvzchar = rand(65,89); 	//Pick a random ASCII code for a capital letter
				
				if($hvzchar == 73 || $hvzchar == 81	|| $hvzchar == 85) 	//No 'Q' 'I' 'U'
				{	$hvzchar = 90; }		//If it is one of the restricted letters, just set it to 'Z'
				
				$hvzid .= chr($hvzchar);	//Add the letter to the id
				$i++;
			}
			else{
				$hvznum = rand(1,9);
				$hvzid .= $hvznum;	 //Add the number to the id
				$i++;
			}
		}while($i<=6); 		//creates a 7 digit id number 	
				
		return $hvzid;
			
	}//end function
	
	function user_id_check($hvzid)
	{
		global $cxn;
		
		$query = "SELECT COUNT(id) FROM hvzids WHERE '".$hvzid."' GROUP BY hvzid";
		$result = mysqli_query($cxn,$query);
		$row = mysqli_fetch_assoc($result);
		if($row['COUNT(id)'] != 0)
		{	return false;	}
		else
		{	return true;			}
		
	}//end function
	
	function key_gen()
	{
		$key = '';
		
		$num = rand(1, 50);
		$num .= rand(51, 100);
		$num .= time();
		
		$key = sha1($num);
		
		$key = substr($key, 0, 9);
		
		return $key;
	}//end function

	function checkifregistered($email, $firstname,  $lastname)
	{
		global $cxn;
		
			$query = "SELECT COUNT(id) FROM members WHERE firstname='".$firstname."', AND lastname='".$lastname."' GROUP BY lastname";
			$result = mysqli_query($cxn, $query);
			$row = mysqli_fetch_assoc($result);
			if($row['COUNT(id)'] >= 1)
			{		return true;			}
			
			mysqli_free_result($result);
			
			$query = "SELECT COUNT(id) FROM members WHERE email='".$email."' GROUP BY email";
			$result = mysqli_query($cxn, $query);
			$rows = mysqli_fetch_assoc($result);
			if($rows['COUNT(id)'] >= 1)
			{		return true;			}
			
			//if both tests pass, then...			
		return false;
	}//end function
	
	function checkifindb($firstname, $lastname, $email)
	{
		global $cxn;
		
			$query = "SELECT COUNT(id) FROM members_old WHERE firstname='".$firstname."' AND lastname='".$lastname."' AND email='".$email."' GROUP BY email";
			$result = mysqli_query($cxn, $query);
			$row = mysqli_fetch_assoc($result);
			if($row['COUNT(id)'] != 0)
			{	return true;	}
			else
			{	return false;	}
	}//end function
	
	function getoldhvzid($firstname, $lastname, $email)
	{
		global $cxn;		
			$query = "SELECT hvzid FROM members_old WHERE lastname='".$lastname."' AND email='".$email."'";
			$result = mysqli_query($cxn, $query);
			$row = mysqli_fetch_assoc($result);
		return $row['hvzid'];
	} //end function
	
	function register_main()	//the big kahuna
	{

		global $cxn;
			include('security.php');	
			
		$firstname = ucfirst(strtolower(sanitize($_REQUEST['firstname'])));		//get all the form fields
		$lastname = ucfirst(strtolower(sanitize($_REQUEST['lastname'])));		//and then use sanitize()
		$email = strtolower(sanitize($_REQUEST['email']));						//to eliminate any mysql
		$phone = sanitize($_REQUEST['phone']);									//injection attacks that
		$password = $_REQUEST['password'];										//are attempted
		
		$radiobutton = $_REQUEST['gender'];
		if($radiobutton == 'male')
		{	$gender = 'male';	}
		else {	$gender = 'female';	}
		
		$secretq = sanitize($_REQUEST['secretq']);
		$secreta = sanitize($_REQUEST['secreta']);
		if($_REQUEST['oz'] == 'ozchecked')
		{	$oz = 1;	}
		else {	$oz = 0;	}	
		$aimsn = sanitize($_REQUEST['aimsn']);
		$yimsn = sanitize($_REQUEST['yimsn']);
		
		$ipaddr = ip2long($_SERVER['REMOTE_ADDR']);
		$useragent = $_SERVER['HTTP_USER_AGENT'];
		
		$password = sha1($password);
		if(checkifregistered($email, $firstname,  $lastname))
		{	header('Location: http://'.$_SERVER['SERVER_NAME'].'/reglogin.php?talk=You are already registered. If you forgot your password, please contact a moderator.');	}
			/** send back to registration page **/	
		
		if(checkifindb($firstname, $lastname))		//check if user already has a hvzid that is set to be specifically theirs
		{	$hvzid = getoldhvzid($firstname, $lastname, $email);	}
		
		else
		{
			$hvzid = user_id_creator();	// if not, make one
			
			if(!user_id_check($hvzid))	//check if hvzid is already used
			{	
				do{		//enter loop to continously make hvzids until we reach one that isnt used
					
					$hvzid = user_id_creator();	
	
					$used = user_id_check($hvzid);
					
				}while($used == true);	
			}
		}
		
		$key = key_gen();	//create unique key
		
		$hvzidext = rand(1,999);
		$birthday = mktime(0,0,0,$_REQUEST['month'], $_REQUEST['day'], $_REQUEST['year']);

		
		$query = "INSERT INTO members (aboutme, personalkey, password, firstname, lastname, gender, birthday, hvzid, hvzidext, ozchoice, datereg, email, phone, lastonline, aim, yahoo, secretq, secreta)
					VALUES ('I am an awesome HvZ Player.', '$key','$password', '$firstname', '$lastname', '$gender', '$birthday', '$hvzid', '$hvzidext', '$oz', '$datereg', '$email', '$phone', '$datereg', '$aimsn', '$yimsn', '$secretq', '$secreta')";
		$result = mysqli_query($cxn, $query);
		
		if(!$result)
		{	die(mysqli_error($cxn));	}
		
		else
		{
			mysqli_free_result($result);
			$msgtext = '[internal firstmessage]';
			
			$query = "INSERT INTO messages(subject, tohvzid, fromhvzid, msgtext, datetime)
							VALUES('Welcome, ".$firstname.".', '".$hvzid."', 'SYSTEM', '".$msgtxt."', '".time()."')";
			$result = mysqli_query($cxn, $query);
			
			
			//registration worked, now send to function to register cookies
			include('login.php');
				loginplayer($firstname, $rowlastname, $hvzid, 0, $hvzidext);

		}
		
		header('Location: http://'.$_SERVER['SERVER_NAME'].'/profile.php');
		mysqli_close($cxn);
		return true;
					
					
	}//end function

?>