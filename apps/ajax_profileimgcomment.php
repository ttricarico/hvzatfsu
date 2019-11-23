<?php

	/*******************************
	 * Function Directory
	 *		noshow(void) = blocks user from page
	 *
	 *
	 *
	 *
	***********************/
	define('hvz', 1);	
	include('../php/settings.php');
		global $cxn;
		$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);

	include('../php/security.php');


	function noshow()	//if no request, end process.
	{
		header("HTTP/1.0 401 Unauthorized"); //send 401 error code
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: no-cache, must-revalidate'); // HTTP/1.1
		header('Pragma: no-cache'); // HTTP/1.0
		
		echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
		<html xmlns=\"http://www.w3.org/1999/xhtml\">
		<head>
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
		<title>403 Forbidden</title>
		</head>
		
		<body>
			<h1>Forbidden</h1>
			<p>You don't have permission to access this page or directory on this server. If you feel that you have reached this message in error, please contact the webmaster.</p>
			<hr />
			<address>http://".$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']." on Port 80</address>
		</body>
		</html>";
		return;
	}	//end function
	
	function newpost()
	{
		global $cxn;
		
			$postername = sanitize($_REQUEST['pn']);
			$imgname = sanitize($_REQUEST['p']);
			$postcontent = sanitize($_REQUEST['pc']);	
			$posterip = ip2long($_SERVER['REMOTE_ADDR']);
			$posterhvzid = $_COOKIE['hvzid'];
			$postername = $_COOKIE['firstname']." ".$_COOKIE['lastname'];
			
			$query = "INSERT INTO imagecomments(imgname, posterhvzid, postername, postcontent, posterip, posttime)
									VALUES('".$imgname."', '".$posterhvzid."', '".$postername."', '".$postcontent."', '".$posterip."', '".time()."')";
			$result = mysqli_query($cxn, $query);
			
			
		return;
	}
	
	function updatecaption()
	{
		global $cxn;
			$query = "UPDATE uploadedimages SET imgcaption='".sanitize($_REQUEST['captiontxt'])."' WHERE imagename='".sanitize($_REQUEST['p'])."'";
			$result = mysqli_query($cxn, $query);
			
		return;
	}//end function
	
	function getnewposts()
	{
		global $cxn;
			header('Content-type: text/xml');	//send as xml
			//$query = "SELECT * FROM imagecomments WHERE imgname='".sanitize($_REQUEST['p'])."' ORDER BY posttime DESC";
			$query = "SELECT * FROM forums_posts WHERE 1 LIMIT 20";
			$result = mysqli_query($cxn, $query);
	/*		if(mysqli_num_rows($result) == 1)
			{
				echo "<div style=\"text-align: center;\">No New Posts</div>";
				echo "<div id=\"checkfornew\" onclick=\"getnewcomments(".$sanitize($_REQUEST['lastpost']).");\">Check For New Posts</div>";
			}*/
			$comment = mysqli_fetch_assoc($result);
				echo "
				<div id=\"container\">
				<div class=\"imgcomment\" id=\"imgcomment".$comment['id']."\">
					<div class=\"imgcommenthead\">
						<span class=\"postername\"><a href=\"profile.php?hvzid=".$comment['posterhvzid']."\" title=\"Visit Profile\">
						".$comment['postername']."</a></span>
						<span class=\"options\">";
						if($_COOKIE['admin'] == true || $_COOKIE['hvzid'] == sanitize($_REQUEST['hvzid']) || $_COOKIE['hvzid'] == $comment['posterhvzid'])
						{ echo "<a href=\"javascript://\" onclick=\"delimgcomment(".$comment['id'].");\" title=\"Delete Post\">X</a> ";	}
						echo "</span>
						<br class=\"clearfloat\" />
					</div>
					<div class=\"imgcommentbody\">".nl2br($comment['postcontent'])."</div>
					<div class=\"imgcommentfoot\">
						<span class=\"icl\">";
							if($_COOKIE['admin'] == true)
							{
								echo "<abbr title=\"".long2ip($comment['posterip'])."\">IP Logged</abbr>";
							}
						echo"</span>
						<span class=\"icr\">Posted on: ".date('F j, Y \a\t g:i:s a', $comment['posttime'])."</span>
						<br class=\"clearfloat\" />
					</div>
				</div>
				</div>";
		return;
	}//end function
	
	function deletepost()
	{
		global $cxn;
			$query = "DELETE FROM imagecomments WHERE id='".$_REQUEST['post']."'";
			$result = mysqli_query($cxn, $query);
		return;
	}
	
	
	$actionArray = array(     //'$action=' array variables  'action name' => array('File function is in..', 'Function name')
		'default' => array('index', 'noshow'),
		'newpost' => array('index', 'newpost'),
		'updatecaption' => array('index', 'updatecaption'),
		'getnew' => array('index', 'getnewposts'),
		'deletepost' => array('index', 'deletepost')
	);
	
	if (!isset($_REQUEST['action']) || !isset($actionArray[$_REQUEST['action']]))
	{
		$file = 'index';
		$function = 'noshow';			
	}					
	else
	{
		//$file = $actionArray[$_REQUEST['action']][0];
		$function = $actionArray[$_REQUEST['action']][1];
	}
	$function();
		
	mysqli_close($cxn);
?>