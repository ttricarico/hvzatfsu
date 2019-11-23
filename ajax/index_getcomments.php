<?php
	
	include('../php/settings.php');
	$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);

	$query = "SELECT * FROM homecomments ORDER BY datestamp DESC LIMIT 15";
	$result = mysqli_query($cxn, $query);

	date_default_timezone_set('America/New_York');

	echo "<div id=\"cmt_holder\">";
	while($cmt = mysqli_fetch_assoc($result))
	{
		/** url with http:// to link ([http://link -> <a href="link">http://link</a>) **/
		$commenttext = preg_replace("@((https?://)?([-\w]+\.[-\w\.]+)+\w(:\d+)?(/([-\w/_\.]*(\?\S+)?)?)*)@", "<a href=\"http://".$_SERVER['SERVER_NAME']."/link.php?lnk=\\1\" class=\"playerinfo\" target=\"_blank\">\\1</a>", $cmt['commenttext']);

		//include('../php/textparsing.php');
		//$commenttext = parsetext($cmt['commenttext']);
		
		echo "<div class=\"comment\" id=\"comment".$cmt['id']."\">
                <div class=\"commenthead\">";
					if($_COOKIE['admin'] == true || $_COOKIE['hvzid'] == $cmt['hvzid'])
					{
						echo "<span class=\"delete\" id=\"delete".$cmt['id']."\"><a href=\"javascript://\" onclick=\"deletecomment(".$cmt['id'].")\" class=\"delete\">X</a></span>";
					}
                    echo "<span class=\"poster\">Post by: <a href=\"profile.php?hvzid=".$cmt['hvzid']."\" class=\"posterlink\">".$cmt['poster']."</a></span>
					<span class=\"datestamp\">".date('F j, Y \a\t g:i:s a', $cmt['datestamp'])."</span>
                </div><br class=\"clearfloat\" />
                <div class=\"commentbody\">
                    <span class=\"commenttext\">
                    ".nl2br($commenttext)."
                    </span>
                </div>

            </div>";
				
	}

	echo "</div>";

		
	
	mysqli_close($cxn);	
?>
