<?php 
	//Attendance Functions
	
	if(!defined('hvz'))
	{	die('Access Denied...');	}
	
	function view()
	{
		
	}//end function##############################################################3
	function setattendance()
	{
		global $cxn;
		
		date_default_timezone_set('America/New_York');
		
		?>
        <form action="?action=setattendance2" method="post">
        	
        	<?php echo "<tr><td colspan=\"9\" align=\"left\">Player Attendance - Today is <font style=\"color:#FF0000\">".date('l', time())."</font></td></tr>";		?>
            	<table width="100%" style="text-align:center;">
            	<tr>
                	<td>&nbsp;</td>
                    <td colspan="2">Monday</td>
                    <td colspan="2">Tuesday</td>
                    <td colspan="2">Wednesday</td>
                    <td colspan="2">Thursday</td>
                </tr>
                <tr>
                	<td>&nbsp;</td>
                    <td>Day</td>
                    <td>Night</td>
                    <td>Day</td>
                    <td>Night</td>
                    <td>Day</td>
                    <td>Night</td>
                    <td>Day</td>
                    <td>Night</td>
                </tr>

                <?php 
					$query = "SELECT * FROM attendance WHERE 1";
					$result = mysqli_query($cxn, $query);
					$row = mysqli_fetch_assoc($result);
					if(!$result)
					{
						echo "<tr><td colspan=\"9\" align=\"left\">MySQL error: ".mysqli_error($cxn)."</td></tr>";	
					}
					$x = 0;
					if(mysqli_num_rows($result) == 0)
					{?>
						<tr>
							<td colspan="9">
								There are no active attendance lists. Please create a new one to mark attendance. 
								<br /><br />
								<input type="button" value="Create New Attendance List" id="create_attendance" />
								<div id="create_attendance" style="display:none;">
									<img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/loadingicons/redloader.gif" title="Loading..." />Creating new attendance list. Please wait...
								</div>
							</td>
						</tr>
                        </table>
					<?php 
						return;
					}
					else
					{
						while($row = mysqli_fetch_assoc($result))
						{
							$query = "SELECT firstname, lastname FROM members WHERE hvzid='".$row['hvzid']."'";
							$innerresult = mysqli_query($cxn, $query);
							$n = mysqli_fetch_assoc($innerresult);
							
							if($x%2)
							{
								?>
								  <tr style="background-color:#FFFF99; border-top:1px solid #CCCCCC; padding-top: 2px; padding-bottom: 2px;">
<?php						}
							else
							{?>
								 <tr style="background-color:#FFFFFF; border-top:1px solid #CCCCCC; padding-top: 2px; padding-bottom: 2px;">								
<?php						}?>
                            <td><a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/profile.php?view=profile&hvzid=<?php echo $row['hvzid']; ?>" class="playerinfo">
                                <?php echo $n['firstname']." ".$n['lastname'];?></a>
                            </td>
                            <td class="m_day"><input type="checkbox" name="m_day[]" title="Monday Day" value="<?php echo $row['hvzid']; ?>"<?php if($row['m_day'] == 1){ echo ' checked="checked"'; }?> /></td>
                            <td class="m_night"><input type="checkbox" name="m_night[]" title="Monday Night" value="<?php echo $row['hvzid']; ?>"<?php if($row['m_night'] == 1){ echo ' checked="checked"'; }?> /></td>
                            <td class="t_day"><input type="checkbox" name="t_day[]" title="Tuesday Day" value="<?php echo $row['hvzid']; ?>"<?php if($row['t_day'] == 1){ echo ' checked="checked"'; }?> /></td>
                            <td class="t_night"><input type="checkbox" name="t_night[]" title="Tuesday Night" value="<?php echo $row['hvzid']; ?>"<?php if($row['t_night'] == 1){ echo ' checked="checked"'; }?> /></td>
                            <td class="w_day"><input type="checkbox" name="w_day[]" title="Wednesday Day" value="<?php echo $row['hvzid']; ?>"<?php if($row['w_day'] == 1){ echo ' checked="checked"'; }?> /></td>
                            <td class="w_night"><input type="checkbox" name="w_night[]" title="Wednesday Night" value="<?php echo $row['hvzid']; ?>"<?php if($row['w_night'] == 1){ echo ' checked="checked"'; }?> /></td>
                            <td class="th_day"><input type="checkbox" name="th_day[]" title="Thursday Day" value="<?php echo $row['hvzid']; ?>" <?php if($row['th_day'] == 1){ echo ' checked="checked"'; }?>/></td>
                            <td class="th_night"><input type="checkbox" name="th_night[]" title="Thursday Night" value="<?php echo $row['hvzid']; ?>"<?php if($row['th_night'] == 1){ echo ' checked="checked"'; }?> /></td>               	
                        </tr>  

<?php
                            $x++;	
                        } //end while
                    }//end else
					
					mysqli_free_result($result);
					
					$query = "SELECT COUNT(id) FROM attendance WHERE m_day='1'";
					$result = mysqli_query($cxn, $query);
					$x = mysqli_fetch_assoc($result);
					$m_day = $x['COUNT(id)'];
					mysqli_free_result($result);
					
					$query = "SELECT COUNT(id) FROM attendance WHERE m_night='1'";
					$result = mysqli_query($cxn, $query);
					$x = mysqli_fetch_assoc($result);
					$m_night = $x['COUNT(id)'];
					mysqli_free_result($result);
										
					$query = "SELECT COUNT(id) FROM attendance WHERE t_day='1'";
					$result = mysqli_query($cxn, $query);
					$x = mysqli_fetch_assoc($result);
					$t_day = $x['COUNT(id)'];
					mysqli_free_result($result);
					
					$query = "SELECT COUNT(id) FROM attendance WHERE t_night='1'";
					$result = mysqli_query($cxn, $query);
					$x = mysqli_fetch_assoc($result);
					$t_night = $x['COUNT(id)'];
					mysqli_free_result($result);
					
					
					$query = "SELECT COUNT(id) FROM attendance WHERE w_day='1'";
					$result = mysqli_query($cxn, $query);
					$x = mysqli_fetch_assoc($result);
					$w_day = $x['COUNT(id)'];
					mysqli_free_result($result);
					
					
					$query = "SELECT COUNT(id) FROM attendance WHERE w_night='1'";
					$result = mysqli_query($cxn, $query);
					$x = mysqli_fetch_assoc($result);
					$w_night = $x['COUNT(id)'];
					mysqli_free_result($result);
					
					$query = "SELECT COUNT(id) FROM attendance WHERE th_day='1'";
					$result = mysqli_query($cxn, $query);
					$x = mysqli_fetch_assoc($result);
					$th_day = $x['COUNT(id)'];
					mysqli_free_result($result);
					
					$query = "SELECT COUNT(id) FROM attendance WHERE th_night='1'";
					$result = mysqli_query($cxn, $query);
					$x = mysqli_fetch_assoc($result);
					$th_night = $x['COUNT(id)'];
					mysqli_free_result($result);
				?>
                <tr style="background-color:#00CCFF; border-top:2px solid #000000;">
               		<td>Number of players attended:</td>
                    <td><script>$('input#th_night:checked')</script><?php echo $m_day; ?></td>
                    <td><?php echo $m_night; ?></td>
                    <td><?php echo $t_day; ?></td>
                    <td><?php echo $t_night; ?></td>
                    <td><?php echo $w_day; ?></td>
                    <td><?php echo $w_night; ?></td>
                    <td><?php echo $th_day; ?></td>
                    <td><?php echo $th_night; ?></td>
                </tr>
                <tr>
                	<td colspan="9">
                    	<input type="submit" value="Upload Updated Attendance" style="padding-left: 15px; padding-right:15px;" /><br />
                        
                    </td>
                </tr>
            </table>
			</form>
        <?php
		return;
	}// end function	###########################################
	function setattendance2()
	{
		
		global $cxn;
		
			//get Monday Day's attendance
			
			$selected = $_REQUEST['m_day'];			
			foreach($selected as $value)
			{
				$query = "UPDATE attendance SET m_day='1' WHERE hvzid='".$value."'";
				mysqli_query($cxn, $query);
			}

			//get Monday Night's Attendance
			$selected = $_REQUEST['m_night'];			
			foreach($selected as $value)
			{
				$query = "UPDATE attendance SET m_night='1' WHERE hvzid='".$value."'";
				mysqli_query($cxn, $query);
			}
			
			//get Tuesday Day's attendance
			$selected = $_REQUEST['t_day'];			
			foreach($selected as $value)
			{
				$query = "UPDATE attendance SET t_day='1' WHERE hvzid='".$value."'";
				mysqli_query($cxn, $query);
			}
			
			//get Tuesday Night's attendance
			$selected = $_REQUEST['t_night'];
			foreach($selected as $value)
			{
				$query = "UPDATE attendance SET t_night='1' WHERE hvzid='".$value."'";
				mysqli_query($cxn, $query);
			}
			
			//get Wednesday Day's attendance
			$selected = $_REQUEST['w_day'];
			foreach($selected as $value)
			{
				$query = "UPDATE attendance SET w_day='1' WHERE hvzid='".$value."'";
				mysqli_query($cxn, $query);
			}
			
			//get Wednesday Night's attendance
			$selected = $_REQUEST['w_night'];
			foreach($selected as $value)
			{
				$query = "UPDATE attendance SET w_night='1' WHERE hvzid='".$value."'";
				mysqli_query($cxn, $query);
			}
			
			//get Thursday Day's attendance
			$selected = $_REQUEST['th_day'];
			foreach($selected as $value)
			{
				$query = "UPDATE attendance SET th_day='1' WHERE hvzid='".$value."'";
				mysqli_query($cxn, $query);
			}
			
			//get Thursday Night's attendance
			$selected = $_REQUEST['th_night'];
			foreach($selected as $value)
			{
				$query = "UPDATE attendance SET th_night='1' WHERE hvzid='".$value."'";
				mysqli_query($cxn, $query);
			}
			
			
			echo "Attendance Set";
	
		return;
		
	}// end function ##############################################
	
	function viewperfect()
	{
		global $cxn;
		
		$query = "SELECT * FROM attendance WHERE m_day='1' AND m_night='1' AND t_day='1' AND t_night='1' AND w_day='1' AND w_night='1' AND th_day='1' AND th_night='1'";
		$result = mysqli_query($cxn, $query);
		?>
        <table width="100%" border="0">
			<tr>
            	<td>hvzid</td>
            	<td>Name</td>
                <td>Attended All?</td>
            </tr>
        <?php
		if(mysqli_num_rows($result) == 0)
		{
			?>
            <tr>
            	<td align="center" colspan="3">No one has perfect attendance</td>
            </tr>
            <?php	
		}
		else
		{
			while($row = mysqli_fetch_assoc($result))
			{
				?>
				<tr>
					<td><?php echo $row['hvzid'];?></td>
					<td><a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/profile.php?view=profile&hvzid=<?php echo $row['hvzid'];?>" class="playerinfo"><?php echo $row['firstname']." ".$row['lastname'];?></a></td>
					<td>Yes</td>
				</tr>
				<?php
			}//ends while
		}//end else
		?>
        	<tr>
            	<td colspan="3">You need to buy <span style="font-weight:bold; color:#CC0000;"><?php echo mysqli_num_rows($result);?></span> patches.</td>
		</table>
        <?php
		return;
	}// end function ##########################################