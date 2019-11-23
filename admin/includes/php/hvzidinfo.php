<?php
	if(!defined('hvz'))
	{	die("Access Denied...");	}
		
	function hvzinfo_main()
	{
		global $connection, $hvzid, $username;
		include('getfns.php');
		//these are the get_something functions. Most are very small
		$killnumber = get_total_kills();
		$whokilled = get_who_killed();
		$numgamesplayed = get_num_games();
		$duespayed = get_dues_payed();
		$duesreceipt = get_dues_receipt();
		$firstname = get_firstname();
		$lastname = get_lastname();
		$phone = get_phoneno();
		$email = get_email();
		$hvzidext = get_hvzidext();
		
		
		$hvzid = $_REQUEST['hvzid'];
		
		/*$query = "SELECT * FROM members WHERE hvzid='$hvzid'";
		$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
		$row = mysqli_fetch_assoc($result);
		*/
		echo"<table width=\"90%\" border=\"0\">
			  <tr>
				<td width=\"25%\">FSU HvZ ID + ext: </td>
				<td width=\"25%\">".$hvzid."-".$hvzidext."</td>
				<td width=\"25%\">First Name:</td>
				<td width=\"25%\">".$firstname."</td>
			  </tr>
			  <tr>
				<td>HvZ at FSU Username:</td>
				<td>".$username."</td>
				<td>Last Name:</td>
				<td>".$lastname."</td>
			  </tr>
			  <tr>
				<td>Number of Kills:</td>
				<td>".$killnumber."</td>
				<td>Phone Number:</td>
				<td>".$phone."</td>
			  </tr>
			  <tr>
				<td>Who killed: </td>
				<td>".$whokilled."</td>
				<td>Email Address:</td>
				<td>".$email."</td>
			  </tr>
			  <tr>
				<td>Favorite Place to hunt:</td>
				<td>Not Available Yet</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				<td>Number of games played:</td>
				<td>".$numgamesplayed."</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				<td>Dues Payed:</td>
				<td>".$duespayed."</td>
				<td>Dues Receipt Number:</td>
				<td>".$duesreceipt."</td>
			  </tr>
			  <tr>
				<td colspan=\"4\"><hr width=\"90%\" size=\"1px\" /></td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			  </tr>
			</table>
			<br /><br /><br /><br /><br /><br /><br />";
			return;
}

?>