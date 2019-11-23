
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="copyright" content="Copyright 2010 Thomas Tricarico and HvZatFSU" /> 
<meta name="contact" content="fsuzombies[at]gmail[dot]com" /><title>HvZ@FSU  :: Profile</title> 
 
<link rel="stylesheet" href="http://new.hvzatfsu.com/styles/basestyle.css" type="text/css" /> 
<link rel="stylesheet" href="http://new.hvzatfsu.com/styles/buttons.css" type="text/css" /> 
<link rel="stylesheet" href="http://new.hvzatfsu.com/styles/links.css" type="text/css" /> 
<link rel="stylesheet" href="http://new.hvzatfsu.com/styles/footer.css" type="text/css" /> 
<link rel="stylesheet" href="http://new.hvzatfsu.com/styles/index.css" type="text/css" /> 
 
<script type="text/javascript" src="http://new.hvzatfsu.com/scripts/jquery.js"></script> 
<script type="text/javascript" src="http://new.hvzatfsu.com/scripts/awesomestuff.js"></script><style type="text/css"> 
 
::-moz-selection { background:#FFFF00; color:#000; /* Firefox */  }
::selection { background:#c3effd; color:#000; /* Safari and Opera */ }
 
 
</style> 
<style type="text/css"> 
	#profilename{
		width:100%;
		float:left;
		text-align:left;
		padding-left:10%;
		padding-bottom: .5em;
		padding-top: 1em;
		font-family:Verdana, Arial, Helvetica, sans-serif;
		font-size: 24px;
		font-weight:bold;
		color:#000099;
	}
	#profilepicmenu{
		float:left;
		width:24%;
		margin-left:3px;
		margin-right:3px;
		margin-top:5px;
		border-right: 1px solid #CCCCCC;
	}
	#profilecontent{
		float:right;
		width:74%;	
	}
	a.promenu, a.promenu:visited{
		color:#CC0000;
		text-decoration:none;
		display:block;
		padding-bottom:.2em;
	}
	a.promenu:hover{
		color:#FF9900;
		text-decoration:underline;
	}
 
	img.imgdisp{
		margin-top:5px;
		margin-bottom: 5px;
		padding: 10px;
		border: 1px solid #CCCCCC;
		display:block;
	}
	img.imgthumb{
		padding: 4px;
		margin: 2px;
		border: 1px solid #CCCCCC;
	}
	div#imageholder{
		margin-left:auto;
		margin-right:auto;
		width: 670px;
	}
	div#imgcaption{
		padding-left:10px;
		padding-right:10px;
		margin-top: 3px;
		margin-bottom:3px;	
	}
	span#imgcaptiontxt{
		float:left;
		width:auto;
		display: inline;
		font-size:10px;
		font-family:Verdana, Arial, Helvetica, sans-serif;
	}
	span#imageinfo{
		float:right;
		width:auto;
	}
	span#imageheadleft{
		float:left;
		width:auto;
	}
	span#imageheadright{
		float:right;
		width:auto;
	}
</style> 
 
<style type="text/css"> 
  /*this is what we want the div to look like when it IS showing*/
  div.sendmsg{
    display:block;
	display:none;
 
    /*set the div in the center of the screen*/
    position:absolute;
    top:45%;
    left:30%;
	right:30%;
    /*width:500px;*/
	z-index:105;
	
	border:7px solid #FFAAAC;
	background:#FFFFFF;
	padding: 3px;
  }
  span.msgto{
  	color:#999999;
  }
</style> 
<style type="text/css"> 
	input.msgtext{
		width: 80%;
	}
	textarea{
		width:90%;
	}
	span.msgerror{
		font-size:10px;
		color:#FF0000;
		display:none;
	}
 
</style> 
<style type="text/css"> 
	div#commenter{
	
	}
	div#commenterhead{
	
	}
	div#commenterhead a:link, div#commenterhead a:visited{
	
	}
	div#commenterhead a:hover{
	
	}
	div#commenterbody{
		display:none;
	}
	div#picturecomments{
		float: right;
		width: 65%;
		margin-right: 5px;
		margin-left: 5px;
	}
	div#imagedirectory{
		float:left;
		width: 31%;
		margin-left: 5px;
		margin-right:5px;
		padding-right: 3px;
		border-right:1px solid #00FF00;
	}
