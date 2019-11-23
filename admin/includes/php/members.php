<?php
	if(!defined('hvz'))
	{	die('Access Denied....');	}
	
	/****************************
		(c) 2010 Thomas Tricarico
		(c) 2010 HvZ at FSU
		
		members.php
		This holds all the administrative functions for the options under the member catagory
		
		function viewmembers()
			displays lists of members
		function viewactive()
			displays list of active members
		function viewmembers_delete()
			deletes selected members
		function viewemails()
			displays the email addresses of the members
		function viewhvzids()
			displays all hvzid numbers, and can reassign them
		function hvzidext()
			assigns and reassigns hvzid numbers
		function banned()
			displays banned members
	
	**************************/

	function viewmembers()
	{
	global $cxn;
	//Print title bar
			echo "<span class=\"content_titles\">Everyone registered on the site:</span><br />";
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
			$query = "SELECT firstname, lastname, hvzid, hvzidext, phone, human, admin, oz, email FROM members WHERE 1 ORDER BY id ASC";
			if ($stmt = mysqli_prepare($cxn, $query)) {
				mysqli_stmt_execute($stmt);
			
				/* bind variables to prepared statement */
				mysqli_stmt_bind_result($stmt, $firstname, $lastname, $hvzid, $hvzidext, $phone, $human, $admin, $oz, $email);
			
				
				
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
						
					
						echo"<span class=\"id_no\"> &nbsp;</span>
							<span class=\"hvzid\">".$hvzid."-".$hvzidext."</span>
							<span class=\"user_name\">".$email."</span>
							<span class=\"first_name\">".$firstname."</span>
							<span class=\"last_name\">".$lastname."</span>
							<span class=\"phone_no\">".$phone."</span>
							<span class=\"life_status\">".$status."</span>
						</div>".PHP_EOL;
					
				$i++;
				}
		
					/* close statement */
					mysqli_stmt_close($stmt);
			}	
			
		return;
}

#########################	view active		########################################################
function viewactive()
{
	global $cxn;
	
		//Print title bar
		echo "<span class=\"content_titles\">These are all of the members who are active at hvzatfsu.com:</span><br />";
		echo "<div class=\"row_title\">".PHP_EOL;
		echo"<span class=\"id_no\">id</span>
					<span class=\"hvzid\">hvzid-ext</span>
					<span class=\"user_name\">Email</span>
					<span class=\"first_name\">First Name</span>
					<span class=\"last_name\">Last Name</span>
					<span class=\"phone_no\">Phone</span>
					<span class=\"life_status\">Life Status</span>
				</div>".PHP_EOL;

		//get and print table
		$query = "SELECT firstname, lastname, hvzid, hvzidext, phone, human, admin, oz, email FROM members WHERE isplaying='1'";
		if ($stmt = mysqli_prepare($cxn, $query)) {
			mysqli_stmt_execute($stmt);
		
			/* bind variables to prepared statement */
			mysqli_stmt_bind_result($stmt, $firstname, $lastname, $hvzid, $hvzidext, $phone, $human, $admin, $oz, $email);
		
			
			
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
			echo"<span class=\"id_no\"> &nbsp; </span>
						<span class=\"hvzid\">".$hvzid."-".$hvzidext."</span>
						<span class=\"user_name\">".$email."</span>
						<span class=\"first_name\">".$firstname."</span>
						<span class=\"last_name\">".$lastname."</span>
						<span class=\"phone_no\">".$phone."</span>
						<span class=\"life_status\">".$status."</span>
					</div>".PHP_EOL;
			$i++;
			}
	
				/* close statement */
				mysqli_stmt_close($stmt);
		}	
		
		echo "<br /><center><a href=\"?action=resetactive\"><input value=\"Reset all Active Players\" type=\"button\" /></a></center>";
	return;

}//end function
###################### reset active members  ############################################
function resetactive()
{
	global $cxn;
	
	$query = "UPDATE members SET isplaying='0' WHERE 1";
	$result = mysqli_query($cxn, $query);
	
	echo "Active Members Reset";
	return;
}
######################  set active members  #######################################################
function setactive()
{
	global $cxn;
		
		//Print title bar
		echo "<form action=\"?action=setactive2\" method=\"post\" enctype=\"application/x-www-form-urlencoded\">";
		echo "<span class=\"content_titles\">These are all of the members who are active at hvzatfsu.com:</span><br />";
		echo "<div class=\"row_title\">".PHP_EOL;
		echo"<span class=\"id_no\">Pay</span>
					<span class=\"hvzid\">hvzid-ext</span>
					<span class=\"user_name\">Email</span>
					<span class=\"first_name\">First Name</span>
					<span class=\"last_name\">Last Name</span>
					<span class=\"phone_no\">Phone</span>
					<span class=\"life_status\">Life Status</span>
				</div>".PHP_EOL;

		//get and print table
		$query = "SELECT firstname, lastname, hvzid, hvzidext, phone, banned, human, admin, oz, email FROM members WHERE 1";
		if ($stmt = mysqli_prepare($cxn, $query)) {
			mysqli_stmt_execute($stmt);
		
			/* bind variables to prepared statement */
			mysqli_stmt_bind_result($stmt, $firstname, $lastname, $hvzid, $hvzidext, $phone, $banned, $human, $admin, $oz, $email);
		
			
			
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
					if($banned==1)
					{	$status = 'Banned'; }
			echo"<span class=\"id_no\"> <input type=\"checkbox\" name=\"check[]\" value=\"".$hvzid."\" /> </span>
						<span class=\"hvzid\">".$hvzid."-".$hvzidext."</span>
						<span class=\"user_name\">".$email."</span>
						<span class=\"first_name\">".$firstname."</span>
						<span class=\"last_name\">".$lastname."</span>
						<span class=\"phone_no\">".$phone."</span>
						<span class=\"life_status\">".$status."</span>
					</div>".PHP_EOL;
			$i++;
			}
	
				/* close statement */
				mysqli_stmt_close($stmt);
		}	
		echo "<br /><center><input type=\"submit\" value=\"Set Active Players\" /></center></form>";
		echo "<br /><center><a href=\"?action=resetactive\"><input value=\"Reset Active Players\" type=\"button\" /></a></center>";
	
	return;
}
######################################################################3

