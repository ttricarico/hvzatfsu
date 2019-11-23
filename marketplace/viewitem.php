<?php	session_start();
	define('hvz',1);	
	
	include('../php/settings.php');
		global $cxn;
		$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
	
	include('../php/security.php');	//included for security - sanitization of input

	$query = "SELECT * FROM marketplace WHERE id='".sanitize($_GET['itemid'])."'";
	$result = mysqli_query($cxn, $query);
	if(mysqli_num_rows($result) == 0)
	{	header('Location: http://'.$_SERVER['SERVER_NAME'].'/marketplace/');
		mysqli_close($cxn);
		exit;
	}
	
	$iteminfo = mysqli_fetch_array($result);
	mysqli_free_result($result);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="copyright" content="Copyright 2010 Thomas Tricarico and HvZatFSU" /> 
<meta name="contact" content="fsuzombies[at]gmail[dot]com" />
<title>HvZatFSU :: Marketplace</title> 

<link rel="stylesheet" href="../styles/marketplace.css" />
 
<script type="text/javascript" src="http://hvzatfsu.com/scripts/jquery.js"></script> 
<script type="text/javascript" src="http://hvzatfsu.com/scripts/awesomestuff.js"></script> 
<script type="text/javascript">
<!--//
/** Search Box Stuff **/
	$(document).ready(function(){
		$("#search").click(function(){
			$("#search").attr("style", "color:#000000;width:300px;");
			$("#search").attr("value", "");
		});
		$("#search").focusout(function(){
			if($("#search").val() == false)
			{	$("#search").attr("style", "color:#999999; width:300px;");
				$("#search").attr("value", "Search Marketplace");/**do nothing**/ 
			}
			else
			{	/**do nothing**/ }
		});
	});
	/** Submit item div controller **/
	$(document).ready(function(){
		$("a.newitemlink").click(function(){
			$("div.postnewitemcontainer").fadeIn(500);
		});
	});
	
	$(document).ready(function(){
		$("#hidepostnewitemdiv").click(function(){
			$("div.postnewitemcontainer").fadeOut(500);
		});
	});

/*** Form Submit Function ***
	$(document).ready(function(){
		$("#submit").click(function(){
			$(".loading").show();	//show loading circle
			$(".formtext").attr("disabled", "true");	//disable text fields
			$("#submit").attr("disabled", "true"); //disable button
			return true;	//force cancel form submit actions
		});
	});*/
//-->
</script>
<style>
/**Footer styles**/
	div#framefooter{
		width:100%;
		font-family: Verdana, sans-serif;
		font-size: 10pt;
	}
		
	span.framefooterleft{
		text-align:left;
		float:left;
		width: 40%;
	}
	span.framefooterright{
		text-align:right;
		float: right;
		width: 55%;
	}
	#framefooter a, #framefooter:visited{
		color: #990099;
		text-decoration: none;	
	}
	#framefooter a:hover{
		color: #330033;
		text-decpration: underline;
	}
	/** End footer stuff **/
</style>
</head>

