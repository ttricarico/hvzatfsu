<?php
	/** Updates Player Settings **/



	function account()
	{
		global $cxn;
			require('../php/security.php');
		$name = sanitize($_POST['name']);
		$hvzid = sanitize($_POST['hvzid']);
		$email = sanitize($_POST['email']);
		$phonenum = sanitize($_POST['phonenum']);
		$password = sanitize($_POST['password']);
		$password2 = sanitize($_POST['retypedpassword']);
		$location = sanitize($_POST['location']);
		
		
		if($password != '******')	//if password is changed, change it in the system
		{
			// do password check
			if($password != $password2)
			{	header('Location: http://'.$_SERVER['SERVER_NAME'].'/settings.php?talk=Your passwords do not match');	}
			
			$query = "UPDATE members SET email='".$email."', phonenum='".$phonenum."', password='".md5($password)."' WHERE hvzid='".$hvzid."'";
		}
		else
		{
			$query = "UPDATE members SET email='".$email."', phonenum='".$phonenum."' WHERE hvzid='".$hvzid."'"; 
		}
		
		$result = mysqli_query($cxn, $query);
		
		header('Location: http://'.$_SERVER['SERVER_NAME'].'/settings.php?talk=Settings Updated');
	}//end function
	
	function gameoptions()
	{
		global $cxn;
		if($_POST['ozpool'] == 1)
		{	
			$query = "UPDATE members SET ozchoice='1' WHERE hvzid='".$_COOKIE['hvzid']."'";
			$result = mysqli_query($cxn, $query);
		}
		if($_POST['ozpool'] == 0)
		{	
			$query = "UPDATE members SET ozchoice='0' WHERE hvzid='".$_COOKIE['hvzid']."'";
			$result = mysqli_query($cxn, $query);
		}
		header('Location: http://'.$_SERVER['SERVER_NAME'].'/settings.php?talk=Game Options Updated#tabs-3');
		return;
	}//end function
	
	function privacy()
	{
		global $cxn;
		$showemail = $_POST['showemail'];
		$showphone = $_POST['showphone'];
		if($showemail == 1)
		{	$hideemail == 0;  }
		if($showemail == 0)
		{	$hideemail == 1;  }
		if($showephone == 1)
		{	$hidephone == 0;  }
		if($showemail == 0)
		{	$hideemail == 1;  }
		
		$showaim = (isset($_POST['showaim']) ? 1 : 0);  
		$showyimsn = (isset($_POST['showyimsn']) ? 1 : 0);  
		$showmsn = (isset($_POST['showmsn']) ? 1 : 0);  
		$showskype = (isset($_POST['showskype']) ? 1 : 0);  
		
		$query = "UPDATE members SET hidephone='".$showemail."', hideemail='".$hideemail."', showaim='".$showaim."', showyimsn='".$showyimsn."', showmsn='".$showmsn."', showskype='".$showskype."' WHERE hvzid='".$_COOKIE['hvzid']."'";
		$result = mysqli_query($cxn, $query);
		
		header('Location: http://'.$_SERVER['SERVER_NAME'].'/settings.php?talk=Privacy Settings Updated');
		return;
	}//end function
	
	function profile()
	{
		global $cxn;
			include('../uploads/images/index.php');
			postimage();
		
		return;
	}//end function
	

?>