function setactive2()
{
	global $cxn;
		$selected = $_REQUEST['check'];
		
		foreach($selected as $value)
		{
			$query = "UPDATE members SET isplaying='1' WHERE hvzid='".$value."'";
			$result = mysqli_query($cxn, $query);
		}
		
		echo "Players have been activated";
	return;
}
######################  view emails  ##############################################################
	function viewemails()
	{
		global $cxn;
		
		$timestart = time();
		$query = "SELECT * FROM members WHERE 1";
		$result = mysqli_query($cxn, $query);
		if(!$result)
		{	echo mysqli_error($cxn);
			return;}
		
		$row = mysqli_fetch_assoc($result);
		
		
		echo "<span class=\"content_titles\">These are the email addresses of all the members:</span><br />";
		echo "<div class=\"row_title\">".PHP_EOL;
		echo"<span class=\"id_no\">id</span>
					<span class=\"hvzid\">hvzid-ext</span>
					<span class=\"first_name\">First Name</span>
					<span class=\"last_name\">Last Name</span>
					<span class=\"life_status\">Life Status</span>
					<span class=\"email\">Email</span>
				</div>".PHP_EOL;
				
				//Print the first entry from the table
				
				echo "<div class=\"row_even\">".PHP_EOL;
				if($row['human']==1)
					{	$status = 'Human';	}
					if($row['human']==0)
					{	$status = 'Zombie';	}
					if($row['admin']==1)
					{	$status = 'Admin';	}
					if($row['oz']==1)
					{	$status = 'OZ';	}
			echo"<span class=\"id_no\">".$row['id']."</span>
						<span class=\"hvzid\">".$row['hvzid']."-".$row['hvzidext']."</span>
						<span class=\"first_name\">".$row['firstname']."</span>
						<span class=\"last_name\">".$row['lastname']."</span>
						<span class=\"life_status\">".$status."</span>
						<span class=\"email\">".$row['email']."</span>
					</div>".PHP_EOL;
					
					//Print the rest of the table
		$i=0;		
		while($row = mysqli_fetch_assoc($result))
		{		
			if($i&1)
			{	echo "<div class=\"row_even\">".PHP_EOL;	}
			else{	echo "<div class=\"row_odd\">".PHP_EOL;	}
				if($row['human']==1)
					{	$status = 'Human';	}
					if($row['human']==0)
					{	$status = 'Zombie';	}
					if($row['admin']==1)
					{	$status = 'Admin';	}
					if($row['oz']==1)
					{	$status = 'OZ';	}
			echo"<span class=\"id_no\">".$row['id']."</span>
						<span class=\"hvzid\">".$row['hvzid']."-".$row['hvzidext']."</span>
						<span class=\"first_name\">".$row['firstname']."</span>
						<span class=\"last_name\">".$row['lastname']."</span>
						<span class=\"life_status\">".$status."</span>
						<span class=\"email\">".$row['email']."</span>
					</div>".PHP_EOL;
			$i++;
		}
					
		
		mysqli_free_result($result);
		$timedone = time();
		$timetotal = $timedone - $timestart;
		$timetotal = date('u',$timetotal);
		echo "<span class=\"time_took\">Total of ".$i." Records.</span>";
		  
		  return;
	
	}
