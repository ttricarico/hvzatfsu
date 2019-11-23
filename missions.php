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

	/****MySQL Login***/
	include('php/settings.php');
		global $cxn;
		$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
		
	if(isset($_COOKIE['hvzid']))
	{
		$query = "SELECT human, oz, admin, isplaying FROM members WHERE hvzid='".$_COOKIE['hvzid']."'";
		$result = mysqli_query($cxn, $query);
		$row = mysqli_fetch_array($result);
		if($row['isplaying'] != 1)
		{
			header('Location: http://'.$_SERVER['SERVER_NAME'].'/?talk=You must be playing this game to view the missions');
			exit;
		}
	}
	else
	{
		header('Location: http://'.$_SERVER['SERVER_NAME'].'/?talk=You must be logged in to view missions');
		exit;
	}	
	/*****Header Stuff*****/
	global $title;
		$title = "";
		include('php/header.php');
		
	//record keeping
/*		include('php/records.php')
		recordkeeping();*/
		
	htmlheader();

?>
<link rel="stylesheet" href="styles/index.css" type="text/css" /> 
<link rel="stylesheet" href="styles/basestyle.css" type="text/css" />
<link rel="stylesheet" href="styles/buttons.css" type="text/css" />
<link rel="stylesheet" href="styles/linrks.css" type="text/css" />
<link rel="stylesheet" href="styles/footer.css" type="text/css" />
<link rel="stylesheet" href="styles/index.css" type="text/css" />
<link rel="stylesheet" href="styles/rules.css" type="text/css" />

<script type="text/javascript" src="scripts/jquery.js"></script>
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
      $("#submitcomment").hide();
});
	$(document).ready(function(){
      $("div.whatcanipost").hide();
});

	$(document).ready(function(){
  $("a.commentlogin").click(function(){
    $("#submitcomment").slideToggle(1500);
  });
});

	$(document).ready(function(){
		$("#whatcanipost").click(function(){
			$("div.whatcanipost").fadeIn(100);
		});
	});
	
	$(document).ready(function(){
		$("#hidewhatcanipostdiv").click(function(){
			$("div.whatcanipost").fadeOut(100);
		});
	});


