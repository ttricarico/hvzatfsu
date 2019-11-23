<?php

	$action = $_REQUEST['action'];
	
	include('includes/php/settings.php');
		global $cxn;
		$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);

	include('php/header.php');
		
		ini_set('display_errors', true);
	    error_reporting(E_ALL ^ E_NOTICE);

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>HvZ@FSU</title>

<link rel="stylesheet" href="styles/basestyle.css" type="text/css" />
<link rel="stylesheet" href="styles/buttons.css" type="text/css" />
<link rel="stylesheet" href="styles/links.css" type="text/css" />
<link rel="stylesheet" href="styles/footer.css" type="text/css" />
<link rel="stylesheet" href="styles/index.css" type="text/css" />
<link rel="stylesheet" href="styles/rules.css" type="text/css" />

<script type="text/javascript" src="scripts/jquery.js"></script>

<script language="javascript">

	$(window).scroll(function(){
		$("#topbox").animate({top:$(window).scrollTop()+"px" },{queue: false, duration: 0});
	});


</script>

<?php visheader(); ?>


  
  
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
     
     <!--new stuff here -->
     
   
     
     
     <!-- end New stuff-->
  </div> 
  <p>
    <!--end content-->
    
    <?php include('includes/php/footer.php'); ?>
  </p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p><br class="clearfloat" />
  </p>
</div> <!--end frame-->
<br /><br /><br /><br />
<?php mysqli_close($cxn);?>
</body>
</html>
