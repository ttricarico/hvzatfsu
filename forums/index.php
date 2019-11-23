<?php	
	define('hvz',1);

/**
	ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
**/
	/** Disable Session ID in URL **/
	   //Use cookies to store the session ID on the client side
	   @ini_set ('session.use_only_cookies', 1);
	   //Enable transparent Session ID support
	   @ini_set ('session.use_trans_sid',    1);
session_start();

	
	include('php/settings.php');
		global $cxn;
		$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
		if(!$cxn)
		{	die(mysqli_error());	}
		
	include('php/permissions.php');
		getpermissions();
		
	require_once('php/security.php');
	
	ob_start();	//catch all output
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>HvZatFSU &mdash; Forums <?php echo $title; ?></title>

<link rel="stylesheet" href="http://<?php echo $_SERVER['SERVER_NAME'];?>/styles/basestyle.css" type="text/css" />
<link rel="stylesheet" href="http://<?php echo $_SERVER['SERVER_NAME'];?>/styles/popup.css" type="text/css" />
<link rel="stylesheet" href="style/categories.css" type="text/css" />
<link rel="stylesheet" href="style/threads.css" type="text/css" />
<link rel="stylesheet" href="style/forums.css" type="text/css" />
<link rel="stylesheet" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/styles/links.css" type="text/css" />

<script language="javascript" src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/scripts/jquery.js" type="text/javascript"></script>
<script language="javascript" src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/scripts/jquery.insertRoundCaret.js" type="text/javascript"></script>
<script language="javascript" src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/scripts/main.js" type="text/javascript"></script>
<script language="javascript" src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/forums/scripts/forums.js" type="text/javascript"></script>
<script language="javascript" src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/forums/scripts/newpost.js" type="text/javascript"></script>

<script>
<!--//
	
	/** Slide down what can i post **/
	$(document).ready(function(){
		$("#showforums_whatcanipost").click(function(){
			$("div#forums_whatcanipost").slideToggle(1500);
		});
	});
	
	// Load Rules
	function loadforumrules(){
		$("#popupframefooter").slideDown(150);
		$("#popupframefooter").html('<center><img src="ajax/redloader.gif" title="Loading..." /></center>');
		$("#popupframefooter").load("ajax/newpost.php #popupframefooter");
	}
	
	/** Open BBCode Window **/
	function open_bbcodeinfo(){
		window.open ("bbcodeinfo.php","newwindow",
					"status=yes,resizable=no,width=350,height=500");
	}

$(document).ready(function(){
	$("div#getnewpost").click(function(){
		window.location.reload()
	});
});

