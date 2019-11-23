<?php
	define('hvz', 1);
	
	function postcomment()
	{
		include('../php/settings.php');
			
			global $cxn;
			$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);

		include('../php/security.php');
		
		
		$postername = sanitize($_REQUEST['postername']);
		$posterhvzid = sanitize($_REQUEST['posterhvzid']);
		$commenttext = sanitize($_REQUEST['commenttext']);
		$ipaddr = sanitize($_REQUEST['ipaddr']);
		$posterhvzid = sanitize($_REQUEST['posterhvzid']);
		$profilehvzid = sanitize($_REQUEST['profilehvzid']);
		
		
		$query = "INSERT INTO profilecomments(profileid, postername, posterhvzid, commenttext, posttime, ipaddr)
									VALUES('".$profilehvzid."', '".$postername."', '".$posterhvzid."', '".$commenttext."', '".time()."', '".$ipaddr."')";
		$result = mysqli_query($cxn, $query);
		
		$query = "UPDATE members SET notifications=notifications+1 WHERE hvzid='".$profilehvzid."'";
		$result = mysqli_query($cxn, $query);
		
		mysqli_close($cxn);
		header('Location: http://'.$_SERVER['SERVER_NAME'].'/profile.php?hvzid='.$profilehvzid);
	}//end function
	
	function delcomment()
	{
		include('../php/settings.php');
			global $cxn;
			$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);

		include('../php/security.php');
		
		$query = "DELETE FROM profilecomments WHERE id='".sanitize($_REQUEST['postid'])."'";
		$result = mysqli_query($cxn, $query);
		
		if(!$result)
		{	mysqli_close($cxn); return;	}
		else
		{	mysqli_close($cxn); return;	}
	}//end function
	
	$actionArray = array(
						'postcomment' => array('postcomment'),
						'delpost' => array('delcomment')
						);
			if (!isset($_REQUEST['action']) || !isset($actionArray[$_REQUEST['action']]))
			{
				die('Access Denied...');		
			}					
			else
			{
				$function = $actionArray[$_REQUEST['action']][0];
			}
	
			$function();

?>
