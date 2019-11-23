<?php	define('hvz', 1);
	date_default_timezone_set('America/New_York');	
	if(!isset($_COOKIE['hvzid']))	//if not logged in, kick back to login screen
	{	header('Location: http://'.$_SERVER['SERVER_NAME'].'/reglogin.php?talk=You must be logged in to view notifications'); exit; }
	
		/** Disable Session ID in URL **/
	//Use cookies to store the session ID on the client side
	@ini_set ('session.use_only_cookies', 1);
	//Enable transparent Session ID support
	@ini_set ('session.use_trans_sid',    1);
	session_start();
	
	//header time!	Prevent catching, etc
	header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	header ('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
	header ('Cache-Control: no-cache, must-revalidate'); // HTTP/1.1
	header ('Pragma: no-cache'); // HTTP/1.0


	/*****Header Stuff*****/
	include('php/header.php');
	if($_REQUEST['view'] == 'messages')
	{	$title = " :: Messages";	}
	else
	{	$title = " :: Notifications";	}
	
	/****MySQL Login***/
	include('php/settings.php');
		global $cxn;
		$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
	require('php/security.php');

	if($_REQUEST['view'] == 'rss')
	{
		include('php/notifmessages.php');
		viewrss();
		mysqli_close($cxn);
		exit;
	}
	$viewArray = array(     //'$action=' array variables  'action name' => array('File function is in..', 'Function name')
				'messages' => array('notifmessages', 'viewmessages'),
				'notifications' => array('notifmessages', 'viewnotifications'),
				'notifviewed' => array('notifmessages', 'notifviewed'),
				'indivmsg' => array('notifmessages', 'viewindivmessage'),
				
			);
			
			if (!isset($_REQUEST['view']) || !isset($viewArray[$_REQUEST['view']]))	//if not view=profile, make it so
			{
				$file = 'notifmessages';
				$function = 'viewnotifications';
			}					
			else
			{
				$file = $viewArray[$_REQUEST['view']][0];
				$function = $viewArray[$_REQUEST['view']][1];
			}
	

		 htmlheader();	?>


<script language="javascript">
<!--//
	function openpopup(id)
	{
		switch(id)
		{
			case 'sendmsg':
				$("div#popupframe").fadeIn(1000);
				$("div#popupframebody").load("apps/ajax_sndmsg.php?action=viewtemp #popupframebody");
			break;
		}
	}
	$(document).ready(function(){
		$("#closepopupframe").click(function(){
				$("div#popupframe").fadeOut(1000);
				$("#div#popupframebody").html('<h2>Loading...</h2><center><img src="images/icons/redloader.gif" title="Loading..." alt="Loading..."></center>');
		 });
   });

	function deletemessage(msgid)
	{
		$("div#popupframe").fadeIn(1000);
		$("div#popupframebody").load("ajax/confirmdelete.php?msgid="+msgid+" #popupframebody");
	}
	function deletemsg(msgid)	//delete msg from page
	{
	   $.ajax({
			type: 'post',
			url: 'ajax/confirmdelete.php?action=delete',
			data: 'msgid='+msgid,		
			success: function(){
					$("div#msg" + msgid).slideUp(500);
				}
		});
	}
	
	function deletesentmsg(msgid)
	{
		$.ajax({
			type: 'post',
			url: 'ajax/confirmdelete.php?action=deletesent',
			data: 'msgid='+msgid,		
			success: function(){
					$("div#msg" + msgid).slideUp(500);
				}
		});
	}
	
	function confirmdelete(msgid)
	{
		$(".loading").show();
		$("#popupbtn").attr("disabled", "true");
		$.ajax({
			type: 'post',
			url: 'ajax/confirmdelete.php?action=delete',
			data: 'msgid='+msgid,		
			success: function(){
					$("div#popupframebody").load("ajax/confirmdelete.php #deleted");	
					$("#popupbtn").removeAttr("disabled");			
			}
		});
	}
	
	function replytomsg(msgid)
	{
		$("div#popupframe").fadeIn(1000);
		$("div#popupframebody").load("ajax/replytomsg.php?msgid="+msgid+" #popupframebody");
	}
	
	function sendmsg()
	{
		var subject = $("#msgsubject").val();
		var msgtext = $("#textbox").val();
		var tohvzid = $("#tohvzid").val();
		
		$(".loading").show();
		$(".msgtext").attr("disabled", "true");
		$(".btn").attr("disabled", "true");

		$.ajax({
			type: 'post',
			url: 'ajax/replytomsg.php?action=sendmsg',
			data: 'subject='+subject+'&msgtext='+msgtext+'&tohvzid='+tohvzid,		
			success: function(){
					$("div#popupframebody").load("ajax/replytomsg.php #messagesent");	
					$(".btn").removeAttr("disabled");
					$(".msgtext").RemoveAttr("disabled");			
			}
		});
	}
	function showsent()
	{
		$("#viewmessages").html('<br /><br /><br /><br /><br /><br /><center><img src="images/icons/redloader.gif" /></center><br /><br /><br /><br /><br /><br /><br /><br />');
		$("div#viewmessages").load("ajax/getmsgs.php?type=sent #output");
	}
	function showreceived()
	{
		$("#viewmessages").html('<br /><br /><br /><br /><br /><br /><center><img src="images/icons/redloader.gif" /></center><br /><br /><br /><br /><br /><br /><br /><br />');
		$("div#viewmessages").load("ajax/getmsgs.php?type=received #output");
	}

//-->
</script>
<link rel="stylesheet" href="http://<?php echo $_SERVER['SERVER_NAME'];?>/styles/notifications.css" type="text/css" />
<link rel="stylesheet" href="http://<?php echo $_SERVER['SERVER_NAME'];?>/styles/messages.css" type="text/css" />
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
			$function();	
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