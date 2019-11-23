<?php
	if(!defined('hvz'))
	{	die('Access Denied...');	}
	
	function setzombies()
	{	global $cxn;
		//Print title bar
			echo "<form action=\"?action=setzombies2\" method=\"post\" enctype=\"application/x-www-form-urlencoded\">";
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
			$query = "SELECT firstname, lastname, hvzid, hvzidext, phone, human, admin, oz, email FROM members WHERE admin='0' AND isplaying='1'";
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
				echo"<span class=\"id_no\"> <input name=\"check[]\" type=\"checkbox\" value=\"".$hvzid."\"></span>
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
			
			echo "<center><input type=\"submit\" value=\"Set checked as Zombies\" /></center></form>";
		return;
	}//end function
	
	function setzombies2()
	{
		global $cxn;
			$selected = $_REQUEST['check'];
			
			foreach($selected as $value)
			{
				$query = "UPDATE members SET human='0' WHERE hvzid='".$value."'";
				$result = mysqli_query($cxn, $query);
			}
			
			echo "Admins have been removed";
		return;
	} //end function
	
	function assignadmin()
	{
		global $cxn;
		
			//Print title bar
			echo "<form action=\"?action=assignadmin2\" method=\"post\" enctype=\"application/x-www-form-urlencoded\">";
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
			$query = "SELECT firstname, lastname, hvzid, hvzidext, phone, human, admin, oz, email FROM members WHERE admin='1'";
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
				echo"<span class=\"id_no\"> <input name=\"check[]\" type=\"checkbox\" value=\"".$hvzid."\"></span>
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
			
			echo "<center><input type=\"submit\" value=\"Remove Checked from Administrator Priviliges\" /></center></form>";
			echo "<center><a href=\"?action=chooseadmins\"><input type=\"button\" value=\"Choose New Administrators\"></a></center>";
		return;
	
	}//end function

function assignadmin2()
{
	global $cxn;
		$selected = $_REQUEST['check'];
		
		foreach($selected as $value)
		{
			$query = "UPDATE members SET admin='0' WHERE hvzid='".$value."'";
			$result = mysqli_query($cxn, $query);
		}
		
		echo "Admins have been removed";
	return;
} //end function

