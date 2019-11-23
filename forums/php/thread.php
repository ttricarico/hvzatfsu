<?php
	if(!defined('hvz'))
	{	die('Access Denied...');	}
		error_reporting(E_ALL);

	function viewthread()	//shows the posts in a thread
	{
		global $cxn;
			require_once('security.php');
			require_once('post.php');
			
			if(isset($_GET['page']))
			{
				$page = sanitize($_GET['page']);
				$start = 15 * ($page - 1);
				$end = $page * 15;
				if($end == 0)
				{	$end = 15;	}
				$query = "SELECT COUNT(id) FROM forums_posts WHERE threadid='".sanitize($_GET['threadid'])."' GROUP BY threadid";
				$result = mysqli_query($cxn, $query);
				$row = mysqli_fetch_assoc($result);
				$totalpages =ceil($row['COUNT(id)']/15);
			}
			else
			{	$start = 0;	$end = 15;	}
			
			$query = "SELECT * FROM forums_threads WHERE id='".sanitize($_GET['threadid'])."'";
			$result = mysqli_query($cxn, $query);
			$threadinfo = mysqli_fetch_assoc($result);
			
			
			
			echo PHP_EOL."<div id=\"allposts\">".PHP_EOL;
			echo "<div id=\"allpostsheader\">".PHP_EOL;
			echo "<span id=\"allpostsheader_left\">".PHP_EOL;
			if($threadinfo['locked'] == 0 or $_COOKIE['admin'] == true)
			{	echo "<input type=\"button\" value=\"Create New Post\" id=\"newpostbtn\">&nbsp;&nbsp;";	}
			echo "<a href=\"?action=viewcategory&catid=".sanitize($_GET['catid'])."\"><input type=\"button\" value=\"Back to Category\" id=\"newpostbtn\"></a>";
			echo "</span>".PHP_EOL;
			echo "<span id=\"allpostsheader_right\">".PHP_EOL;
			if($_COOKIE['admin'] == true)
			{
				if($threadinfo['sticky'] == 1)
				{	echo "<span id=\"stickyinfo\"><a href=\"javascript://\" onclick=\"removesticky(".sanitize($_GET['threadid']).")\">Remove Sticky</a></span> | ";	}
				if($threadinfo['sticky'] == 0)
				{	echo "<span id=\"stickyinfo\"><a href=\"javascript://\" onclick=\"makesticky(".sanitize($_GET['threadid']).")\">Make Sticky</a></span> | ";	}
				
				if($threadinfo['locked'] == 0)
				{	echo "<span id=\"lockinfo\"><a href=\"javascript://\" onclick=\"lockthread(".sanitize($_GET['threadid']).")\">Lock Thread</a></span> | ";	}
				elseif($threadinfo['locked'] == 1)
				{	echo "<span id=\"lockinfo\"><a href=\"javascript://\" onclick=\"unlockthread(".sanitize($_GET['threadid']).")\">Unlock Thread</a></span> | ";	}
				echo "<a href=\"javascript://\" id=\"delthread\">Delete Thread</a>";
				
			}
			echo "</span>".PHP_EOL;
			echo "<br class=\"clearfloat\">".PHP_EOL;
			echo "</div>".PHP_EOL;
			mysqli_free_result($result);
			$query = "SELECT * FROM forums_posts WHERE threadid='".sanitize($_GET['threadid'])."' ORDER BY posttime ASC LIMIT ".$start.", ".$end;
			$result = mysqli_query($cxn, $query);
			while($post = mysqli_fetch_assoc($result))
			{
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
                
			}
			echo "<div class=\"newpostholder\"></div>";
			echo "<a name=\"bottom\"></a>";
			echo "<div id=\"getnewpost\">There are new posts. <a href=\"#bottom\">Show them</a></div>";
			echo "</div>";
			echo "<div id=\"pageholder\">";
			if($totalpages == 1)
						{
							echo "&laquo; Page: 1 &raquo; of 1";
						}
						else
						{
							if(isset($_GET['page']))
							{
								if($_GET['page'] != 1 || !isset($_GET['page']))
								{	echo "<a href=\"?action=viewthread&threadid=".$_GET['threadid']."&catid=".$_GET['catid']."&page=1\" title=\"First Page\" class=\"pagenum\">First Page</a>&nbsp;&nbsp;&nbsp;&nbsp;";  }
								if($_GET['page'] > 1)
								{
									echo "<a href=\"?action=viewthread&threadid=".$_GET['threadid']."&catid=".$_GET['catid']."&page=".($_GET['page'] - 1)."\" title=\"Previous Page\" class=\"pagenum\">&laquo;</a>";
								}
								else
								{	echo "&laquo;";		}
								echo "Page: ".$_GET['page']." <a href=\"?action=viewthread&threadid=".$_GET['threadid']."&catid=".$_GET['catid']."&page=".($_GET['page'] + 1)."\" title=\"Next Page\" class=\"pagenum\">&raquo;</a> of <a href=\"?action=viewthread&threadid=".$_GET['threadid']."&catid=".$_GET['catid']."&page=".$totalpages."\" title=\"Last Page\" class=\"pagenum\">".$totalpages."</a>";
							}
							else
							{
								echo "&laquo;";		
								echo "Page: 1 <a href=\"?action=viewthread&threadid=".$_GET['threadid']."&catid=".$_GET['catid']."&page=2\" title=\"Next Page\" class=\"pagenum\">&raquo;</a> of <a href=\"?action=viewthread&threadid=".$_GET['threadid']."&catid=".$_GET['catid']."&page=".$totalpages."\" title=\"Last Page\" class=\"pagenum\">".$totalpages."</a>";						
							}
						}//end else
			echo "</div>";
			if(isset($_COOKIE['hvzid']))
			{
				if($threadinfo['lock'] == 0 || $_COOKIE['admin'] == true)
				{
					echo "<div id=\"postquickreply\">
						<form action=\"\" name=\"newquickpost\" method=\"post\"><h3 class=\"qphead\">Post a quick reply</h3>
							<input type=\"hidden\" name=\"hvzid\" value=\"".$_COOKIE['hvzid']."\" /><input type=\"hidden\" name=\"name\" value=\"".$_COOKIE['firstname']." ".$_COOKIE['lastname']."\" />
							<span class=\"qperror\" style=\"display:none; color:#FF0000; font-size: 9px;\">You Cannot Submit a Blank Post</span>
							<textarea style=\"width:99%;\" rows=\"10\" name=\"postcontent\" id=\"postcontent\" class=\"formtext\"></textarea>
							<input type=\"button\" value=\"Submit a New Post\" id=\"newpostbtn\" class=\"newpostbtn\" onclick=\"quickformsubmit();return false;\" />
							<span class=\"qploading\" style=\"display:none;padding-left:5px;\"><img src=\"ajax/redloader.gif\" title=\"Sending\" /></span> 
						</form>
						</div>";
				}
			}
			echo "<br /><br /><br /><br />";
			$view = $threadinfo['viewnum'] + 1;
			$query = "UPDATE forums_threads SET viewnum='".$view."' WHERE id='".sanitize($_GET['threadid'])."'";
			$result = mysqli_query($cxn, $query);
				
		return;
	}//end function
	function newthread2()
	{
		global $cxn;
		require_once('security.php');
		
		$catid = sanitize($_REQUEST['catid']);
		$threadtitle = sanitize($_REQUEST['threadtitle']);	//These are sanitized so
		$postername = sanitize($_REQUEST['postername']);	//that no one can do any
		$posterhvzid = $_COOKIE['hvzid'];					//sort of MySQL Injection
		$postcontent = sanitize($_REQUEST['postcontent']);
		$ipaddr = $_SERVER['REMOTE_ADDR'];
		$starttime = time();
		
		
		
		$query = "INSERT INTO forums_threads(name, category, sticky, lastposttime, lastposter, startbyname, starttime, replynum)
VALUES('".$threadtitle."', '".$catid."', '0', '".$starttime."', '".$postername."', '".$postername."','".$starttime."','0')";
		$result = mysqli_query($cxn, $query);
		
		mysqli_free_result($result);
		
		
		/** Create new post **/
		$query = "INSERT INTO forums_posts(postername, posterhvzid, posttime, threadid, postcontent)
						VALUES('".$postername."', '".$posterhvzid."', '".$starttime."', '".mysqli_insert_id($cxn)."', '".$postcontent."')";
		$result = mysqli_query($cxn, $query);
		mysqli_free_result($result);
		return;
	}//end function
	
	function stickythread()
	{
		global $cxn;
			require_once('security.php');
			//if(checkifadmin() == false)
			//{	return false;	}
			$query = "UPDATE forums_threads SET sticky='1' WHERE id='".sanitize($_REQUEST['threadid'])."'";
			$result = mysqli_query($cxn, $query);
		return;
	}
	
	function unstickythread()
	{
		global $cxn;
			require_once('security.php');
			$query = "UPDATE forums_threads SET sticky='0' WHERE id='".sanitize($_REQUEST['threadid'])."'";
			$result = mysqli_query($cxn, $query);
		return;
	}//end function
	function lockthread()
	{
		global $cxn;
			require_once('security.php');
			$query = "UPDATE forums_threads SET locked='1' WHERE id='".sanitize($_REQUEST['threadid'])."'";
			$result = mysqli_query($cxn, $query);
		return;
	}//end function
	function unlockthread()
	{
		global $cxn;
			require_once('security.php');
			$query = "UPDATE forums_threads SET locked='0' WHERE id='".sanitize($_REQUEST['threadid'])."'";
			$result = mysqli_query($cxn, $query);
		return;
	}//endfunction
	function deletethread()
	{
		global $cxn;
			require_once('security.php');
			//if(checkifadmin() == false)
			//{	return false;	}
			$query = "DELETE FROM forums_threads WHERE id='".sanitize($_REQUEST['threadid'])."'";
			$result = mysqli_query($cxn, $query);
			mysqli_free_result($result);
			$query = "DELETE FROM forums_posts WHERE threadid='".sanitize($_REQUEST['threadid'])."'";
			$result = mysqli_query($cxn, $query);
			mysqli_free_result($result);
			
		return;
	}
?>