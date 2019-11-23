<?php
	header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	header ('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
	header ('Cache-Control: no-cache, must-revalidate'); // HTTP/1.1
	header ('Pragma: no-cache'); // HTTP/1.0

	/****MySQL Login***/
	include('../php/settings.php');
		global $cxn;
		$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);


	function getsent()
	{
		global $cxn;
		
			$query = "SELECT * FROM messages WHERE fromhvzid='".$_COOKIE['hvzid']."' AND sendshow='1' ORDER BY datetime DESC";
			$result = mysqli_query($cxn, $query);
			
			if(mysqli_num_rows($result) < 1)
			{
				echo "<br /><br /><br />";
				echo "<center>You have not sent a message</center>";
				//echo "<br /><input type=\"button\" id=\"btn\" class=\"sendmsgbtn\" value=\"Send Message\" onclick=\"openpopup('sendmsg');\" /></center>";
				echo "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";
			}
			else
			{
				while($msg = mysqli_fetch_assoc($result))
				{
						if($msg['viewed'] == 0)
						{	echo "<div class=\"indivnotifunview\" id=\"msg".$msg['id']."\">";	}
						else
						{	echo "<div class=\"indivnotif\" id=\"mag".$msg['id']."\">";	}
							
							$query = "SELECT firstname, lastname FROM members WHERE hvzid='".$msg['tohvzid']."'";
							$result2 = mysqli_query($cxn, $query);
							$frominfo = mysqli_fetch_assoc($result2);
							
							echo "To: <a href=\"profile.php?hvzid=".$msg['fromhvzid']."\" class=\"msgfromprof\">".$frominfo['firstname']." ".$frominfo['lastname']."</a><span class=\"options\"><a href=\"javascript://\" onclick=\"deletesentmsg(".$msg['id'].")\">Delete</a></span>";
							echo "<div class=\"indivnotiftext\">".substr($msg['msgtext'],0,50)."<span class=\"notiflink\"><a href=\"?view=indivmsg&msgid=".$msg['id']."\" class=\"helplinks\">View</a></span>
							</div><div class=\"indivnotiftime\">At ".date('g:i a \o\n F j', $msg['datetime'])."</div>
						</div><!-- end indivnotif-->".PHP_EOL;
				}
			}
		return;	
	}
	
	function getreceived()
	{
		global $cxn;
		
			$query = "SELECT * FROM messages WHERE tohvzid='".$_COOKIE['hvzid']."' AND receiveshow ='1' ORDER BY datetime DESC";
			$result = mysqli_query($cxn, $query);
			

			if(mysqli_num_rows($result) < 1)
			{
				echo "<br /><br /><br />";
				echo "<center>You have no unread messages.";
				//echo "<br /><input type=\"button\" id=\"btn\" class=\"sendmsgbtn\" value=\"Send Message\" onclick=\"openpopup('sendmsg');\" /></center>";
				echo "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";
			}
			else
			{
				while($msg = mysqli_fetch_assoc($result))
				{
						if($msg['viewed'] == 0)
						{	echo "<div class=\"indivnotifunview\" id=\"msg".$msg['id']."\">";	}
						else
						{	echo "<div class=\"indivnotif\" id=\"mag".$msg['id']."\">";	}
							
							$query = "SELECT firstname, lastname FROM members WHERE hvzid='".$msg['fromhvzid']."'";
							$result2 = mysqli_query($cxn, $query);
							$frominfo = mysqli_fetch_assoc($result2);
							
							echo "From: <a href=\"profile.php?hvzid=".$msg['fromhvzid']."\" class=\"msgfromprof\">".$frominfo['firstname']." ".$frominfo['lastname']."</a><span class=\"options\"><a href=\"javascript://\" onclick=\"deletemsg(".$msg['id'].")\">Delete</a></span>";
							echo "<div class=\"indivnotiftext\">".substr($msg['msgtext'],0,50)."<span class=\"notiflink\"><a href=\"?view=indivmsg&msgid=".$msg['id']."\" class=\"helplinks\">View</a></span>
							</div><div class=\"indivnotiftime\">At ".date('g:i a \o\n F j', $msg['datetime'])."</div>
						</div><!-- end indivnotif-->".PHP_EOL;
				}
			}
		return;	
	}
	
	if($_REQUEST['type'] == 'sent')
	{
		echo "<div id=\"output\">";
			getsent();
		echo "</div>";
	}
	if($_REQUEST['type'] == 'received')
	{
		echo "<div id=\"output\">";
			getreceived();
		echo "</div>";
	}
	mysqli_close($cxn);
	
?>