<?php
	
	function displaycomments()
	{
	
		return;	
	}
	
	function cleanInput($input) {

		  $search = array(
			'@<script[^>]*?>.*?</script>@si',   // Strip out javascript
			'@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
			'@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
			'@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
		  );
		
			$output = preg_replace($search, '', $input);
			return $output;
	}
	
	
	function protectinput($string)
	{
		global $cxn;
		$string = strip_tags($string);
		$string = mysqli_real_escape_string($cxn, $string);
		$string = htmlentities($string);
		$string = stripslashes($string);
		return $string;
	}//end function
	
	
	function postnew()
	{
		global $cxn;
		
		$datestamp = time();	//time of post
		
		$hvzid = $_REQUEST['hvzid'];	//get infomation
		$name = $_REQUEST['name'];
		$comment = $_REQUEST['commenttext'];
		
		$comment = cleanInput($comment);
		$comment = protectinput($comment);
		if(!get_magic_quotes_gpc())
			$comment = addslashes($comment);
			
		$query = "INSERT INTO  homecomments(id, hvzid, poster, datestamp, commenttext) 
				VALUES ('' ,  '".$hvzid."' ,  '".$name."' ,  '".$datestamp."' ,  '".$comment."')"; 
		$result = mysqli_query($cxn, $query);
		if(!$result)
		{		
			header('Location: http://'.$_SERVER['SERVER_NAME'].'/?talk=Error in posting the comment. Please try again. If the problem persists, contact a moderator. Error: '.mysqli_error($cxn).'');
		}
		else
		{
			mysqli_free_result($result);
			header('Location: http://'.$_SERVER['SERVER_NAME'].'/?talk=Comment Posted');
		}

		return;
	}
	
	function deletecomment()
	{
		global $cxn;
		
		$id = $_REQUEST['id'];
		
		$query = "DELETE FROM homecomments WHERE id='".$id."'";
		$result = mysqli_query($cxn, $query);
		return;
	}
?>