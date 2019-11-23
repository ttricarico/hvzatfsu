<?php
	if(!defined('hvz'))
	{	die('Access Denied...');	}
	/*******
	 *	(c) 2011 Thomas Tricarico
	 *
	 *	Function Directory:
	 *		rawcontenttoformatted($content) = Converts raw bbcode and information into formatted post
	 *		--(we dont need a formatted->raw: everything is formatted on the fly, the database hold unformatted posts)
	 *		newpost(void) = seperate page for creating a post, contains buttons and stuff to format
	 *		newpost2(void) = actually puts post in database
	 *		deletepost(void) = deletes post from database FOREVER
	 *		reportpost(void) = reports post to moderators
	 *		editpost(void) = edits the post
	 *		editpost2(void) = loads the edited post into the database
	 *		viewpost(void) = views a specific post, and only the post someone is tagged in
	 *		removetag(void) = removes tag of specific person
	 *********************************/
	
	function rawcontenttoformatted($content)
	{
		global $cxn;
			$bbcode = array('[b]', '[/b]', '[i]', '[/i]', '[u]', '[/u]', '[center]', '[/center]', '[s]', '[/s]');	//simple conversion bb code
			$htmlcode = array('<strong>', '</strong>', '<em>', '</em>', '<span style=\"text-decoration:underline;\">', '</span>', '<center>', '</center>', '<span style=\"text-decoration:line-through;\">', '</span>');	//bbcode to easy html ([b] -> <strong>)
			$content = str_replace($bbcode, $htmlcode, $content);
			
			//bbcode into html that changes styles ([quote] -> <div style>)
			$bbcode2 = array('[quote]', '[/quote]', '[code]', '[/code]');
			$htmlcode2 = array('<div class="quote"><span class="codequotehead">Quote:</span>', '</div>', 
								'<div class="code"><span class="codequotehead">Code view:</span><pre>', '</pre>');
			$content = str_replace($bbcode2, $htmlcode2, $content);
			//bbcode font-size to style ([size=1] -> <span style="font-size:8px;">
			$bbcode3 = array('[size=1]', '[size=2]', '[size=3]', '[size=4]', '[size=5]',
							 '[size=6]', '[size=7]', '[size=8]', '[size=9]', '[size=10]', '[/size]');
			$htmlcode3 = array('<span style="font-size:10px;">', '<span style="font-size:12px;">', '<span style="font-size:14px;">', '<span style="font-size:16px;">', '<span style="font-size:20px;">', '<span style="font-size:24px;">', '<span style="font-size:28px;">','<span style="font-size:32px;">','<span style="font-size:36px;">','<span style="font-size:42px;">', '</span>');
			$content = str_replace($bbcode3, $htmlcode3, $content);
			/** profile to link ([profile id=XXX] -> <a href=profile.php?hvzid=XXX>)	**/
			$content = preg_replace("#\[profile id=(.+?)\](.+?)\[/profile\]#is", 
						"<a href=\"".$_SERVER['SERVER_NAME']."/profile.php?hvzid=\"\\1\">\\2</a>", $content );
			/** market id to link ([market id=XXX] -> <a href=marketplace/viewitem.php?item=XXX>)**/
			$content = preg_replace("#\[market id=(.+?)\](.+?)\[/market\]#is", 
						"<a href=\"".$_SERVER['SERVER_NAME']."/marketplace/viewitem.php?item=\"\\1\">\\2</a>", $content );
						
			/** url to link ([url]link[/url] -> <a href="link">http://link</a>) **/
			$content = preg_replace("#\[url\](.+?)\[/url\]#is", 
						"<a href=\"http://".$_SERVER['SERVER_NAME']."/link.php?lnk=\\1\" class=\"forumlink\" target=\"_blank\">\\1</a>", $content );
			/** url with http:// to link ([url]http://link[/url] -> <a href="link">http://link</a>) **/
			$content = preg_replace("#\[url\]http://(.+?)\[/url\]#is", 
						"<a href=\"http://".$_SERVER['SERVER_NAME']."/link.php?lnk=\\1\" class=\"forumlink\" target=\"_blank\">\\1</a>", $content );
			/** img to actual linked image ([img]link[/img] -> <img src="link" />) **/
			$content = preg_replace("#\[img\](.+?)\[/img\]#is", 
						"<img src=\"\\1\" />", $content );
						/**** COLOR -> strreplace
			/** color to style color ([color= ]-> <span style="font-color: "></span>) **/
			$content = preg_replace("#\[color=(.+?)\]#is", 
						"<span style=\"color:\\1\" />", $content );
			$content = str_replace("[/color]","</span>",$content);
			
						
			/** link to profiles by @Firstname Lastname **/
			preg_match_all("#(@(.+?)\b (.+?)\b)#is", $content, $matches, PREG_PATTERN_ORDER);
		
		$query = "SELECT COUNT(id) FROM members WHERE firstname='".$matches[2][0]."' AND lastname='".$matches[3][0]."' GROUP BY id";
			$result = mysqli_query($cxn, $query);
			$row = mysqli_fetch_assoc($result);
			if($row['COUNT(id)'] != 0)	//if its not tagging a specific person, dont put it in
			{	
				$content = preg_replace("#(@(.+?)\b (.+?)\b)#is","<a href=\"http://".$_SERVER['SERVER_NAME']."/profile.php?s=lookup&firstname=\\2&lastname=\\3\" class=\"forumlink\">\\2 \\3</a>",$content);
			}
			
			/** Link to other posts **/
			$content = preg_replace("#(\#(.+?)\b)#is", 
						"<a href=\"\\1\" class=\"forumlink\" />\\1</a>", $content );

	
			//codes for colors
			$colorwords = array('color:blue', 'color:red', 'color:limegreen', 'color:yellow', 'color:black', 	//color names
								'color:orange', 'color:pink', 'color:purple', 'color:teal', 'color:silver', 
								'color:brown', 'color:green', 'color:cyan', 'darkblue', 'color:garnet',
								'color:gold', 'color:lightgrey', 'color:darkgrey', 'color:magenta', 'color:darkpurple');
								
			$htmlcolors = array('color:#0000FF', 'color:#FF0000', 'color:#00FF00', 'color:#FFFF00', 'color:#000000',	//color codes
								'color:#FFA500', 'color:#FF91A4', 'color:#800080', 'color:#008080', 'color:#C0C0C0', 	//color:#rrggbb
								'color:#964B00', 'color:#008000', 'color:#00FFFF', 'color:#00008B', 'color:#8B0000',
								'color:#FFD700', 'color:#BEBEBE', 'color:#808080', 'color:#FF1DCE', 'color:#682860');
			
			$content = str_replace($colorwords, $htmlcolors, $content);	//change words to colors
	
			//extra stuff
		#	$search = array('C:');
		#	$changeto = array(':)');
		return $content;
	}
	function newpost()
	{
		global $cxn;
			echo "<form action=\"?action=newpost2\" name=\"newpost\" method=\"post\">
    <input type=\"text\" name=\"name\" value=\"".$_COOKIE['firstname']." ".$_COOKIE['lastname']."\" readonly=\"readonly\" />&nbsp;::&nbsp;<input type=\"text\" name=\"hvzid\" value=\"".$_COOKIE['hvzid']."\" readonly=\"readonly\"/>
    <br />
    <div id=\"postinginfo\">
    <span id=\"postingleft\">Post Content:</span>
    <span id=\"postingright\">
    	<a href=\"#\">Back to Thread</a>
    </span>
    <br class=\"clearfloat\" />
    </div>
	<center>
    <textarea style=\"width:75%;\" rows=\"15\" name=\"postcontent\"></textarea>
    </center>
	<br /><input type=\"submit\" id=\"newpostbtn\" value=\"Submit New Post\" />
    </form>";
	echo "<table width=\"95%\" border=\"0\" align=\"center\">
      <tr>
        <td colspan=\"4\"><p>We use a modified form of bbCode in the forums. You can use any of the bbCode below to format your post.<br />
          HTML, CSS, JavaScript is all forbidden, and will be stripped before posting</p></td>
      </tr>
      <tr>
        <td colspan=\"4\"><center>
          Quotes and Code Blocks
          </center></td>
      </tr>
      <tr>
        <td colspan=\"2\">[quote]Some text that will be quoted in the post.[/quote]</td>
        <td colspan=\"2\">[code]Other Text that will be in code form[/code]</td>
      </tr>
      <tr>
        <td colspan=\"2\"><div class=\"quote\"><span class=\"quotecodehead\">Quote View:</span>Some text that will be quoted in the post.</div></td>
        <td colspan=\"2\"><div class=\"code\"><span class=\"quotecodehead\">Code View:</span>
              <pre>Other Text that will be in code form</pre>
          </div></td>
      </tr>
      <tr>
        <td height=\"21\" colspan=\"4\">&nbsp;</td>
      </tr>

      <tr>
        <td width=\"127\" height=\"27\">[b][/b]</td>
        <td width=\"238\"><strong>Bold Text</strong></td>
        <td width=\"324\">[url]http://hvzatfsu.com[/url]</td>
        <td width=\"192\"><a href=\"http://hvzatfsu.com/\" class=\"forumlink\">http://hvzatfsu.com</a></td>
      </tr>
      <tr>
        <td>[i][/i]</td>
        <td><em>Italic Text</em></td>
        <td>[profile id=hvzid]Someone's Profile[/profile]</td>
        <td><a href=\"http://".$_SERVER['SERVER_NAME']."/profile.php?hvzid=hvzid\" class=\"forumlink\">Someone's Profile</a></td>
      </tr>
      <tr>
        <td>[u][/u]</td>
        <td><span style=\"text-decoration:underline;\">Underlined Text</span></td>
        <td>[center][/center]</td>
        <td><center>
          Centered Text
          </center></td>
      </tr>
      <tr>
        <td>[size={1-6}][/size]</td>
        <td><p>Text sizes 1-6<br />
          You can also use pixel sizes, too.</p>        </td>
        <td >[img]http://hvzatfsu.com/images/homebutton.png[/img]</td>
        <td><img src=\"http://".$_SERVER['SERVER_NAME']."/images/homebutton.png\" width=\"110\" height=\"35\" /></td>
      </tr>
    <tr>
      <td>&nbsp;</td>
        <td><center>[color=name][/color]</center></td>
        <td><center>Text colors from below.</center></td>
        <td>&nbsp;</td>
      </tr>
    <tr>
        <td colspan=\"4\"><table width=\"100%\" border=\"0\">
          <tr>
            <td><div align=\"center\"><span style=\"color:#0000FF;\">blue </span></div></td>
            <td><div align=\"center\"><span style=\"color:#FF0000;\"> red </span></div></td>
            <td><div align=\"center\"><span style=\"color:#00FF00;\"> limegreen </span></div></td>
            <td><div align=\"center\"><span style=\"color:#FFFF00;\"> yellow </span></div></td>
            <td><div align=\"center\"><span style=\"color:#FFD700;\"> gold </span></div></td>
          </tr>
          <tr>
            <td><div align=\"center\"><span style=\"color:#FFA500;\"> orange</span></div></td>
            <td><div align=\"center\"><span style=\"color:#FF91A4;\"> pink </span></div></td>
            <td><div align=\"center\"><span style=\"color:#800080;\">purple </span></div></td>
            <td><div align=\"center\"><span style=\"color:#00008B;\"> darkblue </span></div></td>
            <td><div align=\"center\"><span style=\"color:#8B0000;\"> garnet </span></div></td>
          </tr>
          <tr>
            <td><div align=\"center\"><span style=\"color:#008080;\"> teal </span></div></td>
            <td><div align=\"center\"><span style=\"color:#964B00;\"> brown </span></div></td>
            <td><div align=\"center\"><span style=\"color:#00FFFF;\"> cyan </span></div></td>
            <td><div align=\"center\"><span style=\"color:#FF1DCE;\"> magenta </span></div></td>
            <td><div align=\"center\"><span style=\"color:#682860;\"> darkpurple</span></div></td>
          </tr>
          <tr>
            <td><div align=\"center\"><span style=\"color:#C0C0C0;\"> silver </span></div></td>
            <td><div align=\"center\"><span style=\"color:#008000;\"> green </span></div></td>
            <td><div align=\"center\"><span style=\"color:#BEBEBE;\"> lightgrey </span></div></td>
            <td><div align=\"center\"><span style=\"color:#808080;\"> darkgrey </span></div></td>
            <td><div align=\"center\"><span style=\"color:#000000;\"> black </span></div></td>
          </tr>
        </table></td>
      </tr>
    </table>";
		return;
	}
	
	function newpost2()
	{
		global $cxn;
			require_once('security.php');

			$postername = sanitize($_REQUEST['name']);			//prevent any kind
			$posterhvzid = sanitize($_REQUEST['hvzid']);		//of mysql injection
			$threadid = sanitize($_REQUEST['threadid']);		//sanitize() also removes
			$postcontent = sanitize($_REQUEST['postcontent']);	//any html tags
			$posterip = sanitize($_REQUEST['ipaddr']);
			
			// Upload the raw unformatted post content. That way, when it needs to be edited,
			// we can just take the raw post out of the database and we dont have to worry about
			// any sort of reformatting to the simple bbcode and such. All the posts are formatted
			// on the fly when they are loaded for viewing.
			
			$query = "SELECT locked FROM forums_threads WHERE id='".$threadid."'";
			$result = mysqli_query($cxn, $query);
			$info = mysqli_fetch_assoc($result);
			
			$query = "INSERT INTO forums_posts(postername, posterhvzid, posttime, posterip, threadid, postcontent)
							VALUES('".$postername."', '".$posterhvzid."', '".time()."', '".$posterip."', '".$threadid."', '".$postcontent."')";
			$result = mysqli_query($cxn, $query);
			mysqli_free_result($result);

			/** Send notification if someone is tagged **/
			preg_match_all("#(@(.+?)\b (.+?)\b)#is", $postcontent, $matches, PREG_PATTERN_ORDER);	//scan for tagged people
			$firstname = $matches[2][0];
			$lastname = $matches[3][0];

			/** Make sure someone is actually tagged, and not just a reference to an earlier post **/
		$query = "SELECT COUNT(id) FROM members WHERE firstname='".$firstname."' AND lastname='".$lastname."' GROUP BY id";
			$result = mysqli_query($cxn, $query);
			$row = mysqli_fetch_assoc($result);
			if($row['COUNT(id)'] != 0)
			{
				$query = "SELECT hvzid FROM members WHERE firstname='".$firstname."' AND lastname='".$lastname."'";
				$result = mysqli_query($cxn, $query);
				$hvzidget = mysqli_fetch_assoc($result);
				$notifhvzid = $hvzidget['hvzid'];
				
				/*** Insert Notification into table ***/
				$query = "INSERT INTO notifications(hvzid, notiftime, bywhohvzid, bywhoname, notifwhere, notiftext, notiflink)
			VALUES('".$notifhvzid."', '".time()."', '".$posterhvzid."', '".$postername."', '1', 'You have been tagged in a post in the forums.', '".mysqli_insert_id($cxn)."')";	//set notification for tagged hvzid
				$result = mysqli_query($cxn,$query);
				mysqli_free_result($result);
				
				/** Update notification amount **/
				$query = "UPDATE members SET notifications=notifications+1 WHERE hvzid='".$notifhvzid."'";
				$result = mysqli_query($cxn, $query);
				mysqli_free_result($result);
			}			
			
			/** Update post number in thread database **/
	#		$query = "UPDATE forums_threads SET replynum=replynum+1";
	#		$result = mysqli_query($cxn, $query);
	#		mysqli_free_result($result);
			
			$query = "UPDATE forums_threads SET lastposttime='".time()."', lastposter='".$postername."' WHERE id='".$threadid."'";
			$result = mysqli_query($cxn, $query);
			mysqli_free_result($result);		
		return;
	}	//end function
	
	function deletepost(){
		global $cxn;
			require_once('security.php');
			
			$threadid = sanitize($_REQUEST['threadid']);
			$postid = sanitize($_REQUEST['postid']);
						
			$query = "DELETE FROM forums_posts WHERE id='".$postid."'";
			$result = mysqli_query($cxn, $query);
			mysqli_free_result($result);
			
			$query = "UPDATE forums_threads SET replynum=replynum-1 WHERE id='".$threadid."'";
			$result = mysqli_query($cxn, $query);
			mysqli_free_result($result);
			
		return;
	}//end function
	function reportpost(){
		global $cxn;
			require_once('security.php');
			
			$query = "INSERT INTO forums_reported (postid, hvzid) VALUES('".sanitize($_REQUEST['postid'])."','".sanitize($_REQUEST['rhvzid'])."')";
			$result = mysqli_query($cxn, $query);
			
		return;
	}
	
	function editpost()
	{
		global $cxn;
		require_once('security.php');
			$query = "SELECT * FROM forums_posts WHERE id='".sanitize($_REQUEST['postid'])."'";
			$result = mysqli_query($cxn, $query);
			$post = mysqli_fetch_assoc($result);
		echo "Edit Post&nbsp;&nbsp;&nbsp;<span class=\"posterror\">You cannot submit a blank post.</span><br />";
		echo "<a href=\"javascript://\" class=\"addbold\" title=\"Bold Text\"><img src=\"images/boldbtn.jpg\" /></a>";echo "&nbsp;";
		echo "<a href=\"javascript://\" class=\"additalic\" title=\"Italic\"><img src=\"images/italicbtn.jpg\" /></a>";echo "&nbsp;";
		echo "<a href=\"javascript://\" class=\"addul\" title=\"Underline\">Underline Tags</a>";echo "&nbsp;";
		echo "<a href=\"javascript://\" class=\"addst\" title=\"Strikethrough\">Strike Through</a>";echo "&nbsp;";
		echo "<a href=\"javascript://\" class=\"addcenter\" title=\"Centered\">Center</a>";echo "&nbsp;";
		echo "<a href=\"javascript://\" class=\"addurlt\" title=\"URL Tag\">Url Tag</a>";echo "&nbsp;";
		echo "<a href=\"javascript://\" class=\"addimgt\" title=\"IMG Tag\">Img Tag</a>";echo "&nbsp;";
		echo "<a href=\"javascript://\" class=\"addcred\" title=\"Red\"><img src=\"images/redbtn.jpg\" /></a>";echo "&nbsp;";
		echo "<a href=\"javascript://\" class=\"addcblue\" title=\"Blue\"><img src=\"images/bluebtn.jpg\" /></a>";echo "&nbsp;";
		echo "<a href=\"javascript://\" class=\"addlime\" title=\"Lime Green\"><img src=\"images/greenbtn.jpg\" /></a>";echo "&nbsp;";
        echo "<form action=\"\" method=\"post\">
        	<textarea name=\"postcontent\" id=\"postcontent\" style=\"width:99%;\" id=\"editpost\" rows=\"15\">".$post['postcontent']."</textarea>
            <input type=\"submit\" value=\"Submit Post Edit\" id=\"newpostbtn\" onclick=\"submiteditedpost();return false;\" />
			<span class=\"loading\" style=\"display:none;padding-left:5px;\"><img src=\"ajax/redloader.gif\" title=\"Sending\" /></span>
        </form>";
        
		return;
	}
	function editpost2()
	{
		global $cxn;
		require_once('security.php');
			$posterhvzid = sanitize($_REQUEST['hvzid']);
			$postcontent = sanitize($_REQUEST['postcontent']);
			$postid = sanitize($_REQUEST['postid']);
			
			$query = "SELECT firstname, lastname FROM members WHERE hvzid='".$posterhvzid."'";
			$result = mysqli_query($cxn, $query);
			$row = mysqli_fetch_assoc($result);
			$postcontent .= PHP_EOL."[size=1][color=silver]Edited on: ".date('F j, Y \a\t h:i:s a',time())." by: ".$row['firstname']." ".$row['lastname'].".[/color][/size]";

			$query = "UPDATE forums_posts SET postcontent='".$postcontent."' WHERE id='".$postid."'";
			$result = mysqli_query($cxn, $query);
		return;
	}//end function
	function viewpost()
	{
		global $cxn;
		require_once('security.php');
		$query = "SELECT * FROM notifications WHERE notiflink='".sanitize($_GET['postid'])."'";
		$result = mysqli_query($cxn, $query);
		$row = mysqli_fetch_assoc($result);
		
		if($_COOKIE['hvzid'] == $row['hvzid'] || $_COOKIE['admin'] == true)
		{
			$query = "SELECT * FROM forums_posts WHERE id='".sanitize($_GET['postid'])."'";
			$result = mysqli_query($cxn, $query);
			$post = mysqli_fetch_assoc($result);
			echo "<div class=\"post\" id=\"".$post['id']."\"><a name=\"".$post['id']."\"></a>
                	<div class=\"posthead\">
                    	<span class=\"postheadleft\"><a href=\"http://".$_SERVER['SERVER_NAME']."/profile.php?hvzid=".$post['posterhvzid']."\" class=\"prolink\">".$post['postername']."</a></span>
                        <span class=\"postheadright\">Post: <a href=\"#".$post['id']."\" class=\"postidlink\">#".$post['id']."</a></span><br class=\"clearfloat\">
                    </div>
					<div class=\"postmiddle\">
						<div class=\"postleft\">
							<a href=\"http://".$_SERVER['SERVER_NAME']."/profile.php?hvzid=".$post['posterhvzid']."\" class=\"imgprolink\">";
				echo "<img class=\"propicthumb\" src=\"http://".$_SERVER['SERVER_NAME']."/uploads/images/index.php?action=get&img=".$post['posterhvzid']."&h=150&w=150\"></a><br />";
						$query2 = "SELECT admin, superadmin FROM members WHERE hvzid='".$post['posterhvzid']."'";
						$result2 = mysqli_query($cxn, $query2);
						$row = mysqli_fetch_assoc($result2);
						if($row['superadmin'] == 1)
						{	echo "<center style=\"font-size:12px;\">Administrator</center>";	}
						elseif($row['admin'] == 1)
						{	echo "<center style=\"font-size:12px;\">Moderator</center>";	}
						mysqli_free_result($result2);
						echo "</div>
						<div class=\"postcontent\">
							".nl2br(rawcontenttoformatted($post['postcontent']))."
						</div>
						<br class=\"clearfloat\" />
					</div>
                    <div class=\"postfooter\">
						<span class=\"postfooterleft\">
                    	Posted on: ".date('F j, Y \a\t h:i:s a',$post['posttime'])." &bull; ";
					if($_COOKIE['admin'] == true)
					{	echo "<abbr title=\"".long2ip($post['posterip'])."\">IP Address Logged</abbr>"; }
					else
					{	echo "IP Address Logged"; }
					echo"</span>
						<span class=\"postfooterright\">";
						if($_COOKIE['hvzid'] == $post['posterhvzid'] or $_COOKIE['admin'] == true){
							echo "<a href=\"?action=editpost&postid=".$post['id']."&threadid=".sanitize($_GET['threadid'])."&catid=".sanitize($_GET['catid'])."\">Edit Post</a> &bull; <a href=\"javascript://\" onclick=\"delpost(".$post['id'].",".sanitize($_GET['threadid']).");\">Delete Post</a> | ";
						}
						echo "<a href=\"javascript://\" onclick=\"reportpost(".$post['id'].");\" id=\"rptpost".$post['id']."\">Report Post</a>";
						echo "</span>
						<br class=\"clearfloat\" />
                   </div>
                	
				</div><!-- end post-->";
				echo "<center>
				<input type=\"button\" value=\"Remove My Tag\" onclick=\"removetag(); return false;\" class=\"topbtn\" /><br />
				<span class=\"loading\" style=\"display:none;\"><img src=\"<img src=\"../ajax/redloader.gif\" title=\"Updating...\" /></span>
				</center>";
                
		}
		if($_COOKIE['hvzid'] != $row['hvzid'])
		{
			echo "You cannot view this specific post. You may, however, view the thread it is in if you have the permissions to do so.";
			return;
		}
		
		return;
	}//end functon
	
	function removetag()
	{
		global $cxn;
		require_once('security.php');
		$query = "SELECT postcontent FROM forums_posts WHERE id='".sanitize($_REQUEST['postid'])."'";
		$result = mysqli_query($cxn, $query);
		$row = mysqli_fetch_assoc($result);
		$postcontent = preg_replace("#(@".$_COOKIE['firstname']."\b ".$_COOKIE['lastname']."\b)#", $_COOKIE['firstname']." ".$_COOKIE['lastname'],$row['postcontent']);		//scan for tagged person and replace without @ symbol
		
		$query = "UPDATE forums_posts SET postcontent='".$postcontent."' WHERE id='".sanitize($_REQUEST['postid'])."'";
		$result = mysqli_query($cxn, $query);
		
		return;
	}

?>
