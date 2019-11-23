<?php

	$action = $_REQUEST['action'];
	
	include('includes/php/settings.php');
		global $cxn;
		$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);

		
		ini_set('display_errors', true);
	    error_reporting(E_ALL ^ E_NOTICE);

?>
<style type="text/css">
	#topbox{
		position: absolute;
		top: 0;
		left: 0;
		background-color:#FFFF99;
		border-bottom:1px solid #CCCCCC;
		width:100%;
		z-index:105;
		overflow:auto;
		font-size:14px;
		height: 1.5em;
	}
	span.tbleft{
		float:left;
		width: auto;
		text-align:center;
		padding-left:3%;
	}
	span.tbright{
		float:right;
		width:auto;
		padding-right:3%;
		text-align:right;
	}
	
	#frame{
	background:#FFFFFF;
	width:900px;
	margin-left:auto;
	margin-right:auto;
	padding-top:3px;
	margin-top: 2.5em;
	padding-bottom:3px;
	padding-left: 3px;
	padding-right:3px;
	}
	
</style>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>HvZ@FSU</title>

<link rel="stylesheet" href="includes/styles/basestyle.css" type="text/css" />
<link rel="stylesheet" href="includes/styles/buttons.css" type="text/css" />
<link rel="stylesheet" href="includes/styles/linrks.css" type="text/css" />
<link rel="stylesheet" href="includes/styles/footer.css" type="text/css" />
<link rel="stylesheet" href="includes/styles/index.css" type="text/css" />
<link rel="stylesheet" href="includes/styles/rules.css" type="text/css" />



</head>

<body>


		
<div id="topbox">
<span class="tbleft"><a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/" class="playerinfo"><abbr title="Return to hvzatfsu.com">HvZatFSU</abbr></a></span>
<span class="tbright">
<a href="" class="playerinfo">Forums</a> | 
<a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/profile.php" class="playerinfo">Profile</a> | 
<a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/messages.php" class="playerinfo">Messages</a> | 
<a href="http://blog.hvzatfsu.com/" class="playerinfo">Blog</a> | 
<a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/settings.php" class="playerinfo">Settings</a>|
<a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/rules.php" class="playerinfo">Rules</a> |
</span>
</div>

<div id="frame">
		<div id="header">
        	<span class="headerleft"><a href="http://www.facebook.com/group.php?gid=53924719249" class="header">FSU HvZ on Facebook</a></span>
            <span class="headerright"><a href="#" class="header">Next Game: Summer C 2010</a></span>
         <img src="images/banners/banner3_w900xh150.png" />

  		</div><!--end header-->
 
<br class="clearfloat" />
	
	<!-- ?php playerinfo();	?>    
  
  -->
  <div id="content">
   
   <div id="talk">	<!-- if the computer has anything important for the player, it goes here-->
   	<?php if(isset($_REQUEST['talk']))
			{
				$talk = $_REQUEST['talk'];
				
				echo $talk.PHP_EOL;
				echo "<hr size=\"1px\" width=\"80%\" />".PHP_EOL;
			} 
		?>
    </div>	
     <!--end talk-->
     
     <?php
	
		$view = $_REQUEST['view'];
		include('includes/php/rules.php');
		switch($view)
		{
			default:
			case 'playerrules':
				display_playerrules();
			break;
			
			case 'modrules':
				display_modrules();
			break;		
		}
	
	?>
  </div> 
  <!--end content-->
	
      <?php include('includes/php/footer.php'); ?>

<br class="clearfloat" />

</div> <!--end frame-->
<br /><br /><br /><br />
<?php mysqli_close($cxn);?>
</body>
</html>
