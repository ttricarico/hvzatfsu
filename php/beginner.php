<?php //basic page stuff
	
	$_COOKIE['school_short'] = 'FSU';
	
	define('hvz', 1);	//prevent hacking to sub pages
	session_start();

	if(function_exists('ini_set'))//disable session id in url
	{
	   //Use cookies to store the session ID on the client side
	   @ini_set ('session.use_only_cookies', 1);
	   //Enable transparent Session ID support
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
		
	//record keeping
/*		include('php/records.php')
		recordkeeping();*/
	
	htmlheader();

?>

<script language="javascript" type="text/javascript" src="scripts/index.js"></script>
<script language="javascript" type="text/javascript" src="scripts/comments.js"></script>
<script language="javascript" type="text/javascript" src="scripts/jquery.qtip.min.js"></script>


<?php visheader(); ?>
<noscript>
	You must have Javascript enabled to use this page. Don't know how to enable it? <a href="http://<?php echo $_SERVER['SERVER_NAME']; 
?>/help.php#jshelp">click here.</a>
</noscript>
<div id="content"> 
   
   
   <div id="talk">	<!-- if the computer has anything important for the player, it goes here--> 
      	<?php 
   			if(isset($_REQUEST['talk']) && $_REQUEST['talk'] != 'thankyou')
			{
				$talk = $_REQUEST['talk'];
				
				echo $talk.PHP_EOL;
				echo "<hr size=\"1px\" width=\"80%\" />".PHP_EOL;
			} 
		?>
  	     </div>	<!--end talk--> 
      
 
 
 <div id="content"> 
 	 
 	<h3>Welcome to HvZatFSU.com!</h3>             
    <!-- embed video -->
    <p>Humans vs. Zombies is a moderated game of tag played on college campuses around the country. As an organization we strive to provide a fun and interactive way for students to socialize and participate in a friendly envieronment.</p>
    <p>In this game there are two opposing forces, humans and zombies., The humans' focus is on surviving their day to day lives on campus, whether it be trying to fight their way to classrooms or breaking out of a dining hall besieged by their undead conterparts. To aid them ithe human players wear a fashionable HvZ bandana on their ypper arms and wield Nerf&regl blasters, dart blow guns, or sock grenades. With these weapons, they will hold onto their survival for as long as possible.</p>
    <p>On the opposite side ar zombies. As a collective horde, or as individual hunters, the zombies' goal remains the same. Eat humans. The zombies wear the HvZ bandana on their heads and tag humans in order to turn the humans into zombie players. The game week begins with a few starter zombies, but by the end of the week a horde will have amassed and the human's humbers will be dwindling. Until the last human player is tagged, the zombie horde will continue.</p>
    <p>There are two games per semester (one during the Summer C semester). Each game is 5 days long, lasting from Monday at midnight to ~7PM Friday.</p>
    <p>Before you begin playing it is recommended that you join <a href="https://www.facebook.com/groups/53924719249/" class="helplinks">FSU's Human vs. Zombies Facebook group</a> in forder to receive the invitations to game events (mandatory meetings and game weeks).
	<p>In order to play, you need to:
    	<ol class="letters">
        	<li><a href="http://<?php echo $_SERVER['SERVER_NAME']; 
?>/reglogin.php?action=regdisp" class="helplinks">Register on this website</li>, please be sure to register only once and remember your login information.</li>
			<li>(optional) Attend an interest meeting and ask any questions you have (or ask them oon the <a href="https://www.facebook.com/groups/53924719249/" class="helplinks">Facebook Group</a>).</li>
            <li>Attend the mandatory meeting and pay your game dues and buy a player bandana
            	<ul>
                	<li>Game dues are $3 per dame (to cover the costs of props, additional darts, and other game related items)</li>
                    <li>Bandanas are $4 and oly need to be purchased once, after that you can continue to use them in all games</li>
                </ul>
            </li>
        </ol>
   </p>
   <!--
   <p>Useful links for beginners: <a href="ter
	
    -->
 
 </div> <!--end current info--> 

 <div style="clear:right;"></div>
 <div id="fblike" style="float:right; margin-top:15px; border: 1px solid #CCCCCC; border-radius: 5px; -moz-border-radius:5px; padding: 4px;">
<iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2Fpages%2FHvZ-at-FSU%2F164421720285889&amp;send=true&amp;layout=standard&amp;width=275&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:275; height:80px;" allowTransparency="true"></iframe>    
 </div>
 <div id="twitterupdates" style="float:right; margin-top:15px; margin-right: 10%; border: 1px solid #CCCCCC; border-radius: 5px; -moz-border-radius:5px; padding: 4px;">
 	<a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="FSUZombies">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
 </div>

<div class="clearright"></div>

<br class="clearfloat" />
        <?php include "php/footer.php" ?>
     


 
 </div><!--end content-->

<br /><br /><br />
</div><!--end frame-->


<br /><br /><br />
  

<div style="float:right;">
<font style="font:Tahoma; color:#FFFFFF; font-size:10pt;">
<?php	//hit counter
	$count_my_page = ("hitcounter.txt");
	$hits = file($count_my_page);
	$hits[0] ++;
	$fp = fopen($count_my_page , "w");
	fputs($fp , "$hits[0]");
	fclose($fp);
	echo "Number of hits: ".$hits[0];
?>
</font>
</div>

</body>
</html>

<?php mysqli_close($cxn);?>