</style> 
<script type="text/javascript" src="scripts/jquery.js"></script> 
 
<script language="javascript"> 
	$(window).scroll(function(){$("#topbox").animate({top:$(window).scrollTop()+"px" },{queue: false, duration: 0});});
</script> 
<script language="javascript"> 
//Get url variables
function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}
</script> 
<script language="javascript"> 
<!--//
	$(document).ready(function(){
      $("div.sendmsg").hide();
	});
	
	$(document).ready(function(){
		$("#sendmsg").click(function(){
			$("div.sendmsg").fadeIn(100);
		});
	});
	
	$(document).ready(function(){
		$("#hidesendmsgdiv").click(function(){
			$("div.sendmsg").fadeOut(100);
		});
	});
 
//-->
</script> 
<script language="javascript"> 
<!--//
$(function() {  
	$("input.msgsubmit").click(function(){
		var msgcontent = $("textarea#textbox").val();
		if(msgcontent == ""){
			$("span.msgerror").show();
			return false;
		}
		
		//Form Submission
		var msgsub = $("input#msgsubject").val();
		var msgtext = $("textarea#textbox").val();
		var msgdata = "fromhvzid=T4YH84S&tohvzid=&subject=" + msgsub + "&msgtext=" + msgtext;
		
		$.ajax({
			type: "POST",
			url: "apps/msgsend.php",
			data: msgdata,
			success:function(){
						$(".sendmsghead").html("Message Sent");
						$(".sendmsgbody").html("Your message has been sent.");
					},
			error: alert("There was a problem sending the message. Please try again."),
		});
		return false;
	});
});
//-->
</script> 
<script type="text/javascript"> 
<!--// Comment Deletion
 
function delcomment(postid)
{
	$.ajax({
			type: 'POST',
			url: 'apps/profilecomments.php?action=delpost',
			data: 'postid=' + postid,
			success:function(){
				$("div#comment"+postid).slideUp(150);
			}
		});
}
 
//img comment submission
function postpiccomment()
{
	var postcontent = $("#postcontent").val();
	var name = $("#postername").val();
	var p = $("#picturename").val();
	if(postcontent == "")
	{	$("span#posterror").show();	return false;}
	else{
		var dataString = 'pn='+ name + '&p=' + p + '&pc=' + postcontent; 
		$("span#posterror").hide();
		$(".postsubmit").show();	//show loading circle
		$(".formtext").attr("disabled", "true");	//disable text fields
		$.ajax({
			type: "POST",
			url: "apps/ajax_profileimgcomment.php?action=newpost",
			data: dataString,
			success:function(){
				$(".postsubmit").hide();	//hide loading circle
				$(".formtext").removeAttr("disabled");	//enable text fields
				$("#postcontent").val("");	//clear box
			},
		});
		return false;
	}
}
//delete pic comment
/***	Future Location	***/
 
//Image caption change
$(document).ready(function(){
	var imgcaption = $("span#imgcaptiontxt").text();
	$("#editcaption").click(function(){
		$("#editsymbol").hide();
		$("span#imgcaptiontxt").html('<form onsubmit="submitcaptiontxt();return false;" id="updatecaption"><input type="text" id="captiontxt" name="captiontxt" value="' + imgcaption + '" style="width: 300px;"><span class="chgcaption" style="padding-left:5px; display:none;"><img src="images/icons/redloader.gif" title="Updating..."></span><span class="chgerror" style="padding-left:5px; color:#FF0000; font-size:10px; display:none;">There was an error changing the caption.</span></form>');
	});
});
 