function chooseadmins()
{
	global $cxn;
	//Print title bar
			echo "<form action=\"?action=chooseadmins2\" method=\"post\" enctype=\"application/x-www-form-urlencoded\">";
			echo "<span class=\"content_titles\">Check the boxes to select new Administrators:</span><br />";
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
			$query = "SELECT firstname, lastname, hvzid, hvzidext, phone, human, admin, oz, email FROM members WHERE 1";
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
						
					if($admin==1)
					{
						echo"<span class=\"id_no\"> <input name=\"check[]\" type=\"checkbox\" value=\"".$hvzid."\" disabled=\"true\" /></span>
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
			
			echo "<center><input type=\"submit\" value=\"Set Checked as Administrators\" /></center></form>";
		return;
}

function chooseadmins2()
{
	global $cxn;
		$selected = $_REQUEST['check'];
		
		foreach($selected as $value)
		{
			$query = "UPDATE members SET admin='1' WHERE hvzid='".$value."'";
			$result = mysqli_query($cxn, $query);
		}
		
		echo "Admins have been added";
	return;
}

function ozpool()
{
	global $cxn;
	//Print title bar
			echo "<form action=\"?action=ozpool2\" method=\"post\" enctype=\"application/x-www-form-urlencoded\">";
			echo "<span class=\"content_titles\">Check the boxes to select new Administrators:</span><br />";
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
			$query = "SELECT firstname, lastname, hvzid, hvzidext, phone, human, admin, oz, ozchoice, email FROM members WHERE 1";
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
						echo"<span class=\"id_no\"> <input name=\"check[]\" type=\"checkbox\" value=\"".$hvzid."\" disabled=\"true\" /></span>
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

function changelife()
{
	global $cxn;
	
		echo "<center>Allow the page to load before changing anyone's status. The statuses will activate when the page loads. <font style=\"color:#FF0000;\"><b>DO NOT</b> use Firefox on Apple OSX.</font> The dropdown boxes will not work properly and it may give some strange results, such as turning the wrong people to the wrong status. Use Chrome or Safari instead. Firefox on Windows is fine. Safari, however, does some funky stuff with the layout. It should still work regardless.</center>";
		echo "<form action=\"?action=changelife2\" method=\"post\" enctype=\"application/x-www-form-urlencoded\">";
			echo "<span class=\"content_titles\">Check the boxes to set as human:</span><br />";
			echo "<div class=\"row_title\">".PHP_EOL;
			echo"<span class=\"life_select\">Zombie?</span>
						<span class=\"hvzid\">hvzid-ext</span>
						<span class=\"first_name\">First Name</span>
						<span class=\"last_name\">Last Name</span>
						<span class=\"phone_no\">Phone</span>
						<span class=\"life_status\">Life Status</span>
					</div>".PHP_EOL;
			
			//get and print table
			$query = "SELECT firstname, lastname, hvzid, hvzidext, phone, human, oz FROM members WHERE admin='0' AND isplaying='1'";
			if ($stmt = mysqli_prepare($cxn, $query)) {
				mysqli_stmt_execute($stmt);
			
				/* bind variables to prepared statement */
				mysqli_stmt_bind_result($stmt, $firstname, $lastname, $hvzid, $hvzidext, $phone, $human, $oz);
			
				
				$i = 0;
				
				//for human, zombie and oz counts
				$h = 0;
				$z = 0;
				$o = 0;
					
				/* fetch values */
				while (mysqli_stmt_fetch($stmt)) {
					if($i&1)
					{	echo "<div class=\"row_even\">".PHP_EOL;	}
					else
					{	echo "<div class=\"row_odd\">".PHP_EOL;	}
						if($human==1) {
							$status = 'Human';
							$life_select = '<option value="0" selected="selected">Human</option><option value="1">Zombie</option><option value="2">OZ</option>';
							$h++;
						}
						if($human==0) {	
							$status = 'Zombie';
							$life_select = '<option value="0">Human</option><option value="1" selected="selected">Zombie</option><option value="2">OZ</option>';
							$z++;
						}
						if($oz==1) {
							$status = 'OZ';	
							$life_select = '<option value="0">Human</option><option value="1">Zombie</option><option value="2" selected="selected">OZ</option>';
							$o++;
						}
							
						echo"<span class=\"id_no\"></span>";
						echo "<span class=\"hvzid\">".$hvzid."-".$hvzidext."</span>
							<span class=\"life_select\">
							<select disabled=\"disabled\" class=\"life\" id='".$hvzid."'>".$life_select."</select><span class=\"loader\" id=\"loader_".$hvzid."\"><img src=\"http://".$_SERVER['SERVER_NAME']."/images/loadingicons/redloader.gif\" /></span>
							</span>
							<span class=\"first_name\">".$firstname."</span>
							<span class=\"last_name\">".$lastname."</span>
							<span class=\"phone_no\">".$phone."</span>
							<span class=\"life_status\">".$status."</span>
						</div>".PHP_EOL;
				
					$i++;	//increment i for the color-coded rows
				}
		
					/* close statement */
					mysqli_stmt_close($stmt);
			}	
			if(!mysqli_prepare($cxn, $query))
			{
				echo mysqli_error($cxn);
			}
			$i = $h + $z + $o;
			echo "<center>".$i." Players, ".$h." Humans, ".$z." Zombes, ".$o." OZs</center></form>";
		return;
}//end function

function changelife2()
{
	global $cxn;

		$selected = $_REQUEST['check'];
		
		foreach($selected as $value)
		{
			$query = "UPDATE members SET human='1' WHERE hvzid='".$value."'";
			$result = mysqli_query($cxn, $query);
		}
		
		echo "Players have been set to human";

	return;
}
?>
