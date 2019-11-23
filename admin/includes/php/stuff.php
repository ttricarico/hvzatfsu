<?php
	if(!defined('hvz'))
	{	die('Access Denied....');	}

	/*************************
		stuff.php
		includes: 
			- function changerules()
			- function editindex()
			- function editphones()
			- function webprobs()
				This function is used to message the webmaster about problems with the site.
		(c) 2010 Thomas Tricarico
		(c) 2010 HvZ at FSU
	*******************************/
#########################	function changerules()	#################################
	
	function changerules()
	{
		global $cxn;
		$query = "SELECT context FROM content WHERE pagefor='rules'";
			if ($stmt = mysqli_prepare($cxn, $query)) {
				mysqli_stmt_execute($stmt);
			
				/* bind variables to prepared statement */
				mysqli_stmt_bind_result($stmt, $context);
			
				
				
				/* fetch values */
				while (mysqli_stmt_fetch($stmt)) {
			echo "<form name=\"editpage\" action=\"index.php?action=editrules2\" method=\"post\">
				<textarea name=\"edittext\" cols=\"70\" rows=\"25\">".$context."</textarea>
				<br />
				<input type=\"submit\" value=\"Update Rules Page\" />
				</form>";						
				}
		
					/* close statement */
					mysqli_stmt_close($stmt);
			}	
			if(!mysqli_prepare($cxn, $query))
			{
				echo mysqli_error($cxn);
			}
		
		return;				
	}
	
	function editrules2()
	{
		global $cxn;
			$edittext = $_REQUEST['edittext'];
			$query = "UPDATE content SET context='".$edittext."' WHERE pagefor='rules'";
			$result = mysqli_query($cxn, $query);
			echo "Rules Updated";
		return;
	}
	function editindex()
	{
		global $cxn;
		
		$query = "SELECT * FROM content WHERE pagefor='index'";
		$result = mysqli_query($cxn, $query);
		$row = mysqli_fetch_assoc($result);

		echo "<textarea name=\"indexedit\" cols=\"75\" rows=\"30\">";
		echo $row['context'];
		echo "</textarea>";
		return;
	}//end function
	
	function editphones()
	{
		global $cxn;
		//print title bar
		echo "<form action=\"?action=viemembers2\" method=\"post\" enctype=\"application/x-www-form-urlencoded\">";
		echo "<div class=\"row_title\">".PHP_EOL;
		echo"<div style=\"width:18%; text-align:center;float:left;\">Name</div>
						<div style=\"width:38%; text-align:center;float:left;\">Phone Number</div>
						<div style=\"width:38%; text-align:center;float:left;\">Email</div>
					</div>".PHP_EOL;

		if ($stmt = mysqli_prepare($cxn, "SELECT firstname, lastname, phone, email FROM members WHERE admin='1'")) {
				mysqli_stmt_execute($stmt);
			
				/* bind variables to prepared statement */
				mysqli_stmt_bind_result($stmt, $firstname, $lastname, $phone, $email);
			
				/* fetch values */
				$i=0;
				while (mysqli_stmt_fetch($stmt)) {
					if($i&1){	echo "<div class=\"row_even\">".PHP_EOL;	}
					else{	echo "<div class=\"row_odd\">".PHP_EOL;	}
					echo "<div style=\"width:18%; text-align:center; float:left;\">".$firstname." ".$lastname."</div>
						<div style=\"width:38%; text-align:center;float:left;\"><input type=\"text\" value=\"".$phone."\" /></div>
						<div style=\"width:38%; text-align:center;float:left;\">".$email."</div>";
					echo "</div>";
					$i++;
				}
				
		
					/* close statement */
					mysqli_stmt_close($stmt);
			}
	}
	function editphones2()
	{
		global $cxn;

		foreach($selected as $value)
		{
			$query = "UPDATE members SET isplaying='1' WHERE hvzid='".$value."'";
			$result = mysqli_query($cxn, $query);
		}

		return;
	}
		

?>