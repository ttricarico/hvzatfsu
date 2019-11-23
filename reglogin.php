<?php
	define('hvz', 1);	//prevent hacking to sub pages
	session_start();
	

	/****MySQL Login***/
	include('php/settings.php');
		include('php/header.php');//stuff for the headers
		global $cxn;
		$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);

	
	$actionArray = array(     //'$action=' array variables  'action name' => array('File function is in..', 'Function name')
		'login' => array('login', 'playerlogin'),	
		'logout' => array('login', 'playerlogout'),
		'register' => array('register', 'register_main'),
		'updatepassword' => array('register', 'update')
		);
	
	if (!isset($_REQUEST['action']) || !isset($actionArray[$_REQUEST['action']]) and $_REQUEST['action'] != 'regdisp' and $_REQUEST['action'] != 'forgotpass' and $_REQUEST['action'] != 'forgotpass2' and $_REQUEST['action'] != 'forgotpass3')
	{	//begin html login page
		//header time! (dont cache page, etc)
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header ('Cache-Control: no-cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: no-cache'); // HTTP/1.0
		
		$title = ":: Log In";
		htmlheader();
	?>
		<link rel="stylesheet" href="includes/styles/user.css" type="text/css" />

<style type="text/css">
<!--
	
	label
	{
		font-size: 12px;
		color:#999999;
	}
	#submit
	{
		background-color:#FF9900;
		margin-top: -3px;
		margin-bottom: -5px;
		padding-left: 15px;
		padding-right:15px;
		font:Arial, Helvetica, sans-serif;
		color:#000000;
		font-weight:bold;
		border: 1px solid #000000;
	}
-->
</style>
<?php visheader(); ?>
                <div id="content">
                   You must be logged in to see this page.
                    <form name="login" action="?action=login" enctype="application/x-www-form-urlencoded" method="post">
                        <table cellspacing="0" cellpadding="0">
                        	<tr>
                            	<td><label for="email" id="email">Email</label></td>
                                <td>&nbsp;&nbsp;&nbsp;</td>
                            	<td><label for="password" id="pass">Password</label></td>
                            </tr>
                        	<tr>
                            	<td><input type="text" name="email" id="email" maxlength="40" size="30" placeholder="yourname@domain.ext" /></td>
                            	<td>&nbsp;&nbsp;&nbsp;</td>
                            	<td><input type="password" name="password" id="password" maxlength="40" size="30"placeholder="password" /></td>
                            </tr>
                            <tr>
                            	<td colspan="3" align="center"><input type="submit" name="submit" id="submit" /></td>
                            </tr>
                        </table>
                       
                    </form>
                    <br /><br />Or do you need to <a href="http://hvzatfsu.com/reglogin.php?action=regdisp" class="helplinks">register?</a><br /><br /><br /><br /><br />
                </div>
    			<?php include('php/footer.php'); ?>
                <br class="clearfloat" />
            </div>
        </body>
        </html>

	<? 
	}//end html login page
		
		if($_REQUEST['action'] == 'regdisp')
		{	//display register page
			//header time! (dont cache page, etc)
			header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
			header ('Cache-Control: no-cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: no-cache'); // HTTP/1.0
		$title = ":: Register";
		htmlheader();
	?>

<style type="text/css">
<!--
	
	label
	{
		font-size: 12px;
		color:#999999;
	}
	#submit
	{
		background-color:#FF9900;
		margin-top: -3px;
		margin-bottom: -5px;
		padding-left: 15px;
		padding-right:15px;
		font:Arial, Helvetica, sans-serif;
		color:#000000;
		font-weight:bold;
		border: 1px solid #000000;
	}
	span#formerror{
		color:#FF0000;
		font-size:10px;
		font-weight:bold;
		display: none;
	}
