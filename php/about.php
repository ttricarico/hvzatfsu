<?php

	$action = $_REQUEST['action'];
	
	include('php/settings.php');


	include('php/header.php');
	

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

<style>
#contactinfo
{margin: 10px auto auto 20px;
	}

</style>

<?php visheader(); ?>
  
  
  <div id="content">
   

     
     <!--new stuff here -->
  <div id="contactinfo"> 
<table>
<tr><td> <h2>Moderator Contact Info:</h2></td></tr>
<tr><td>John Seigel, Head Referee:</td>					            <td>(305) 528-6558 </td></tr>
<tr><td>Thomas Tricarico, PR Chair/Webmaster:</td>  			            <td>(561) 762-5574 </td></tr>
<tr><td>Laura Bradley, Treasurer:</td>  					                <td>(352) 316-0622 </td></tr>
<tr><td>Andrew Clements, Secretary:</td>						            <td>(904) 718-0298 </td></tr>
<tr><td>Patrick Murphy, Referee:</td>						            <td>(321) 482-8738 </td></tr>
<tr><td>Ryan Learn, Referee:</td>								        <td>(904) 327-3778</td></tr>
<tr><td> <h2>Moderator Contact Info:</h2></td></tr>
<tr> <td><a href="http://www.hvzatfsu.com/info.php" </a>From our Founder </td></tr>
 <tr> <td><a href="http://www.hvzatfsu.com/bearef.php" </a>Join Us</td></tr>
  <tr> <td><a href="http://www.hvzatfsu.com/constitution.php" </a> Our Constitution</td></tr>
    
</table>
    </div>
 <!-- end New stuff-->
  </div> 
  
  <p>
    <!--end content-->
    
    <?php include('php/footer.php'); ?>
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