<body>
<?php include('../php/header.php'); topbar(); ?>
<div id="frame">
	<div class="postnewitemcontainer">
        <div class="postnewitem">
            <h2 style="width:70%; float:left;">Submit a new item</h2><div style="float: right; right:5px; top: 5px; padding-left:3px; padding-right:3px;" id="hidepostnewitemdiv"><a href="javascript://" title="Hide this box">Close</a></div>
            <br class="clearfloat" />
            <form enctype="multipart/form-data" method="post" action="apps/newitem.php">
                Item Name:<input type="text" name="itemname" style="width:300px;" maxlength="50" class="formtext" /><br />
                Item Image:<input type="file" name="itemimage" class="formtext" /><br />
                Price: $<input type="text" name="itemprice" style="width:100px;" class="formtext"  /><br />
                Category: 	<select name="itemcat" class="formtext" style="width:200px;">
                				<?php 
									$query = "SELECT * FROM marketplace_cat WHERE 1";
									$result = mysqli_query($cxn, $query);
									while($categories = mysqli_fetch_assoc($result))
									{
										echo "<option value=\"".$categories['id']."\">".$categories['title']."</option>".PHP_EOL;
									}
								?>
                			</select><br />
                Item Description:<br />
                <textarea name="itemdesc" style="width: 90%; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10pt;" rows="7" class="formtext"></textarea>
                <input type="hidden" name="ipaddr" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" />
                <input type="hidden" name="hvzid" value="<?php echo $_COOKIE['hvzid']; ?>" />
               	<div class="formelem"><input type="submit" id="submit" value="Post New Item" /></div><div class="loading"><img src="../images/loadingicons/redloader.gif"  />&nbsp;&nbsp;&nbsp;Posting Item...</div>
                
                
            </form>
        </div>
    </div><!--end popup box-->
    
	<div id="header">
    	<img src="images/banners/marketbanner_w900xh150.png" alt="HvZatFSU Blogs" />
        <form action="search.php" method="get">
        <div id="headermenu">
        	<ul class="headerlinks">
            	<li><a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/">HvZatFSU</a></li>
            	<li><a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/marketplace/">Marketplace Home</a></li>
                <li><a href="viewcats.php?">View Categories</a></li>
                <li>Search: <input type="text" value="Search Marketplace" id="search" name="q" style="color:#999999;width:300px;"  /></li>
            </ul>
        </div>
        </form>
	<div id="headersubbar">
	<?php
		if(isset($_COOKIE['hvzid']))
		{
			if($_COOKIE['admin'] == true)
			{  echo "<a href=\"http://".$_SERVER['SERVER_NAME']."/admin/\">HvZ Admin Page</a> | <a href=\"http://".$_SERVER['SERVER_NAME']."/marketplace/admin/\">Marketplace Admin</a> | "; }
			echo "<a href=\"http://".$_SERVER['SERVER_NAME']."/profile.php?hvzid=".$_COOKIE['hvzid']."\">My Profile</a> | <a href=\"http://".$_SERVER['SERVER_NAME']."/settings.php\">Settings</a>";
		}
	?>
	</div><!-- end subheader menu -->
    </div><!--end headermenu-->
    <div id="left">
    	
	</div>
    <div id="rightbar">
    	<div id="rightbartop">
          <?php   
		  	if(isset($_COOKIE['hvzid']))
			{
				echo "<span id=\"name\">";
				echo "Welcome, ".$_COOKIE['firstname']." ".$_COOKIE['lastname'];
				echo "</span>
					<span id=\"newitem\"><a href=\"javascript://\" class=\"newitemlink\">Create a new sale item</a></span>
					<span id=\"newitem\"><a href=\"http://".$_SERVER['SERVER_NAME']."/viewitems.php?hvzid=".$_COOKIE['hvzid']."\">View My Items</a></span>";
				echo "<span id=\"newitem\"><a href=\"http://".$_SERVER['SERVER_NAME']."/selleraccnt.php\">My Seller Account</a></span>";
			}
			if(!isset($_COOKIE['hvzid']))
			{ echo "<span id=\"name\"><a href=\"http://".$_SERVER['SERVER_NAME']."/reglogin.php\">Log in to post items</a></span>"; }
		?>
		
        </div>
        <div id="rightbarcenter">
        	Stuff<br />Stuffity Stuff Stuff<br />
            More.
        </div>
    </div>
	
    
    <br class="clearfloat" />
    <div id="framefooter"> 
        <span class="framefooterleft"> 
            <a href="http://hvzatfsu.com/copyright.php" class="helplinks">&copy;2010-2011</a><br /><a rel="license" 
href="http://<?php echo 
$_SERVER['SERVER_NAME'];?>/copyright.php"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-nc-nd/3.0/us/88x31.png" /></a>
        </span> 
        <span class="framefooterright"> 
            <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/info.php?action=about" class="helplinks">About</a> &bull; <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/rules.php" class="helplinks">Rules</a> &bull; <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/forums/" class="helplinks">Forums</a> &bull; <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/info.php?action=contact" class="helplinks">Contact</a> | <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/info.php?action=help" class="helplinks">Help</a> | <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/constitution.php" class="helplinks">Constitution</a> 
        </span> 
    </div><!--end frame footer--> 
    <br class="clearfloat" />
</div>
</body>
</html>
<?php mysqli_close($cxn); ?>
