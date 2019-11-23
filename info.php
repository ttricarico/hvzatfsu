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
		$title = ":: Game History";
		include('php/header.php');
		
	/****MySQL Login***/
	include('php/settings.php');
		global $cxn;
		$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
	
	htmlheader();


?>
<style type="text/css">
<!--
	p {
		text-indent:60px;
		padding-left: 10px;
		padding-right:10px;
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
   	    </div>	<!--end talk--> 
		A word from our founder: Angel SanMartin - <br />

<br />

	<p>I suppose it all started in late February after a Phi Sigma Pi meeting. My friend Glen Davis mentioned to me a game of tag played at Goucher College involving zombies and Nerf guns. After seeing the website and watching the documentary, it occurred to me that this game would be a perfect fit at FSU. I told Glen I would definitely try to bring Humans vs. Zombies to our campus.</p>
	<p>I contacted Goucher College soon after, and they sent me a care package of three hundred bandannas along with some stickers to advertise - tokens of their support. The first game started a week after Spring Break in April of 2009 with a player base of about eighty and myself as the sole moderator.</p>
	<p>We did not play that summer because too many people went home, leaving us with an insufficient number of players. In the Fall, however, this was not the case. I recruited Nicholas Shy, Cody Neff, and Meagan Happel to assist in moderation of Fall semester games. The first Fall '09 game was a game mostly centered around advertisement to freshman, and it was a true success, doubling our player base to include one hundred and sixty people. That was when people began to notice HvZ. All of a sudden there were interviews, spots on local news channels, and even a film school project centered around our game. The second game garnered even more support, with three hundred and twenty players as well as three new moderators: Idan Zaitsev, Quinton Brown, and Erin Lightning. The game has since continued growing and developing, providing entertainment and camaraderie for countless students that would otherwise never have met. Through all of its incarnations, that is what Humans vs. Zombies will always be about.</p>

    <br/> <br/> <br/> <br/> <br/>
  </div> 
  <!--end content--> 
	
  <?php include('includes/php/footer.php'); ?>

<br class="clearfloat" />

</div> <!--end frame-->
<br /><br /><br /><br />
</body>
</html>
<?php mysqli_close($cxn);?>