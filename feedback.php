<?php	define('hvz', 1);
	date_default_timezone_set('America/New_York');	
	
		/** Disable Session ID in URL **/
	//Use cookies to store the session ID on the client side
	@ini_set ('session.use_only_cookies', 1);
	//Enable transparent Session ID support
	@ini_set ('session.use_trans_sid',    1);
	session_start();
	
	//header time!	Prevent catching, etc
	header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	header ('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
	header ('Cache-Control: no-cache, must-revalidate'); // HTTP/1.1
	header ('Pragma: no-cache'); // HTTP/1.0


	/*****Header Stuff*****/
	include('php/header.php');
	global $title;
		$title = " :: Feedback";
	
	/****MySQL Login***/
	include('php/settings.php');
		global $cxn;
		$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
	require('php/security.php');

	/****** FUNCTIONS *******/
	
	function leavefeedback($str)
	{
			
			echo "<div id=\"talk\" style=\"font-color:#FF0000; font-weight:bold;\">".$str."</div>
            <div id=\"feedbackform\" style=\"width: 90%; margin-left: auto; margin-right:auto;\">
            	<form action=\"?action=postfeedback\" method=\"post\">
                	Name: <input type=\"text\" name=\"from\" style=\"width:300px;\" />&nbsp;&nbsp;<input type=\"submit\" value=\"Send Feedback\" /><br /><br />
					Feedback information. Please include anything that would help us fix the error you are reporting. If you are not reporting an error, you can type in whatever you would like to see included, or any other comments or questions. You do not have to fill out the name if you would like this to be anonymous. 
                    <textarea rows=\"15\" style=\"width: 99%; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;\" name=\"feedtext\"></textarea>
                </form>
            </div>";
	
		if($_COOKIE['admin'] == true)
		{
			get_feedback();
		}
            
		return;
	}
	/////////////////////////
	function postfeedback()
	{
	include('php/settings.php');
		global $cxn;
	require('php/security.php');
			if(!isset($_COOKIE['hvzid']))
			{	$hvzid = 'NOT_SET';		}
			else
			{	$hvzid = $_COOKIE['hvzid'];		}
			$query = "INSERT INTO feedback(fromwho, feedtext, datestamp, ipaddr, hvzid, sid)
									VALUES('".sanitize($_REQUEST['from'])."', '".sanitize($_REQUEST['feedtext'])."', '".time()."', '".ip2long($_SERVER['REMOTE_ADDR'])."', '".$hvzid."', '".session_id()."')";
			$result = mysqli_query($cxn, $query);
			call_user_func('leavefeedback', 'Feedback has been Submitted. Thanks for your help!');
			
		return;
	}

	function get_feedback()
	{
		global $cxn;

		$query = "SELECT * FROM feedback WHERE 1 ORDER BY datestamp DESC";
		$result = mysqli_query($cxn, $query);

		?><table>
		<tr><th>From</th><th>Feed Back Text</th><th>Time</th></tr>
		<?php
		while($row = mysqli_fetch_assoc($result))
		{?>
			<tr>
				<td><?php echo $row['fromwho'];?></td>
				<td><?php echo $row['feedtext'];?> </td>
				<td><?php echo date('g:i:s a \o\n m-d-Y',$row['datestamp']);?></td>
			</tr>
		<?php
		}
		?></table><?php
		return;
	}
	
	
	/******* END FUNCTIONS *********/

	$actionArray = array(     //'$action=' array variables  'action name' => array('File function is in..', 'Function name')
				'leavefeedback' => array('leavefeedback'),
				'postfeedback' => array('postfeedback')				
			);
			
			if (!isset($_REQUEST['action']) || !isset($actionArray[$_REQUEST['action']]))	//if not view=profile, make it so
			{
				$function = 'leavefeedback';
			}					
			else
			{
				$function = $actionArray[$_REQUEST['action']][0];
			}
	

	 htmlheader();	?>


<?php visheader(); ?>

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
     <div id="content"> 
     <?php
	 		include_once('php/'.$file.'.php');
			$function();	
	 ?>    
 </div><!--end content-->
<br class="clearfloat" />
  <?php include('php/footer.php'); ?>

 <br class="clearfloat" />


</div> <!--end frame--> 
<br /><br /><br /><br /> 
</body> 
</html> 
<?php mysqli_close($cxn); ?>
