<?php	//(c) 2011 Thomas Tricarico
	if(!defined('hvz'))
	{	die('Access Denied...');	}
	
	
	function viewallcat()
	{
		global $cxn;
			echo "<div id=\"allcats\">";
			foreach($_SESSION['permission'] as $perm)
			{
				$query = "SELECT * FROM forums_categories WHERE permission='".$perm."'";
				$result = mysqli_query($cxn, $query);
				while($cat = mysqli_fetch_array($result))
				{
					$innerquery = "SELECT * FROM forums_threads WHERE category='".$cat['id']."' ORDER BY lastposttime DESC LIMIT 1";
					$innerresult = mysqli_query($cxn, $innerquery);
					$catinfo = mysqli_fetch_assoc($innerresult);
					echo "<div class=\"category\">
                    	<table width=\"100%\" border=\"0\">
							<tr>
								<td>
                        	<span class=\"cattitle\"><a href=\"index.php?action=viewcategory&catid=".$cat['id']."&page=1\" class=\"catlink\">".$cat['name']."</a></span>
								</td>
                            	<td width=\"40%\" align=\"right\"><span class=\"footleft\">Last post by: ".$catinfo['lastposter']."</span></td>
                        	
							</tr>
							<tr>
								<td><div class=\"catdescr\">".$cat['description']."</div></td>
								<td><span class=\"footmiddle\">At: ".date('F j, Y \a\t h:i:s a', $catinfo['lastposttime'])."</span></td>
							</tr>
						<tr>
							<td><span class=\"cattitleright\">".$perm."</span></td>
							<td><span class=\"footright\">In: ".$catinfo['name']."</span></td>
						</tr>
                        
						</table></div>".PHP_EOL;
					
					mysqli_free_result($innerresult);
				}
				mysqli_free_result($result);
			}
			echo "</div>";
		return;
	}//end function
	function viewcategory()
	{
		global $cxn;
			require_once('security.php');
			// first, make sure category number is a real category //
			$query = "SELECT COUNT(id) FROM forums_categories WHERE id='".sanitize($_REQUEST['catid'])."' GROUP BY id";
			$result = mysqli_query($cxn, $query);
			$thingy = mysqli_fetch_assoc($result);
			if($thingy['COUNT(id)'] != 1)
			{	header('Location: http://'.$_SERVER['SERVER_NAME'].'/forums/');	}
			$query = "SELECT permission FROM forums_categories WHERE id='".sanitize($_REQUEST['catid'])."'";
			$result = mysqli_query($cxn, $query);
			$cperm = mysqli_fetch_assoc($result);
			$x = 0;
			foreach($_SESSION['permission'] as $perm)
			{
				if($perm == $cperm['permission'])
				{	$x++;	}
			}
			if($x==0)
			{	header('Location: http://'.$_SERVER['SERVER_NAME'].'/forums/');	}
			/** Get page number, if no page number, go to first **/
			if(isset($_GET['page']))
			{
				$page = sanitize($_GET['page']);
				$start = 15 * ($page - 1);
				$end = $page * 15;
				if($end == 0)
				{	$end = 20;	}
				$query = "SELECT COUNT(id) FROM forums_threads WHERE category='".sanitize($_GET['catid'])."' GROUP BY category";
				$result = mysqli_query($cxn, $query);
				$row = mysqli_fetch_assoc($result);
				$totalpages =ceil($row['COUNT(id)']/15);
			}
			else
			{	
				$start = 0;	$end = 15;	
				$query = "SELECT COUNT(id) FROM forums_threads WHERE category='".sanitize($_GET['catid'])."' GROUP BY category";
				$result = mysqli_query($cxn, $query);
				$row = mysqli_fetch_assoc($result);
				$totalpages =ceil($row['COUNT(id)']/15);
			}
			echo "<div id=\"allcats\">";
			echo "<span id=\"allcatsleft\">
			<input type=\"button\" class=\"topbtn\" id=\"newthread\" value=\"Create New Thread\">
			&nbsp;&nbsp;
			<a href=\"index.php\"><input type=\"button\" class=\"topbtn\" value=\"Back to Categories\"></a>
			</span>
			<span id=\"allcatsright\"></span>
			<br class=\"clearfloat\">";
			echo "<table width=\"100%\" border=\"0\" class=\"threads\" cellpadding=\"0\" cellspacing=\"0\">";
			echo "<thead>";
			echo "<tr class=\"boardhead\">
					<th>&nbsp;</th>
					<th width=\"300\">Thread Title</th>
					<th width=\"200\">Started By</th>
					<th width=\"200\">Latest Post</th>
					<th width=\"100\">Stats</th>
				</tr>";
			echo "<tbody>";

			$i = 0;
			if($_GET['page'] == 1 or !isset($_GET['page']))
			{	
				/** First, get sticked **/
				$query = "SELECT * FROM forums_threads WHERE category='".sanitize($_GET['catid'])."' AND sticky='1' ORDER BY lastposttime DESC";
				$result = mysqli_query($cxn, $query);
				while($threadinfo = mysqli_fetch_assoc($result))
				{
					if($i&1)
					{	echo "<tr class=\"ethread\">";	}
					else
					{	echo "<tr class=\"othread\">";	}
							echo "<td class=\"sticky\">	
								<span class=\"issticky\"><img src=\"images/sticky.png\" alt=\"Stickied\" title=\"Stickied\" />";
								if($threadinfo['locked'] == 1)
								{	echo "<img src=\"images/lock.png\" alt=\"Locked\" title=\"Locked\" />";	}
								echo "</span>
							</td>
							<td class=\"threadname\">
								<a href=\"?action=viewthread&threadid=".$threadinfo['id']."&catid=".sanitize($_GET['catid'])."&page=1\">".$threadinfo['name']."</a>
							</td>
							<td class=\"threadinfo\">
								<ul>
									<li>".$threadinfo['startbyname']."</li>
									<li>".date('M j, Y \a\t g:i:s a', $threadinfo['starttime'])."</li>
								</ul>
							</td>
							<td class=\"latestinfo\">
								<ul>
									<li>".$threadinfo['lastposter']."</li>
									<li>".date('M j, Y \a\t g:i:s a', $threadinfo['lastposttime'])."</li>
								</ul>
							</td>
							<td class=\"viewinfo\">
								<ul>
									<li><!--Views: ".$threadinfo['viewnum']."--></li>
									<li>Replies: ".$threadinfo['replynum']."</li>
								</ul>
							</td>
						</tr>";
						$i++;
				}
				mysqli_free_result($result);
			}//end sticked if -- if not on first page, dont show stickies
			/** Now, Get non-sticked **/
			$query = "SELECT * FROM forums_threads WHERE category='".sanitize($_GET['catid'])."' AND sticky='0' ORDER BY lastposttime DESC LIMIT ".$start." , ".$end;
			$result = mysqli_query($cxn, $query);
			while($threadinfo = mysqli_fetch_assoc($result))
			{
                if($i&1)
				{	echo "<tr class=\"ethread\">";	}
				else
				{	echo "<tr class=\"othread\">";	}
						echo "<td class=\"sticky\">	
							<span class=\"issticky\">";	
							if($threadinfo['locked'] == 1)
							{	echo "<img src=\"images/lock.png\" alt=\"Locked\" title=\"Locked\" />";	}
							else{ echo "&nbsp;"; }
							echo "</span>
						</td>
						<td class=\"threadname\">
							<a href=\"?action=viewthread&threadid=".$threadinfo['id']."&catid=".sanitize($_GET['catid'])."&page=1\">".$threadinfo['name']."</a>
						</td>
						<td class=\"threadinfo\">
							<ul>
								<li>".$threadinfo['startbyname']."</li>
								<li>".date('M j, Y \a\t g:i:s a', $threadinfo['starttime'])."</li>
							</ul>
						</td>
						<td class=\"latestinfo\">
							<ul>
								<li>".$threadinfo['lastposter']."</li>
								<li>".date('M j, Y \a\t g:i:s a', $threadinfo['lastposttime'])."</li>
							</ul>
						</td>
						<td class=\"viewinfo\">
							<ul>
								<li><!--Views: ".$threadinfo['viewnum']."--></li>
								<li>Replies: ".$threadinfo['replynum']."</li>
							</ul>
						</td>
					</tr>";
					$i++;
			}
			echo "</tbody>";
			echo "<tfoot>
				<tr>
					<td colspan=\"5\" style=\"text-align:right\">";
						$pagebefore = $totalpages - $_GET['page'];
						if($totalpages == 1)
						{
							echo "&laquo; Page: 1 &raquo; of 1";
						}
						else
						{
							if(isset($_GET['page']))
							{
								if($_GET['page'] != 1 || !isset($_GET['page']))
								{	echo "<a href=\"?action=viewcategory&catid=".$_GET['catid']."&page=1\" title=\"First Page\" class=\"pagenum\">First Page</a>&nbsp;&nbsp;&nbsp;&nbsp;";  }
								if($_GET['page'] > 1)
								{
									echo "<a href=\"?action=viewcategory&catid=".$_GET['catid']."&page=".($_GET['page'] - 1)."\" title=\"Previous Page\" class=\"pagenum\">&laquo;</a>";
								}
								else
								{	echo "&laquo;";		}
								echo "Page: ".$_GET['page']." <a href=\"?action=viewcategory&catid=".$_GET['catid']."&page=".($_GET['page'] + 1)."\" title=\"Next Page\" class=\"pagenum\">&raquo;</a> of <a href=\"?action=viewcategory&catid=".$_GET['catid']."&page=".$totalpages."\" title=\"Last Page\" class=\"pagenum\">".$totalpages."</a>";
							}
							else
							{
								echo "&laquo;";		
								echo "Page: 1 <a href=\"?action=viewcategory&catid=".$_GET['catid']."&page=2\" title=\"Next Page\" class=\"pagenum\">&raquo;</a> of <a href=\"?action=viewcategory&catid=".$_GET['catid']."&page=".$totalpages."\" title=\"Last Page\" class=\"pagenum\">".$totalpages."</a>";						
							}
						}//end else
					echo "</td>
				</tr>
				</tfoot>";
			echo "</table>";
			mysqli_free_result($result);
			echo "<a name=\"bottom\"></a>";
			echo "<div id=\"getnewpost\">There are new threads. <a href=\"#bottom\">Show them</a></div>";
			echo "</div>";
		return;
	}//end function
	
	function newcategory()
	{
		global $cxn;
			echo "Future new category thingy";
		return;
	} //end function
	
	function newcategory2()
	{
		global $cxn;
			/** Script to post new category **/
		return;
	}
?>