//-->
</script>
<script language="javascript">
<!--//Population Retrieval
	$(document).ready(function(){
		$("#updatepop").click(function(){
			$.ajax({ 
				type: "GET",
				url: "apps/ajax_populations.php",
				dataType: "xml",
				success: parsepopXml
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
	}
-->
</script>


<script language="javascript">
<!--//
	$(window).scroll(function(){
		$("#topbox").animate({top:$(window).scrollTop()+"px" },{queue: false, duration: 0});
	});

//-->
</script>



</head>

<body>

<?php topbar(); ?>



<div id="reportkill2">

<a href="http://new.hvzatfsu.com/reportkill.php"/>
	<img src="images/killbtn.png"/> </a>
  
  
</div>



<div id="frame">
<?php echo"
		<div id=\"header\">
        	<span class=\"headerleft\"><a href=\"http://www.facebook.com/group.php?gid=53924719249\" class=\"header\">FSU HvZ on Facebook</a></span>
            <span class=\"headerright\"><a href=\"#\" class=\"header\">Next Game: Spring 2011</a></span>
         <img src=\"images/banners/banner3_w900xh150.png\" />

  		</div>
		<!--end header-->

 	 <div id=\"navblock\">
        
   	
	
	
	
	<div id=\"playerinfo\">";
		headerinfo();
        echo "
	</div>
	<!-- end player info-->
   	</div>     
    <!-- end navblock-->
   
";
	
	playerinfo(); ?>
    
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
      
    <?php 
		if($_COOKIE['admin'] == true)
		{
			$query = "SELECT human, missiondetails FROM missions WHERE currentgame='1' AND day='".date('N', time())."'";
			$result = mysqli_query($cxn, $query);
		}
		elseif($row['human'] == 1 and $row['oz'] == 0 and $_COOKIE['admin'] == false)
		{
			$query = "SELECT missiondetails FROM missions WHERE human='1' AND currentgame='1' AND day='".date('N', time())."'";
			$result = mysqli_query($cxn, $query);
		}
		elseif($row['human'] == 0 or $row['oz'] == 1 and $_COOKIE['admin'] == false)
		{
			$query = "SELECT missiondetails FROM missions WHERE human='0' AND currentgame='1' AND day='".date('N', time())."'";
			$result = mysqli_query($cxn, $query);
			
		}
		
		while($details = mysqli_fetch_array($result))
		{
			if($details['human'] == 1)
			{	$species = 'Human Mission:';	}
			if($details['human'] == 0)
			{	$species = 'Zombie Mission:';	}
			echo $species."<br />".$details['missiondetails'];
		}
		
		if($_COOKIE['admin'] == 1)
		{
			echo "<div id=\"missioncreate\">
        <form action=\"apps/missionadd.php\" method=\"post\">
            <label for=\"day\">Day the mission will take place: (ex: 5 for friday)</label><input type=\"text\" name=\"day\" size=\"3\" maxlength=\"2\" /><br />
            <label><input type=\"radio\" name=\"species\" value=\"human\" >Human</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <label><input type=\"radio\" name=\"species\" value=\"zombie\">Zombie</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <label for=\"currentgame\">For the current game?<input type=\"checkbox\" name=\"currentgame\" value=\"1\"></label><br />
        	<textarea name=\"missiondetails\" style=\"width:85%; height:50px; font-family:Verdana, Geneva, sans-serif; font-size:12px; border:1px solid #CCCCCC\"></textarea>
			<input type=\"hidden\" name=\"hvzid\" value=\"".$_COOKIE['hvzid']."\">
            <input type=\"submit\" value=\"Submit Mission\" />
        </form>
        </div>
        <div id=\"oldmissions\">";
			echo "Old Missions";
        	$query = "SELECT * FROM missions WHERE 1";
			$result = mysqli_query($cxn, $query);
			
			while($oldmissions = mysqli_fetch_array($result))
			{
				switch($oldmissions['day'])
				{
					case 1:
						$missionday = "Monday";
					break;
					
					case 2:
						$missionday = "Tuesday";
					break;
					
					case 3:
						$missionday = "Wednesday";
					break;
					
					case 4:
						$missionday = "Thursday";
					break;
					
					case 5:
						$missionday = "Friday";
					break;
					
					default:
					$missionday = "Unknown ".$oldmissions['day'];
					break;
				}
				if($oldmissions['human'] == 1)
				{	$species = 'Humans';	}
				if($oldmissions['human'] == 0)
				{	$species = 'Zombies';	}
				echo "<div class=\"oldmission\">";
				echo "<div class=\"oldmissionhead\">On: ".$missionday."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;For the: ".$species."</div>";
				echo "<div class=\"oldmissiontext\">".$oldmissions['missiondetails']."</div>";
				echo "</div>";
			}
		echo "</div>";
		}
		
?>
    <br /><br /><br /><br /><br /><br /><br /><br />
 </div><!--end content-->
	
<div id="framefooter"> 
        <span class="framefooterleft"> 
            &copy;2010 HvZatFSU<br /><a rel="license" href="<?php echo $_SERVER['SERVER_NAME'];?>/copyright.php"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-nc-nd/3.0/us/88x31.png" /></a>
        </span> 
        <span class="framefooterright"> 
            <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/info.php?action=about" class="helplinks">About</a> &bull; <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/rules.php" class="helplinks">Rules</a> &bull; <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/forums/" class="helplinks">Forums</a> &bull; <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/info.php?action=contact" class="helplinks">Contact</a> | <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/info.php?action=help" class="helplinks">Help</a> | <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/constitution.php" class="helplinks">Constitution</a> 
        </span> 
    </div><!--end frame footer--> 
<br class="clearfloat" />

</div> <!--end frame-->
<br />
  <br class="clearfloat" />

</body>
</html>

<?php mysqli_close($cxn);?>