function submitcaptiontxt()
{
	var imgname = getUrlVars()['p'];
	var captiontext = $("#captiontxt").val();
	var dataString = 'p=' + imgname +'&captiontxt=' + captiontext;
	$(".chgcaption").show();
	$("#captiontxt").attr("disabled", "true");
	$.ajax({
			type: "POST",
			url: "apps/ajax_profileimgcomment.php?action=updatecaption",
			data: dataString,
			success:function(){
				$(".chgcaption").hide();
				$("span#imgcaptiontxt").html(captiontext);
				$("span#imgcaptiontxt").append('&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/icons/pencil.png" id="editsymbol" title="Edit Caption" alt="Edit" border="0">');
			},
			error:function(){
				$(".chgerror").show();
				$(".chgcaption").hide();
				$("#captiontxt").removeAttr("disabled", "true");
			}
		});
		return false;
}
		
//-->
</script> 
<script type="text/javascript"> 
<!--//
	$(document).ready(function(){
		$("a#postnew").click(function(){
			$("div#commenterbody").toggle(500);
		});
	});
//-->
</script> 
<script type="text/javascript"> 
<!--//
	function uploader()
	{	
		$(".uploading").show();	
		$(".formtext").attr("disabled", "true");
		
	}
 
	function delimage(imgid)
	{
		var answer = confirm("Are You Sure?");
		if(answer)
		{
			dataString = 'img=' + imgid;
			$.ajax({
				type: "POST",
				url: "uploads/images/index.php?action=deleteimg",
				data: dataString,
				success:function(){
						window.location.href = 'profile.php?view=pictures&hvzid=' + getUrlVars()['hvzid'];
				}
			});
		}
		
	}
//-->
</script> 
 
 <style>
 	div#uploader{
		float: left;
		width:auto;
	}
	div#recents{
		float: right;
		width: auto;
		padding-left: 10px;
		border-left: 1px solid #CCCCCC;
		margin-right: 15px;
		margin-top: 5px;
		margin-bottom: 30px;
	}
	div#recentshead{
		font-size: 18px;
		color:#990000;
		font-weight:bold;
	}
 	table#uploadtable{
		width: auto;
		padding-top: 5px;
		border:0px;
	}
	table#uploadtable tr{
		padding-top: 3px;
		padding-bottom: 3px;
		text-align:center;
	}
	table#uploadtable td{
		padding-left: 5px;
		padding-right: 5px;
	}
	input#submit{
		background-color:#999999;
		color:#FFFFFF;
		border: 2px solid #000000;
		border-radius:3px;
		margin-top: 10px;
	}
	input#submit:hover{
		background-color:#CCCCCC;
	}
	input#submit:active{
		background-color:#666666;
	}
 	span#uploaderhead{
		margin-left:30px;
		font-size:14px;
		color:#990000;
		font-weight:bold;
	}
 </style>
 
</head> 
 
<body><div id="topbox"> 
<span class="tbleft"> <a href ="http://new.hvzatfsu.com"> <img src="http://new.hvzatfsu.com/images/homebutton.png" border="0"/> </a> </span> 
<span class="tbright"> 
<a href="http://new.hvzatfsu.com/forums/" class="playerinfo"\>Forums</a> | 
<a href="http://new.hvzatfsu.com/profile.php" class="playerinfo">Profile</a> | 
<a href="http://blog.hvzatfsu.com" class="playerinfo">Blog</a> |
<a href="http://new.hvzatfsu.com/settings.php" class="playerinfo">Settings</a> |
<a href="http://new.hvzatfsu.com/rules.php" class="playerinfo">Rules</a> |
<a href="http://new.hvzatfsu.com/marketplace/" class="playerinfo">Marketplace</a> |
<a href="http://new.hvzatfsu.com/about.php" class="playerinfo">About</a> | <a href="http://new.hvzatfsu.com/reglogin.php?action=logout" class="playerinfo">Log Out</a></span> 
</div><div id="frame"> 
		
		<div id="header"> 
        	<span class="headerleft"><a href="http://www.facebook.com/group.php?gid=53924719249" class="header">FSU HvZ on Facebook</a></span> 
            <span class="headerright"><a href="#" class="header">Next Game: Spring 2011</a></span> 
         <img src="http://new.hvzatfsu.com/images/banners/banner3_w900xh150.png" /> 
 
  		</div> 
		<!--end header--> 
 
 
