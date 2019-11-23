<?php

	function population()	//gets current population stats from the system
	{
		global $cxn, $txt;
		
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
		
		return;
	}//end function
	
	function report_kill()
	{
		global $cxn;
		$yourhvzid = strtoupper($_REQUEST['yourhvzid']);
		$theirhvzid = strtoupper($_REQUEST['theirhvzid']);
		$killplace = $_REQUEST['killplace'];
		
		$query = "SELECT * FROM members WHERE hvzid='".$theirhvzid."'";
		$result = mysqli_query($cxn, $query);
		$row = mysqli_fetch_array($result);
		if($row['human']==0)
		{
			header('Location: http://'.$_SERVER['SERVER_NAME'].'/reportkill.php?talk=This person is already a zombie.');
			exit;
		}
		$rowcnt = mysqli_num_rows($result);
		mysqli_free_result($result);
		
		

		
		if(!$rowcnt)
		{	header('Location: http://'.$_SERVER['SERVER_NAME'].'/reportkill.php?talk=You have supplied an incorrect HvZID'); exit;	}
		
		if($rowcnt)
		{
			$query = "INSERT INTO kills (z_hvzid, h_hvzid, time, killplace)
					VALUES ('$yourhvzid', '$theirhvzid', '".time()."', '$killplace')";
			$result = mysqli_query($cxn, $query);
			mysqli_free_result($result);
			
			$query = "UPDATE members SET human='0' WHERE hvzid='$theirhvzid'";
			$result = mysqli_query($cxn, $query);
			mysqli_free_result($result);
			
			$query = "SELECT * FROM kills2 WHERE z_hvzid='".$yourhvzid."'";
			$result = mysqli_query($cxn, $query);
			$rowcnt = mysqli_num_rows($result);
			mysqli_free_result($result);
			if($rowcnt != 0)//not first kill
			{
				$query = "UPDATE kills2 SET totalkills=totalkills+1 WHERE z_hvzid='".$yourhvzid."'";
				$result = mysqli_query($cxn, $query);
				$query = "UPDATE kills2 SET lastkilltime='".time()."' WHERE z_hvzid='".$yourhvzid."'";
				$result = mysqli_query($cxn, $query);
			}
			else//else, first kill
			{
				$query = "SELECT firstname, lastname, oz FROM members WHERE hvzid='".$yourhvzid."'";
				$result = mysqli_query($cxn, $query);
				$row = mysqli_fetch_array($result);
				if($row['oz'] != 1)
				{
					$firstname = $row['firstname'];
					$lastname = $row['lastname'];
				}
				if($row['oz'] == 1)
				{
					$firstname = 'Original';
					$lastname = 'Zombie';
				}
				
				mysqli_free_result($result);
				$query = "INSERT INTO kills2(z_hvzid, totalkills, firstname, lastname, lastkilltime)
									VALUES('".$yourhvzid."','1', '".$firstname."', '".$lastname."', '".time()."')";
				$result = mysqli_query($cxn, $query);
			}
			
			
			$query = "SELECT * FROM members WHERE hvzid='$theirhvzid'";
			$result = mysqli_query($cxn, $query);
			$row = mysqli_fetch_assoc($result);
			$theiremail = $row['email'];
			mysqli_free_result($result);
			
			

					/**###########################################################
							Possible send email script in the future
					############################################################*/
		
		
		}//end if statement		
		header('Location: http://'.$_SERVER['SERVER_NAME'].'/index.php?talk=Your kill has been reported.');
		
		
	}//end function
?>