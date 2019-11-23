<?php

	//(c) 2011 Thomas Tricarico and Others
	define('hvz',1);
	define('tat',1);
	include('../php/settings.php');
	$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_passwor, $mysql_db);

	include('../php/security.php');

	$query = "SELECT * FROM events WHERE id='".sanitize($_REQUEST['id'])."'";
	$result = mysqli_query($cxn, $query);
	
	while($ei = mysqli_fetch_assoc($result))
	{
?>	

	<div id="eventinfo">
		<div id="eventname"><a href="events.php?id=<?php echo sanitize($_REQUEST['id']); ?>"><?php echo $ei['name']; ?></a></div>
		<div id="eventtimes"><?php echo date('F j, Y \a\t g:i:s a', $ei['datestart'])." - ".date('F j, Y \a\t g:i:s a', $ei['dateend']);?></div>
	</div>

<?php } //end while
mysqli_close($cxn);?>