<div id="navblock"> 
 
   <div id="reportkill2"> 
 
        <a href="http://new.hvzatfsu.com/reportkill.php"/> 
	    <img src="http://new.hvzatfsu.com/images/killbtn.png" border="0"/> </a> 
   
    </div> 
    <!-- end reportkill2--> 
	
	
 
		<form action="http://blog.hvzatfsu.com/search.php" method="get" id="searchform"> 
			<input type="text" value="Search Names, or HvZIDs" id="search" name="q" style="width:200px;"  /> 
		</form> 
 
<!-- end searchbar--> 
 
    <div id="playerinfo"> 
	
	<span class="hvzidtitle">HvZ ID:</span> <span class="hvzid">T4YH84S-849</span><br /> 
            <span class="lifestatustitle">Life Status:</span> <span class="lifestatus">Administrator</span> 
		
	</div> 
	<!--end playerinfo--> 
		
		
 </div>     
 <!-- end navblock--> 
   
   <div id="playermenu"> 
			<span class="playerleft"><a href="http://new.hvzatfsu.com/admin/" class="playerinfo">Admin Page</a> | <a href="http://new.hvzatfsu.com/profile.php?hvzid=T4YH84S" class="playerinfo">Profile</a> | <a href="http://new.hvzatfsu.com/settings.php" class="playerinfo">Settings</a><!-- | <a href="#" class="playerinfo">Contact</a> | <a href="#" class="playerinfo">Comments</a> --> 
			</span>&nbsp;
			<span class="playerright"> 
				&raquo; <a href="http://new.hvzatfsu.com/reglogin.php?action=logout" class="playerinfo">Logout</a> 
			</span> 
		</div><!--end playermenu--><br class="clearfloat" /><div class="sendmsg"> 
 
  <div style="top:5px; left:3px; font-size:24px; color:#000066; font-weight:bold;" class="sendmsghead">Send Message</div><div style="right:5px; top:5px; position:absolute; background:#CCCCFF; padding:2px;" class="sendmsgbody"><a href="javascript://" id="hidesendmsgdiv" class="helplinks">X</a></div> 
  		<form name="sendmessage" action=""> 
            To: <span class="msgto"> </span><br /> 
            Subject: <input type="text" maxlength="255" id="msgsubject" class="msgtext" /><br /> 
            Message:&nbsp;&nbsp;<span class="msgerror">Please Insert a Message</span> 
            <center><textarea rows="7" id="textbox"></textarea></center> 
            <input type="button" value="Send Message" id="msgsubmit" class="msgsubmit" /> 
        </form> 
 
