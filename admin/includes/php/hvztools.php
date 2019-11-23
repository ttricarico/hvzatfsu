<?php
	if(!defined('hvz'))
	{	die('Access Denied....');	}


############################ function gamedate() #############################
//obviously, this one controls the game date, when it is, when it was, when it can be, etc

function gamedate()
{
	global $cxn;
		$query = "SELECT * FROM games WHERE 1";
		$result = mysqli_query($cxn, $query);
		$i=0;
		while($row = mysqli_fetch_assoc($result))
		{
			$datestart[$i] = date('F d, Y',$row['startdate']);
			$dateend[$i] = date('F d, Y',$row['enddate']);
			$i++;
		}
		
		echo "Closest Game: ".$datestart[$i]." &mdash; ".$dateend[$i];
		echo "<br /><br /><br /><br />";
		echo "Past Games:<br />";
		$i--;
		do {
			echo $datestart[$i]." &mdash; ".$dateend[$i]."<br />";
			$i--;
		
		}while($i!=0);
		
	
	
	return;
}

############################ function viewoz() #############################
	
	function viewoz()
	{
		global $cxn;
		
		$timestart = time();
		
			echo "<span class=\"content_titles\">Current Original Zombie:</span><br />";
			echo "<div class=\"row_title\">".PHP_EOL;
			echo"<span class=\"id_no\">&nbsp;&nbsp;</span>
						<span class=\"hvzid\">hvzid-ext</span>
						<span class=\"user_name\">Email</span>
						<span class=\"first_name\">First Name</span>
						<span class=\"last_name\">Last Name</span>
						<span class=\"phone_no\">Phone</span>
						<span class=\"life_status\">Life Status</span>
					</div>".PHP_EOL;
	
			//get and print table
			$query = "SELECT firstname, lastname, hvzid, hvzidext, phone, human, admin, oz, ozchoice, email FROM members WHERE oz='1' AND admin='0'";
			if ($stmt = mysqli_prepare($cxn, $query)) {
				mysqli_stmt_execute($stmt);
			
				/* bind variables to prepared statement */
				mysqli_stmt_bind_result($stmt, $firstname, $lastname, $hvzid, $hvzidext, $phone, $human, $admin, $oz, $ozpool, $email);
			
				
				if(mysqli_stmt_num_rows($stmt)<1)
				{	
					echo "<div class=\"row_even\">".PHP_EOL;
					echo "<center>There are currently no OZs selected. <a href=\"?action=chooseoz\" >Select an OZ?</a></center></div>".PHP_EOL;
				}
				
				/* fetch values */
				while (mysqli_stmt_fetch($stmt)) {
				if($i&1)
				{		}
				else{	echo "<div class=\"row_odd\">".PHP_EOL;	}
					if($human==1)
						{	$status = 'Human';	}
						if($human==0)
						{	$status = 'Zombie';	}
						if($admin==1)
						{	$status = 'Admin';	}
						if($oz==1)
						{	$status = 'OZ';	}
						
					
					if($ozpool==1)
					{
						echo"<span class=\"id_no\"> <input name=\"check[]\" type=\"checkbox\" value=\"".$hvzid."\"  /></span>
							<span class=\"hvzid\">".$hvzid."-".$hvzidext."</span>
							<span class=\"user_name\">".$email."</span>
							<span class=\"first_name\">".$firstname."</span>
							<span class=\"last_name\">".$lastname."</span>
							<span class=\"phone_no\">".$phone."</span>
							<span class=\"life_status\">".$status."</span>
						</div>".PHP_EOL;
					}
					else
					{
						echo"<span class=\"id_no\"> <input name=\"check[]\" type=\"checkbox\" value=\"".$hvzid."\" /></span>
									<span class=\"hvzid\">".$hvzid."-".$hvzidext."</span>
									<span class=\"user_name\">".$email."</span>
									<span class=\"first_name\">".$firstname."</span>
									<span class=\"last_name\">".$lastname."</span>
									<span class=\"phone_no\">".$phone."</span>
									<span class=\"life_status\">".$status."</span>
								</div>".PHP_EOL;
					}
				$i++;
				}
		
					/* close statement */
					mysqli_stmt_close($stmt);
			}	
			if(!mysqli_prepare($cxn, $query))
			{
				echo mysqli_error($cxn);
			}
		return;
	}
