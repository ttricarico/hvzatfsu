<?php //basic page stuff
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
		include_once('php/'.$file.'.php');
		$function();
	}
	
	htmlheader();

?>


<script type="text/javascript" src="http://blog.hvzatfsu.com/scripts/search.js"></script>




<?php visheader(); ?>
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
      
 
 
    	
    <?php 
		include('php/security.php');
		$search = explode(' ', $_GET['q']);
		if(!isset($_GET['q']))
		{
			echo "<div id=\"noresults\">
        	You did not search for anything. Please fill in the search field and try again.
            <form action=\"?\" method=\"get\">
            	<input type=\"text\" id=\"search\" name=\"q\" style=\"width:200px;\"  />
            </form>
        </div><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";
		}
		if(isset($_GET['q']))
		{
			if(!isset($search[1]))
			{
				$query = "SELECT firstname, lastname, hvzid FROM members WHERE firstname LIKE '%".sanitize($search['0'])."%' OR lastname LIKE '%".sanitize($search['0'])."%' OR hvzid LIKE '%".sanitize($search['0'])."%' LIMIT 0, 30";
			}
			else
			{
				$query = "SELECT firstname, lastname, hvzid FROM members WHERE firstname LIKE '%".sanitize($search['0'])."%' OR firstname LIKE '%".sanitize($search['1'])."%' OR lastname LIKE '%".sanitize($search['1'])."%' OR lastname LIKE '%".sanitize($search['0'])."%' OR hvzid LIKE '%".sanitize($search['0'])."%' LIMIT 0, 30";
			}
			
			$result = mysqli_query($cxn, $query);
			if(mysqli_num_rows($result) == 0)
			{
				echo "<div id=\"noresults\">
        	Your search returned no results. Please fill in the search field and try again. This time, use a more general query.<br /><br />
            <form action=\"?\" method=\"get\">
            	<input type=\"text\" id=\"search\" name=\"q\" style=\"width:200px;\"  />
            </form>
        </div><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";
			}
			
			while($row = mysqli_fetch_array($result))
			{
				echo "<div class=\"result\">
						<span class=\"resultname\">".$row['firstname']." ".$row['lastname']."</span>
						<span class=\"viewstuff\"><a href=\"http://blog.hvzatfsu.com/viewblog.php?hvzid=".$row['hvzid']."\">View Blog</a> | <a href=\"http://".$_SERVER['SERVER_NAME']."/profile.php?hvzid=".$row['hvzid']."\">View Profile</a></span>";
				echo "</div>";

			}
		}
    
	
	?>
	
    <div id="framefooter"> 
        <?php include('php/footer.php'); ?>
    </div><!--end frame footer--> 
     
 
   </div> <!--end frame-->
 
 </div><!--end content-->

 


<br />
  <br class="clearfloat" />

</body>
</html>

<?php mysqli_close($cxn);?>