// Fade in frame box for delete confirmation
$(document).ready(function(){
	$("#delthread").click(function(){
		$("#popupframe").fadeIn("150");
		var currentthreadid = getUrlVars()['threadid'];
		var currentcatid = getUrlVars()['catid'];
		$("#popupframebody").load("ajax/delpost.php?threadid="+ currentthreadid +"&catid=" + currentcatid +" #popupframebody");
	});
});
function delconfirm() {
	$("input").attr("disabled, true");
	$(".loading").show();
	var tid = getUrlVars()['threadid'];
	var catid = getUrlVars()['catid'];
	var dataString = "threadid=" + tid + "&catid=" + catid;
	$.ajax({
		type: "POST",
		url: "index.php?action=deletethread",
		data: dataString,
		success:function(){
			$('#popupframebody').html("<h1 align=\"center\">Thread Deleted</h1>");
			$('#popupframe').delay(1500);
			window.location.href = "index.php?action=viewcategory&catid=" + catid
		},
		error: function(){
			$(".loading").hide();	//hide loading circle
			$("input").removeAttr("disabled"); //enable button
			$("span#posterror").html("There was a problem, please try again").show();
		}
	});
}
/** New Thread popup box **/
$(document).ready(function(){
	$("#newthread").click(function(){
		$("#popupframe").fadeIn("150");
		$("#popupframebody").load("ajax/newthread.php #popupframebody");
	});
});
function threadformsubmit(){
	var postcontent = $("#postcontent").val();
	var name = "<?php echo $_COOKIE['firstname']." ".$_COOKIE['lastname'];?>";
	var hvzid = $("#hvzid").val();
	var newthreadtitle = $("#nttitle").val();
	var ipaddr = "<?php echo ip2long($_SERVER['REMOTE_ADDR']);?>";	//long version of ip address
	if(postcontent == "" || newthreadtitle == ""){
		$("span#posterror").show();	
		$("span#threaderror").show();
		return false;
	}
	else{
		var dataString = 'postername='+ name + '&posterhvzid=' + hvzid + '&ipaddr=' + ipaddr + '&catid=' + getUrlVars()['catid'] + '&threadtitle=' + newthreadtitle + '&postcontent=' + postcontent;  
		$(".loading").show();	//show loading circle
		$(".formtext").attr("disabled", "true");	//disable text fields
		$("input#newpostbtn").attr("disabled", "true"); //disable button
		$.ajax({
			type: "POST",
			url: "index.php?action=newthread2",
			data: dataString,
			success:function(){
				$('#popupframebody').html("<h1 align=\"center\">Thread Created</h1>");
				$('#popupframe').delay(1500).fadeOut(500);
				$("input#newpostbtn").removeAttr("disabled"); //enable button
				$("div#getnewpost").slideDown(100);
			},
			error: function(){
				$(".loading").hide();	//hide loading circle
				$(".formtext").removeAttr("disabled");	//enable text
				$("input#newpostbtn").removeAttr("disabled"); //enable button
				$("span#posterror").html("There was a problem, please try again").show();
			}
		});
		return false;
	}
}
/*** Thread functions ***/
function makesticky(threadid){
	$.ajax({
			type: "POST",
			url: "index.php?action=makesticky",
			data: "threadid=" + threadid,
			success:function(){
				$("#stickyinfo").html('<a href="javascript://" onclick="removesticky(' + threadid + ')">Remove Sticky</a>');
			}
		});
}
function removesticky(threadid){
	$.ajax({
			type: "POST",
			url: "index.php?action=makeunsticky",
			data: "threadid=" +threadid,
			success:function(){
				$("#stickyinfo").html('<a href="javascript://" onclick="makesticky(' + threadid + ')">Make Sticky</a>');
			}
		});
}
function lockthread(threadid){
	$.ajax({
			type: "POST",
			url: "index.php?action=lockthread",
			data: "threadid=" + threadid,
			success:function(){
				$("#lockinfo").html('<a href="javascript://" onclick="unlockthread(' + threadid + ')">Unlock Thread</a>');
			}
		});
}
function unlockthread(threadid){
	$.ajax({
			type: "POST",
			url: "index.php?action=unlockthread",
			data: "threadid=" + threadid,
			success:function(){
				$("#lockinfo").html('<a href="javascript://" onclick="lockthread(' + threadid + ')">Lock Thread</a>');
			}
		});
}

/** Post Functions [delete/report] **/
function delpost(postid, threadid){
	$.ajax({
			type: "POST",
			url: "index.php?action=deletepost",
			data: "postid=" + postid + "&threadid=" + threadid,
			success:function(){
				$("div#" + postid).slideUp(1500);
			}
		});
}
function reportpost(postid){
	$.ajax({
			type: "POST",
			url: "?action=reportpost",
			data: "postid=" + postid + "&rhvzid=<?php echo $_COOKIE['hvzid']; ?>",
			success:function(){
				$("a#rptpost"+postid).html("Post Reported");
			}
		});

}
/** Highlight post**/
if(window.location.hash != "")
{
	$(document).ready(function(){
		$('div#'+window.location.hash).css('background-color', '#FFFFA8');
	});
}