############################ function resetzombies() #############################

	function resetzombies()
	{
		global $cxn;
		$query = "SELECT * FROM members WHERE 1";
		$result = mysqli_query($cxn, $query);
		$numrows = mysqli_num_rows($result);
		$i = 0;
		do{
			$query = "UPDATE members SET human=1 WHERE 1";
			$result = mysqli_query($cxn, $query);
			$query = "UPDATE members SET oz=0 WHERE 1";
			$result = mysqli_query($cxn, $query);

			$i++;
		}while($i < $numrows);		
		
		include('members.php');
		echo "Zombie and OZ status is Reset<br /><br />";
		viewmembers();
		
		return;
	}

############################ function paydues() #############################
	function paydues()
	{
		global $cxn;
			$query = "SELECT ";
		return;
	}
############################ function chooseoz() #############################
function chooseoz()
	{
		global $cxn;
		
		$timestart = time();
		
echo "<form action=\"?action=setoz\" method=\"post\" enctype=\"application/x-www-form-urlencoded\">";
			echo "<span class=\"content_titles\">Check the boxes to select the new Original Zombie:</span><br />";
			echo "<div class=\"row_title\">".PHP_EOL;
			echo"<span class=\"id_no\">&nbsp;&nbsp;</span>
						<span class=\"hvzid\">hvzid-ext</span>
						<span class=\"user_name\">Email</span>
						<span class=\"first_name\">First Name</span>
						<span class=\"last_name\">Last Name</span>
						<span class=\"phone_no\">Phone</span>
						<span class=\"life_status\">Life Status</span>
					</div>".PHP_EOL;
	
			//get and print table
			$query = "SELECT firstname, lastname, hvzid, hvzidext, phone, human, admin, oz, ozchoice, email FROM members WHERE ozchoice='1' AND admin='0' ORDER BY RAND() LIMIT 5";
			if ($stmt = mysqli_prepare($cxn, $query)) {
				mysqli_stmt_execute($stmt);
			
				/* bind variables to prepared statement */
				mysqli_stmt_bind_result($stmt, $firstname, $lastname, $hvzid, $hvzidext, $phone, $human, $admin, $oz, $ozpool, $email);
			
				
				
				/* fetch values */
				while (mysqli_stmt_fetch($stmt)) {
				if($i&1)
				{	echo "<div class=\"row_even\">".PHP_EOL;	}
				else{	echo "<div class=\"row_odd\">".PHP_EOL;	}
					if($human==1)
						{	$status = 'Human';	}
						if($human==0)
						{	$status = 'Zombie';	}
						if($admin==1)
						{	$status = 'Admin';	}
						if($oz==1)
						{	$status = 'OZ';	}
						
					if($ozpool==1)
					{
						echo"<span class=\"id_no\"> <input name=\"check[]\" type=\"checkbox\" value=\"".$hvzid."\"  /></span>
							<span class=\"hvzid\">".$hvzid."-".$hvzidext."</span>
							<span class=\"user_name\">".$email."</span>
							<span class=\"first_name\">".$firstname."</span>
							<span class=\"last_name\">".$lastname."</span>
							<span class=\"phone_no\">".$phone."</span>
							<span class=\"life_status\">".$status."</span>
						</div>".PHP_EOL;
					}
					else
					{
						echo"<span class=\"id_no\"> <input name=\"check[]\" type=\"checkbox\" value=\"".$hvzid."\" /></span>
									<span class=\"hvzid\">".$hvzid."-".$hvzidext."</span>
									<span class=\"user_name\">".$email."</span>
									<span class=\"first_name\">".$firstname."</span>
									<span class=\"last_name\">".$lastname."</span>
									<span class=\"phone_no\">".$phone."</span>
									<span class=\"life_status\">".$status."</span>
								</div>".PHP_EOL;
					}
				$i++;
				}
		
					/* close statement */
					mysqli_stmt_close($stmt);
			}	
			if(!mysqli_prepare($cxn, $query))
			{
				echo mysqli_error($cxn);
			}
			echo "<center><input type=\"submit\" value=\"Set Checked into OZ Pool\" /></center></form>";
		return;
}//end function		
######################################################################################################################################

function setoz()
{
	global $cxn;
		$selected = $_REQUEST['check'];
		
		foreach($selected as $value)
		{
			$query = "UPDATE members SET oz='1' WHERE hvzid='".$value."'";
			$result = mysqli_query($cxn, $query);
		}
		
		echo "Original Zombies have been added";
	return;
}
?>