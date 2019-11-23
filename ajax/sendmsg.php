<?php
	//(c) 2011 Thomas Tricarico
	/**************************
	 *	Function Directory
	 *		viewtemplate(void) = loads the send message template
	 *		sendmessage(void) = sends a message
	 **************************/
	 
	 
	 function viewtemplate()
	 {
		define('hvz', 1);
		require('../php/settings.php');
		require('../php/security.php');
		global $cxn;
			$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
		$query = "SELECT * FROM members WHERE hvzid='".sanitize($_REQUEST['tohvzid'])."'";
		$result = mysqli_query($cxn, $query);
		$row = mysqli_fetch_assoc($result);
        echo "<div id=\"popupframebody\">
	<div id=\"popupframebody_title\">Send Message</div>
	<form name=\"sendmessage\" \">
            To: <span class=\"msgto\">".$row['firstname']." ".$row['lastname']."</span><br />
			<input type=\"hidden\" id=\"tohvzid\" name=\"tohvzid\" value=\"".$_REQUEST['tohvzid']."\" />
            Subject: <input type=\"text\" maxlength=\"255\" id=\"msgsubject\" class=\"msgtext\" /><br />
            Message:&nbsp;&nbsp;<span class=\"msgerror\">Please Insert a Message</span>
            <center><textarea rows=\"7\" id=\"textbox\"></textarea></center>
            <input type=\"button\" value=\"Send Message\" id=\"msgsubmit\" class=\"msgsubmit\" onclick=\"sendmsg();return false;\" />
        </form>

    	
</div>

<div id=\"popupframefooter\"></div>";
        mysqli_close($cxn);
		return;
	 }
	 
	 function sendmessage()
	 {
			define('hvz', 1);
		require('../php/settings.php');
		require('../php/security.php');
		global $cxn;
			$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
		$query = "INSERT INTO messages(subject, tohvzid, fromhvzid, msgtext, datetime)
								VALUES('".sanitize($_REQUEST['s'])."', '".sanitize($_REQUEST['tohvzid'])."', '".$_COOKIE['hvzid']."', '".sanitize($_REQUEST['msg'])."', '".time()."')";
		$result = mysqli_query($cxn, $query);

		$query = "UPDATE members SET messages=messages+1 WHERE hvzid='".sanitize($_REQUEST['tohvzid'])."'";
		$result = mysqli_query($cxn, $query);

		echo "<div id=\"popupframebody\">
	<div id=\"popupframebody_title\"></div>
	<br /><br /><br /><br /><br /><br />
	<center><h2>Message Sent</h2></center>
	<br /><br /><br /><br /><br /><br />

    	
</div>

<div id=\"popupframefooter\"></div>";
			return;
		mysqli_close($cxn);
	}
	 




	$viewArray = array(     //'$action=' array variables  'action name' => array('File function is in..', 'Function name')
			'template' => array('viewtemplate'),
			'sendmessage' => array('sendmessage')
		);
		
		if (!isset($_REQUEST['action']) || !isset($viewArray[$_REQUEST['action']]))	//if not view=profile, make it so
		{
			//do nothing
		}					
		else
		{
			$function = $viewArray[$_REQUEST['action']][0];
		}

	 $function();

?>