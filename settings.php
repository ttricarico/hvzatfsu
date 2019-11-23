<?php //basic page stuff
	define('hvz', 1);	//prevent hacking to sub pages

	if(function_exists('ini_set'))//disable session id in url
	{
	   //Use cookies to store the session ID on the client side
	   @ini_set ('session.use_only_cookies', 1);
	   //Enable transparent Session ID support
	   @ini_set ('session.use_trans_sid',    0);
	}	
	session_start();
	
	if(!isset($_COOKIE['hvzid']))
	{
		header('Location: http://'.$_SERVER['SERVER_NAME'].'/reglogin.php');
		exit;
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
		
	//record keeping
/*		include('php/records.php')
		recordkeeping();*/

	
	$actionArray = array(     //'$action=' array variables  'action name' => array('File function is in..', 'Function name')
			'account' => array('updatesettings', 'account'),
			'gameoptions' => array('updatesettings', 'gameoptions'),
			'privacy' => array('updatesettings', 'privacy'),
			'profile' => array('updatesettings', 'account'),
			);
	
	if (!isset($_REQUEST['s']) || !isset($actionArray[$_REQUEST['s']]))
	{
		//do nothing	
	}
	else
	{
		$file = $actionArray[$_REQUEST['s']][0];
		$function = $actionArray[$_REQUEST['s']][1];
		include_once('apps/'.$file.'.php');
		$function();
	}
	
	$query = "SELECT * FROM members WHERE hvzid='".$_COOKIE['hvzid']."'";
	$result = mysqli_query($cxn, $query);
	$playerinfo = mysqli_fetch_array($result);
	
	htmlheader();

?>
<script type="text/javascript" src="scripts/settings.js"></script>
<script type="text/javascript" src="http://blog.hvzatfsu.com/scripts/search.js"></script>
<script language="javascript">
<!--//
	$(function(){
		$("#tabs").tabs();
	});
//-->
</script>
<script language="javascript">
<!--//
	var varemail = "<?php echo $playerinfo['email']; ?>";
	var varphone = "<?php echo $playerinfo['phone']; ?>";
	var varemail = "<?php echo $playerinfo['email']; ?>";

//-->
</script>

<link rel="stylesheet" type="text/css" href="styles/jquery-ui-1.8.9.custom.css"/>

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
		<!-- Tabs -->

		<h2 class="demoHeaders">User Settings</h2>

		<div id="tabs">

			<ul>
				<li><a href="#tabs-1">Account</a></li>
				<li><a href="#tabs-2">Privacy</a></li>
                <li><a href="#tabs-3">Game Options</a></li>
                <li><a href="#tabs-4">Edit Profile</a></li>
			</ul>
			<div id="tabs-1">
            	<h2>Click values to change.</h2><!--?s=account-->
            	<form name="accountsettings" action="#" method="post">
                	<label for="name">Name:</label><input name="name" type="text" value="<?php echo $playerinfo['firstname']." ".$playerinfo['lastname']; ?>" readonly="readonly" /><br/><br/>
                	<label for="hvzid">HvZID-Ext:</label><input name="hvzid" type="text" value="<?php echo $playerinfo['hvzid']."-".$playerinfo['hvzidext']; ?>" readonly="readonly" /><br/><br/>
                    <label for="email">Email Address:</label><input name="email" id="email" type="text" value="<?php echo $playerinfo['email']; ?>" /><br/><br/>
                    <label for="phonenum">Phone Number:</label><input name="phonenum" id="phonenum" type="text" value="<?php echo $playerinfo['phone']; ?>" /><br/><br/>
                    <label for="password">Password:<input name="password" type="text" id="password" value="******" /></label><br/><br/>
                    <label for="password">Retype Password:<input name="password" type="text" id="password" value="******" /></label><br /><br />
                    <label for="location">Location:</label><select name="location"><option value="fsu" selected="selected">Florida State University</option></select><br/><br/>
                    <!--<label for="deactivate">Deactivate Account:</label><a href="javascript://" onclick="deleteconfirm()"><input name="deactivate" type="button" /></a>--><br/><br/><br/><br/>
                    
                    <br/><br/>
                    
                    <input type="submit" id="accountsubmit" value="Update Settings">

                    
                </form>
            </div>
			<div id="tabs-2">
            	<form action="?s=privacy" name="privacysettings" id="accountsettings" method="post">
                	<label for="showphone">Show Phone Number in Profile<input name="showphone" type="checkbox" value="" <?php if($playerinfo['hidephone'] == 0) {echo "checked=\"checked\" ";}?>></label><br />
                    <label for="showprofile">Show Email Address in Profile<input name="showprofile" type="checkbox" value="" <?php if($playerinfo['hideemail'] == 0) {echo "checked=\"checked\" ";}?>></label><br /> 
                    <label for="showyimsn">Show Yahoo!<input name="showyimsn" type="checkbox" value="" <?php if($playerinfo['showyimsn'] == 1) {echo "checked=\"checked\" ";}?>></label> <br />
                    <label for="showaim">Show AIM<input name="showaim" type="checkbox" value="" <?php if($playerinfo['showaim'] == 1) {echo "checked=\"checked\" ";}?>></label> <br />
                    <label for="showmsn">Show MSN<input name="showmsn" type="checkbox" value="" <?php if($playerinfo['showmsn'] == 1) {echo "checked=\"checked\" ";}?>></label> <br />
                    <label for="showskype">Show Skype<input name="showskype" type="checkbox" value="" <?php if($playerinfo['showskype'] == 1) {echo "checked=\"checked\" ";}?>></label> <br />
                    <br /><input type="submit" value="Update Settings">

                </form>
                <br/><br/><br/><br/><br/><br/><br/><br/><br/><br /><br /><br /><br /><br /><br /><br /><br /><br />
            </div>
  			<div id="tabs-3">
            	<form action="?s=gameoptions" name="gameoptions" id="gameoptions" method="post">
                	<label for="ozpool">I want to be in the OZ pool<input name="ozpool" type="checkbox" value="1" <?php if($playerinfo['ozchoice'] == 1) {echo "checked=\"checked\" ";}?>/></label><br />
                    <input type="hidden" value="<?php echo $_COOKIE['hvzid'];?>" name="hvzid" />
                    <input type="submit" value="Update Settings">
                <br/><br/><br/><br/><br/><br/><br/><br/><br/><br /><br /><br /><br /><br /><br /><br /><br />
                </form>
            </div>
            <div id="tabs-4">
           		<a href="profile.php">Back to Profile</a>
                <form action="http://<?php echo $_SERVER['SERVER_NAME'];?>/uploads/images/index.php?action=post" name="profileoptions" id="profileoptions" method="post" enctype="multipart/form-data">
                    New Profile Picture: <input name="picture" id="picture" type="file" /><br /><br /><br /><br />
                    <input type="hidden" id="location" name="location" value="settings.php" />
                    Your Current Profile Picture:<br />
                    <img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/uploads/images/index.php?action=profile&img=<?php echo $playerinfo['hvzid']; ?>&h=150&w=150" align="middle" />
                    <br />
                    <input type="submit" value="Update Profile Information" />
                </form>
            </div>
            
		</div>

	<br class="clearfloat">
	</div><!--end content-->
    
   <?php include('php/footer.php'); ?>
</body>
</html>