/** Submit Edited Post **/
function submiteditedpost(){
	var postcontent = $("#postcontent").val();
	var postid = getUrlVars()['postid'];
	var threadid = getUrlVars()['threadid'];
	var catid = getUrlVars()['catid'];
	if(postcontent == "")
	{	$("span#posterror").show();	return false;}
	else{
		var dataString = 'postid='+ postid + '&hvzid=<?php echo $_COOKIE['hvzid']; ?>&postcontent=' + postcontent;  
		$(".loading").show();	//show loading circle
		$(".formtext").attr("disabled", "true");	//disable text fields
		$("input#newpostbtn").attr("disabled", "true"); //disable button
		$.ajax({
			type: "POST",
			url: "index.php?action=editpost2",
			data: dataString,
			success:function(){
				$("#popupframe").fadeIn(150);
				$("#popupframebody").html("<center><h2>Post Updated</h2></center>").delay(2000);
				window.location.href = "index.php?action=viewthread&threadid=" + threadid + "&catid=" + catid + "#" + postid;
			},
			error: function(){
				$(".loading").hide();	//hide loading circle
				$(".formtext").removeAttr("disabled");	//enable text
				$("input#newpostbtn").removeAttr("disabled"); //enable button
				$("span#posterror").html("There was a problem, please try again").show();
			}
		});
		return false;
	}
}


/** Removing Tags in Posts **/
function removetag()
{
	var postid = getUrlVars()['postid'];
	$(".loading").show();
	
	$.ajax({
			type: "POST",
			url: "index.php?action=removetag",
			data: "&postid=" + postid,
			success:function(){
				$("#popupframe").fadeIn(150);
				$(".loading").show();
				$("#popupframebody").html("<center><h2>Tag Removed from Post</h2></center>").delay(500);
				window.location.reload;
			},
		});
}
//-->
</script>
</head>
<body>
<?php	include('../php/header.php');	
	topbar();
?>
<!-- This div has the newpost/newthread/etc stuff if it-->
<div id="popupframe">
	<div id="popupframehead">
		<div id="head_left">
		</div>
    	<div id="head_right">
			<a href="javascript://" id="closepopupframe" title="Close">X</a>
		</div>

		<div class="clearer"></div>
    </div>
    <div id="popupframebody">
    <center><img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/images/loadingicons/redloader.gif" title="Loading..." alt="Loading..." /></center>
    <br /><br />
    </div>
    <div id="popupframefooter"></div>
    
</div>
<div id="frame"> 
		
  <div id="header"> 
        	<span class="headerleft"><a href="http://www.facebook.com/group.php?gid=53924719249" class="header">FSU HvZ on Facebook</a></span> 
            <span class="headerright"><a href="#" class="header">Next Game: Spring 2011</a></span> 
         <img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/banners/banner3_w900xh150.png" /> 
 
  		</div> 
		<!--end header--> 
 
 
<div id="navblock"> 
 
   <div id="reportkill2"> 
 
        <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/reportkill.php"/> 
	    <img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/killbtn.png" border="0"/> </a> 
   
    </div> 
    <!-- end reportkill2--> 
	
	
 
		<form action="index.php?action=search" method="get" id="searchform"> 
			<input type="text" value="Search Names, or HvZIDs" id="search" name="q" style="color:#606060; width:250px;;"  /> 
		</form> 
 
<!-- end searchbar--> 
 
    <div id="playerinfo"> 
	<?php
		if(isset($_COOKIE['hvzid']))
		{
			$query = "SELECT human, admin, oz FROM members WHERE hvzid='".$_COOKIE['hvzid']."'";
			$result = mysqli_query($cxn, $query);
			$p = mysqli_fetch_assoc($result);
			if($p['admin'] == 1)
			{	$life = 'Administrator';	}
			elseif($p['oz'] == 1)
			{	$life = 'Original Zombie';	}
			elseif($p['human'] == 1)
			{	$life = 'Human';	}
			elseif($p['human'] == 0)
			{	$life = 'Zombie';	}
			else
			{	$life = 'Please contact a Moderator';	}
			echo "<span class=\"hvzidtitle\">HvZ ID:</span> <span class=\"hvzid\">".$_COOKIE['hvzidext']."</span><br /> 
            <span class=\"lifestatustitle\">Life Status:</span> <span class=\"lifestatus\">".$life."</span>";
		}
		else{
			echo "<form action=\"http://".$_SERVER['SERVER_NAME']."/reglogin.php?action=login\" method=\"post\">
											 <input type=\"email\" name=\"email\" id=\"loginemail\" style=\"width:100px;color:#999999;\" value=\"Email\" />&nbsp;&nbsp;<input type=\"password\" name=\"password\" id=\"loginpass\" style=\"width:100px;color:#999999;\" value=\"Password\"/>
										  <input name=\"btnsubmit\" type=\"submit\" value=\"Go!\" />
										  <br class=\"clearfloat\" />
										&raquo;<a href=\"http://".$_SERVER['SERVER_NAME']."/reglogin.php?action=regdisp\" class=\"playerinfo\">Register</a>&nbsp;&nbsp;&raquo;<a href=\"http://".$_SERVER['SERVER_NAME']."/reglogin.php?action=forgotpass\" class=\"playerinfo\">Forgot Password?</a>
                        </form>";
			}
