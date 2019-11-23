<?php	session_start();
	define('hvz', 1);	//define constant for shit
	
	include('../../php/security.php');	//string sanitization function

	
	
	include('../../php/settings.php');
		$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
	
	$itemname = sanitize($_POST['itemname']);
	$itemprice = $_POST['itemprice'];
	if(!is_numeric($itemprice))
	{	die('You did not enter a number for price. Try again');	}
	$itemcat = sanitize($_POST['itemcat']);
	$itemdescr = sanitize($_POST['itemdesc']);
	$ipaddr = sanitize($_POST['ipaddr']);
	$hvzid = sanitize($_POST['hvzid']);
	
	$query = "SELECT firstname, lastname FROM members WHERE hvzid='".$hvzid."'";
	$result = mysqli_query($cxn, $query);
	$row = mysqli_fetch_assoc($result);
	$name = $row['firstname']." ".$row['lastname'];
	mysqli_free_result($result);
	
	/** File Uploader **/
		if($_FILES['itemimage']['size'] === 0 || empty($_FILES['itemimage']['tmp_name']))
		{
			$imgurl = 'default.jpg';
		}
		else
		{
			if($_FILES['itemimage']['size'] > 1048576) //if image is bigger than 1Mb
			{
				header('Location: http://'.$_SERVER['SERVER_NAME'].'/marketplace/?talk=The image is too big, please shrink the image size.');
				mysqli_close($cxn);
				exit;
			}
			$filename = time()."_".sha1($_FILES['itemimage']['name']);

			/** Create Thumbnail of Image **/
			//$imgx = imageSX($_FILES['itemimage']);	//get width
			//$imgy = imageSY($_FILES['itemimage']);	//get height
			
			
			move_uploaded_file($_FILES['itemimage']['tmp_name'], 'uploads/fullsize');	//move file here to activate folder writing
			
			list($imgx, $imgy) = getimagesize($_FILES['itemimage']['tmp_name']);	//get height and width
			$imgratio = $imgx / $imgy;
			$towidth = 100;
			$toheight = 100;
			$xscale = $imgx / $towidth;
			$yscale = $imgy / $toheight;
			/** Resize thumbnail to the ratio size **/
			if($imgratio > 1)
			{
				$new_width = round($imgx * (1/$xscale));
				$new_height = round($imgy * (1/$xscale));
			}
			elseif($imgratio <1 )
			{
				$new_width = round($imgx * (1/$yscale));
				$new_height = round($imgy * (1/$yscale));
			}
			else
			{
				$new_width = 100;
				$new_height = 100;
			}
			
			
			$new_image = imagecreatetruecolor($new_width, $new_height);
			if($_FILES['itemimage']['type'] == 'image/jpeg')
			{	$image = imagecreatefromjpeg($_FILES['itemimage']['tmp_name']);	}
			elseif($_FILES['itemimage']['type'] == 'image/png')
			{	$image = imagecreatefrompng($_FILES['itemimage']['tmp_name']);	}
			elseif($_FILES['itemimage']['type'] == 'image/gif')
			{	$image = imagecreatefromgif($_FILES['itemimage']['tmp_name']);	}
			elseif($_FILES['itemimage']['type'] == 'image/bmp')
			{	$image = imagecreatefromwbmp($_FILES['itemimage']['tmp_name']);	}
			else
			{	
				header('Location: http://'.$_SERVER['SERVER_NAME'].'/marketplace/?talk=This image format is not supported. Try again with a file of format jpg, bmp, gif, or png');	
				exit;
			}
			
			imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, $imgy, $imgx);
			
			imagejpeg($image, 'uploads/fullsize/'.$filename.'.jpg');
			
			move_uploaded_file($_FILES['itemimage']['tmp_name'], 'uploads/thumbnails/');
			imagejpeg($new_image, 'uploads/thumbnails/'.$filename.'.jpg');

			/** Enter into datebase **/
			$query = "INSERT INTO marketplace(hvzid, name, title, price, image,  descr, timepost, cat, ipaddr)
		VALUES('".$hvzid."', '".$name."',  '".$itemname."', '".$itemprice."', '".$filename.".jpg','".$descr."', '".time()."', '".$cat."', '".$ipaddr."')";
			$result = mysqli_query($cxn, $query);
			
			//$filetest1 = fopen('uploads/thumbnails/'.$filename.'.jpg');
			//$filetest2 = fopen('uploads/fullsize/'.$filename.'.jpg');
			if(!$result)// or $filetest2 == false)
			{
				echo "There was an error posting the item: <br>";
				echo "MySQLi: ".mysqli_error($cxn)."<br><br>";
				echo "File 1: ".var_dump($filetest2)."<br><br>";
				echo "File 2: ".var_dump($filetest2)."<br><br>";
				fclose($filetest1);
				fclose($filetest2);
				imagedestroy($image);
				imagedestroy($new_image);
				unlink('uploads/thumbnails/'.$filename.'.jpg');
				unlink('uploads/fullsize/'.$filename.'.jpg');
				mysqli_close($cxn);
				die('----End Error----');
				header('Location: http://'.$_SERVER['SERVER_NAME'].'/marketplace/?talk=There was an error with posting your item. Please try again.');
				exit;
			}
			else	/** If all is good, move on **/
			{
				fclose($filetest1);
				fclose($filetest2);
				imagedestroy($image);
				imagedestroy($new_image);
				mysqli_close($cxn);
				header('Location: http://'.$_SERVER['SERVER_NAME'].'/marketplace/?talk=Your item has been posted');
			}

		}


?>
