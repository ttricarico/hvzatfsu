<?php

	function display_playerrules()
	{
		global $cxn;
			$query = "SELECT context FROM content WHERE pagefor='rules'";
			if ($stmt = mysqli_prepare($cxn, $query)) {
				mysqli_stmt_execute($stmt);
			
				/* bind variables to prepared statement */
				mysqli_stmt_bind_result($stmt, $context);
			
				
				
				/* fetch values */
				while (mysqli_stmt_fetch($stmt)) {
			echo $context;						
				}
		
					/* close statement */
					mysqli_stmt_close($stmt);
			}	
		
		return;
	}//end function

function display_modrules()
{
	echo " <span class=\"modrules\"><a href=\"rules.php?view=playerrules\" class=\"modrules\">Back to the player rules.</a></span>
	  <h2><center>Moderator Rules</center></h2>
    <blockquote>Any personal problems between officers/refs are to only be discussed   during de-briefs and specially allotted meetings, not during the HVZ   games/skirmishes or in front of players and all personal (non HVZ   issues) are to be kept out of the HVZ pool.  Also, officers/refs are to   be honest within respects to the HVZ game.</blockquote>
    
    
    <blockquote> All officers/refs are   to have a technological way of being contacted while the game is in   session as well as during the off-season.  If you are unable to attain   such a way you must inform the rest of the officers/refs so that   arrangements can be made.  If at any time you purposely turn your device   off to avoid contact there will be consequences.</blockquote>
     <blockquote>All officers/refs are expected to   treat players with respect.  If an officer/ref is found to be cussing or   yelling at a player there will be consequences.  As officers/refs we   are expected to act with decorum within the boundaries of HVZ and to   maintain a level of calmness and clarity within our dealings with   players even if they are acting in a ridiculous manner.</blockquote>
     <blockquote>Without a legitimate excuse, any   officer/ref that misses 3 meetings will be given a warning and   eventually asked to step down.</blockquote>
     <blockquote>Anything discussed between the officers/refs in   their meetings is to stay between the officers/refs and not be discussed   with the general population or HVZ players. Failure to do so will   result in severity based on the recurrence of this event with said   mod/ref eventually asked to step down.</blockquote>
     <blockquote>During HVZ;   missions, meetings where players are present, fund raising or awareness   activities, scrimmages, or any other HVZ related event, Officers/refs   are not allowed to wear paraphernalia promoting the following but not   limited to:
       <ul>
     	 <li>Cigarettes</li>
         <li>Marijuana</li>
         <li>The promotion of illegal   drugs</li>
         <li>Alcohol</li>
         <li>Hooka</li>
     </ul>
 </blockquote>
    <blockquote>During HvZ missions, meetings where   players are present, fund raising or awareness activities, scrimmages,   or any other HvZatFSU related event, officers/refs are not allowed to smoke   hooka/cigarettes or do illegal drugs. Drink while under 21 is illegal and is banned from the moderators.</blockquote>";




	return;
}


?>