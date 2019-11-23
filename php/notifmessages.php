<?php
	if(!defined('hvz'))
	{	die('Access Denied...');	}
	
	
	/********************
	 *	Function Directory
	 *		messageparse($content) = parses a message for view
	 *		viewmessages(void) = view all messages
	 *		viewindivmessage(void) = view an individual message
	 *		viewnotifications = view all notifications
	 *		notifviewed(void) = checks a notification as viewed in database
	 *		viewrss(void) = view notifications in an rss feed
	 ***************************/
	 
	function messageparse($content)
	{
		 global $cxn;
		 	
			if($content == '[internal firstmessage]')
			{
				$content = "Welcome to hvzatfsu.com,".PHP_EOL."We have changed a lot since the first time we opened. And we have opened a lot of new things. Each member has a <a href=\"profile.php\">profile,</a> and a <a href=\"http://blog.hvzatfsu.com\">blog</a>. The basics are all still there, and if you have played before, your HvZID shouldn't have changed.".PHP_EOL."Welcome to the site. Don't hesitatie to <a href=\"feedback.php\">contact</a> us if you have help, or check out the <a href=\"help.php\">help pages</a>".PHP_EOL;
				return $content;
			}
			
			//bbcode to easy html ([b] -> <strong>)
			$bbcode = array('[b]', '[/b]', '[i]', '[/i]', '[u]', '[/u]', '[center]', '[/center]', '[s]', '[/s]');	//simple conversion bb code
			$htmlcode = array('<strong>', '</strong>', '<em>', '</em>', '<span style=\"text-decoration:underline;\">', '</span>', '<center>', '</center>', '<span style=\"text-decoration:line-through;\">', '</span>');					
			$content = str_replace($bbcode, $htmlcode, $content);
			
			/** url with http:// to link ([url]http://link[/url] -> <a href="link">http://link</a>) **/
			$content = preg_replace("#\[url\]http://(.+?)\[/url\]#is", 
						"<a href=\"http://".$_SERVER['SERVER_NAME']."/link.php?lnk=\\1\" class=\"forumlink\" target=\"_blank\">\\1</a>", $content );
			
			/** color to style color ([color= ]-> <span style="font-color: "></span>) **/
			$content = preg_replace("#\[color=(.+?)\]#is", 
						"<span style=\"color:\\1\" />", $content );
			$content = str_replace("[/color]","</span>",$content);
			
			$content = nl2br($content);
		 return $content;
	} //end function
	 
	function viewmessages()
	{
	 	global $cxn;

			$query = "SELECT COUNT(id) FROM messages WHERE tohvzid='".$_COOKIE['hvzid']."' AND viewed='0' AND recieveshow='1'";
			$result = mysqli_query($cxn, $query);
			$msgnum = mysqli_fetch_assoc($result);
			
			echo "
			
			<div id=\"messages\">
				
				<div id=\"notiftop\">
					<span id=\"notiftitle\">You have ".$msgnum['COUNT(id)']." unread message";
					if($msgnum['COUNT(id)'] == 1)
					{	/* do nothing */	}
					else
					{	echo "s";	}
					echo "</span>
					
					<div id=\"notifoptions\">
						<span id=\"notifopt1\"><a href=\"javascript://\" onclick=\"showsent()\">Sent Messages</a> | <a href=\"javascript://\" onclick=\"showreceived()\">Received Messages</a></span>
						
						<br class=\"clearfloat\" />
					</div>
				</div>";
			echo "<div id=\"viewmessages\">";
			$query = "SELECT * FROM messages WHERE tohvzid='".$_COOKIE['hvzid']."' AND receiveshow='1' ORDER BY datetime DESC";
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
						if($msg['fromhvzid'] == 'SYSTEM')
						{
							$frominfo['firstname'] = 'HvZatFSU';
							$frominfo['lastname'] = '';
						}
						else
						{
							$query2 = "SELECT firstname, lastname FROM members WHERE hvzid='".$msg['fromhvzid']."'";
							$result2 = mysqli_query($cxn, $query2);
							$frominfo = mysqli_fetch_assoc($result);
						}
						if($msg['viewed'] == 0)
						{	echo "<div class=\"indivnotifunview\" id=\"msg".$msg['id']."\">";	}
						else
						{	echo "<div class=\"indivnotif\" id=\"msg".$msg['id']."\">";	}
							echo "<span class=\"notiffrom\">From: ".$frominfo['firstname']." ".$frominfo['lastname']."</span><span class=\"options\"><a href=\"javascript://\" onclick=\"deletemsg(".$msg['id'].")\">Delete</a></span>";
							echo "<div class=\"indivnotiftext\">".substr($msg['msgtext'],0,50)."<span class=\"notiflink\"><a href=\"?view=indivmsg&msgid=".$msg['id']."\" class=\"helplinks\">View</a></span>
							</div><div class=\"indivnotiftime\">At ".date('g:i a \o\n F j', $msg['datetime'])."</div>
						</div><!-- end indivnotif-->".PHP_EOL;
				}
			}
			echo "</div><!-- end view messages div -->";
			echo "</div> <!-- end messages div -->";
		return;
	}//end function
	
	function viewindivmessage()
	{
		global $cxn;
			$query = "SELECT * FROM messages WHERE id='".sanitize($_REQUEST['msgid'])."'";
			$result = mysqli_query($cxn, $query);
			$msg = mysqli_fetch_assoc($result);
			
			$query = "SELECT firstname, lastname FROM members WHERE hvzid='".$msg['fromhvzid']."'";
			$result = mysqli_query($cxn, $query);
			$info = mysqli_fetch_assoc($result);
			
			echo "<div id=\"indivmessage\">
				<div id=\"notiftop\">
					<span id=\"notifopt1\"><input type=\"button\" value=\"Delete Message\" class=\"btn\" onclick=\"deletemessage(".$msg['id'].");\" /> <input type=\"button\" class=\"btn\" value=\"Reply\" onclick=\"replytomsg(".$msg['id'].");\" /></span>
                    <span id=\"notifopt2\"><a href=\"?view=messages\">Back to Message Inbox</a> </span>
					<br class=\"clearfloat\" />
				</div>
				<div id=\"message\">";
					echo "<div id=\"messageheader\">
								<div id=\"mht\">
									<span id=\"messagefrom\">From: <a href=\"profile.php?hvzid=".$msg['tohvzid']."\" >".$info['firstname']." ".$info['lastname']."</a></span>
									<span id=\"messageinfo\">Time: ".date('F j,Y \a\t g:i:s a', $msg['datetime'])."</span>
									<br class=\"clearfloat\">
								</div>
								<div id=\"mhb\">
									Subject: ".$msg['subject']."
								</div>
							</div>
							<div id=\"messagebody\">";
							
							echo messageparse($msg['msgtext']);
							
				echo "</div><!-- end message body -->
				<div id=\"messagefooter\">
					&nbsp;
				</div>
				</div><!-- end message -->
			</div>";
			
			$query = "UPDATE messages SET viewed='1' WHERE id='".sanitize($_REQUEST['msgid'])."'";
			mysqli_query($cxn, $query);
			
		return;
	}//end function
	
	function sendmessage()
	{
		global $cxn;
		require('security.php');
			$query = "INSERT INTO messages(subject, tohvzid, fromhvzid, msgtext, datetime)
								VALUES('".sanitize($_REQUEST['subject'])."', '".sanitize($_REQUEST['tohvzid'])."', '".$_COOKIE['hvzid']."', '".sanitize($_REQUEST['msgtext'])."', '".time()."')";
			$result = mysqli_query($cxn, $query);
			
			$query = "UPDATE members SET messages=messages+1 WHERE hvzid='".sanitize($_REQUEST['tohvzid'])."'";
			$result = mysqli_query($cxn, $query);
		
		return;
	}
	
	function viewnotifications()
	{
		global $cxn;
        	
			$hvzid = $_COOKIE['hvzid'];
			$query = "SELECT notifications, personalkey, messages FROM members WHERE hvzid='".$_COOKIE['hvzid']."'";
			$result = mysqli_query($cxn, $query);
			$notifnum = mysqli_fetch_assoc($result);
        	echo "<div id=\"notifications\">
            	<div id=\"notiftop\">
                	<span id=\"notiftitle\">You have ".$notifnum['notifications']." unseen notifications.</span>
                    <div id=\"notifoptions\">
                    	<span id=\"notifopt1\">Subscribe and view your Notifications via <a href=\"?view=rss&notif=".$_COOKIE['hvzid']."&viewby=".$_COOKIE['hvzid']."&key=".$notifnum['personalkey']."\">RSS</a></span>
                        <span id=\"notifopt2\"><a href=\"?view=messages\">View Messages(".$notifnum['messages'].")</a> </span>
						<br class=\"clearfloat\" />
                    </div>
                </div>
                <div id=\"notifside\"></div>
                <div id=\"notifbody\">";
				mysqli_free_result($result);
				$query = "SELECT * FROM notifications WHERE hvzid='".$_COOKIE['hvzid']."' ORDER BY notiftime DESC";
				$result = mysqli_query($cxn, $query);
                while($notif = mysqli_fetch_assoc($result))
				{
					if($notif['viewed'] == 0)
					{	echo "<div class=\"indivnotifunview\" id=\"notif".$notif['id']."\">";	}
					else
					{	echo "<div class=\"indivnotif\" id=\"notif".$notif['id']."\">";	}
					
                    	echo "<div class=\"indivnotiftext\">".$notif['notiftext']."<span class=\"notiflink\">";
						echo "<a href=\"http://".$_SERVER['SERVER_NAME']."/".$notif['notiflink']."\" class=\"helplinks\">Link</a></span>
						</div><div class=\"indivnotiftime\">At ".date('g:i a \o\n F j', $notif['notiftime'])."</div>
					</div><!-- end indivnotif-->".PHP_EOL;
				}
					
                echo "</div>
                <br class=\"clearfloat\" />
             </div>";
			 notifviewed();
		return;
	}//end function
	
	function notifviewed()
	{
		global $cxn;
			
			$query = "UPDATE notifications SET viewed='1' WHERE hvzid='".$_COOKIE['hvzid']."'";
			$result = mysqli_query($cxn, $query);
			
			$query = "UPDATE members SET notifications=0 WHERE hvzid='".$_COOKIE['hvzid']."'";
			$result = mysqli_query($cxn, $query);
		return;
	}
	function viewrss()
	{
		global $cxn;
			require('sanitize.php');
			if(!isset($_REQUEST['notif']) || !isset($_REQUEST['viewby']))
			{	die('This feed has expired. To view your notifications, go to <a href="http://'.$_SERVER['SERVER_NAME'].'/notifications.php');	}
			
			if($_REQUEST['notif'] != $_REQUEST['viewby'])
			{	die('This feed has expired. To view your notifications, go to <a href="http://'.$_SERVER['SERVER_NAME'].'/notifications.php');	}
			
			$query = "SELECT COUNT(id), key, firstname, lastname FROM members WHERE hvzid='".sanitize($_REQUEST['notif'])." GROUP BY id'";
			$result = mysqli_query($cxn, $query);
			$meminfo = mysqli_fetch_assoc($result);
			if($_REQUEST['key'] != $meminfo['key'])
			{	die('This feed has expired. To view your notifications, go to <a href="http://'.$_SERVER['SERVER_NAME'].'/notifications.php');	}
			if($meminfo['COUNT(id)'] != 1)
			{	die('This feed has expired. To view your notifications, go to <a href="http://'.$_SERVER['SERVER_NAME'].'/notifications.php');	}
			
			/** If they get to this point, they're either real or really good. Either way, all the info is correct ***/
			
			//And this is where the RSS feed goes
			
		return;
	}
?>
