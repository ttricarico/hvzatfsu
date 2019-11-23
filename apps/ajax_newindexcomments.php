<?php

	include('../php/settings.php');
		$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);	//connect to mysql

	if(!$cxn)
	{	exit;	}
		
	//get zombie stats
	$query = "SELECT * FROM homecomments ORDER BY datestamp DESC LIMIT 15,2000";
	$result = mysqli_query($cxn, $query) or die(mysql_error());


	date_default_timezone_set('America/New_York');		//set default time to eastern
	
	/*** print out the xml file ***/

	header('Content-type: text/xml');
		//print out xml file
	echo "<div id=\"newcomments\">";
	while ($row = mysqli_fetch_array($result)) 
	{
				$commenttext = preg_replace("@((https?://)?([-\w]+\.[-\w\.]+)+\w(:\d+)?(/([-\w/_\.]*(\?\S+)?)?)*)@", "<a href=\"http://".$_SERVER['SERVER_NAME']."/link.php?lnk=\\1\" class=\"playerinfo\" target=\"_blank\">\\1</a>", $row['commenttext']);
		echo "<div class=\"comment\" id=\"comment".$row['id']."\">
                <div class=\"commenthead\">";
					if($_COOKIE['admin'] == true)
					{
						echo "<span class=\"delete\" id=\"delete".$row['id']."\"><a href=\"javascript://\" onclick=\"deletecomment(".$row['id'].")\" class=\"delete\">X</a></span>";
					}
                    echo "<span class=\"poster\">Post by: <a href=\"profile.php?hvzid=".$row['hvzid']."\" class=\"posterlink\">".$row['poster']."</a></span>
					<span class=\"datestamp\">". date('F j, Y \a\t h:i:s a', $row['datestamp'])."</span>
                </div><br class=\"clearfloat\" />
                <div class=\"commentbody\">
                    <span class=\"commenttext\">
                    ".nl2br($commenttext)."
                    </span>
                </div>

            </div>";
	}		
    echo "</div>";
mysqli_free_result($result);
?>