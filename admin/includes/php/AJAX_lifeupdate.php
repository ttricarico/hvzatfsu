<?php

//header time!
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header ('Cache-Control: no-cache, must-revalidate'); // HTTP/1.1
header ('Pragma: no-cache'); // HTTP/1.0




/****MySQL Login***/
include('settings.php');
//      settimezone();
$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);

$v = $_REQUEST['v'];
if($v == 0) {
	$addlq = "human='1', oz='0' WHERE hvzid='".mysqli_real_escape_string($cxn, $_REQUEST['id'])."'";
}
else if($v == 1) {
	$addlq = "human='0', oz='0' WHERE hvzid='".mysqli_real_escape_string($cxn, $_REQUEST['id'])."'";
}
else if($v == 2) {
	$addlq = "human='0', oz='1' WHERE hvzid='".mysqli_real_escape_string($cxn, $_REQUEST['id'])."'";
}
else {
	$addlq = "";
}


$query = "UPDATE members SET ".$addlq; 
$result = mysqli_query($cxn, $query);
if($result) {
	echo $query." | ";
	echo "ok";
}
else {
	echo mysqli_error($cxn);
}
mysqli_close($cxn);
