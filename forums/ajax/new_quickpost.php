<?php

	define('hvz', '1');
	
	include('../php/settings.php');
		$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
	include('../php/post.php');
	require('../php/security.php');

		
			$threadid = sanitize($_REQUEST['threadid']);		//prevent any kind of mysql injection
			$postcontent = sanitize($_REQUEST['postcontent']);	//sanitize() also removes any html tags
			
			$postername = $_COOKIE['firstname'].' '.$_COOKIE['lastname'];			
			$posterhvzid = $_COOKIE['hvzid'];
			$posterip = $_SERVER['REMOTE_ADDR'];
			
			// Upload the raw unformatted post content. That way, when it needs to be edited,
			// we can just take the raw post out of the database and we dont have to worry about
			// any sort of reformatting to the simple bbcode and such. All the posts are formatted
			// on the fly when they are loaded for viewing.
			
		//	$query = "SELECT locked FROM forums_threads WHERE id='".$threadid."'";
		//	$result = mysqli_query($cxn, $query);
		//	$info = mysqli_fetch_assoc($result);
			
			$query = "INSERT INTO forums_posts(postername, posterhvzid, posttime, posterip, threadid, postcontent)
							VALUES('".$postername."', '".$posterhvzid."', '".time()."', '".$posterip."', '".$threadid."', '".$postcontent."')";
			$result = mysqli_query($cxn, $query);
			$postid = mysqli_insert_id($cxn);
			mysqli_free_result($result);
			
			$query = "SELECT * FROM forums_posts WHERE id='".$postid."'";
			$result = mysqli_query($cxn, $query);
			$post = mysqli_fetch_assoc($result);
						

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


		//take post variable and print everything in a div

//		$query = "SELECT * FROM forums_posts WHERE id='".$postid."'";
//		$result = mysqli_query($cxn, $query);
//		$post = mysqli_fetch_assoc($result);
			
		echo "<div class=\"post\" id=\"".$post['id']."\"><a name=\"".$post['id']."\"></a>
                	<div class=\"posthead\">
                    	<span class=\"postheadleft\"><a href=\"http://".$_SERVER['SERVER_NAME']."/profile.php?hvzid=".$post['posterhvzid']."\" class=\"prolink\">".$post['postername']."</a></span>
                        <span class=\"postheadright\">Post: <a href=\"#".$post['id']."\" class=\"postidlink\">#".$post['id']."</a></span><br class=\"clearfloat\">
                    </div>
					<div class=\"postmiddle\">
						<div class=\"postleft\">
							<a href=\"http://".$_SERVER['SERVER_NAME']."/profile.php?hvzid=".$post['posterhvzid']."\" class=\"imgprolink\">";
				echo "<img class=\"propicthumb\" src=\"http://".$_SERVER['SERVER_NAME']."/uploads/images/index.php?action=profile&img=".$post['posterhvzid']."&h=150&w=150\"></a><br />";
						$query2 = "SELECT admin, superadmin, betatester FROM members WHERE hvzid='".$post['posterhvzid']."'";
						$result2 = mysqli_query($cxn, $query2);
						$row = mysqli_fetch_assoc($result2);
						if($row['superadmin'] == 1)
						{	echo "<center style=\"font-size:12px;\">Administrator</center>";	}
						if($row['admin'] == 1)
						{	echo "<center style=\"font-size:12px;\">Moderator</center>";	}
						if($row['admin'] == 1)
						{	echo "<center style=\"font-size:12px;\">Beta Tester</center>";	}
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
	mysqli_close($cxn);
?>