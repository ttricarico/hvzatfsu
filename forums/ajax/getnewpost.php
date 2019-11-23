<?php 

	include('../php/settings.php');
		$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
	$query = "SELECT human, oz, admin, FROM members WHERE hvzid='".$_COOKIE['hvzid']."'";
	$result = mysqli_query($cxn, $query);
	$player = mysqli_fetch_assoc($result);
	if($player['admin'] == 1)
	{	$perm = array('admin', 'human', 'zombie', 'general');	}
	elseif($player['oz'] == 1)
	{	$perm = array('zombie', 'general');	}
	elseif($player['human'] == 1)
	{	$perm = array('human', 'general');	}
	elseif($player['human'] == 0)
	{	$perm = array('zombie', 'general');	}
	else
	{	$perm = array('general');	}

	mysqli_free_result($result);

	$k = 1;
	foreach($perm as $v)
	{
		$query = "SELECT * FROM forums_categories WHERE permission='".$v."'";
		$result = mysqli_query($cxn, $query);
		$perms = mysqli_fetch_assoc($cxn, $result);
		$thing = array($k => array($v, $perms['id']));
		$k++;
	}
	
	$query = "SELECT * FROM forums_posts WHERE category='".$thing[1]."' ORDER BY posttime LIMIT 15";
	$result = mysqli_query($cxn, $query);

	header('Content-type: text/xml'); 
	echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
	echo "<newforumposts>";
	$i = 1;
	while($row = mysqli_fetch_assoc($result))
	{
		echo "<newpost item=\"".$i."\">";
		while
		echo "\t<category>".$thing[0]."</category>";
	
	}	
	
	?>
