<?php

	$action = $_REQUEST['action'];
	
	include('php/settings.php');
	include('php/header.php');
	 htmlheader();
	?>



<style>
#contactinfo
{margin: 10px auto auto 20px;}

</style>
</head>
 

<?php visheader(); ?>
  
  
  <div id="content">
   
   <div id="talk">	<!-- if the computer has anything important for the player, it goes here-->
   	<?php 
	if(isset($_REQUEST['talk']))
			{
				$talk = $_REQUEST['talk'];
				
				echo $talk.PHP_EOL;
				echo "<hr size=\"1px\" width=\"80%\" />\".PHP_EOL;" ;
			} 
    ?>
	</div>	
     
	 <!--end talk-->
     
     <!--new stuff here -->
  <div id="contactinfo"> 
  <center>
<table>
<tr><td> <h2>Moderator Contact Info:</h2></td></tr>
<tr><td>Patrick Murphy, President:</td>						            <td>(321) 482-8738 </td></tr>
<tr><td>Ryan Learn, Treasurer:</td>								        <td>(904) 327-3778</td></tr>
<tr><td>Matt Fischer, Public Relations Chair</td>                       <td>(904)-304-1783</td></tr>
<tr><td>Travis Sampiero, Secretary</td>                                 <td></td></tr> 
<tr><td>Riley Lungmus, Moderator</td>									<td></td></tr>
<tr><td>Taylor Van Winkle, Moderator</td>								<td></td></tr>
<tr><td>Sean Adams, Moderator</td>										<td></td></tr>
<tr><td>Becca Garrett, Moderator</td>									<td></td></tr>
<tr><td>Khari Brusch, Moderator</td>									<td></td></tr>

<tr><td></td><td></td></tr>
<tr><td></td><td></td></tr>
<tr><td></td><td></td></tr>


<tr><td> <h2>Other Info:</h2></td></tr>
<tr> <td><a href="http://www.hvzatfsu.com/info.php"> From our Founder</a> </td></tr>
 <tr> <td><a href="http://www.hvzatfsu.com/bearef.php">Join Us </a></td></tr>
  <tr> <td><a href="http://www.hvzatfsu.com/constitution.php">Our Constitution</a></td></tr>
    
</table>
    </center>
    </div>
 <!-- end New stuff-->
  </div> 
  
     <!--end content-->
    
    <?php include('php/footer.php'); ?>
 
 
  
</div>
 <!--end frame-->

<?php mysqli_close($cxn);?>
</body>
</html>