?>
	</div> 
	<!--end playerinfo--> 
		
		
 </div>     
 <!-- end navblock--> 
   
   <div id="playermenu"> 
			
            <?php
            	if(isset($_COOKIE['hvzid']))
				{
					echo "<span class=\"playerleft\">";
					if($_COOKIE['admin'] == true)
					{  echo "<a href=\"http://".$_SERVER['SERVER_NAME']."/admin/\" class=\"playerinfo\">Admin Page</a> | ";  }
					echo "<a href=\"http://".$_SERVER['SERVER_NAME']."/profile.php?hvzid=".$_COOKIE['hvzid']."\" 
class=\"playerinfo\">Profile</a> | <a href=\"http://".$_SERVER['SERVER_NAME']."/settings.php\" class=\"playerinfo\">Settings</a><!-- | <a href=\"#\" class=\"playerinfo\">Contact</a> | <a href=\"#\" class=\"playerinfo\">Comments</a> --> 
			</span>&nbsp;
			<span class=\"playerright\"> 
				&raquo; <a href=\"http://".$_SERVER['SERVER_NAME']."/reglogin.php?action=logout\" class=\"playerinfo\">Logout</a> 
			</span>"; 
				}
			?>
		</div><!--end playermenu-->
        <br class="clearfloat" />
        
        
	<div id="leftbar">
    
    </div>
    <div id="content">
<?php /*********/
			
			$actionArray = array(     //'$action=' array variables  'action name' => array('File function is in..', 'Function name')
				'viewall-default' => array('category', 'viewallcat'),
				
				'viewcategory' => array('category', 'viewcategory'),
				'newcategory' => array('category', 'newcategory'),
				'newcategory2' => array('category', 'newcategory2'),
				
				'viewthread' => array('thread', 'viewthread'),
				'lockthread' => array('thread', 'lockthread'),
				'unlockthread' => array('thread', 'unlockthread'),
				'newthread' => array('thread', 'newthread'),
				'newthread2' => array('thread', 'newthread2'),
				'makesticky' => array('thread', 'stickythread'),
				'makeunsticky' => array('thread', 'unstickythread'),
				'deletethread' => array('thread', 'deletethread'),
				
				'editpost' => array('post', 'editpost'),
				'editpost2' => array('post', 'editpost2'),
				'newpost' => array('post','newpost'),
				'newpost2' => array('post','newpost2'),
				'deletepost' => array('post','deletepost'),
				'reportpost' => array('post', 'reportpost'),
				'viewpost' => array('post', 'viewpost'),
				'removetag' => array('post', 'removetag'),
				
				'search' => array('search', 'searchforums')
			);
			
			if (!isset($_REQUEST['action']) || !isset($actionArray[$_REQUEST['action']]))
			{
				$file = 'category';
				$function = 'viewallcat';			
			}					
			else
			{
				$file = $actionArray[$_REQUEST['action']][0];
				$function = $actionArray[$_REQUEST['action']][1];
			}
	
			include_once('php/'.$file.'.php');
			
			$function();
			?>
            
            </div><!--end content-->
   	<?php include('../php/footer.php'); ?>
<br class="clearfloat" /> 
 
</div> <!--end frame--> 

<br /><br />
<br /><br />
</body>
</html>
			
<?php
	ob_end_flush();	//send output
	mysqli_close($cxn); 
?>
