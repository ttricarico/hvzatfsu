<?php	define('hvz', 1);
	date_default_timezone_set('America/New_York');	
	if(!isset($_COOKIE['hvzid']))	//if not logged in, kick back to login screen
	{	header('Location: http://'.$_SERVER['SERVER_NAME'].'/reglogin.php?talk=You must be logged in to view profiles'); exit; }
	
		/** Disable Session ID in URL **/
	//Use cookies to store the session ID on the client side
	@ini_set ('session.use_only_cookies', 1);
	//Enable transparent Session ID support
	@ini_set ('session.use_trans_sid',    1);
	session_start();
	
	/****MySQL Login***/
	include('php/settings.php');
		global $cxn;
		$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
	require_once('php/security.php');

	if(isset($_GET['s']))
	{
		$query = "SELECT hvzid FROM members WHERE firstname='".sanitize($_GET['firstname'])."' AND lastname='".sanitize($_GET['lastname'])."'";
		$result = mysqli_query($cxn, $query);
		$row = mysqli_fetch_assoc($result);
		header('Location: http://'.$_SERVER['SERVER_NAME'].'/profile.php?view=profile&hvzid='.$row['hvzid']);
		mysqli_free_result($result);
		mysqli_close($cxn);
		exit;
	}
	if(!isset($_GET['view']))	//if ?view=profile is not set, make it so.
	{
		if(isset($_GET['hvzid']))	// if ?hvzid=XXXXXXX is set
		{	header('Location: http://'.$_SERVER['SERVER_NAME'].'/profile.php?view=profile&hvzid='.$_GET['hvzid']); exit; }
		else	//if ?hvzid=XXXXXX is NOT set
		{	header('Location: http://'.$_SERVER['SERVER_NAME'].'/profile.php?view=profile&hvzid='.$_COOKIE['hvzid']); exit; }
	}
	
	if(!isset($_GET['hvzid']))	//if ?hvzid=XXXXXXX is not set, but ?view=???? is, set ?hvzid= as cookie value
	{	
		if($_GET['view'] == 'profile')
		{	header('Location: http://'.$_SERVER['SERVER_NAME'].'/profile.php?view=profile&hvzid='.$_COOKIE['hvzid']); exit; }
		if($_GET['view'] == 'pictures')
		{	header('Location: http://'.$_SERVER['SERVER_NAME'].'/profile.php?view=pictures&hvzid='.$_COOKIE['hvzid']); exit; }
	}	
	//header time!	Prevent catching, etc
	header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	header ('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
	header ('Cache-Control: no-cache, must-revalidate'); // HTTP/1.1
	header ('Pragma: no-cache'); // HTTP/1.0


	/*****Header Stuff*****/
	include('php/header.php');
	global $title;
		$title = " :: Profile";
	
	



	$viewArray = array(     //'$action=' array variables  'action name' => array('File function is in..', 'Function name')
				'profile' => array('profile', 'viewprofile'),
				'pictures' => array('profile', 'viewpictures'),
				'pic' => array('profile', 'viewindividualpic'),
				'imageuploader' => array('profile', 'imageuploader'),
				'imageuploader2' => array('profile', 'imageuploader2'),
				'makeprofilepic' => array('profile', 'makeprofilepic')
			);
			
			if (!isset($_REQUEST['view']) || !isset($viewArray[$_REQUEST['view']]))	//if not view=profile, make it so
			{
				if(isset($_GET['hvzid']))	// if ?hvzid=XXXXXXX is set
				{	header('Location: http://'.$_SERVER['SERVER_NAME'].'/profile.php?view=profile&hvzid='.$_GET['hvzid']); exit; }
				else	//if ?hvzid=XXXXXX is NOT set
				{	header('Location: http://'.$_SERVER['SERVER_NAME'].'/profile.php?view=profile&hvzid='.$_COOKIE['hvzid']); exit; }
			}					
			else
			{
				$file = $viewArray[$_REQUEST['view']][0];
				$function = $viewArray[$_REQUEST['view']][1];
			}
	
?>
	<?php htmlheader();	?>
<link rel="stylesheet" href="http://<?php echo $_SERVER['SERVER_NAME'];?>/styles/profile.css" type="text/css" />
<script language="javascript" src="scripts/jquery.simplycountable.js" type="text/javascript"></script> 
<script language="javascript" src="scripts/jquery.autoresize.js" type="text/javascript"></script>
<script language="javascript">
	//Simply countable
	$(document).ready(function(){
		$('#postcontent').simplyCountable({
			counter:            'span#charcnt',
			countable:          'characters',
			wordSeparator:      ' ',
			maxCount:           400,
			strictMax:          false,
			countDirection:     'down'
			/*safeClass:          'safe',
			overClass:          'over',
			thousandSeparator:  ',',
			onOverCount:        function(count, countable, counter){},
			onSafeCount:        function(count, countable, counter){},
			onMaxCount:         function(count, countable, counter){}*/
		});
	});
		
function imposeMaxLength(Object)
{	return (Object.value.length <= 405);	}



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
		var msgdata = "fromhvzid=<?php echo $_COOKIE['hvzid'];?>&tohvzid=<?php echo $hvzid; ?>&subject=" + msgsub + "&msgtext=" + msgtext;
		
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

	// Comment Deletion

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
			url: "ajax/profileimgcomment.php?action=newpost",
			data: dataString,
			success:function(){
				$(".postsubmit").hide();	//hide loading circle
				$(".formtext").removeAttr("disabled");	//enable text fields
				$("#postcontent").val("");	//clear box
				$("div#commenter").slideUp(500).delay(1000);
				$("div#checkfornew").slideDown(100);

			}
		});
		return false;
	}
}
//get new posts
function getnewcomments()
{
	window.location.reload(true);
}
//delete pic comment
function delimgcomment(postid)
{
	$.ajax({
		type: "POST",
		url: "ajax/profileimgcomment.php?action=deletepost",
		data: "post=" + postid,
		success:function(){
				$("div#imgcomment" + postid).slideUp(500);
			}
		});

}
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
		

	$(document).ready(function(){
		$("a#postnew").live('click', function(){
			$("div#commenterbody").slideDown(1000);
			$("div#commenterhead").html('<a href="javascript://" id="hidepostnew">Hide Comment Box</a>');
		});
		$("a#hidepostnew").live('click', function(){
			$("div#commenterbody").slideUp(1000);
			$("div#commenterhead").html('<a href="javascript://" id="postnew">Post a new comment</a>');
		});
	});

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
	/*** About me edit script ***/
	function aboutmechg()
	{
		$("#aboutme").load("ajax/aboutmechg.php?action=retrieve #fillin");
	
	}
	function sendaboutme(aboutmetxt)
	{	
		$(".abtmeload").show();
		$("#aboutmetext").attr("disabled", "true");
		$.ajax({
				type: 'post',
				url: 'ajax/setprofile.php?action=aboutme',
				data: 'data='+ aboutmetxt,
				success: function(){
					$("#aboutme").load("ajax/aboutmechg.php?action=get #fillin");
					$(".abtmeload").hide();
				}
			});
	}
	$(document).ready(function(){
		$("#profile_whatcanipost").click(function(){
			$("div#popupframe").fadeIn(1000);
			$("div#popupframebody").load('ajax/whatcanipost.php #profile');	
		});
	});
	$(document).ready(function(){
		$("#sendmsg").click(function(){
			$("div#popupframe").fadeIn(1000);
			$("div#popupframebody").load("apps/ajax_sndmsg.php?action=template&tohvzid=" + getUrlVars()['hvzid'] +" #popupframebody");
		});
	});
	$(document).ready(function(){
		$("textarea#aboutmetext").autoResize({
			onResize: function(){	//on resize
				$(this).css({opacity: .8});
			},
			animateDuration: 50,
			extraSpace: 40
		});

	});
	
	function closepopupframe()
	{
		$("div#popupframe").fadeOut(500);
		$("div#popupframe").html('<div id="popupframehead"><a href="javascript://" id="closepopupframe" title="Close">X</a></div><div id="popupframebody"><h2>Loading...</h2><center><img src="images/icons/redloader.gif" title="Loading..." alt="Loading..." /></center><br /><br /></div><div id="popupframefooter"></div>');
	}
	
	function sendmsg()
	{
		var tohvzid = $("#tohvzid").val();
		var subject = $("#msgsubject").val();
		var message = $("#textbox").val();
		var dataString = 'tohvzid=' + tohvzid + '&s=' + subject + '&msg=' + message;
		$(".sendmsgload").show();
		$.ajax({
			type: "GET",
			url: "apps/ajax_sndmsg.php?action=sendmessage",
			data: dataString,
			success:function(){
				$("div#popupframe").load("ajax/sendmsg.php?action=sendmessage #popupframebody").delay(1500);
				$("div#popupframe").fadeOut(1000);
			}
		});
	}
	function makeprofilepic(pid)
	{
		$.ajax({
			type: "POST",
			url: "profile.php?view=makeprofilepic&hvzid="+getUrlVars()['hvzid'],
			data: "pic=" + pid,
			success:function(){
					$("#popupframe").fadeIn(1000);
					$("#popupframebody").html("<center><h2>Your profile picture has been changed</h2></center>");
				}
			});
	
	}
	$(document).ready(function(){
		$(".status").click(function(){
			});
	});
//-->
</script>


<?php visheader(); ?>

   <div id="talk">	<!-- if the computer has anything important for the player, it goes here-->
   	<?php 
   			if(isset($_REQUEST['talk']))
			{
				$talk = $_REQUEST['talk'];
				
				echo $talk.PHP_EOL;
				echo "<hr size=\"1px\" width=\"80%\" />".PHP_EOL;
			} 
		?>
     </div>	<!--end talk-->
     <div id="content"> 
     <?php
	 		include_once('php/'.$file.'.php');
			$function();	/*close connection*/
	 ?>    
 </div><!--end content-->
<br class="clearfloat" />
  <?php include('php/footer.php'); ?>

 <br class="clearfloat" />


</div> <!--end frame--> 
<br /><br /><br /><br /> 
</body> 
</html> 
<?php mysqli_close($cxn); ?>
