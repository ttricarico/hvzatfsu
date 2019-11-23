<?php //basic page stuff
	define('hvz', 1);	//prevent hacking to sub pages
	session_start();
	if(function_exists('ini_set'))//disable session id in url
	{
	   //Use cookies to store the session ID on the client side
	   @ini_set ('session.use_only_cookies', 1);
	   //Disable transparent Session ID support
	   @ini_set ('session.use_trans_sid',    0);
	}	
	
	//header time!
	header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	header ('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
	header ('Cache-Control: no-cache, must-revalidate'); // HTTP/1.1
	header ('Pragma: no-cache'); // HTTP/1.0
	
	/*****Header Stuff*****/
	global $title;
		$title = ":: Constitution";
		include('php/header.php');
		
	/****MySQL Login***/
	include('php/settings.php');
		global $cxn;
		$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
	
	htmlheader();


?>
    
    <link rel="stylesheet" href="styles/const.css" type="text/css" />



<?php visheader(); ?>


      <div id="content">
   
   <div id="talk">	<!-- if the computer has anything important for the player, it goes here-->
   	<?php 
   			if(isset($_REQUEST['talk']))
			{
				$talk = $_REQUEST['talk'];
				
				echo $talk.PHP_EOL;
				echo "<hr size=\"1px\" width=\"80%\" />".PHP_EOL;
			} 
		?>
     </div>	<!--end talk-->
     <a name="top"></a>
     <div id="constinfo"> <img src="images/icons/PDF.gif" align="absbottom"><a href="apps/constitution.pdf" class="helplinks" target="_blank">Download PDF Format</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Created: June 1, 2010 | Ratified: </div>
     <blockquote>
       <p class="title"><strong>Constitution of Humans versus Zombies at  The Florida State University</strong></p>
       <p class="articletitle">Article I &ndash; Organization Name</p>
       <p>This organization shall be called  Humans versus Zombies at The Florida State University. This organization may  also call itself &lsquo;HvZ at FSU&rsquo;. The organization may also call itself &lsquo;Humans  vs. Zombies at Florida State&rsquo;.</p>
       <p class="articletitle">Article II &ndash; Organization  Purpose</p>
       <p class="sectioncontent">All activities and functions of  HvZ at FSU shall be legal under university, state, and federal laws. The  purpose of this organization is to promote healthy living in the form of  alternative exercise and entertainment for the general population of Florida  State. </p>
       <p class="articletitle">Article III &ndash; Membership  Requirements</p>
       
       <p class="sectiontitle">Section 1: Membership Statement</p>
         <p class="sectioncontent">Membership is limited to all  students who are enrolled with The Florida State University, Tallahassee  Community College, Florida Agricultural and Mechanical University, Keiser  University, Lively Technical School, or Alumni of the aforementioned schools.  Students must be members of the nearest Humans vs. Zombies chapter. </p>
       
       <p class="sectiontitle">Section 2: Hazing</p>
           <p class="sectioncontent">
       		 <strong>No hazing or discrimination  will be used as a condition of membership in this organization. Any and all  hazing within this organization is therefore banned indefinitely.</strong>       </p>
       
       <p class="sectiontitle">Section 3: Discrimination</p>
           <p class="sectioncontent">
       		 <strong>No university student may be  denied membership on the basis of race, creed, color, sex, sexual orientation,  religion, national origin, age, disability, veteran, marital, or parental  status, or any protected status. </strong>       </p>
       <p class="sectiontitle">Section 4: Recruitment</p>
       <p class="sectioncontent">Recruitment  shall take place throughout the semester and membership is open at all times.</p>
       
       <p class="sectiontitle">Section 5: Revocation of Membership</p>
         <p class="sectioncontent">Membership may be revoked without mutual agreement for  non-participation, misconduct, or violations of any provisions of the constitution.  Membership will be revoked for extreme circumstances. Officers will vote on  whether someone will be revoked of their membership.</p>
         
       <p class="sectiontitle">Section 6: Appeal Process</p>
         <p class="sectioncontent">Any student whose membership is revoked will have seven (7)  calendar days to appeal the revocation. The appeal must be submitted in writing  to the Official Board and must include any relevant information that has not  already been presented. The officers will then create an Appeals Committee  which will consist of the current officers and an equal number of referees.  This committee will then render a decision at the next meeting. </p>
         
       <p class="articletitle">Article IV &ndash; Officers</p>
       
       <p class="sectiontitle">Section 1: Eligibility</p>
         <p class="sectioncontent">All officers of  HvZ at FSU shall be enrolled at least part time at The Florida State University  with a minimum GPA of 2.0 and at least six (6) credit hours for undergraduates,  and at least one (1) credit hour for graduate students. All officers must meet  the eligibility in Article V.</p>
         
       <p class="sectiontitle">Section 2: Titles and Duties</p>
       <p class="sectioncontent">
       <ul class="officers">
       		<li>Overview</li>
            <ul class="desc">
         		<li>All officers of  this organization can only hold one position at one time. This organization  shall have at least a President, a Public Relations Chair, a Treasurer, and a Secretary.</li>
            </ul>
        	<li>President shall:
           <ul class="desc">
             <li>Preside over all official meetings and call the  meetings to order.</li>
             <li>Be one of two signers on financial documents.</li>
             <li>Ensure all officers are performing their duties  as defined in this constitution.</li>
             <li>Have the ability to assign special projects to  other officers and referees.</li>
           </ul>
       <li>The Secretary  shall:</li>
           <ul class="desc">
             <li>Keep an accurate record of all meetings.</li>
             <li>Prepare ballots for elections.</li>
             <li>Keep a copy of the constitution at all meetings  available at request.</li>
             <li>Review all reports from the Treasurer</li>
           </ul>
         <li>The Treasurer shall:</li>
             <ul class="desc">
               <li>Maintain an accurate record of all financial  transactions.</li>
               <li>Be one of two signers on all financial  documents.</li>
               <li>Complete a detailed monetary report per each  semester end.</li>
               <li>Complete a monetary report on request of any  officer, or a Florida State University Faculty or Staff Member.</li>
               <li>Be in charge of collecting dues and notifying  delinquent members.</li>
             </ul>
         <li>The Public Relations Chair shall:</li>
             <ul class="desc">
               <li>Assign a webmaster to maintain the HvZ at FSU  website.</li>
               <li>Have the final say in all advertising campaigns  and ideas.</li>
               <li>Have the ability to assign advertising projects  to members.</li>
               <li>Works closely with the Treasurer to create an  advertising budget.</li>
             </ul>
       </ul>
       </p>
       
       <p class="articletitle">Article V &ndash; Selection of  Officers</p>
       <p class="sectiontitle">Section 1: Eligibility to Vote and Hold Office</p>
         <p class="sectioncontent">Active voting membership will be limited to all students who  are participating members in good standing with a comprehension of the rules.  Only active voting members who meet the requirements stated in Article IV,  Section 1 are eligible to hold offices. If an officer has resigned from a  position in the past and did not submit a resignation letter, they are  ineligible to hold office.</p>
         
       <p class="sectiontitle">Section 2: Nomination Process</p>
         <p class="sectioncontent">The nomination  of officers will occur during a &lsquo;Referee Interest and Voting Meeting&rsquo; which  will be announced at least two weeks before the actual meeting. The Referee  Interest and Voting Meeting will take place the week before the final game in  April. The current and future referees and officers will vote on who will  become the next set of officers.</p>
  
 <p class="sectiontitle">Section 3: Election Process</p>
         <p class="sectioncontent">All members  present at the &lsquo;Referee Interest and Voting Meeting&rsquo; are eligible for an  officer position if they meet the eligibility as defined in Article V Section  1. All members at the &lsquo;Referee Interest and Voting Meeting&rsquo; will then vote on  the next officers. The members will vote by secret ballot, which will be  counted by the secretary.</p>
         
       <p class="sectiontitle">Section 4: Term of Office</p>
  <p class="sectioncontent">All  officers hold a term of one calendar year. </p>
  
       <p class="articletitle">Article VI &ndash; Officer Vacancies</p>
       <p class="sectiontitle">Section 1: Removal of Officers</p>
         <p class="sectioncontent">Any officer with  less than six (6) credit hours for undergraduates, or less than one (1) credit  hour for graduates, or that has less than a 2.0 GPA will be removed from  office. Any officer that does not fulfill the duties set forth in Article IV  Section 2 can be removed by majority vote of all officers and referees.</p>
         
       <p class="sectiontitle">Section 2: Process of Removal of Officers</p>
         <p class="sectioncontent">Any officer  which may be removed will be notified at least one (1) week in advance and will  be allowed to present their case to the officers at the next meeting. The  current officers and referees will then vote on the removal with a super  majority. Eligible members may submit complaints in writing to the Public  Relations Chair.</p>
         
  <p class="sectiontitle">Section 3: Resignation</p>
         <p class="sectioncontent">An officer may  decide to resign from their position at any time. The officer that wishes to  resign must submit a written resignation letter to the Public Relations Chair  at least two weeks before they will resign. If they do not submit a resignation  letter, they are ineligible to run as an officer again.</p>
         
       <p class="sectiontitle">Section 4: Filling Vacant Officer Positions</p>
         <p class="sectioncontent">If an officer  resigns, the current officers and referees will then vote on who will fill that  officer position. The position will be filled by someone who is a current  referee.</p>
         
       <p class="articletitle">Article VII &ndash; Advisor</p>
       
       <p class="sectiontitle">Section 1: Advisor Selection</p>
          <p class="sectioncontent">The advisor must  be a full-time employee of The Florida State University. The advisor must be a  faculty or staff member. </p>
         
       <p class="sectiontitle">Section 2: Advisor Role</p>
         <p class="sectioncontent">The advisor must  give guidance or assistance to this organization and must monitor the officer  positions, if requested. </p>
         
       <p class="sectiontitle">Section 3: Advisor Removal</p>
         <p class="sectioncontent">If at any time  the advisor is no longer a Florida State University Faculty or Staff Member,  the advisor will be removed immediately and a new one will be selected. If the  advisor does not do his or her job as outlined in Article VII Section 2, the  advisor may be removed by a majority vote of both the officers and referees.</p>
         
       <p class="articletitle">Article VIII &ndash; Finances</p>
       
  <p class="sectiontitle">Section 1:</p>
         <p class="sectioncontent">No university  student may be denied membership due to inability to pay dues. If a member is  not able to pay dues, other arrangements will be made. No member will be  removed from this organization if they cannot pay dues. Proof of financial  hardship may be requested for by the Treasurer, President, Public Relations  Chair, or Secretary.</p>
       <p class="sectiontitle">Section 2: Membership Dues</p>
         <p class="sectioncontent">Membership dues  will be set at three (3) dollars per game. Membership dues will be collected  during the week before the scheduled games. If unable to pay dues, a student  will not be removed from membership, as stated in Article VIII Section 1.  However, if a student does not have a viable proof, they will not be allowed to  participate in the HvZ at FSU sponsored events.</p>
         
       <p class="sectiontitle">Section 3: Spending the Organization&rsquo;s Money</p>
         <p class="sectioncontent">For the protection of the organization and its officers it  is required that two authorized signatures sign all monetary transactions. Only  the President, and Treasurer can be signers on the organization&rsquo;s account.  Organizational funds may be spent on items such as office supplies,  events/activities, publicity, travel expenses, conference fees, etc., but will  not be used for anything illegal under University, local, state, and federal  laws.</p>
         
       <p class="sectiontitle">Section 4: Other Financial Matters</p>
         <p class="sectioncontent">A report of all  financial expenses and incomes must be prepared by the Treasurer each semester  and presented to both the President, Secretary, and Public Relations Chair.  This report must include, but not limited to the following:</p>
       <ul class="desc">
         <ul>
           <li>All membership dues received and processed,</li>
           <li>All expenses for that semester,</li>
           <li>All members who have not paid dues for that semester,</li>
           <li>Any other miscellaneous fees or incomes.</li>
         </ul>
       </ul>
       <p class="sectiontitle">Section 5: Dissolution of Organization</p>
         <p class="sectioncontent">If at any time  this organization falls below ten (10) members, this organization will be  dissolved and all money will be donated to the Leon County Humane Society.</p>
       
       <p class="articletitle">Article IX &ndash; Meetings</p>
       <p class="sectioncontent">All available  officers and referees must attend meetings. Any players that have any  legitimate concerns or comments may attend athe meetings. Members shall be  notified of meetings at least forty-eight (48) hours in advance.</p>
       
       <p class="articletitle">Article X &ndash; Squad Wars</p>
       
 <p class="sectioncontent"> &lsquo;Squad Wars&rsquo;  operates as a subsidiary to &lsquo;HvZ at FSU.&rsquo; Players must comply with the same  code of conduct and requirements for membership as in HvZ at FSU to join Squad  Wars. The parent group of Squad Wars, HvZ at FSU, has the authority to disband the  membership of Squad Wars at any time, with or without notice.</p>
  
       <p class="articletitle">Article XI &ndash; Future Related Groups</p>
        <p class="sectioncontent"> Any other group  at Florida State University that wishes to use this organization&rsquo;s resources  must become a subsidiary of HvZ at FSU. Resources include, but are not limited  to: bandannas, dart blasters, or any sort of monetary aid.</p>
         
       <p class="articletitle">Article XII &ndash; Publications</p>
       <p class="sectiontitle">Section 1: Compliance</p>
         <p class="sectioncontent">All  advertisements or notices posted for this organization must comply with the  Florida State University Posting Policy (http://posting.fsu.edu).<br>
  <p class="sectiontitle">Section 2: Approval</p>
         <p class="sectioncontent">The Public  Relations Chair of this organization must approve of all publications,  t-shirts, logos, website additions or modifications, flyers, signs, etc. Any  publication that is not approved must be fixed to the Public Relations Chair&rsquo;s  specifications and then resubmitted at the next meeting. No publication may be  processed or distributed without Public Relations Chair approval.</p>
         
       <p class="articletitle">Article XIII &ndash; Amendments</p>
       <p class="sectioncontent">Amendments to the constitution must be proposed in writing  to the President. The amendment must then be presented to the organization  during a scheduled meeting and should include a full explanation and/or  rationale for the amendment. The amendment must be voted on at the next  scheduled meeting. The amendment shall not take effect until approved by a 2/3  majority vote of eligible members of the organization present. The President  may veto an amendment, in which case, the amendment must be revised and may be  resubmitted for voting.</p>
       
       <p class="articletitle">Article XIV &ndash; Constitution  History</p>
       <p class="sectioncontent">All amendments must include the  date which they are ratified. Any amendments without the date included are deemed invalid, and must be resubmitted.</p>
     </blockquote>
     <br />
     <p class="sectioncontent">^<a href="#top" class="helplinks">Back to Top</a></p>
     <br class="clearfloat" />
     <br /><br /><br /><br />
 </div><!--end content-->
	
  <?php include('includes/php/footer.php'); ?>

<br class="clearfloat" />

</div> <!--end frame-->
<br /><br /><br /><br />
</body>
</html>
<?php mysqli_close($cxn);?>