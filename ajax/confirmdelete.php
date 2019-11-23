<?php 
	if($_REQUEST['action'] == 'delete')
	{
		define('hvz',1);
		require('../php/security.php');
		require('../php/settings.php');
			$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
			
		$query = "UPDATE messages SET receiveshow='0' WHERE id='".sanitize($_REQUEST['msgid'])."'";
		$result = mysqli_query($cxn, $query);
		
		mysqli_close($cxn);
		
		return true;
	}
	if($_REQUEST['action'] == 'deletesent')
	{
		define('hvz',1);
		require('../php/security.php');
		require('../php/settings.php');
			$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
			
		$query = "UPDATE messages SET sendshow='0' WHERE id='".sanitize($_REQUEST['msgid'])."'";
		$result = mysqli_query($cxn, $query);
		
		mysqli_close($cxn);
		
		return true;
	}
?>

<div id="popupframebody">
    <div id="popupframebody_title">Delete Message</div>
	<center>
    	Are you <strong>SURE</strong> you want to delete this message?
        <br />
        <input type="button" class="btn" id="popupbtn" value="Yes" onClick="confirmdelete(<?php echo $_REQUEST['msgid'];?>)" />
        &nbsp;&nbsp;&nbsp;
        <input type="button" class="btn" id="popupbtn" value="No" onclick="closepopupframe();" /><br />
        <span class="loading" style="display:none;"><img src="images/icons/redloader.gif"></span>
    </center>
    <br /><br /><br /><br />
</div>

<div id="popupframefooter">

</div>

<div id="deleted">
	<div id="popupframebody_title">Message Deleted</div>
	<center>
    	This message has been deleted.
        <br /><br /><br />
        <input type="button" class="btn" id="popupbtn" value="Okay" onclick="window.location.href='notifications.php?view=messages'" />
    </center>
    <br /><br /><br /><br />
</div>


