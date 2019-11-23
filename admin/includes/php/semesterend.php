<?php
	if(!defined('hvz'))
	{	die('Access Denied....');	}


	function resetdues()
	{
		global $cxn;
		if(!isset($_REQUEST['req']))
		{
			echo"<table width=\"80%\" border=\"0\">
			  <tr>
				<th scope=\"col\">Are you SURE you want to reset the dues roster? (This CANNOT be undone)</th>
				</tr>
			  <tr>
				<td><div align=\"center\"><a href=\"#\" onclick=\"deleteconfirm();\" class=\"duesreset_yes\">Yes, I do want to delete everything forever.</a> | <a href=\"admin.php\" class=\"duesreset_no\">No, maybe I should make sure.</a></div></td>
				</tr>
			</table>";
		}
		if(isset($_REQUEST['req']))
		{	$action = $_REQUEST['req'];	
			if($action == 'resetall')
			{
				$query = "DELETE FROM paydues WHERE 1";
				$result = mysqli_query($cxn, $query);
				$rows = mysqli_affected_rows($cxn);
				$timedone = time();
				echo "Deleted ".$rows." entries.";
			}
		}
		
		return;
	}
?>