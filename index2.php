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
<script language="javascript" type="text/javascript">
<!--//Body Onload statements

/*Population Retrieval*/
	$(document).ready(function(){
		$.ajax({ 
				type: "GET",
				url: "apps/ajax_populations.php",
				dataType: "xml",
				success: parsepopXml
		});
	});

//-->
</script>
<script language="javascript" type="text/javascript">
<!--//

	$(document).ready(function(){
	  $("a#commentlogin").click(function(){
		$("#submitcomment").fadeIn(1500);
	  });

	});

	$(document).ready(function(){
		$("#whatcanipost").click(function(){
			$("div#popupframe").fadeIn(100);
			$("div#popupframebody").load("ajax/whatcanipost.php #indexcomments");
		});
	});

	function deletecomment(cid)
	{
		$("span#delete"+cid).html('<img src="images/icons/redloader.gif" title="deleting" />');
		$.ajax({
			type: 'POST',
			url: 'ajax/indexcomment_delete.php',
			data:'id=' + cid,
			success: function(){
				$("#comment"+cid).slideUp(500);
			}
		});
	}
//-->
</script>
<script language="javascript">
<!--//Population Retrieval
	$(document).ready(function(){
		$("#updatepop").click(function(){
			$(".loading").show();
			$.ajax({ 
				type: "GET",
				url: "apps/ajax_populations.php",
				dataType: "xml",
				success:parsepopXml
			});
		});
	});
	
	function parsepopXml(xml)
	{
		$(xml).find("population").each(function()
		{
		  $("#human").html($(this).find("human").text());
		  $("#zombie").html($(this).find("zombie").text());
		  $("#total").html($(this).find("total").text());
		  $("#date").html($(this).find("indexdate").text());
		});
		$(".loading").hide();
	}
	
	$(document).ready(function(){
		if(getUrlVars()['talk'] == 'thankyou')
		{
			$("div#popupframe").fadeIn(1500);
			$("div#popupframebody").load("ajax/thankyou.html #popupframebody");
		}
	});
-->
</script>

<style type="text/css">
	#updatedblogs{
		float:left;
		clear:left;
		margin-top:10px;
		padding-right:10px;
		padding-left:10px;
		width:33%;
	}
	#newposts{
		padding-top: 7px;
		padding-bottom: 7px;
		margin: 3px;
		border: 1px solid #990000;
		display: block;
		text-align:center;
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
      
 
 
 <div id="currentinfo"> 
 	 
 	<h3>Welcome to HvZatFSU.com!</h3>                      
                       <p> To those of you who are new to our site, Welcome! This website was built to help make our game on campus run smoother. When you register on the site you will be given an HvZID that must be carried with you throughout the game. If you are tagged, give this to the zombie to put into the system to swap you over to the zombie side of the site. The full rules are posted on the rules page, and if you have any questions, don't hesistate to ask on the forums. Welcome to the game!</p>
                       <p>For those of you familiar with the site, You will see that we have once again made many changes and upgrades. You can now edit your profile much more, upload pictures, message people personally and comment on other people's profiles. This new system will hopefully help the game run smoother by allowing easier communication amongst players, as well as allowing a common ground for both teams to see. However, YOU DO NEED TO RE-REGISTER.  </p>
                       <p>In the latest round of updates, we made the posting of comments a bit smoother, and smoothed out many of the forum bugs. But even with all the work that has gone into this site, we know that it is not perfect. We did run a beta test of the site with a small group of players, but we do know that we will see more bugs as more people start using it. If you do see a problem, let us know on the "feedback" page. </p>
                       
                       <p> Thank you for your patience.</p>
                       <p>So <a href="reglogin.php" class="helplinks">Log In</a> or <a href="reglogin.php?action=regdisp" class="helplinks">Register</a> and start exploring the new site.</p>                       
                       
 
 </div> <!--end current info--> 
 <div id="currentpop">
 <?php global $txt;
 		include('php/report.php');
		population();	
		$tot = $txt['humanpop'] + $txt['zombiepop'];
        $txt['humanpop'] = "Zero";
		$txt['zombiepop'] = "All Infected";
		$date = date('M d, Y \a\t h:i:s a', time());
		?>
   <table id="poptable" width="100%" border="0" >
          <tr>
            <td colspan="2"><span class="currentpop">Current Populations:</span><span class="loading" style="display:none; padding-left:5px;"><img src="images/icons/redloader.gif" /></span></td>
          </tr>
          <tr>
            <td width="14%"><center><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/human.png" width="13" height="20" align="middle" /></center></td>
            <td><span class="currentpop">Humans:&nbsp;</span><span class="currentpopnum" id="human">Loading...</span></td>
          </tr>
          <tr>
            <td><center><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/zombie.png" align="middle" /></center></td>
            <td><span class="currentpop">Zombies:&nbsp;</span><span class="currentpopnum" id="zombie">Loading...</span></td>
          </tr>
          <tr>
            <td><center><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/humanandzombie.png" align="middle" /></center></td>
            <td><span class="currentpop">Total Population:&nbsp;</span><span class="currentpopnum" id="total">Loading...</span></td>
          </tr>
          <tr>
            <td colspan="2"><span class="currentpop">On:&nbsp;</span><span class="popdate" id="date"><?php echo date('M d, Y \a\t h:i:s a', time());?></span></td>
          </tr>
          <tr>
          	<td colspan="2"><font size="-3"><a href="javascript://" class="helplinks" id="updatepop">Update Population</a></font></td>
          </tr>
        </table>
        <br /><br /><br /><br /><br />
 </div>
 
 <div style="clear:right;"></div>
 <div id="fblike" style="float:right; margin-top:15px; border: 1px solid #CCCCCC; border-radius: 5px; -moz-border-radius:5px; padding: 4px;">
<iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2Fpages%2FHvZ-at-FSU%2F164421720285889&amp;send=true&amp;layout=standard&amp;width=275&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:275; height:80px;" allowTransparency="true"></iframe>    
 </div>
 <div id="twitterupdates" style="float:right; margin-top:15px; margin-right: 10%; border: 1px solid #CCCCCC; border-radius: 5px; -moz-border-radius:5px; padding: 4px;">
 	<a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="FSUZombies">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
 </div>

<div class="clearright"></div>

<?php if(isset($_COOKIE['hvzid']))
{	?>
<?php	} //end if  ?>     
     <br class="clearfloat" />
     <div id="comments">
        <div id="commentheader">
			<span class="commenttitle">Comments</span>
			<?php

			
			if(isset($_COOKIE['hvzid']))
			{
				echo "<span id=\"showcomments\">Want to say something? Say it <a href=\"javascript://\"  class=\"commentlogin\" id=\"commentlogin\">here</a>";
			}
			else
			{
				echo "<span id=\"showcomments\">You must be <a href=\"http://hvzatfsu.com/reglogin.php\" class=\"commentlogin\" id=\"commentlogin\">logged in</a> to leave a comment.</span>";
			}
			
			?>
            <br class="clearfloat" />
            </div>
		<div id="submitcomment">
			<form action="#" method="post" enctype="application/x-www-form-urlencoded" id="indexcomment">            
				<div id="submit_head">
					<span id="left">
						What's on your mind, <?php echo $_COOKIE['firstname']." ".$_COOKIE['lastname'];?>?
					</span>
					<span id="right">
						<a href="javascript://" class="helplinks" id="whatcanipost">What can I post?</a>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					</span>
					<div class="clearer"></div>
				</div>
				<div id="submit_body">
					<textarea id="commenttext"></textarea>   
					<br />
					<span style="float: right">
						<span id="loader_commentpost" style="margin-top: 3px; display: none;" ><img src="images/loadingicons/redloader.gif" title="Posting..." /></span>
		 				<input type="button" value="Post" id="submit" style="float:right;" />
					</span>
					<div class="clearer"></div>
				</div>
			</form>
		</div>
        <div id="commentbottom">
        <div id="actualcomments">
       	<?php
			include('php/indexcomments.php');
			displaycomments();
		?>
         </div>
        <!-- <div id="newposttemplate"></div>
         <div id="newposts"><center>Load older Posts <img src="images/icons/redloader.gif" title="Loading" id="loader" style="display:none;" /></center></div>-->

       </div> <!-- end commentbottom -->
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