-->
</style>
<script language="javascript" type="text/javascript" src="scripts/registration.js"></script> 
<script>
<!--//
$(document).ready(function(){
    jQuery.validator.addMethod("phoneUS", function(phone_number, element) {
    phone_number = phone_number.replace(/\s+/g, ""); 
	return this.optional(element) || phone_number.length > 9 && phone_number.match(/^(1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);}, "Please specify a valid phone number");
});
$(document).ready(function(){
    $("#registrationForm").validate();
  });



//-->
</script>
 
<?php visheader(); ?>
	    
  <div id="content"> 
   
   <div id="talk">	<!-- if the computer has anything important for the player, it goes here--> 
  
Do not reregister if you have been playing this game. We know that there are players who are not activated. You will be reactivated once we check your medical waiver.
   	    </div>	<!--end talk--> 
		            <span class="reginfo">To register for HvZ at FSU, please fill out the form below. A membership fee of $3 per game is required. This must be paid in person to a moderator. All fields are required unless stated otherwise.</span>

        <form action="?action=register" id="registrationForm" method="post">

        <table width="100%" border="0">

			

         <tr>

            <td width="53%"><span class="category">First Name</span></td>

            <td width="47%"><input name="firstname" type="text" id="firstname" size="21" maxlength="20" class="forminfo"  value=""/><span class="fnerror" id="formerror"><- ERROR</span></td>

          </tr>

          <tr>

            <td><span class="category">Last Name</span></td>

            <td><input name="lastname" type="text" id="lastname" size="21" maxlength="25" class="forminfo" value="" /><span class="lnerror" id="formerror"><- ERROR</span></td>

          </tr>



		 <tr>          

            <td><span class="category">Password<br />

            </span>

            <span class="description">5-20 characters long.</span></td>

        

            <td><input name="password" type="password" id="password" size="21" maxlength="20" class="forminfo" /><span class="passerror" id="formerror"><- ERROR</span></td>

          </tr>

          <tr>

            <td><span class="category">Repeat Password<br />

            </span> <span class="description">Must be identical to the password above.</span></td>

            <td><input name="repeatpassword" type="password" id="repeatpassword" size="21" maxlength="20" class="forminfo" /></td>

          </tr>

        

          <tr>

            <td><span class="category">Gender<br /></span></td>

            <td><p>

           <label>

         <input type="radio" name="gender" id="gender" value="male" />

             <span class="category">Male</span></label> 

                    &nbsp;&nbsp;&nbsp;

        

                   <label>

                     <input type="radio" name="gender" id="gender" value="female" />

                         <span class="category">Female</span></label>

           <br />

        </p></td>

          </tr>

          <tr>

            <td><span class="category">Birthday</span><br />

        

            <span class="description">Only use real dates. The computer will not accept made up dates.</span></td>

            <td><span class="description">&nbsp;</span><span class="description">&nbsp;</span><br />

                                       <span class="description">&nbsp;</span>

                                       <select name="month" size="1">

                                         <option value="1" selected="selected">January</option>

                                         <option value="2">February</option>

                                         <option value="3">March</option>

                                         <option value="4">April</option>

                                         <option value="5">May</option>

                                         <option value="6">June</option>

                                         <option value="7">July</option>

                                         <option value="8">August</option>

                                         <option value="9">September</option>        

                                         <option value="10">October</option>

                                         <option value="11">November</option>

                                         <option value="12">December</option>

                                       </select>

                                       &nbsp;

                                       <input name="day" type="text" id="day" size="2" maxlength="2" class="forminfo" value="Day" /><input name="year" type="text" id="year" size="4" maxlength="4" class="forminfo" value="Year" /><span class="dateerror" id="formerror"><- ERROR</span></td>

          </tr>

        

          <tr>

            <td><span class="category">Email Address<br /></span>

            <span class="description">We will use this to send out important information.</span></td>

            <td><input name="email" type="text" id="email" size="31" maxlength="30" class="forminfo"  value="" /><span class="emailerror" id="formerror"><- ERROR</span></td>

          </tr>

          <tr>

            <td><span class="category">Phone Number</span><br />

        

                <span class="description">Type like this: 8505551212</span>    </td>

            <td><input name="phone" type="text" id="phone" size="11" maxlength="10" class="forminfo"  value="" /><span class="phoneerror" id="formerror"><- ERROR</span></td>

          </tr>

          <tr>

            <td><span class="category">AIM Screenname<br />

            <span class="description">Optional</span></span></td>

            <td><input name="aimsn" type="text" id="aimsn" size="26" maxlength="25" class="forminfo" /></td>

        

          </tr>

          <tr>

            <td><span class="category">Yahoo! Screenname<br />

            <span class="description"> Optional</span></span></td>

            <td><input name="yimsn" type="text" id="yimsn" size="26" maxlength="25" class="forminfo" /></td>

          </tr>

          <tr>

        

            <td><span class="category">Secret Question</span><br />

            <span class="description">In case you forget your password, don't put a question mark at the end.</span></td>

            <td><input name="secretq" type="text" id="secretq" size="31" maxlength="100" class="forminfo" value="" /><span class="sqerror" id="formerror"><- ERROR</span></td>

          </tr>

          <tr>

            <td><span class="category">Secret Answer</span></td>

            <td><input name="secreta" type="text" id="secreta" size="31" maxlength="30"  class="forminfo"  value="" /><span class="saerror" id="formerror"><- ERROR</span></td>

        

          </tr>

          <tr>

            <td><span class="category">Do you want to be put into the OZ pool?</span><br />

            <span class="description">This can be changed later</span><br /></td>

            <td><input type="checkbox" name="oz" id="oz" value="ozchecked" />

        <span class="category">Yes I do</span></td>

          </tr>

          <tr>

        

            <td colspan="2" align="center">

              <input type="submit" name="submit" id="submit" value="Register For HvZ at FSU" /></td>

          </tr>

          <tr>

        </table>

          </form>

    
    
    
    </div> <!--end content--> 
	
    <div id="framefooter"> 
        <span class="framefooterleft"> 
            &copy;2010 HvZatFSU &mdash; Vitam ab morte dÄ&#147;fendimus.
        </span> 
        <span class="framefooterright"> 
            <a href="http://new.hvzatfsu.com" class="helplinks">About</a> &bull; <a href="http://new.hvzatfsu.com" class="helplinks">Rules</a> &bull; <a href="http://new.hvzatfsu.com" class="helplinks">Forums</a> &bull; <a href="http://new.hvzatfsu.com" class="helplinks">Contact</a> | <a href="http://new.hvzatfsu.com" class="helplinks">Help</a> | <a href="#" class="helplinks">Constitution</a> 
        </span> 
    </div><!--end frame footer-->  
 
<br class="clearfloat" /> 
 
</div> <!--end frame--> 
<br /><br /><br /><br /> 
</body> 
</html> 
<?php }	//end register page

	if($_REQUEST['action'] == 'forgotpass')
		{	//display register page
			//header time! (dont cache page, etc)
			header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
			header ('Cache-Control: no-cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: no-cache'); // HTTP/1.0
		$title = ":: Forgot Password";
		
		include('php/settings.php');
		global $cxn;
		$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);

		htmlheader();

