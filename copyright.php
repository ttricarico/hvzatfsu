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
		$title = ":: Copyright";
		include('php/header.php');
		
	/****MySQL Login***/
	include('php/settings.php');
		global $cxn;
		$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
	
	htmlheader();


?>
<style type="text/css">
<!--
	body{
		font-size: 10pt;
	}

-->
</style>
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
   	    </div>	<!--end talk--> http://creativecommons.org/licenses/by-nc-nd/3.0/us/
<p>All of the work on hvzatfsu.com (the website) is copyrighted by the organization Humans vs. Zombies at Florida State University (HvZatFSU) or by other parties. Nothing on this website is in the public domain. The name &quot;Humans vs. Zombies&quot; or &quot;HvZ&quot; are licenced to HvZ at FSU to allow the game to be played at The Florida State University.</p>
</p>

<p>The rule set, the images, and anything else placed on the website is copyrighted by HvZ at FSU. The source of the page is copyrighted by Thomas Tricarico, and no part may be used without permission.</p>

<p>Humans vs. Zombies and HvZ are registered trademarks of Gnarwhal Studios. Nerf is a registered trademark of Hasbro, Inc.</p>

<p>No part of this website may be used without express written permission of HvZ at FSU. If you have any questions or comments, please email fsuzombies [at] gmail [dot] com.</p>

<p>The website hvzatfsu.com and its subsidiaries are owned and operated by Thomas Tricarico and the organization HvZatFSU. For more information, including questions or comments, please fill out the form at <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/feedback.php" class="playerinfo">feedback</a> form.</p>

    
  </div> 
  <!--end content--> 
	
  <?php include('php/footer.php'); ?>

<br class="clearfloat" />

</div> <!--end frame-->
<br /><br /><br /><br />
</body>
</html>
<?php mysqli_close($cxn);?>
