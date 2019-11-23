<?php
	if($_COOKIE['admin'] != true)
	{
		header('Location: http://'.$_SERVER['SERVER_NAME'].'/');
		exit;
	}
	
	/** Basic page stuff **/
	define('tat', 1);	//prevent hacking to included pages
	define('hvz', 1);	//prevent hacking to included pages

	if(function_exists('ini_set'))//disable session id in url
	{
	   //Use cookies to store the session ID on the client side
	   @ini_set ('session.use_only_cookies', 1);
	   //Enable transparent Session ID support
	   @ini_set ('session.use_trans_sid',    0);
	}
	session_start();
	
	//header time!
	header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	header ('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
	header ('Cache-Control: no-cache, must-revalidate'); // HTTP/1.1
	header ('Pragma: no-cache'); // HTTP/1.0

	
	global $cxn;
			
	/****MySQL Login***/
	include('includes/php/settings.php');
	//	settimezone();
		$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
	
	/**** Load Plugins ****/
//	include('./includes/plugins.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>HvZ@FSU :: Moderators</title>

<link rel="stylesheet" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/styles/basestyle.css" />
<link rel="stylesheet" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/styles/footer.css" />
<link rel="stylesheet" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/styles/link.css" />
<link rel="stylesheet" href="includes/styles/admin.css" />
<link rel="stylesheet" href="includes/styles/members.css" />

<script language="javascript" src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/scripts/jquery.js" type="text/javascript"></script>
<script language="javascript" src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/scripts/admin.js" type="text/javascript"></script>
<script language="javascript" src="scripts/admin.js" type="text/javascript"></script>
<script language="javascript" src="scripts/chat.js" type="text/javascript"></script>


<style>
span.hvzid {
 float: none;    text-align: center;
    width: 15%;
}

span.admin_head{
		display:block;
		font-family:Verdana, Arial, Helvetica, sans-serif;
		font-size: 1.2em;
		padding-left: 2em;

	}
span.admin_head:hover{
	background-color:#C0C0C0;	
}


</style>



<script type="text/javascript">

$(document).ready(function(){
	$('ul.sidebar').hide();
	
	/*
	var loc = window.location.hash;
	$('ul#' + loc).show();
	*/
		
	$('span.admin_head').click(function(){
		var id = $(this).attr('id');
		$('ul#' + id).slideToggle(100);
		

	});
	
	
});
/*
$(window).scroll(function(){
	var docViewTop = $(window).scrollTop();
    var docViewBottom = docViewTop + $(window).height();

    var elemTop = $("div#reportkill2").offset().top;
    var elemBottom = elemTop + $("div#reportkill2").height();
	
	console.log((elemBottom >= docViewTop) && (elemTop <= docViewBottom));
	
	if(!((elemBottom >= docViewTop) && (elemTop <= docViewBottom)))
	{
		$('div#reportkill2').stop().css('top', $(window).scrollTop() + 30);
		console.log($(window).scrollTop() + 30);
	}
//	{	$('div#reportkill2').stop().animate({"marginTop": ($(window).scrollTop() ) + "px"}, "slow" );			}
	
});
*/


</script>
<!--&darr;
&uarr;-->
</head>

<body><div id="topbox">
<span class="tbleft"> <a href ="http://<?php echo $_SERVER['SERVER_NAME']; ?>/"> <img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/images/homebutton.png" border="0"/> </a></span>
<span class="tbright">
<a href="http:/<?php echo $_SERVER['SERVER_NAME']; ?>/forums/" class="topbarlnk"\>Forums</a> | <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/profile.php" class="topbarlnk">Profile</a> | 
		<a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/settings.php" class="topbarlnk">Settings</a> | <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/blogs" class="topbarlnk">Blog</a> |
 
<a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/rules.php" class="topbarlnk">Rules</a> | <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/notifications.php" class="topbarlnk">Notifications</a> |
	<a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/notifications.php?view=messages" class="topbarlnk">Messages</a> | <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/about.php" class="topbarlnk">About</a> | <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/reglogin.php?action=logout" class="topbarlnk">Log Out</a>&nbsp;&bull;&nbsp;<a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/feedback.php" class="topbarlnk">Feedback</a></span>
</div>
<noscript>
You must have JavaScript enabled to use this site. If you do not know how to enable it, <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/help/docs/javascript.php" class="helplinks">click here</a>.
</noscript>

<div id="frame">
		
		<div id="header">
		<span class="headerleft">
		<?php
		if($_setting['display_fb_group'] == true)
        {
			?><a href="http://www.facebook.com/group.php?gid=<?php echo $_setting['fb_group_url'];?>" class="header"><?php echo $_setting['fb_group_name']; ?> on Facebook</a><?php
		}
		?>
		</span>
		<span class="headerright">
		<?php
		if($_setting['display_tw_page'] == true)
		{
			?><a href="http://www.twitter.com/#!/<?php echo $_setting['tw_page_url']; ?>" class="header"><?php echo $_setting['tw_page_name'];?> on Twitter</a><?php
		}
		?>
		</span>
         <img src="http://new.hvzatfsu.com/images/banners/banner3_w900xh150.png" />

  		</div>
		<!--end header-->

<div id="navblock">

   <div id="reportkill2">

        <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/reportkill.php"/>
	    <img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/images/killbtn.png" border="0"/> </a>
   
    </div>
    <!-- end reportkill2-->
	
	

		<form action="http://new.hvzatfsu.com/search.php" method="get" id="searchform">

			<input type="text" value="Search Names, or HvZIDs" id="search" name="q" style="color:#606060;width:250px;"  />
		</form>

<!-- end searchbar-->

    <div id="playerinfo">
	
	<span class="hvzidtitle">HvZ ID:</span> <span class="hvzid"><?php echo $_COOKIE['hvzidext']; ?></span><br />
            <span class="lifestatustitle">Life Status:</span> <span class="lifestatus">Administrator</span>

		
	</div>
	<!--end playerinfo-->
		
		
 </div>     
 <!-- end navblock--> 
   
   <div id="playermenu">
			<span class="playerleft"><a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/profile.php?hvzid=<?php echo $_COOKIE['hvzid'];?>" class="playerinfo">Profile</a> | <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/settings.php" class="playerinfo">Settings</a><!-- | <a href="#" class="playerinfo">Contact</a> | <a href="#" class="playerinfo">Comments</a> -->
			</span>&nbsp;
			<span class="playerright">

				&raquo; <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/reglogin.php?action=logout" class="playerinfo">Logout</a>
			</span>
		</div><!--end playermenu--><br class="clearfloat" />
        
      <div id="content">
    	<div id="admin_left">
        	<div class="sidebar_section" id="member_fns">
             <span class="admin_head" id="member_fns">Member Functions</span>
             <ul class="sidebar" id="member_fns">
                <li><a href="?action=viewmembers" class="admin">View All Registered</a></li>
                <li><a href="?action=viewactive" class="admin">View Active Members</a></li>
                <li><a href="?action=setactive"	class="admin">Set Active Members</a></li>
                <li><a href="?action=viewemails" class="admin">View Emails</a></li>
                <li><a href="?action=hvzidext" class="admin">Reassign HvZ ID ext.</a></li>
                <li><a href="?action=banned" class="admin">View Banned</a></li>
             </ul>
           </div>
           <div class="sidebar_section" id="member_tools">
             <span class="admin_head" id="member_tools">Member Tools</span>
             <ul class="sidebar" id="member_tools">
                <li><a href="?action=assignadmin" class="admin">Assign Administrators</a></li>
                <li><a href="?action=changelife" class="admin">Change Player's Life Status</a></li>
                <li><a href="?action=ozpool" class="admin">View OZ Pool</a></li>
                <li><a href="?action=setzombies" class="admin">Set Zombies</a></li>
             </ul>
            </div>
            <div class="sidebar_section" id="game_tools">		
             <span class="admin_head" id="game_tools">Game Tools</span>
             <ul class="sidebar" id="game_tools">
                <li><a href="?action=chooseoz" class="admin">Choose OZ</a></li>
                <li><a href="?action=resetzombies" class="admin">Reset Zombie Status</a></li>
    
             </ul>
           </div>
           <div class="sidebar_section" id="attendance">
	         <span class="admin_head" id="attendance">Attendance</span>
    	     <ul class="sidebar" id="attendance">
        	 	<li><a href="?action=viewperfect" class="admin">View Perfect Attendance</a></li>
            	<li><a href="?action=setattendance" class="admin">Set Attendance</a></li>
         	</ul>
          </div>
    	</div>

        <div id="admin_content">
        	<?php
			
			$action = $_REQUEST['action'];
			
			
			$actionArray = array(     //'$action=' array variables  'action name' => array('File function is in..', 'Function name')
			'changerules' => array('stuff', 'changerules'),
			'editindex' => array('stuff', 'editindex'),
			'editphones' => array('stuff' , 'editphones'),			
			'webprobs' => array('stuff', 'webprobs'),
			'webprobs2' => array('stuff', 'webprobs2'),
			'locksite' => array('stuff', 'locksite'),
			
			'viewmembers' => array('members' , 'viewmembers'), 
			'viewactive' => array('members', 'viewactive'),
			'resetactive' => array('members', 'resetactive'),
			'setactive' => array('members', 'setactive'),
			'setactive2' => array('members', 'setactive2'),
			'viewemails' => array('members' , 'viewemails'),
			'viewhvzids' => array('members', 'viewhvzids'),
			'hvzidext' => array('members' , 'hvzidext'),			
			'banned' => array('members', 'banned'),
			'insertban' => array('members', 'insertban'),
			
			'assignadmin' => array('membertools', 'assignadmin'),
			'assignadmin2' => array('membertools', 'assignadmin2'),
			'chooseadmins' => array('membertools', 'chooseadmins'),
			'chooseadmins2' => array('membertools', 'chooseadmins2'),
			'changehvzid' => array('membertools', 'changehvzid'),
			'changelife' => array('membertools', 'changelife'),
			'changelife2' => array('membertools', 'changelife2'),
			'ozpool' =>	array('membertools', 'ozpool'),
			'setzombies' => array('membertools', 'setzombies'),
			'setzombies2' => array('membertools', 'setzombies2'),
			
			'viewoz' => array('hvztools', 'viewoz'),
			'chooseoz' => array('hvztools' , 'chooseoz'),
			'setoz' => array('hvztools', 'setoz'),
			'sendmessage' => array('hvztools', 'sendmessage'),
			'gamedate' => array('hvztools', 'gamedate'),
			'meetings' => array('hvztools', 'meetings'),
			//'resetzombies' => array('hvztools' , 'resetzombies'),
			
			'createlist' => array('attendance', 'createlist'),
			'editlist' => array('attendance', 'editlist'),
			'setattendance' => array('attendance', 'setattendance'),
			'setattendance2' => array('attendance', 'setattendance2'),
			'viewperfect' => array('attendance', 'viewperfect'),
			
			'stats' => array('statistics' ,'genstats')
			);
			
			if (!isset($_REQUEST['action']) || !isset($actionArray[$_REQUEST['action']]))
			{
				//include('includes/php/statistics.php');
				//genstats();
				echo "&lt; -- Pick an option on the left.<br /><br />";
				echo "New things this release: built in attendance, change zombie -&gt; human <br /><br /><br />";
				echo "Spring release: brand new admin options, better functionality, facebook and twitter connect, and more!";
                    
			}			
			else
			{
				$file = $actionArray[$_REQUEST['action']][0];
				$function = $actionArray[$_REQUEST['action']][1];
				include_once('includes/php/'.$file.'.php');
				$function();
			}
		?>
        </div>
		
</div>

         
   
                
                
<br class="clearfloat" />
        <div id="framefooter">
        
		<span class="framefooterleft">
            <a href="http://hvzatfsu.com/info.php?action=about" class="helplinks">About</a> &bull; 
			<a href="http://hvzatfsu.com/rules.php" class="helplinks">Rules</a> &bull; 
			<a href="http://hvzatfsu.com/forums/" class="helplinks">Forums</a> &bull;			
			<a href="http://hvzatfsu.com/constitution.php" class="helplinks">Constitution</a>

			<br />- 4.0 Beta -
        </span>

		<span class="framefooterright">
		&copy;2010<br /><a rel="license" href="http://hvzatfsu.com/copyright.php"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-nc-nd/3.0/us/88x31.png" /></a>
        </span> 
          <p><br class="clearfloat" />
  </p>
</div> <!--end frame-->
<br /><br />

    </div><!--end frame footer-->     


 
 </div><!--end content-->

</div><!--end frame-->


<br /><br /><br />
  


</body>
</html>


<?php mysqli_close($cxn); //close mysql ?>
