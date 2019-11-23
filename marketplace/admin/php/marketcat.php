<?php
	if(!defined('hvz'))
	{ die('Access Denied...'); }
	
	//holds functions
	
	function viewcats()
	{
		global $cxn;
			$query = "SELECT * FROM marketplace_cat WHERE 1";
			$result = mysqli_query($cxn, $query);
			
			echo "<table border=\"0\" width=\"100%\" align=\"center\"><form action=\"?action=delcat\" method=\"post\">";
			
			echo "<tr>";
			echo "<td width=\"10%\" align=\"center\">Delete?</td>";
			echo "<td width=\"30%\" align=\"center\">Title</td>";
			echo "<td width=\"30%\" align=\"center\">Description</td>";
			echo "<td width=\"30%\" align=\"center\">Created On</td>";
			echo "</tr>";
			if(mysqli_num_rows($result) == 0)
			{
				echo "<tr><td colspan=\"4\">There are no categories. Add a new one.</td></tr>";
			}
			while($row = mysqli_fetch_array($result))
			{
				echo "<tr>";
				echo "<td align=\"center\"><input type=\"checkbox\" name=\"catid[]\" value=\"".$row['id']."\" /></td>";
				echo "<td align=\"center\">".$row['title']."</td>";
				echo "<td align=\"center\">".$row['descr']."</td>";
				echo "<td align=\"center\">".date('M j, Y \a\t h:i:s a', $row['timestamp'])."</td>";
				echo "</tr>";
				
			}
		echo "<tr><td colspan=\"4\" align=\"center\"><input type=\"submit\" value=\"Delete Categories\" /></td></tr>";
		echo "</table></form>";
		echo "<br /><br /><br />";
		echo "<form action=\"?action=addcat\" method=\"post\">
	Add a new category:<br /><br />Category Name: <input type=\"text\" name=\"catname\" style=\"width: 250px;\" maxlength=\"20\" /><br />
	Category Description: <input type=\"text\" name=\"descr\" style=\"width:300px;\" maxlength=\"255\" />&nbsp;&nbsp;<input type=\"submit\" value=\"Add Category\" />
</form>";
		
		return;	
	}
	
	function addcat()
	{
		global $cxn;
		include('../../php/security.php');
			$catname = sanitize($_POST['catname']);
			$descr = sanitize($_POST['descr']);
			$hvzid = $_COOKIE['hvzid'];
			
			$query = "INSERT INTO marketplace_cat(title, descr, createby, timestamp)
										VALUES('".$catname."', '".$descr."', '".$hvzid."', '".time()."')";
			$result = mysqli_query($cxn, $query);
			
			echo "Categories have been added.";
		return;
	}
	
	function delcat()
	{
		global $cxn;
			
			$id = $_POST['catid'];
			
			foreach($id as $v)
			{
				$query = "DELETE FROM marketplace_cat WHERE id='".$v."'";
				$result = mysqli_query($cxn, $query);
				$query = "UPDATE marketplace SET cat='2' WHERE cat='".$v."'";
				$result = mysqli_query($cxn, $query);
			}
				
		echo "Categories have been deleted and those items have been moved to the random category";
		return;
	}


?>