?>
			<link rel="stylesheet" href="includes/styles/user.css" type="text/css" />

<style type="text/css">
<!--
	
	label
	{
		font-size: 12px;
		color:#999999;
	}
	#submit
	{
		background-color:#FF9900;
		margin-top: -3px;
		margin-bottom: -5px;
		padding-left: 15px;
		padding-right:15px;
		font:Arial, Helvetica, sans-serif;
		color:#000000;
		font-weight:bold;
		border: 1px solid #000000;
	}
-->
</style>
<script language="javascript" type="text/javascript" src="includes/scripts/registration.js"></script> 
 
<?php visheader(); ?>
	    
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

	Forgot email address or password? That's okay, give me some information, and you'll be able to reset your password.<br /><br />
	
    <form action="?action=forgotpass2" method="post">
        First Name: <input type="text" name="firstname" style="width: 250px;" /><br />
        Last Name: <input type="text" name="lastname" style="width: 250px;" /><br />
        Phone Number: <input type="text" name="phonenumber" style="width: 250px;" /><br />
    	<input type="submit" value="Next Step" />
    </form>
<br /><br /><br /><br /><br /><br /><br />
    </div> <!--end content--> 
	 
 
		<?php include('php/footer.php'); ?>
        <br class="clearfloat" />
    </div>
