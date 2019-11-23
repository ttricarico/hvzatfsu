<?php

	function htmlheader()
	{
		global $title;
		echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
<meta name=\"copyright\" content=\"Copyright 2010 Thomas Tricarico and HvZatFSU\" />
<meta name=\"contact\" content=\"fsuzombies[at]gmail[dot]com\" />
<meta name=\"google-site-verification\" content=\"7fkl9_EobAwzKG0vlM-_JpjS9VkToqJT6wci8MjPlow\" />";
	if($_SERVER['PHP_SELF'] == '/index.php')
	{	echo PHP_EOL."<meta name=\"description\" content=\"Humans vs. Zombies is a moderated game of tag that is played on college campuses throughout the world. Welcome to the Florida State University chapter of Humans vs Zombies. To make the game managable, to play, you must register here. You will receive an identification number to give to a 'Zombie' when tagged. You will also receive news about the game at Florida State University and information about the games.\" />".PHP_EOL;	}
echo"<title>HvZ@FSU ".$title."</title>

<link rel=\"stylesheet\" href=\"http://".$_SERVER['SERVER_NAME']."/styles/basestyle.css\" type=\"text/css\" />
<link rel=\"stylesheet\" href=\"http://".$_SERVER['SERVER_NAME']."/styles/links.css\" type=\"text/css\" />
<link rel=\"stylesheet\" href=\"http://".$_SERVER['SERVER_NAME']."/styles/footer.css\" type=\"text/css\" />
<link rel=\"stylesheet\" href=\"http://".$_SERVER['SERVER_NAME']."/styles/index.css\" type=\"text/css\" />
<link rel=\"stylesheet\" href=\"http://".$_SERVER['SERVER_NAME']."/styles/popup.css\" type=\"text/css\" />

<script type=\"text/javascript\" src=\"http://".$_SERVER['SERVER_NAME']."/scripts/jquery.js\"></script>
<script type=\"text/javascript\" src=\"http://".$_SERVER['SERVER_NAME']."/scripts/jquery-ui-1.8.9.custom.min.js\"></script>
<script type=\"text/javascript\" src=\"http://".$_SERVER['SERVER_NAME']."/scripts/awesomestuff.js\"></script>
<script type=\"text/javascript\" src=\"http://".$_SERVER['SERVER_NAME']."/scripts/awesomestuff.js\"></script>

<script language=\"javascript\">
<!--//

//-->
</script>";
		return;
	
	}
	
	
	
function visheader()
	{
		echo "</head>

<body>";
	topbar();
echo "<div id=\"popupframe\">
	<div id=\"popupframehead\">
    	<a href=\"javascript://\" id=\"closepopupframe\" onclick=\"closepopupframe();\" title=\"Close\">X</a>
    </div>
    <div id=\"popupframebody\">
	<h2>Loading...</h2>
    <center><img src=\"images/icons/redloader.gif\" title=\"Loading...\" alt=\"Loading...\" /></center>
    <br /><br />
    </div>
    <div id=\"popupframefooter\"></div>
    
</div>";
echo "<div id=\"frame\">
		
		<div id=\"header\">
        	<span class=\"headerleft\"><a href=\"http://www.facebook.com/group.php?gid=53924719249\" class=\"header\">FSU HvZ on Facebook</a></span>
            <span class=\"headerright\"></span>
         <img src=\"http://".$_SERVER['SERVER_NAME']."/images/banners/banner3_w900xh150.png\" />

  		</div>
		<!--end header-->


<div id=\"navblock\">

   <div id=\"reportkill2\">

        <a href=\"http://".$_SERVER['SERVER_NAME']."/reportkill.php\"/>
	    <img src=\"http://".$_SERVER['SERVER_NAME']."/images/killbtn.png\" border=\"0\"/> </a>
   
    </div>
    <!-- end reportkill2-->
	
	

		<form action=\"http://".$_SERVER['SERVER_NAME']."/search.php\" method=\"get\" id=\"searchform\">
			<input type=\"text\" value=\"Search Names, or HvZIDs\" id=\"search\" name=\"q\" style=\"color:#606060;width:250px;\"  />
		</form>

<!-- end searchbar-->

    <div id=\"playerinfo\">
	
	";
		headerinfo();
        echo "
		
	</div>
	<!--end playerinfo-->
		
		
 </div>     
 <!-- end navblock--> 
   
   ";

	playerinfo();
	echo "<br class=\"clearfloat\" />";
		return;
	}
	
	
	function headerinfo()
	{
		global $cxn;
		
		if(!isset($_COOKIE['hvzid']))
		{
			echo "<form action=\"http://".$_SERVER['SERVER_NAME']."/reglogin.php?action=login\" method=\"post\">
                                 <input type=\"email\" name=\"email\" id=\"loginemail\" style=\"width:125px;color:#999999;\" value=\"Email\" />&nbsp;&nbsp;<input type=\"password\" name=\"password\" id=\"loginpass\" style=\"width:125px;color:#606060;\" value=\"Password\"/>
                              <input name=\"btnsubmit\" id=\"loginbtn\" type=\"submit\" value=\"Go!\" />
                              <div class=\"clearer\"></div>
                            &raquo;<a href=\"reglogin.php?action=regdisp\" class=\"infolinks\">Register</a>&nbsp;&nbsp;&raquo;<a href=\"reglogin.php?action=forgotpass\" class=\"infolinks\">Forgot Password?</a>
                        </form>";
		}
		
		if($_COOKIE['admin']==1)
		{
			$life = 'Administrator';
		}
		else
		{
			$query = "SELECT * FROM members WHERE hvzid='".$_COOKIE['hvzid']."'";
			$result = mysqli_query($cxn, $query);
			$row = mysqli_fetch_assoc($result);
			if($row['admin'] == 1)
			{	$life = 'Administrator';	}
			elseif($row['human'] == 0)
			{	$life = 'Zombie';	}
			elseif($row['oz'] == 1)
			{	$life = 'Original Zombie';	}
			elseif($row['human'] == 1)
			{	$life = 'Human';	}
			

			mysqli_free_result($result);
		}
		if(isset($_COOKIE['hvzidext']))
		{
			echo "<span class=\"hvzidtitle\">HvZ ID:</span> <span class=\"hvzid\">".$_COOKIE['hvzidext']."</span><br />
            <span class=\"lifestatustitle\">Life Status:</span> <span class=\"lifestatus\">".$life."</span>";
		}
		
		
		return;
	
	}//end function

