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
<style>
#mainContent{
	margin-lefT: .3em;
	margin-right: .3em;
	margin-bottom: .3em;
	border: 1px solid #CCCCCC;
	border-radius: 5px;
	padding: 3px;
}
</style>
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
      
 
 
 <div id="mainContent"> 
 	 
 	<h3>Welcome to HvZatFSU.com!</h3>             
    <center> <iframe src="http://player.vimeo.com/video/36456191?title=0&amp;byline=0&amp;portrait=0" width="600" height="338" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe><p><a href="http://vimeo.com/36456191">HvZ at FSU</a> from <a href="http://vimeo.com/nicholasstaab">Nicholas Staab</a> on <a href="http://vimeo.com">Vimeo</a>.</center>

    <p>Humans vs. Zombies (or HvZ) is a moderated game of tag played on college campuses around the country. As an organization we strive to provide a fun and interactive way for students to socialize and participate in a friendly environment.</p>
    <p>In this game there are two opposing forces, humans and zombies. The humans' focus is on surviving their day to day lives on campus. To aid them, the human players wear a HvZ bandana on their upper arms and use Nerf blasters, dart blow guns, or sock grenades.  With these weapons they will hold onto their survival for as long as possible. On the opposite side are zombies. As a collective horde, or as individual hunters, the zombies' goal remains the same. Tag humans. The zombies wear the HvZ bandana on their heads and tag humans in order to turn the humans into zombie players. </p>
    <p>There are two games per semester (one during the Summer C semester). Each game is 5 days long, lasting from 12:01 AM Monday to ~7PM on Friday.</p>

    <p>Before you begin playing it is recommended that you join <a href="https://www.facebook.com/groups/53924719249/" class="helplinks">FSU's Human vs. Zombies Facebook group</a> in order to receive the invitations to the game
	<p>In order to play, you need to:
    	<ol class="letters">
        	<li><a href="http://<?php echo $_SERVER['SERVER_NAME']; 
?>/reglogin.php?action=regdisp" class="helplinks">Register on this website</a>, please be sure to register only once and remember your login information.</li>
			<li>(optional) Attend an interest meeting and ask any questions you have (or ask them on the <a href="https://www.facebook.com/groups/53924719249/" class="helplinks">Facebook Group</a>).</li>
            <li>Attend the mandatory meeting and pay your game dues and buy a player bandana
            	<ul>
                	<li>Game dues are $3 per dame (to cover the costs of props, additional darts, and other game related items)</li>
                    <li>Bandanas are $4 and oly need to be purchased once, after that you can continue to use them in all games</li>
                </ul>
            </li>
        </ol>
   </p>
   <br /><br />
   
   
   <p>Useful links for beginners: <a href="http://hvzatfsu.com/forums/index.php?action=viewthread&threadid=341&catid=4&page=1" class="helplinks">Terms List</a> | <a href="https://www.facebook.com/groups/53924719249/" class="helplinks">Facebook Group</a> | <a href="http://hvzatfsu.com/" class="helplinks">Official Website</a></p>
 
 </div> <!--end current info--> 

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
