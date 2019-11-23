<?php	session_start();
	define('hvz',1);	//prevent hacking
	
	require('../../php/settings.php');
	global $cxn;
	$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
	
	error_reporting(-1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD SHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmls="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="copyright" content="Copyright 2010 Thomas Tricarico and HvZatFSU" />
<title>HvZatFSU :: Marketplace &mdash; Admin</title>
<link rel="stylesheet" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/styles/marketplace.css" />
<link rel="stylesheet" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/styles/marketplace_admin.css" />


<script type="text/javascript" src="http://<?php echo $_SERVER['SERVER_NAME'];?>/scripts/jquery.js"></script>
<script type="text/javascript" src="http://<?php echo $_SERVER['SERVER_NAME'];?>/scripts/awesomestuff.js"></script>
<style>
	#mainpage{
		width:100%;
	}
</style>
</head>
<body>
<?php include('../../php/header.php'); topbar(); ?>
<div id="frame">
	<div id="header">
    	<img src="../images/banners/marketbanner_w900xh150.png" alt="HvZatFSU Marketplace" />
        <form action="http://<?php echo $_SERVER['SERVER_NAME'];?>/search.php" method="get">
        <div id="headermenu">
        	<ul class="headerlinks">
            	<li><a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/">HvZatFSU</a></li>
            	<li><a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/marketplace/">Marketplace Home</a></li>
                <li><a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/marketplace/viewitems.php?hvzid=<?php echo $_COOKIE['hvzid']; ?>">View My Items</a></li>
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
                echo "<a href=\"http://".$_SERVER['SERVER_NAME']."/profile.php?hvzid=".$_COOKIE['hvzid']."\">Profile</a> | <a href=\"http://".$_SERVER['SERVER_NAME']."/settings.php\">Settings</a>";
            }
        ?>
        </div><!-- end subheader menu -->
    </div><!--end headermenu-->
    <div id="mainpage">
    	<div id="admin_left">
        	<ul>
				<li><a href="?action=viewcats" class="admin">Category Management</a></li>
                <li><a href="?action=viewitems" class="admin">View Items</a></li>
                <li><a href="?action=activemems" class="admin">View Active Members</a></li>
		 	</ul>
            <br />
            <span class="admin_head">Other Stuff</span>
            <ul>
				<li><a href="?action=lockmarket" class="admin">Lock Marketplace</a></li>
                <li><a href="?action=unlockmarket" class="admin">Unlock Marketplace</a></li>
            </ul>
            <br /><br /><br />
            <br /><br /><br />
            <br /><br /><br />
        </div>
        <div id="admin_content">
    		        	<?php
			
			$action = $_REQUEST['action'];
			
			
			$actionArray = array(     //'$action=' array variables  'action name' => array('File function is in..', 'Function name')
			'viewcats' => array('marketcat', 'viewcats'),
			'addcat' => array('marketcat', 'addcat'),
			'delcat' => array('marketcat', 'delcat'),
			'viewitems' => array('marketitems', 'viewitems'),
			'deleteitems' => array('marketitems', 'deleteitems'),
			'lockmarket' => array('marketadmin', 'lock'),
			'unlockmarket' => array('marketadmin', 'unlock')

			);
			
			if (!isset($_REQUEST['action']) || !isset($actionArray[$_REQUEST['action']]))
			{
				echo "Choose an option to the left.";
                    
         
				/*$query = "SELECT * FROM content WHERE pagefor='admin'";
				$result = mysqli_query($cxn, $query);
				$row = mysqli_fetch_assoc($result);
				echo $row['context'];*/
			}			
			else
			{
				$file = $actionArray[$_REQUEST['action']][0];
				$function = $actionArray[$_REQUEST['action']][1];
				include_once('php/'.$file.'.php');
				$function();
			}
		

			
			
			
			
			
			?>
        </div>
    </div>
    <br class="clearfloat" />
    <div id="framefooter"> 
        <span class="framefooterleft"> 
            <a href="http://hvzatfsu.com/copyright.php" class="helplinks">&copy;2010-2011 HvZatFSU</a><br /><a rel="license" href="<?php echo $_SERVER['SERVER_NAME'];?>/copyright.php"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-nc-nd/3.0/us/88x31.png" /></a>
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