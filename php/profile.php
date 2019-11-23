<?php
	if(!defined('hvz'))
	{	die('Access Denied');	}
	// php/profile.php -> profile.php
	/****************************
	 *	Function Directory:
	 *		viewprofile(void) = displays profile of the indicated hvzid
	 *		viewpictures(void) = displays pictures of indicated hvzid
	 *		viewindividualpic(void) = displays an individual picture
	 *		imageuploader(void) = displays template for uploading images
	 *		imageuploader2(void) = displays image options(make profile pic, captions)
	 *		makeprofilepic(void) = makes selected picture the profile picture
	 *		setaboutme(void) = inserts about me into database
	 *		aboutmeparse($content) = parses about me by specific require_oncements
	 ******************************/
	 
	 
	 function viewprofile()
	 {
	 	global $cxn;
			require_once('security.php');
			
			if(isset($_GET['hvzid']))
			{	$hvzid = sanitize($_GET['hvzid']);	}
			else
			{	$hvzid = $_COOKIE['hvzid'];	}
			
			$query = "SELECT * FROM members WHERE hvzid='".$hvzid."'";
			$result = mysqli_query($cxn, $query);
			$row = mysqli_fetch_array($result);


			   echo "<div id=\"profilename\">
             	<span class=\"name\">".$row['firstname']." ".$row['lastname']."</span>
				<span class=\"status\">".$row['status']."</span>
         </div>
            <div id=\"profilepicmenu\">
            <center><img src=\"http://".$_SERVER['SERVER_NAME']."/uploads/images/index.php?action=profile&img=".$hvzid."&h=200&w=150\" align=\"middle\"></center>
              <div id=\"menu\">
                    <a href=\"javascript://\" class=\"promenu\" id=\"sendmsg\">Send Message</a>
                    <a href=\"http://".$_SERVER['SERVER_NAME']."/profile.php?view=pictures&hvzid=".$hvzid."\" class=\"promenu\">View Pictures</a>
                    <!--<a href=\"http://blog.hvzatfsu.com/viewblog.php?hvzid=".$hvzid."\" class=\"promenu\">View Blog</a>-->";
					/**
					$query = "SELECT * FROM friends WHERE hvzid1='".$_COOKIE['hvzid']."' OR hvzid2='".$_COOKIE['hvzid']."'";
					$result = mysqli_query($cxn, $query);
					if(mysqli_num_rows($result))
					<a href";
					**/
                    if($_COOKIE['hvzid'] == $_GET['hvzid'])
					{	echo "<a href=\"settings.php#tabs-4\" class=\"promenu\">Edit Profile</a>";	}	
              echo "</div>
            </div> 
         <div id=\"profilecontent\">
                <div id=\"maininfo\">
                    <span class=\"proinfo\">Birthday: ".date('F d, Y', $row['birthday'])."</span><br />";
                    
				if($row['yimsn'] != "" && $row['showyimsn'] == 1)
				{	echo "<span class=\"yimsn\">Yahoo!: ".$row['yahoo']."</span>";	}
				if($row['aim'] != "" && $row['showaim'] == 1)
				{	echo "<span class=\"aimsn\">AIM: ".$row['aim']."</span>";	}
				if($row['msn'] != "" && $row['showmsn'] == 1)
				{	echo "<span class=\"msnsn\">MSN: ".$row['msn']."</span>";	}
				if($row['skype'] != "" && $row['showskype'] == 1)
				{	echo "<span class=\"skype\">Skype: ".$row['skype']."</span>";	}
				echo "<div id=\"aboutmeframe\">
					<div id=\"aboutme\">".aboutmeparse($row['aboutme'])."</div>	
					<div id=\"aboutmefoot\">
						<span id=\"aboutmefootleft\">";
						if($_GET['hvzid'] == $_COOKIE['hvzid'])
						{
								echo "<a href=\"javascript://\" id=\"editaboutme\" onclick=\"aboutmechg();\"  class=\"editlink\">Edit About Me</a><span class=\"abtmeload\" style=\"padding-left:10px; display:none;\"><img src=\"images/icons/redloader.gif\" title=\"Loading...\" /></span>";
						}
						echo "</span>
						<span id=\"aboutmefootright\"><a href=\"javascript://\" id=\"profile_whatcanipost\">What can I post here?</a></span>
						<br class=\"clearfloat\" />
					</div>
				</div>";
             echo "<br /><br /><br />
                </div>
                <div id=\"profilecomments\">
                    <form action=\"apps/profilecomments.php?action=postcomment\" method=\"post\">
                    	<input type=\"text\" name=\"postername\" value=\"".$_COOKIE['firstname']." ".$_COOKIE['lastname']."\" readonly=\"readonly\" /> <input type=\"submit\" value=\"Post Comment\" />
                    	<textarea name=\"commenttext\" cols=\"50\" rows=\"5\" id=\"postcontent\" onkeypress=\"return imposeMaxLength(this);\"></textarea>
						<span id=\"charinfo\">Character Count: <span id=\"charcnt\"></span> out of 400</span>
                        <input type=\"hidden\" name=\"ipaddr\" value=\"".ip2long($_SERVER['REMOTE_ADDR'])."\" />
                        <input type=\"hidden\" name=\"posterhvzid\" value=\"".$_COOKIE['hvzid']."\" />
                        <input type=\"hidden\" name=\"profilehvzid\" value=\"".$hvzid."\" />
                    </form>
                    
                    <div id=\"comments\">";
                        $query = "SELECT * FROM profilecomments WHERE profileid='".$hvzid."' ORDER BY posttime DESC";
								$result = mysqli_query($cxn, $query);
								
								while($pc = mysqli_fetch_array($result))
								{
									echo "<div class=\"comment\" id=\"comment".$pc['id']."\">
                        	<div class=\"commenthead\">
								<span class=\"commentheadleft\"><a href=\"?view=profile&hvzid=".$pc['posterhvzid']."\">".$pc['postername']."</a></span>
								<span class=\"commentheadright\">";
								if($_COOKIE['hvzid'] == $_GET['hvzid'] || $_COOKIE['hvzid'] == $pc['posterhvzid'])
								{
									echo "<a href=\"javascript://\" onclick=\"delcomment(".$pc['id'].");\">Delete</a>";
								}
								echo "</span>
								<br class=\"clearfloat\" />
							</div>
                            <div class=\"commentbody\">".$pc['commenttext']."</div>
                            <div class=\"commentfoot\">Posted on: ".date('n/j/Y \a\t h:i:s a', $pc['posttime'])." &bull; ";
									if($_COOKIE['admin'] == true)
									{	echo "<abbr title=\"".long2ip($pc['ipaddr'])."\">IP Logged</abbr>";
							
									}
									else
									{
										echo "IP Logged";
									}
							echo "</div>
							</div><!--end comment-->";
								}
		           echo "</div>              
                </div>
        	</div> <!-- end profile -->";


		return;
	 }//end function
	 
	 function viewpictures()
	 {
	 	global $cxn;
			require_once('security.php');
			echo "<div id=\"pictopt\">
					<span id=\"optleft\"><a href=\"profile.php\">Back to profile</a></span>
					<span id=\"optright\">";
					if($_GET['hvzid'] == $_COOKIE['hvzid'])
					{ echo "<a href=\"http://".$_SERVER['SERVER_NAME']."/profile.php?view=imageuploader&hvzid=".$_COOKIE['hvzid']."\">Add new Pictures</a>"; }
					echo "</span>
					<br class=\"clearfloat\" />
				</div>";
			if(isset($_GET['page']))
			{
				$page = sanitize($_GET['page']);
				$start = 20 * ($page - 1);
				$end = $page * 20;
				if($end == 0)
				{	$end = 20;	}
			}
			else
			{	
				$start = 0;	$end = 20;	
			}
			$query = "SELECT COUNT(id) FROM uploadedimages WHERE hvzid='".sanitize($_GET['hvzid'])."' GROUP BY hvzid";
			$result = mysqli_query($cxn, $query);
			$row = mysqli_fetch_assoc($result);
			$totalpages =ceil($row['COUNT(id)']/15);


			$query = "SELECT * FROM uploadedimages WHERE hvzid='".sanitize($_GET['hvzid'])."' LIMIT ".$start.",".$end;
			$result = mysqli_query($cxn, $query);
			echo "<div id=\"picgallery\">";
			if(mysqli_num_rows($result) == 0)
			{	
				echo "This user has no pictures uploaded";
				if($_GET['hvzid'] == $_COOKIE['hvzid'])
				{ echo "<a href=\"http://".$_SERVER['SERVER_NAME']."/profile.php?view=imageuploader&hvzid=".$_COOKIE['hvzid']."\">Add new Pictures</a>"; }
			}
			else{
				while($pictures = mysqli_fetch_assoc($result))
				{
					echo "<a href=\"?view=pic&p=".$pictures['imagename']."&hvzid=".sanitize($_GET['hvzid'])."\"><img src=\"uploads/images/index.php?action=get&name=".$pictures['imagename']."\" class=\"imgthumb\" border=\"0\" title=\"".$pictures['imgcaption']."\"/></a>";
				}

			}
			echo "<div id=\"imgpages\">";
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
					{	echo "<a href=\"?view=pictures&hvzid=".$_GET['hvzid']."&page=1\" title=\"First Page\" class=\"pagenum\">First Page</a>&nbsp;&nbsp;&nbsp;&nbsp;";  }
					if($_GET['page'] > 1)
					{
						echo "<a href=\"?view=pictures&hvzid=".$_GET['hvzid']."&page=".($_GET['page'] - 1)."\" title=\"Previous Page\" class=\"pagenum\">&laquo;</a>";
					}
					else
					{	echo "&laquo;";		}
					echo "Page: ".$_GET['page']." <a href=\"?view=pictures&hvzid=".$_GET['hvzid']."&page=".($_GET['page'] + 1)."\" title=\"Next Page\" class=\"pagenum\">&raquo;</a> of <a href=\"?view=pictures&hvzid=".$_GET['hvzid']."&page=".$totalpages."\" title=\"Last Page\" class=\"pagenum\">".$totalpages."</a>";
					
				}
				else
				{
					echo "&laquo;";		
					echo "Page: 1 <a href=\"?view=pictures&hvzid=".$_GET['hvzid']."&page=2\" title=\"Next Page\" class=\"pagenum\">&raquo;</a> of <a href=\"?view=pictures&hvzid=".$_GET['hvzid']."&page=".$totalpages."\" title=\"Last Page\" class=\"pagenum\">".$totalpages."</a>";						
				}
			}//end else

			echo "</div>";	//end page number
		echo "</div>";	//end gallery
		return;
	 }//end function
	 
	 function viewindividualpic()
	 {
	 	global $cxn;
			require_once('security.php');
			$query = "SELECT firstname, lastname FROM members WHERE hvzid='".sanitize($_GET['hvzid'])."'";
			$result = mysqli_query($cxn, $query);
			$row = mysqli_fetch_assoc($result);
			$profilename = $row['firstname']." ".$row['lastname'];
			mysqli_free_result($result);
			
			$query = "SELECT * FROM uploadedimages WHERE imagename='".sanitize($_GET['p'])."'";
			$result = mysqli_query($cxn, $query);
			$img = mysqli_fetch_assoc($result);
			
			echo "<div id=\"imageholder\">";
			if($_COOKIE['hvzid'] == $_GET['hvzid'])
			{	
				echo "<span id=\"imageheadleft\"><a href=\"javascript://\" onclick=\"delimage(".$img['id'].");\">Delete Image</a></span>";
				echo "<span id=\"imageheadright\"><a href=\"javascript://\" onclick=\"makeprofilepic(".$img['id'].");\">Make Profile Picture</a> | <a href=\"profile.php?view=imageuploader&hvzid=".sanitize($_GET['hvzid'])."\">Add New Images</a></span>";
				echo "<br class=\"clearfloat\" />";
			}
			echo "<center><img src=\"uploads/images/index.php?action=getind&name=".sanitize($_GET['p'])."\" class=\"imgdisp\" /></center>";
			
			echo "<div id=\"imgcaption\">";
			echo "<span id=\"imgcaptiontxt\">".$img['imgcaption']."</span>";
			if($_COOKIE['hvzid'] == $_GET['hvzid'])
			{	echo "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"javascript://\" id=\"editcaption\" title=\"Edit Image Caption\"><img src=\"images/icons/pencil.png\" id=\"editsymbol\" title=\"Edit Caption\" alt=\"Edit\" border=\"0\" /></a>";	}
			echo "<span id=\"imageinfo\">Added on: ".date('F j, Y \a\t g:i:s a',$img['uploadtime'])."</span>";
			echo "<br class=\"clearfloat\">";
			echo "</div>";
			echo "</div> <!-- end image and caption holder-->";
			
			echo "<div id=\"picturefooter\">";
			
			echo "<div id=\"imagedirectory\">";
			//get random images for now
			$query = "SELECT id, imagename FROM uploadedimages WHERE hvzid='".sanitize($_GET['hvzid'])."' ORDER BY RAND() ASC LIMIT 6";
			$result = mysqli_query($cxn, $query);
            echo "<table border=\"0\" style=\"width:100%; text-align:center;\">"; 
			echo "<tr>
					<td colspan=\"2\"><div id=\"randomhead\">Random Images by ".$profilename."</div></td>
				</tr>";         
				$x=1;
			while($pictures = mysqli_fetch_assoc($result))	//put all images into a table
			{
				if($x&1)
				{	echo "<tr>";	}
				echo "<td><a href=\"?view=pic&p=".$pictures['imagename']."&hvzid=".sanitize($_GET['hvzid'])."\"><img src=\"uploads/images/index.php?action=get&name=".$pictures['imagename']."\" border=\"0\" class=\"imgthumb\"/></a></td>";
				if(!$x&1)
				{	echo "</tr>";	}
				$x++;
			}
			
			echo "<tr>
					<td colspan=\"2\"><a href=\"profile.php?view=pictures&hvzid=".sanitize($_GET['hvzid'])."\">Back to Gallery</a></td>
				</tr>";
			echo "</table>";
			echo "</div> <!-- end image directory -->";
			echo"<div id=\"picturecomments\">";
			echo "<div id=\"piccommentheader\">Picture Comments</div>";
			echo "<div id=\"actualcomments\">";	
			$query = "SELECT * FROM imagecomments WHERE imgname='".sanitize($_GET['p'])."' ORDER BY posttime ASC";
			$result = mysqli_query($cxn, $query);
			if(mysqli_num_rows($result) === 0)
			{	
				echo "There are no comments. Be the first!"; 
			}
			else{
				while($comment = mysqli_fetch_assoc($result))
				{
                    echo "<div class=\"imgcomment\" id=\"imgcomment".$comment['id']."\">
                    	<div class=\"imgcommenthead\">
                        	<span class=\"postername\"><a href=\"?view=profile&hvzid=".$comment['posterhvzid']."\" title=\"Visit Profile\">
							".$comment['postername']."</a></span>
							<span class=\"options\">";
							if($_COOKIE['admin'] == true || $_COOKIE['hvzid'] == sanitize($_GET['hvzid']) || $_COOKIE['hvzid'] == $comment['posterhvzid'])
							{ echo "<a href=\"javascript://\" onclick=\"delimgcomment(".$comment['id'].");\" title=\"Delete Post\">X</a> ";	}
							echo "</span>
							<br class=\"clearfloat\" />
                        </div>
                        <div class=\"imgcommentbody\">".nl2br($comment['postcontent'])."</div>
                        <div class=\"imgcommentfoot\">
                        	<span class=\"icl\">";
								if($_COOKIE['admin'] == true)
								{
									echo "<abbr title=\"".long2ip($comment['posterip'])."\">IP Logged</abbr>";
								}
							echo"</span>
                            <span class=\"icr\">Posted on: ".date('F j, Y \a\t g:i:s a', $comment['posttime'])."</span>
							<br class=\"clearfloat\" />
                        </div>
                    </div>";
					$coid = $comment['id'];
                    
				}
			}
			echo "<div id=\"checkfornew\" onclick=\"getnewcomments();\">Check For New Posts</div>";
			echo "</div>";
			echo "<div id=\"newcommentholder\"></div>";
			echo "<div id=\"commenter\">
				<div id=\"commenterhead\"><a href=\"javascript://\" id=\"postnew\">Post a new comment</a></div>
				<div id=\"commenterbody\">
					<form action=\"\" name=\"piccommenter\" id=\"piccommenter\">
						<input type=\"text\" value=\"".$_COOKIE['firstname']." ".$_COOKIE['lastname']."\" id=\"postername\" />
						<input type=\"hidden\" value=\"".sanitize($_GET['p'])."\" id=\"picturename\" />
						<input type=\"submit\" value=\"Post Comment\" onclick=\"postpiccomment(); return false;\" class=\"formtext\"/>
						<span id=\"posterror\" style=\"display:none; font-size: 9px; color:#FF0000; padding-left:10px;\">
						You cannot submit a blank post.
						</span>
						<span class=\"postsubmit\" style=\"display:none; padding-left:10px;\">
							<img src=\"images/icons/redloader.gif\" title=\"Loading...\" />
						</span>
						<br />
						<textarea id=\"postcontent\" name=\"postcontent\" rows=\"5\" style=\"width: 99%;\" class=\"formtext\" onkeypress=\"return imposeMaxLength(this);\"></textarea>
						<br /><span id=\"charinfo\">Character Count: <span id=\"charcnt\"></span> out of 400</span>
					</form>
					<br class=\"clearfloat\" />
				</div>
			</div>";			

			echo "</div><!-- end comments -->";
			echo "<br class=\"clearfloat\">";
			echo "</div> <!-- end picture footer -->";
		return;
	 }	//end function
	 
	 function imageuploader()
	 {
	 	global $cxn;
		require_once('security.php');
			$query = "SELECT COUNT(id) FROM uploadedimages WHERE hvzid='".$_COOKIE['hvzid']."'";
			$result = mysqli_query($cxn, $query);
			$row = mysqli_fetch_assoc($result);
				echo"<div id=\"uploader\">
     <span id=\"uploaderhead\">";
				if($row['COUNT(id)'] == 1)
				{	echo "You have ".$row['COUNT(id)']." picture uploaded.";	}
				else
				{	echo "You have ".$row['COUNT(id)']." pictures uploaded.";	}
			 echo "</span><form action=\"uploads/images/index.php?action=postmultiple\" enctype=\"multipart/form-data\" method=\"post\"> 
                	<table border=\"0\" id=\"uploadtable\"> 
                    	<tr> 
                        	<td><input type=\"file\" name=\"file1\" id=\"file1\" class=\"formtext\" /></td> 
                            <td><input type=\"file\" name=\"file2\" id=\"file2\" class=\"formtext\" /></td> 
                        </tr> 
                        <tr> 
                        	<td><input type=\"file\" name=\"file3\" id=\"file3\" class=\"formtext\" /></td> 
                            <td><input type=\"file\" name=\"file4\" id=\"file4\" class=\"formtext\" /></td> 
                        </tr> 
                        <tr> 
                        	<td><input type=\"file\" name=\"file5\" id=\"file5\" class=\"formtext\" /></td> 
                            <td><input type=\"file\" name=\"file6\" id=\"file6\" class=\"formtext\" /></td> 
                        </tr> 
                        <tr> 
                        	<td colspan=\"2\"><input type=\"submit\" value=\"Upload Pictures\" class=\"formtext\" id=\"submit\" /> 
								<span class=\"uploading\" style=\"padding-left: 10px; display:none;\"><img src=\"images/icons/redloader.gif\" /></span></td> 
                        </tr> 
                     </table> 
                </form> 
     </div>
     <div id=\"recents\">
     	<div id=\"recentshead\">Recent Uploads</div>
        <table border=\"0\" style=\"width:100%; text-align:center;\">
        	<tbody>";
				$query = "SELECT * FROM uploadedimages WHERE 1 ORDER BY uploadtime LIMIT 6";
				$result = mysqli_query($cxn, $query);
				$x=1;
				while($pictures = mysqli_fetch_assoc($result))	//put all images into a table
				{
					if($x&1)
					{	echo "<tr>";	}
					$query2 = "SELECT firstname, lastname FROM members WHERE hvzid='".$pictures['hvzid']."'";
					$result2 = mysqli_query($cxn, $query2);
					$row = mysqli_fetch_assoc($result2);
					echo "<td><a href=\"?view=pic&p=".$pictures['imagename']."&hvzid=".$pictures['hvzid']."\">
						<img src=\"uploads/images/index.php?action=get&name=".$pictures['imagename']."\" border=\"0\" class=\"imgthumb\" title=\"Uploaded by ".$row['firstname']." ".$row['lastname']."\" ht/>
						</a></td>";
					if(!$x&1)
					{	echo "</tr>";	}
					$x++;
				}
                	
           echo "</tbody>
        </table>
        
        </div>";
            
		return;
	}//end function
	
	function imageuploader2()
	{
		global $cxn;
		require_once('security.php');
			$query = "SELECT * FROM uploadedimages WHERE specid='".sanitize($_REQUEST['specid'])."'";
			$result = mysqli_query($cxn, $query);
			while($imginfo = mysqli_fetch_assoc($result))
			{
				echo "These are the images you uploaded: <br />";
				
				echo "<a href=\"http://".$_SERVER['SERVER_NAME']."/profile.php?view=pic&p=".$imginfo['imagename']."&hvzid=".$_COOKIE['hvzid']."\"><img src=\"uploads/images/index.php?action=getind&name=".$imginfo['imagename']."&h=400&w=400\" /></a>";
			}
		return;
	}
	
	function makeprofilepic()
	{
		global $cxn;
			require_once('security.php');
			
			$query = "SELECT * FROM uploadedimages WHERE id='".sanitize($_REQUEST['pic'])."'";
			$result = mysqli_query($cxn, $query);
			$img = mysqli_fetch_assoc($result);
			
			$query = "UPDATE members SET proimg='".$img['imagename']."' WHERE hvzid='".$_COOKIE['hvzid']."'";
			$result = mysqli_query($cxn, $query);
		return;
	} //end function
	
	function setaboutme()
	{
		global $cxn;
			requre('security.php');
			$query = "UPDATE members SET aboutme='".sanitize($_REQUEST['aboutme'])."' WHERE hvzid='".$_COOKIE['hvzid']."'";
			$result = mysqli_query($cxn, $query);
			
		return;
	} //end function

	function aboutmeparse($content)
	{
		global $cxn;
		require_once('security.php');
			
			//bbcode to easy html ([b] -> <strong>)
			$bbcode = array('[b]', '[/b]', '[i]', '[/i]', '[u]', '[/u]', '[center]', '[/center]');	//simple conversion bb code
			$htmlcode = array('<strong>', '</strong>', '<em>', '</em>', '<span style=\"text-decoration:underline;\">', '</span>', '<center>', '</center>');			
			$content = str_replace($bbcode, $htmlcode, $content);

			/** color to style color ([color= ]-> <span style="font-color: "></span>) **/
			$content = preg_replace("#\[color=(.+?)\]#is", 
						"<span style=\"color:\\1\" />", $content );
			$content = str_replace("[/color]","</span>",$content);
			
			/** url with http:// to link ([http://link -> <a href="link">http://link</a>) **/
				$content = preg_replace("@((https?://)?([-\w]+\.[-\w\.]+)+\w(:\d+)?(/([-\w/_\.]*(\?\S+)?)?)*)@", "<a href=\"http://".$_SERVER['SERVER_NAME']."/link.php?lnk=\\1\" class=\"aboutmelnk\" target=\"_blank\">\\1</a>", $content);
			
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
			
		return nl2br($content);
	} //end function
?>
