
<?php
	//Forgetting password = bad
	
	function forgotpassword_template()
	{
		global $cxn;
		
		echo "";
		return;
	}
	
	function forgotpassword()
	{
		global $cxn;
		
		if($_REQUEST['method'] == 'email')
		{
			$firstname = $_REQUEST['firstname'];
			$lastname = $_REQUEST['lastname'];
			$email = $_REQUEST['email'];
			
			$query = "SELECT secretq FROM members WHERE firstname='".$firstname."' AND lastname='".$lastname."' AND email='".$email."'";
			if ($stmt = mysqli_prepare($cxn, $query)) {
						mysqli_stmt_execute($stmt);
					
						/* bind variables to prepared statement */
						mysqli_stmt_bind_result($stmt, $secretq);
					
						
						/* fetch values */
						while (mysqli_stmt_fetch($stmt)) {
							echo $secretq;
							echo "<br><form action=\"?action=forgotpassword2\" method=\"post\" enctype=\"application/x-www-form-urlencoded\"><input name=\"secreta\" type=\"text\" value=\"Answer\" /><input name=\"secretq\" type=\"hidden\" value=\"$secretq\">";
							echo "<input name="" type=\"submit\" value=\"Submit\"></form>";
						}
				
							/* close statement */
							mysqli_stmt_close($stmt);
					}	
		}
		if($_REQUEST['method'] == 'hvzid')
		{	
			$hvzid = $_REQUEST['hvzid'];
			
			$query = "SELECT secretq FROM members WHERE hvzid='".$hvzid."'";
		}
	}//end function
	function forgotpassword2()
	{
		global $cxn;
			$secreta1 = $_REQUEST['secreta'];
			$secretq = $_REQUEST['secretq'];
			
			$query = "SELECT secreta FROM members WHERE secretq='".$secretq."'";
			if ($stmt = mysqli_prepare($cxn, $query)) {
						mysqli_stmt_execute($stmt);
					
						/* bind variables to prepared statement */
						mysqli_stmt_bind_result($stmt, $secreta2);
					
						
						/* fetch values */
						while (mysqli_stmt_fetch($stmt)) {
							if($secreta1 == $secreta2)
							{
								echo "Reset Password: <br><form action=\"?action=forgotpassword3\" method=\"post\" enctype=\"application/x-www-form-urlencoded\">
								Email address: <input name=\"email\" type=\"text\" value=\"\" /><br />
								New Password: <input name=\"password\" type=\"hidden\" value=\"\">";
							echo "<input name="" type=\"submit\" value=\"Submit\"></form>";
							}
							else
							{
								echo "Incorrect Answer";
							}
			
						}
				
							/* close statement */
							mysqli_stmt_close($stmt);
					}	
		
		return;
	}
	function forgotpassword3()
	{
		global $cxn;
			$email = $_REQUEST['email'];
			$newpass = $_REQUEST['password'];
			
			$query = "UPDATE '";
			if ($stmt = mysqli_prepare($cxn, $query)) {
						mysqli_stmt_execute($stmt);
					
						/* bind variables to prepared statement */
						mysqli_stmt_bind_result($stmt, $secreta2);
					
						
						/* fetch values */
						while (mysqli_stmt_fetch($stmt)) {
							if($secreta1 == $secreta2)
							{
								echo "Reset Password: <br><form action=\"?action=forgotpassword3\" method=\"post\" enctype=\"application/x-www-form-urlencoded\">
								Email address: <input name=\"email\" type=\"text\" value=\"\" /><br />
								New Password: <input name=\"password\" type=\"hidden\" value=\"\">";
							echo "<input name="" type=\"submit\" value=\"Submit\"></form>";
							}
							else
							{
								echo "Incorrect Answer";
							}
			
						}
				
							/* close statement */
							mysqli_stmt_close($stmt);
					}	
		return;
	}



?>