function playerinfo()
{
	if(isset($_COOKIE['hvzidext']))
	{

			echo "<div id=\"playermenu\">
			<span class=\"playerleft\">";
			global $cxn;
			$query = "SELECT * FROM members WHERE hvzid='".$_COOKIE['hvzid']."'";
			$result = mysqli_query($cxn, $query);
			$row = mysqli_fetch_assoc($result);
			if($row['admin'] == 1)
			{	
				echo "<a href=\"http://".$_SERVER['SERVER_NAME']."/admin/\" class=\"playerinfo\">Admin Page</a> | ";
			}
				echo "<a href=\"http://".$_SERVER['SERVER_NAME']."/profile.php?hvzid=".$_COOKIE['hvzid']."\" class=\"playerinfo\">Profile</a> | <a href=\"http://".$_SERVER['SERVER_NAME']."/settings.php\" class=\"playerinfo\">Settings</a><!-- | <a href=\"#\" class=\"playerinfo\">Contact</a> | <a href=\"#\" class=\"playerinfo\">Comments</a> -->
			</span>&nbsp;
			<span class=\"playerright\">
				&raquo; <a href=\"http://".$_SERVER['SERVER_NAME']."/reglogin.php?action=logout\" class=\"playerinfo\">Logout</a>
			</span>
		</div><!--end playermenu-->";
		mysqli_free_result($result);

	}	
	return;	
}

function topbar()
{
	global $cxn;
	
	echo "<div id=\"topbox\">
<span class=\"tbleft\"> <a href =\"http://".$_SERVER['SERVER_NAME']."\"> <img src=\"http://".$_SERVER['SERVER_NAME']."/images/homebutton.png\" border=\"0\"/> </a></span>
<span class=\"tbright\">
<a href=\"http://".$_SERVER['SERVER_NAME']."/forums/\" class=\"topbarlnk\"\>Forums</a> | ";
if(isset($_COOKIE['hvzid']))
{
	echo "<a href=\"http://".$_SERVER['SERVER_NAME']."/profile.php\" class=\"topbarlnk\">Profile</a> | 
		<a href=\"http://".$_SERVER['SERVER_NAME']."/settings.php\" class=\"topbarlnk\">Settings</a> | ";
}
echo "<!-- <a href=\"http://blog.hvzatfsu.com\" class=\"topbarlnk\">Blog</a> | -->
<a href=\"http://".$_SERVER['SERVER_NAME']."/rules.php\" class=\"topbarlnk\">Rules</a> | ";

if(isset($_COOKIE['hvzid']))
{
	$query = "SELECT COUNT(id) FROM notifications WHERE hvzid='".$_COOKIE['hvzid']."' AND viewed='0'";
	$result = mysqli_query($cxn, $query);
	$notifnum = mysqli_fetch_assoc($result);
	
	$query = "SELECT COUNT(id) FROM messages WHERE tohvzid='".$_COOKIE['hvzid']."' AND viewed='0' AND recieveshow='1'";
	$result = mysqli_query($cxn, $query);
	$msgnum = mysqli_fetch_assoc($result);

	echo "<a href=\"http://".$_SERVER['SERVER_NAME']."/notifications.php\" class=\"topbarlnk\">Notifications";
	
	if($notifnum['COUNT(id)'] == 0)
	{	/**do nothing **/		}
	else
	{	echo "(".$notifnum['COUNT(id)'].")";	}

	echo"</a> |
	<a href=\"http://".$_SERVER['SERVER_NAME']."/notifications.php?view=messages\" class=\"topbarlnk\">Messages";
	
	if($msgnum['COUNT(id)'] == 0)
	{	/**do nothing **/		}
	else
	{	echo "(".$msgnum['COUNT(id)'].")";	}

echo"</a> | ";
}
else
{	echo ""; }
echo "<a href=\"http://".$_SERVER['SERVER_NAME']."/about.php\" class=\"topbarlnk\">About</a> | ";
	if(isset($_COOKIE['hvzid']))
	{	echo "<a href=\"http://".$_SERVER['SERVER_NAME']."/reglogin.php?action=logout\" class=\"topbarlnk\">Log Out</a>";	}
	if(!isset($_COOKIE['hvzid']))
	{	echo "<a href=\"http://".$_SERVER['SERVER_NAME']."/reglogin.php\" class=\"topbarlnk\">Log In</a>";	}
echo "&nbsp;&bull;&nbsp;<a href=\"http://".$_SERVER['SERVER_NAME']."/feedback.php\" class=\"topbarlnk\">Feedback</a>";
echo "</span>
</div>"
;
}



?>
