<?php
	
	$action = $_REQUEST['action'];
	$q = $_REQUEST['q'];
	
	include('../includes/php/settings.php');
	//global $cxn;
	$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
	
	//function updatepopulation()
	//{
		//global $cxn;

		//get human population	AND isplaying='1'
		$query = "SELECT * FROM members WHERE human='1' AND admin='0' ";
		$result = mysqli_query($cxn,$query);
		$txt['humanpop'] = mysqli_num_rows($result);
		mysqli_free_result($result);				
	
		//get zombie population	AND isplaying='1'
		$query = "SELECT * FROM members WHERE human='0' AND admin='0' ";
		$result = mysqli_query($cxn, $query);
		$txt['zombiepop'] = mysqli_num_rows($result);
		mysqli_free_result($result);


		//print the xml file of stuff
			header('Content-type: text/xml');
	
	echo "<?xml version=\"1.0\" encoding=\"utf-8\" standalone=\"yes\"?>
<response>
	<method>humanpop</method>
	<result>".$txt['humanpop']."</result>
	<method>zombiepop</method>
	<result>".$txt['zombiepop']."</result>
</response>";
		
		
		mysqli_close($cxn);
		return;	
	//}
			
	
	
	
	
