<?php
	define('hvz', 1);

	include('../php/settings.php');	//mysql connect
		$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);


		$query = "SELECT aboutme FROM members WHERE hvzid='".$_COOKIE['hvzid']."'";
		$result = mysqli_query($cxn, $query);
		$abtme = mysqli_fetch_assoc($result);
	
	

	if($_REQUEST['action'] == 'retrieve')
    {
		echo '<div id="fillin"><form id="aboutmechgr" enctype="application/x-www-form-urlencoded"><textarea id="aboutmetext">'.$abtme['aboutme'].'</textarea><input type="submit" value="Change About Me" onClick="sendaboutme($(\'#aboutmetext\').val());return false;" /></div>';
    }
    
	if($_REQUEST['action'] == 'get')
	{
		include('../php/textparsing.php');

		echo "<div id=\"fillin\">";
		echo nl2br(parsetext($abtme['aboutme'],'about_me'));
		echo "</div>";
	}
	mysqli_close($cxn);
    ?>