</div> 
 
   <div id="talk">	<!-- if the computer has anything important for the player, it goes here--> 
   	     </div>	<!--end talk--> 
     <div id="content">
     
     
     	<div id="uploader">
     <span id="uploaderhead">You have 2 pictures uploaded.</span><form action="uploads/images/index.php?action=postmultiple" enctype="multipart/form-data" method="post"> 
                	<table border="0" id="uploadtable"> 
                    	<tr> 
                        	<td><input type="file" name="file1" id="file1" class="formtext" /></td> 
                            <td><input type="file" name="file2" id="file2" class="formtext" /></td> 
                        </tr> 
                        <tr> 
                        	<td><input type="file" name="file3" id="file3" class="formtext" /></td> 
                            <td><input type="file" name="file4" id="file4" class="formtext" /></td> 
                        </tr> 
                        <tr> 
                        	<td><input type="file" name="file5" id="file5" class="formtext" /></td> 
                            <td><input type="file" name="file6" id="file6" class="formtext" /></td> 
                        </tr> 
                        <tr> 
                        	<td colspan="2"><input type="submit" value="Upload Pictures" class="formtext" id="submit" /> 
								<span class="uploading" style="padding-left: 10px; display:none;"><img src="images/icons/redloader.gif" /></span></td> 
                        </tr> 
                     </table> 
                </form> 
     </div>
     <div id="recents">
     	<div id="recentshead">Recent Uploads</div>
        <table border="0" style="width:100%; text-align:center;">
        	<tbody>
            	<tr>
                	<td><a href="?view=pic&p=T4YH84S_1299823402__571e32a9497bc9ce85a05dda04543fd6jpg&hvzid=T4YH84S"><img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/uploads/images/index.php?action=get&name=T4YH84S_1299823402__571e32a9497bc9ce85a05dda04543fd6jpg" border="0" class="imgthumb"></a></td>
                    <td><a href="?view=pic&p=T4YH84S_1299899370__84dac9c08d9ed54283e7ed937bdd0b9bjpg&hvzid=T4YH84S"><img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/uploads/images/index.php?action=get&name=T4YH84S_1299899370__84dac9c08d9ed54283e7ed937bdd0b9bjpg" border="0" class="imgthumb"></a></td>
                </tr>
                <tr>
                	<td><a href="?view=pic&p=T4YH84S_1299823402__571e32a9497bc9ce85a05dda04543fd6jpg&hvzid=T4YH84S"><img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/uploads/images/index.php?action=get&name=T4YH84S_1299823402__571e32a9497bc9ce85a05dda04543fd6jpg" border="0" class="imgthumb"></a></td>
                    <td><a href="?view=pic&p=T4YH84S_1299899370__84dac9c08d9ed54283e7ed937bdd0b9bjpg&hvzid=T4YH84S"><img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/uploads/images/index.php?action=get&name=T4YH84S_1299899370__84dac9c08d9ed54283e7ed937bdd0b9bjpg" border="0" class="imgthumb"></a></td>
                </tr>
                <tr>
                	<td><a href="?view=pic&p=T4YH84S_1299823402__571e32a9497bc9ce85a05dda04543fd6jpg&hvzid=T4YH84S"><img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/uploads/images/index.php?action=get&name=T4YH84S_1299823402__571e32a9497bc9ce85a05dda04543fd6jpg" border="0" class="imgthumb"></a></td>
                    <td><a href="?view=pic&p=T4YH84S_1299899370__84dac9c08d9ed54283e7ed937bdd0b9bjpg&hvzid=T4YH84S"><img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/uploads/images/index.php?action=get&name=T4YH84S_1299899370__84dac9c08d9ed54283e7ed937bdd0b9bjpg" border="0" class="imgthumb"></a></td>
                </tr>
            </tbody>
        </table>
        
        </div>
                
                
 </div><!--end content--> 
<br class="clearfloat" /> 
<style>
div#framefooterleft{
	width: 45%;
	float:left;
}
div#framefooterright{
	width: 45%;
	float:right;
	text-align:right;
}
div#bottomfooter{
	text-align:center;
	font-size: 10px;
	color:#666666;
}
div#recents{
	width:100%;
	padding: 3px;
}
div#footerrecentblogs{
	width: 45%;
	float:left;
	text-align:left;
}
div#footerrecentforums{
	width:45%;
	float:right;
	text-align:right;
}
</style>
<div id="framefooter">
        
		<div id="framefooterleft">
        	<a href="#" class="helplinks">About</a> &bull; <a href="#" class="helplinks">Rules</a> &bull; <a href="#" class="helplinks">Forums</a> &bull; <a href="#" class="helplinks">Constitution</a>
            <br />
            <a href="#" class="helplinks">Settings</a> | <a href="#" class="helplinks">Profile</a> | <a href="#" class="helplinks">Site Help</a>
             
       </div>
		<div id="framefooterright">
		©2010<a rel="license" href="http://new.hvzatfsu.com/copyright.php"><br /><img alt="Creative Commons License" style="border-width: 0pt;" src="http://i.creativecommons.org/l/by-nc-nd/3.0/us/88x31.png"></a>
         </div>
       <p><br class="clearfloat">  </p>

 <br class="clearfloat" /> 
 <div id="bottomfooter">
 	Powered by <abbr title="Completely and Totally Made Up. Still stolen from last game, though." style="color:#990000;">Bananahandler Content System</abbr> &copy; 2010-2011 <abbr title="This, as well." style="color:#990000;">Bananahandler Studios, Inc.</abbr>
 </div>
 
</div> <!--end frame--> 
<br /><br /><br /><br /> 
</body> 
</html> 