<?php //basic page stuff
	define('hvz', 1);	//prevent hacking to sub pages
	session_start();

	if(function_exists('ini_set'))//disable session id in url
	{
	   //Use cookies to store the session ID on the client side
	   @ini_set ('session.use_only_cookies', 1);
	   //Disable transparent Session ID support
	   @ini_set ('session.use_trans_sid',    0);
	}	
	
	//header time!
	header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	header ('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
	header ('Cache-Control: no-cache, must-revalidate'); // HTTP/1.1
	header ('Pragma: no-cache'); // HTTP/1.0

	/*****Header Stuff*****/
	global $title;
		$title = "";
		include('php/header.php');
		
	/****MySQL Login***/
	include('php/settings.php');
		global $cxn;
		$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
		
	
	$action = $_REQUEST['action'];
	
	$actionArray = array(     //'$action=' array variables  'action name' => array('File function is in..', 'Function name')
			'postnewcomment' => array('indexcomments', 'postnew'),
			'deletecomment' => array('indexcomments', 'deletecomment')
			);
	
	if (!isset($_REQUEST['action']) || !isset($actionArray[$_REQUEST['action']]))
	{
		//do nothing	
	}
	else
	{
		$file = $actionArray[$_REQUEST['action']][0];
		$function = $actionArray[$_REQUEST['action']][1];
		include_once('apps/'.$file.'.php');
		$function();
	}
	
	htmlheader();


?>
<link rel="stylesheet" href="styles/index.css" type="text/css" /> 
 
<script language="javascript" type="text/javascript"> 
<!--
		var browserType;
 
		if (document.layers) {browserType = "nn4"}
		if (document.all) {browserType = "ie"}
		if (window.navigator.userAgent.toLowerCase().match("gecko")) { browserType= "gecko"	}
 
		function hide() {
		  if (browserType == "gecko" )
			 document.poppedLayer =
				 eval('document.getElementById("submitnews")');
		  else if (browserType == "ie")
			 document.poppedLayer =
				eval('document.getElementById("submitnews")');
		  else
			 document.poppedLayer =
				eval('document.layers["submitnews"]');
		  document.poppedLayer.style.display = "none";
		}
		
		function show() {
		  if (browserType == "gecko" )
			 document.poppedLayer =
				 eval('document.getElementById("submitnews")');
		  else if (browserType == "ie")
			 document.poppedLayer =
				eval('document.getElementById("submitnews")');
		  else
			 document.poppedLayer =
				 eval('document.layers["submitnews"]');
		  document.poppedLayer.style.display = "inline";
		}
-->
</script> 
<script language="javascript" type="text/javascript"> 
<!--	//comment insertion
		var browserType;
 
		if (document.layers) {browserType = "nn4"}
		if (document.all) {browserType = "ie"}
		if (window.navigator.userAgent.toLowerCase().match("gecko")) { browserType= "gecko"	}
 
		function hidecomments() {
		  if (browserType == "gecko" )
			 document.poppedLayer =
				 eval('document.getElementById("submitcomment")');
		  else if (browserType == "ie")
			 document.poppedLayer =
				eval('document.getElementById("submitcomment")');
		  else
			 document.poppedLayer =
				eval('document.layers["submitcomment"]');
		  document.poppedLayer.style.display = "none";
		}
		
		function showcomments() {
		  if (browserType == "gecko" )
			 document.poppedLayer =
				 eval('document.getElementById("submitcomment")');
		  else if (browserType == "ie")
			 document.poppedLayer =
				eval('document.getElementById("submitcomment")');
		  else
			 document.poppedLayer =
				 eval('document.layers["submitcomment"]');
		  document.poppedLayer.style.display = "inline";
		}
-->
</script> 


<?php visheader(); ?>
   
   <div id="content"> 
   
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
      
 
 
<form id="refform" action="?action=submitrefform" enctype="application/x-www-form-urlencoded">
First Name: <input name="firstname" type="text" size="20" maxlength="20" /><br />
Last Name: <input name="lastname" type="text" size="20" maxlength="20" /><br />
Year in School: <select name="schoolyear">
		<option value="Freshman">Freshman</option>
        <option value="Sophomore">Sophomore</option>
        <option value="Junior">Junior</option>
        <option value="Senior">Senior</option>
        <option value="Grad Student">Grad Student</option>
</select>
<br />
Phone Number: <input name="phone" size="10" maxlength="10" /><br />
Email Address: <input name="email" size="20" maxlength="50" /><br />
Why you want to work with Humans vs Zombies at FSU:<br />
<textarea cols="75" rows="10"></textarea>
<br />
Time Available: <input name="timeavail" size="3" maxlength="2" />hours a week.
<br /><br />
<input name="contactunderstand" type="checkbox" value="contactunderstand">I understand I will be contacted if I am chosen to referee.

<input type="submit">
</form>
     
     
     
     <br class="clearfloat" />
     <br /><br /><br /><br /><br /><br /><br /><br />
 </div><!--end content-->
	
  <?php include('php/footer.php'); ?>

<br class="clearfloat" />

</div> <!--end frame-->
<br />
<br /><br /><br /><br />
</body>
</html>

<?php mysqli_close($cxn);?>
