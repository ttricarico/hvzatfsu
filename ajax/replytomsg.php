<?php 
	define('hvz',1);
	require('../php/security.php');
	require('../php/settings.php');
		$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
			
	$query = "SELECT fromhvzid FROM messages WHERE id='".sanitize($_REQUEST['msgid'])."'";
	$result = mysqli_query($cxn, $query);
	$msginfo = mysqli_fetch_assoc($result);


	
	
	
	$query = "SELECT firstname, lastname FROM members WHERE hvzid='".$msginfo['fromhvzid']."'";
	$result = mysqli_query($cxn, $query);
	
	$row = mysqli_fetch_assoc($result);

?>
<div id="popupframebody">
    <div id="popupframebody_title">Send Message</div>
    <form name="sendmessage">
            To: <span class="msgto"><?php echo $row['firstname']." ".$row['lastname']; ?></span><br />
            <input type="hidden" id="tohvzid" name="tohvzid" value="<?php echo sanitize($_REQUEST['tohvzid']);?>" />
            Subject: <input type="text" maxlength="255" id="msgsubject" class="msgtext" /><br />
            Message:&nbsp;&nbsp;<span class="msgerror" style="display:none; color: #FF0000;">Please Insert a Message</span>
            <center><textarea rows="7" style="width:95%; margin-left:auto;margin-right:auto;" id="textbox" class="msgtext" ></textarea></center>
            <input type="button" value="Send Message" id="msgsubmit" class="btn" onclick="sendmsg();return false;" />
            <span class="loading" style="display:none; padding-left:15px;"><img src="images/icons/redloader.gif" title="Loading..." /></span>
        </form>

        
</div>

<div id="popupframefooter"></div>



<?php
	if($_REQUEST['action'] == 'sendmsg')
	{
		$query = "INSERT INTO messages(subject, tohvzid, fromhvzid, msgtext, datetime)
							VALUES('".sanitize($_REQUEST['subject'])."', '".sanitize($_REQUEST['tohvzid'])."', '".$_COOKIE['hvzid']."', '".$_REQUEST['tohvzid']."', '".time()."')";
		
		$result = mysqli_query($cxn, $query);
	}


 		mysqli_close($cxn);
	
?>
<div id="messagesent">
    <div id="popupframebody_title">Message Sent</div>
    <center>
        <br /><br /><br /><br /><br /><br /><br /><br />
        <input type="button" class="btn" value="Okay" onClick="closepopupframe();" />
        <br /><br /><br /><br /><br /><br /><br /><br />
	</center>
</div>