<?php

	function hvzidext_allnew()
	{
		global $cxn;
		$query = "SELECT * FROM members WHERE 1";
		$result = mysqli_query($cxn, $query);
		$numrows = mysqli_num_rows($result);
		$i = 0;
		do{
			$hvzidext = rand(0,999);
			$query = "UPDATE members SET hvzidext='$hvzidext' WHERE id='$i'";
			$result = mysqli_query($cxn, $query);
			$i++;
		}while($i < $numrows);		
		viewmembers();
		
		return;
	}
	
	function hvzidext_viewall()
	{
		global $cxn;
			viewmembers();
		return;
	}


?>