</body>
</html>
    <?php }	//end forgotpass page

	if($_REQUEST['action'] == 'forgotpass2')
		{	//display register page
			//header time! (dont cache page, etc)
			header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
			header ('Cache-Control: no-cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: no-cache'); // HTTP/1.0
		$title = ":: Forgot Password";
		
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$phone = $_POST['phone'];
		
		include('php/settings.php');
		global $cxn;
		$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
		
		$query = "SELECT * FROM members WHERE firstname='".$firstname."' AND lastname='".$lastname."'";
		$result = mysqli_query($cxn, $query);
		$row = mysqli_fetch_array($result);
		htmlheader();
?>
			<link rel="stylesheet" href="includes/styles/user.css" type="text/css" />

<style type="text/css">
<!--
	
	label
	{
		font-size: 12px;
		color:#999999;
	}
	#submit
	{
		background-color:#FF9900;
		margin-top: -3px;
		margin-bottom: -5px;
		padding-left: 15px;
		padding-right:15px;
		font:Arial, Helvetica, sans-serif;
		color:#000000;
		font-weight:bold;
		border: 1px solid #000000;
	}
-->
</style>
<script language="javascript" type="text/javascript" src="includes/scripts/registration.js"></script> 
 
<?php visheader(); ?>
	    
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

	Forgot email address or password? That's okay, give me some information, and you'll be able to reset your password.
	
    <form action="?action=forgotpass3" method="post">
    	<input type="hidden" name="firstname" value="<?php echo $firstname; ?>" /><input type="hidden" name="lastname" value="<?php echo $lastname; ?>" />
        Secret Question: <?php echo $row['secretq']; ?><br />
        Answer: <input type="text" name="secretanswer" style="width: 250px;" /><br />
    	<input type="submit" value="Next Step" />
    </form>

    </div> <!--end content--> 
	 <br /><br /><br /><br /><br /><br /><br />
 
		<?php include('php/footer.php'); ?>
        <br class="clearfloat" />
    </div>
</body>
</html>
    <?php }	//end forgotpass2 page
	
		if($_REQUEST['action'] == 'forgotpass3')
		{	//display register page
			//header time! (dont cache page, etc)
			header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
			header ('Cache-Control: no-cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: no-cache'); // HTTP/1.0
		$title = ":: Forgot Password";
		
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		
		$answer = strtolower($_POST['secretanswer']);
		$query = "SELECT secreta FROM members WHERE firstname='".$firstname."' AND lastname='".$lastname."'";
		$result = mysqli_query($cxn, $query);
		$row = mysqli_fetch_array($result);
		
		if(strtolower($row['secreta']) == $answer)
		{
			$query = "SELECT email, phone FROM members WHERE firstname='".$firstname."' AND lastname='".$lastname."'";
			$result = mysqli_query($cxn, $query);
			$info = mysqli_fetch_array($result);
		
		htmlheader();
?>
			<link rel="stylesheet" href="includes/styles/user.css" type="text/css" />

<style type="text/css">
<!--
	
	label
	{
		font-size: 12px;
		color:#999999;
	}
	#submit
	{
		background-color:#FF9900;
		margin-top: -3px;
		margin-bottom: -5px;
		padding-left: 15px;
		padding-right:15px;
		font:Arial, Helvetica, sans-serif;
		color:#000000;
		font-weight:bold;
		border: 1px solid #000000;
	}
-->
</style>
<script language="javascript" type="text/javascript" src="includes/scripts/registration.js"></script> 
 
<?php visheader(); ?>
	    
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

	Forgot email address or password? That's okay, give me some information, and you'll be able to reset your password.
	<form method="post" action="?action=updatepassword">
    Email Address: <?php echo $info['email']; ?><input type="hidden" value="<?php echo $info['email']; ?>" name="email" /><br />
	Password: <input type="password" name="pass" style="width:200px;" /><br />
	<input type="submit" value="Reset Password" />
    </form>
    </div> <!--end content--> 
	 
 <br /><br /><br /><br /><br /><br /><br />
		<?php include('php/footer.php'); ?>
        <br class="clearfloat" />
    </div>
</body>
</html>
<?php
		}//end if
	else
	{	die('You are wrong.');	}
}//end forgotpass 3 
	else
	{
		$file = $actionArray[$_REQUEST['action']][0];
		$function = $actionArray[$_REQUEST['action']][1];
		include_once('php/'.$file.'.php');
		$function();
	}
	

	mysqli_close($cxn);?>