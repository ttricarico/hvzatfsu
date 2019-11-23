<?php
	//(c) 2011 Thomas Tricarico and Others
	//index_postcomment.php

	define('hvz', 1);
	include('../php/settings.php');
	
	date_default_timezone_set($_COOKIE['timezone']);

	$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
	if(!$cxn)
	{
		echo "Could not connect: ".mysqli_error($cxn);
		exit;
	}

	include('../php/security.php');
	$query = "INSERT INTO homecomments(hvzid, poster, datestamp, commenttext)
				VALUES('".$_COOKIE['hvzid']."', '".$_COOKIE['firstname']." ".$_COOKIE['lastname']."', '".time()."', '".sanitize($_REQUEST['c'])."')";
	$result = mysqli_query($cxn, $query);

	if(!$result)
	{
		echo "Could not connect :".mysqli_error($cxn);
		exit;
	}
	$query = "SELECT * FROM homecomments WHERE id='".mysqli_insert_id($cxn)."'";
	$result = mysqli_query($cxn, $query);
	$row = mysqli_fetch_assoc($result);

	mysqli_close($cxn);	//close mysql
	?>
	<div id="comment<?php echo $row['id']; ?>" class="comment">
		<div class="commenthead">
			<?php
				if($_COOKIE['admin'] == true || $row['hvzid'] == $_COOKIE['hvzid'])
				{
					?><span id="delete<?php echo $row['id']; ?>" class="delete">
						<a href="javascript://" class="delete" onclick="deletecomment(<?php echo $row['id']; ?>)"> X </a>
					</span><?php
				}
			?>
			<span class="poster">Post by: <a class="posterlink" href="profile.php?hvzid=<?php echo $row['hvzid']; ?>"><?php echo $row['poster']; ?></a></span>
			<span class="datestamp"><?php echo date('F j, Y \a\t g:i:s a', $row['datestamp']); ?></span>
			<br class="clearfloat" />
		</div>
		<div class="commentbody">
			<span class="commenttext">
		<?php
			$cmt = $row['commenttext'];
			$cmt = preg_replace("@((https?://)?([-\w]+\.[-\w\.]+)+\w(:\d+)?(/([-\w/_\.]*(\?\S+)?)?)*)@", "<a href=\"http://".$_SERVER['SERVER_NAME']."/link.php?lnk=\\1\" class=\"playerinfo\" target=\"_blank\">\\1</a>", $cmt);
			echo nl2br($cmt);
		?></span>
		</div>
	</div>
<?php exit; ?>