#########################	function hvzidext	#################################

	function hvzidext()
	{
		global $cxn;
		
		if(isset($_REQUEST['req']))	
		{
			$req = $_REQUEST['req'];	//if req is defined, run the requested function
			include('members_hvzidext.php');
			$req();
		}
		
		echo "<center><a href=\"?action=hvzidext&req=hvzidext_allnew \"><input type=\"button\" value=\"All players will be assigned new extension numbers\" /></a><br /><a href=\"?action=hvzidext&req=hvzidext_viewall \"><input type=\"button\" value=\"View all extension numbers\" /></a></center>";

		return;
	}
#########################	function banned	#################################
	
	function banned()
	{
		global $cxn;
	
			$query = "SELECT * FROM banned WHERE 1";
			$result = mysqli_query($cxn, $query);
			
			$count = mysqli_num_rows($result);
			if($count == 0)
			{
				echo "Enter a banned player:";
				echo "<form id=\"form1\" name=\"form1\" method=\"post\" action=\"?action=insertban\">
  <table width=\"50%\" border=\"0\">
    <tr>
      <td width=\"35%\"><div align=\"right\">Username:&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
      <td width=\"65%\"><input type=\"text\" name=\"username\" id=\"username\" /></td>
    </tr>
    <tr>
      <td><div align=\"right\">First Name:&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
      <td><input type=\"text\" name=\"firstname\" id=\"firstname\" /></td>
    </tr>
    <tr>
      <td><div align=\"right\">Last Name:&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
      <td><input type=\"text\" name=\"lastname\" id=\"lastname\" /></td>
    </tr>
    <tr>
      <td><div align=\"right\">HvZ ID:&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
      <td><input type=\"text\" name=\"hvzid\" id=\"hvzid\" /></td>
    </tr>
    <tr>
      <td><div align=\"right\">Card Color:&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
      <td><select name=\"card\" id=\"card\">
        <option value=\"warning\">Warning</option>
        <option value=\"yellow\">Yellow</option>
        <option value=\"red\">Red</option>
        <option value=\"blue\">Blue</option>
      </select>      </td>
    </tr>
	<tr>
      <td colspan=\"2\"><textarea name=\"reason\" id=\"reason\" cols=\"50\" rows=\"5\"></textarea></td>
    </tr>
    <tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type=\"submit\" name=\"button\" id=\"button\" value=\"Insert Player\" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>";
				return;
			}
			if($count > 0)
			{
				$row = mysqli_fetch_assoc($result);
		
				echo "<span class=\"content_titles\">These are the email addresses of all the members:</span><br />";
				echo "<div class=\"row_title\">".PHP_EOL;
				echo"<span class=\"hvzid\">hvzid</span>
					<span class=\"user_name\">Username</span>
					<span class=\"first_name\">First Name</span>
					<span class=\"last_name\">Last Name</span>
					<span class=\"phone_no\">card</span>
					<span class=\"email\">reason</span></div>".PHP_EOL;
						
						//Print the first entry from the table
						
						echo "<div class=\"row_even\">".PHP_EOL;
					echo"<span class=\"hvzid\">".$row['hvzid']."</span>
						<span class=\"user_name\">".$row['username']."</span>
						<span class=\"first_name\">".$row['firstname']."</span>
						<span class=\"last_name\">".$row['lastname']."</span>
						<span class=\"phone_no\">".$row['card']."</span>
						<span class=\"email\">".$row['reason']."</span>
					</div>".PHP_EOL;
							
							//Print the rest of the table
				$i=0;		
				while($row = mysqli_fetch_assoc($result))
				{		
					if($i&1)
					{	echo "<div class=\"row_even\">".PHP_EOL;	}
					else{	echo "<div class=\"row_odd\">".PHP_EOL;	}

					echo"<span class=\"hvzid\">".$row['hvzid']."</span>
						<span class=\"user_name\">".$row['username']."</span>
						<span class=\"first_name\">".$row['firstname']."</span>
						<span class=\"last_name\">".$row['lastname']."</span>
						<span class=\"phone_no\">".$row['card']."</span>
						<span class=\"email\">".$row['reason']."</span>
					</div>".PHP_EOL;
					
					$i++;
				}
							
				
				mysqli_free_result($result);
			}
		return;
	}
	
	function insertban()
	{
		global $cxn;
		$card = $_REQUEST['card'];
		$hvzid = $_REQUEST['hvzid'];
		$firstname = $_REQUEST['firstname'];
		$lastname = $_REQUEST['lastname'];
		$username = $_REQUEST['username'];
		$reason = $_REQUEST['reason'];
		
		$query = "INSERT INTO banned (card, hvzid, firstname, lastname, username, reason)
				VALUES ('$card', '$hvzid', '$firstname', '$lastname', '$username', '$reason')";
		$result = mysqli_query($cxn, $query);
		header('Location: http://admin.hvzatfsu.com/?action=banned');
		return;
	}
?>

