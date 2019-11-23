<?php	session_start();

	$action = $_REQUEST['action'];
	
	include('php/settings.php');
		global $cxn;
		$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);

	include('php/header.php');
		
		htmlheader();


	
	visheader(); ?>
  
  
  
  <div id="content">
   
   <div id="talk">	<!-- if the computer has anything important for the player, it goes here-->
   	<?php if(isset($_REQUEST['talk']))
			{
				$talk = $_REQUEST['talk'];
				
				echo $talk.PHP_EOL;
				echo "<hr size=\"1px\" width=\"80%\" />".PHP_EOL;
			} 
		?>
    </div>	
     <!--end talk-->
     

<div class=WordSection1>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
line-height:normal;mso-outline-level:1'><b><span style='font-size:24.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white;mso-font-kerning:
18.0pt'>RULE #1: USE COMMON SENSE AND BE RESPECTFUL!!!<o:p></o:p></span></b></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><span style='font-size:10.0pt;font-family:"Verdana","sans-serif";
mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:"Times New Roman";
color:black;background:white'><br>
In other words, Don't Be A Douchebag!!!</span><span style='font-size:10.0pt;
font-family:"Times New Roman","serif";mso-fareast-font-family:"Times New Roman"'><o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
line-height:normal'><b><span style='font-size:10.0pt;font-family:"Verdana","sans-serif";
mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:"Times New Roman";
color:black;background:white'>Game overview (taken from humansvszombies.org)</span></b><b><span
style='font-size:12.0pt;font-family:"Times New Roman","serif";mso-fareast-font-family:
"Times New Roman"'><o:p></o:p></span></b></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
line-height:normal'><span style='font-size:10.0pt;font-family:"Verdana","sans-serif";
mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:"Times New Roman";
color:black;background:white'>Humans vs. Zombies (<span class=SpellE>HvZ</span>)
is a game of moderated tag commonly played on college campuses. A group of
human players attempts to survive a "zombie outbreak" by outsmarting an
ever-growing group of zombie players.<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
line-height:normal;mso-outline-level:3'><b><span style='font-size:13.5pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>Area of
Play:<o:p></o:p></span></b></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><b><span style='font-size:10.0pt;font-family:"Verdana","sans-serif";
mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:"Times New Roman";
color:black;background:white'>Safe Zones</span></b><span style='font-size:10.0pt;
font-family:"Times New Roman","serif";mso-fareast-font-family:"Times New Roman"'><o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
line-height:normal'><span style='font-size:10.0pt;font-family:"Verdana","sans-serif";
mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:"Times New Roman";
color:black;background:white'>Safe zones are areas in which players cannot be tagged.</span><span
style='font-size:12.0pt;font-family:"Times New Roman","serif";mso-fareast-font-family:
"Times New Roman"'><o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><span style='font-size:10.0pt;font-family:"Verdana","sans-serif";
mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:"Times New Roman";
color:black;background:white'>These include:</span><span style='font-size:12.0pt;
font-family:"Times New Roman","serif";mso-fareast-font-family:"Times New Roman"'><o:p></o:p></span></p>

<ul type=disc>
 <li class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
     line-height:normal;mso-list:l4 level1 lfo1;tab-stops:list .5in'><span
     style='font-size:10.0pt;font-family:"Verdana","sans-serif";mso-fareast-font-family:
     "Times New Roman";mso-bidi-font-family:"Times New Roman";color:black;
     background:white'>All school buildings</span><span style='font-size:12.0pt;
     font-family:"Times New Roman","serif";mso-fareast-font-family:"Times New Roman"'><o:p></o:p></span></li>

 <li class=MsoNormal style='color:black;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;line-height:normal;mso-list:l4 level1 lfo1;tab-stops:list .5in'><span
     style='font-size:10.0pt;font-family:"Verdana","sans-serif";mso-fareast-font-family:
     "Times New Roman";mso-bidi-font-family:"Times New Roman";background:white'>Dorms<o:p></o:p></span></li>
 <li class=MsoNormal style='color:black;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;line-height:normal;mso-list:l4 level1 lfo1;tab-stops:list .5in'><span
     style='font-size:10.0pt;font-family:"Verdana","sans-serif";mso-fareast-font-family:
     "Times New Roman";mso-bidi-font-family:"Times New Roman";background:white'>Parking
     Garages<o:p></o:p></span></li>
</ul>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
line-height:normal'><span style='font-size:10.0pt;font-family:"Verdana","sans-serif";
mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:"Times New Roman";
color:black;background:white'>Dart blasters may not be used within safe zones.
Any shots fired inside of or out of safe zones do not count.<o:p></o:p></span></p>

<ul type=disc>
 <li class=MsoNormal style='color:black;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;line-height:normal;mso-list:l3 level1 lfo2;tab-stops:list .5in'><span
     style='font-size:10.0pt;font-family:"Verdana","sans-serif";mso-fareast-font-family:
     "Times New Roman";mso-bidi-font-family:"Times New Roman";background:white'>While
     in safe zones, dart blasters must be concealed at all times.<o:p></o:p></span></li>
 <li class=MsoNormal style='color:black;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;line-height:normal;mso-list:l3 level1 lfo2;tab-stops:list .5in'><span
     style='font-size:10.0pt;font-family:"Verdana","sans-serif";mso-fareast-font-family:
     "Times New Roman";mso-bidi-font-family:"Times New Roman";background:white'>Stuns
     in safe zones can only be made with socks thrown in a manner that does not
     violate any other rules (especially Rule #1).<o:p></o:p></span></li>

 <li class=MsoNormal style='color:black;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;line-height:normal;mso-list:l3 level1 lfo2;tab-stops:list .5in'><span
     style='font-size:10.0pt;font-family:"Verdana","sans-serif";mso-fareast-font-family:
     "Times New Roman";mso-bidi-font-family:"Times New Roman";background:white'>The
     Union is a safe zone from 6am-6pm under any overhang and in the main Union
     courtyard, including the small courtyard by the post office.<o:p></o:p></span></li>
 <li class=MsoNormal style='color:black;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;line-height:normal;mso-list:l3 level1 lfo2;tab-stops:list .5in'><span
     style='font-size:10.0pt;font-family:"Verdana","sans-serif";mso-fareast-font-family:
     "Times New Roman";mso-bidi-font-family:"Times New Roman";background:white'>A
     player must have two feet inside the doorway of a safe zone in order to be
     considered safe.<o:p></o:p></span></li>
</ul>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><span style='font-size:10.0pt;font-family:"Verdana","sans-serif";
mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:"Times New Roman";
color:black;background:white'>NO-PLAY zones:</span><span style='font-size:12.0pt;
font-family:"Times New Roman","serif";mso-fareast-font-family:"Times New Roman"'><o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
line-height:normal'><span style='font-size:10.0pt;font-family:"Verdana","sans-serif";
mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:"Times New Roman";
color:black;background:white'>No-play zones are areas in which game-play does
not occur.&nbsp;<br>
These include:</span><span style='font-size:12.0pt;font-family:"Times New Roman","serif";
mso-fareast-font-family:"Times New Roman"'><o:p></o:p></span></p>

<ul type=disc>

 <li class=MsoNormal style='color:black;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;line-height:normal;mso-list:l1 level1 lfo3;tab-stops:list .5in'><span
     style='font-size:10.0pt;font-family:"Verdana","sans-serif";mso-fareast-font-family:
     "Times New Roman";mso-bidi-font-family:"Times New Roman";background:white'>Classrooms
     (whether they be indoor or outdoor) while class is in session.<o:p></o:p></span></li>
 <li class=MsoNormal style='color:black;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;line-height:normal;mso-list:l1 level1 lfo3;tab-stops:list .5in'><span
     style='font-size:10.0pt;font-family:"Verdana","sans-serif";mso-fareast-font-family:
     "Times New Roman";mso-bidi-font-family:"Times New Roman";background:white'>Events
     sponsored by SGA, Campus Recreation, and Union Productions.<o:p></o:p></span></li>
 <li class=MsoNormal style='color:black;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;line-height:normal;mso-list:l1 level1 lfo3;tab-stops:list .5in'><span
     style='font-size:10.0pt;font-family:"Verdana","sans-serif";mso-fareast-font-family:
     "Times New Roman";mso-bidi-font-family:"Times New Roman";background:white'>Libraries<o:p></o:p></span></li>
 <li class=MsoNormal style='color:black;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;line-height:normal;mso-list:l1 level1 lfo3;tab-stops:list .5in'><span
     style='font-size:10.0pt;font-family:"Verdana","sans-serif";mso-fareast-font-family:
     "Times New Roman";mso-bidi-font-family:"Times New Roman";background:white'>Balcony
     of HCB<o:p></o:p></span></li>
</ul>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
line-height:normal'><span style='font-size:10.0pt;font-family:"Verdana","sans-serif";
mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:"Times New Roman";
color:black;background:white'>Like safe zones, in no-play zones dart blasters
must be concealed at all times.<br>
No tags or stuns may occur in no-play zones (even with socks).<br>

Players may not communicate with active players while they are inside a no-play
zone.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><span style='font-size:10.0pt;font-family:"Verdana","sans-serif";
mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:"Times New Roman";
color:black;background:white'>Human Rules</span><span style='font-size:12.0pt;
font-family:"Times New Roman","serif";mso-fareast-font-family:"Times New Roman"'><o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:5.0pt;line-height:normal'><span
style='font-size:10.0pt;font-family:"Verdana","sans-serif";mso-fareast-font-family:
"Times New Roman";mso-bidi-font-family:"Times New Roman";color:black;
background:white'>FSU <span class=SpellE>HvZ</span> bandanas must be worn on
the upper arm at all times while on campus (including safe zones). A human
player that is not wearing a bandanna may still be tagged if recognized by a
zombie player, unless that player is in a no-play zone or safe zone. Bandanas
may be removed in no-play zones.</span><span style='font-size:12.0pt;
font-family:"Times New Roman","serif";mso-fareast-font-family:"Times New Roman"'><o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:5.0pt;line-height:normal'><span
style='font-size:10.0pt;font-family:"Verdana","sans-serif";mso-fareast-font-family:
"Times New Roman";mso-bidi-font-family:"Times New Roman";color:black;
background:white'>The supplied 3x5 index card with your name and player ID
(written legibly) must be carried at all times. Moderators WILL randomly check
for these cards.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:5.0pt;line-height:normal'><span
style='font-size:10.0pt;font-family:"Verdana","sans-serif";mso-fareast-font-family:
"Times New Roman";mso-bidi-font-family:"Times New Roman";color:black;
background:white'>If a moderator asks you for your ID card, you must provide
it. Failure to do so will result in a yellow card.<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
line-height:normal'><span style='font-size:10.0pt;font-family:"Verdana","sans-serif";
mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:"Times New Roman";
color:black;background:white'>Humans may stun zombies in the following ways:<o:p></o:p></span></p>

<ul type=disc>
 <li class=MsoNormal style='color:black;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;line-height:normal;mso-list:l2 level1 lfo4;tab-stops:list .5in'><span
     style='font-size:10.0pt;font-family:"Verdana","sans-serif";mso-fareast-font-family:
     "Times New Roman";mso-bidi-font-family:"Times New Roman";background:white'>Firing
     an approved dart blaster or blowgun (see Safety Rules)<o:p></o:p></span></li>
 <li class=MsoNormal style='color:black;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;line-height:normal;mso-list:l2 level1 lfo4;tab-stops:list .5in'><span
     style='font-size:10.0pt;font-family:"Verdana","sans-serif";mso-fareast-font-family:
     "Times New Roman";mso-bidi-font-family:"Times New Roman";background:white'>Throwing
     a sock.<o:p></o:p></span></li>
</ul>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
line-height:normal'><span style='font-size:10.0pt;font-family:"Verdana","sans-serif";
mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:"Times New Roman";
color:black;background:white'>Once tagged, human players must remove their
armband and get rid of their blaster or socks.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><span style='font-size:10.0pt;font-family:"Verdana","sans-serif";
mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:"Times New Roman";
color:black;background:white'>Zombie Rules</span><span style='font-size:12.0pt;
font-family:"Times New Roman","serif";mso-fareast-font-family:"Times New Roman"'><o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>FSU <span
class=SpellE>HvZ</span> bandanas must be worn on the head at all times while on
campus (including safe zones). A zombie player that is not wearing a bandanna
may still be stunned if recognized by a human player. Bandannas may be removed
in no-play zones.</span><span style='font-size:12.0pt;font-family:"Times New Roman","serif";
mso-fareast-font-family:"Times New Roman"'><o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>A stunned
zombie must completely remove their bandanna from their body.<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:7.5pt;line-height:normal'><span style='font-size:10.0pt;font-family:
"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:
"Times New Roman";color:black;background:white'>If a player is not logged as a
zombie on hvzatfsu.com within 3 hours of being tagged, they may return to
playing as a human.<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>If a
player makes any tags, they forfeit their ability to return to the human team.<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>Zombies
may collect darts if there are no humans collecting darts in the area.<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>Zombies
may not carry or use blasters or socks.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><span style='font-size:10.0pt;font-family:"Verdana","sans-serif";
mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:"Times New Roman";
color:black;background:white'>Original Zombies</span><span style='font-size:
12.0pt;font-family:"Times New Roman","serif";mso-fareast-font-family:"Times New Roman"'><o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>Fair rules
for original zombies will be decided on by moderators and revealed to the OZ's
on a game-to-game basis.</span><span style='font-size:12.0pt;font-family:"Times New Roman","serif";
mso-fareast-font-family:"Times New Roman"'><o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>Original
Zombies CAN masquerade as humans.<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>OZ's can
wear a bandanna as an armband or headband, but must wear a bandanna<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>OZ's can
be stunned in the same manner as any normal zombie.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><span style='font-size:10.0pt;font-family:"Verdana","sans-serif";
mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:"Times New Roman";
color:black;background:white'>Safety Rules</span><span style='font-size:12.0pt;
font-family:"Times New Roman","serif";mso-fareast-font-family:"Times New Roman"'><o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>Blasters
must be concealed while indoors (do not use garbage bags to do so).</span><span
style='font-size:12.0pt;font-family:"Times New Roman","serif";mso-fareast-font-family:
"Times New Roman"'><o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>No
military or paramilitary patches, symbols or insignias may be worn<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>Players
may not jump from trees in order to get tags.<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>No full
camouflage outfits (fatigues, hunting gear, <span class=SpellE>ghillie</span>
suits, etc.) may be worn<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>Only one
article of camouflage clothing may be worn.<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>No face
coverings or helmets (including costumes with masks) may be worn.<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>Premade
Tactical gear may not be worn during the day.<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>Players
may not impede pedestrian traffic at any point.<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:7.5pt;line-height:normal'><span style='font-size:10.0pt;font-family:
"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:
"Times New Roman";color:black;background:white'>Streets<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>Players
are to avoid playing in or near streets.<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>Do not run
into streets.<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>Zombies
are not to attack humans crossing streets.<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:7.5pt;line-height:normal'><span style='font-size:10.0pt;font-family:
"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:
"Times New Roman";color:black;background:white'>Vehicles<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>Players
are considered out of the game while using vehicles and cannot be stunned or
tagged. After exiting or dismounting a vehicle, zombies are stunned for the
regular ten minutes, and must remove their headband. Humans can use vehicles in
order to get to class. If a human shows up to a checkpoint or mission on a
vehicle, you will not receive attendance for that mission. Any players found
violating this rule will receive a red card.<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>Vehicles
include<o:p></o:p></span></p>

<ul type=disc>

 <li class=MsoNormal style='color:black;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;line-height:normal;mso-list:l0 level1 lfo5;tab-stops:list .5in'><span
     style='font-size:10.0pt;font-family:"Verdana","sans-serif";mso-fareast-font-family:
     "Times New Roman";mso-bidi-font-family:"Times New Roman";background:white'>Automobiles<a
     name="_GoBack"></a><o:p></o:p></span></li>
 <li class=MsoNormal style='color:black;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;line-height:normal;mso-list:l0 level1 lfo5;tab-stops:list .5in'><span
     style='font-size:10.0pt;font-family:"Verdana","sans-serif";mso-fareast-font-family:
     "Times New Roman";mso-bidi-font-family:"Times New Roman";background:white'>Skateboards<o:p></o:p></span></li>
 <li class=MsoNormal style='color:black;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;line-height:normal;mso-list:l0 level1 lfo5;tab-stops:list .5in'><span
     style='font-size:10.0pt;font-family:"Verdana","sans-serif";mso-fareast-font-family:
     "Times New Roman";mso-bidi-font-family:"Times New Roman";background:white'>Bicycles<o:p></o:p></span></li>
 <li class=MsoNormal style='color:black;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;line-height:normal;mso-list:l0 level1 lfo5;tab-stops:list .5in'><span
     style='font-size:10.0pt;font-family:"Verdana","sans-serif";mso-fareast-font-family:
     "Times New Roman";mso-bidi-font-family:"Times New Roman";background:white'>Longboards<o:p></o:p></span></li>
 <li class=MsoNormal style='color:black;mso-margin-top-alt:auto;mso-margin-bottom-alt:
     auto;line-height:normal;mso-list:l0 level1 lfo5;tab-stops:list .5in'><span
     style='font-size:10.0pt;font-family:"Verdana","sans-serif";mso-fareast-font-family:
     "Times New Roman";mso-bidi-font-family:"Times New Roman";background:white'>Any
     other form of transportation<o:p></o:p></span></li>
</ul>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:7.5pt;line-height:normal'><span style='font-size:10.0pt;font-family:
"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:
"Times New Roman";color:black;background:white'>Blowguns<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>Streamlines,
whistler darts, and Velcro guns with the Velcro removed are the only darts
allowed with blowguns.<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>If a
player uses a blowgun in a manner deemed unsafe, the offending player will be
yellow carded and they will be banned from using blowguns. This includes but is
not limited to aiming for the head.<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:7.5pt;line-height:normal'><span style='font-size:10.0pt;font-family:
"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:
"Times New Roman";color:black;background:white'>Modified Dart Blasters<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>Dart
Blasters may be modified. However, they may not be able to leave a mark when
fired at point blank range. Mods will randomly check guns during the game.<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>Dart
blasters may not be made to look realistic in any way. This includes painting
the gun with <span class=SpellE>camo</span>, dark colors, or metallic colors.<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>All dart
blasters must have orange tips. This is a federal law.<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>Moderators
have the final say as to which blasters are allowed and which are not.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal'><span style='font-size:12.0pt;font-family:"Times New Roman","serif";
mso-fareast-font-family:"Times New Roman"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:7.5pt;line-height:normal'><span style='font-size:10.0pt;font-family:
"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:
"Times New Roman";color:black;background:white'>Modified Dart</span><span
style='font-size:12.0pt;font-family:"Times New Roman","serif";mso-fareast-font-family:
"Times New Roman"'><o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>The only
modifications that may be made to darts are marking them (no profanity), taping
them, and removing the Velcro from tagger darts.<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
line-height:normal'><span style='font-size:10.0pt;font-family:"Verdana","sans-serif";
mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:"Times New Roman";
color:black;background:white'><span style='mso-spacerun:yes'>  </span>Modified
Socks<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>Socks may
be marked with the player's name.<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:7.5pt;line-height:normal'><span style='font-size:10.0pt;font-family:
"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:
"Times New Roman";color:black;background:white'>Mission Rules:<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>No player
may enter a safe zone during a mission. If any player (zombie or human) enters
a safe zone during a mission without moderator approval, they can no longer
participate in the night's mission.<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>No player
may use a vehicle during a mission.<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>Tags made
during missions must be logged before 2am, which is 3 hours from the end of
mission time.<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>If any
player wants to enter a building during a mission to get water, they must get
permission from the nearest moderator.<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>Zombies
who are stunned during mission times must remove their bandannas, stay in
place, and kneel.<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>One piece
of premade tactical gear may be worn during missions. Tactical gear includes
holsters, vests, bags, etc.<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:7.5pt;line-height:normal'><span style='font-size:10.0pt;font-family:
"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:
"Times New Roman";color:black;background:white'>Card System:<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>Breaking
any of these rules will result in a yellow card.<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>A player
will receive a red card for a severe offence or after receiving two yellow
cards.<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>A red card
means you are banned from the current game.<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>A player
who receives a red card will automatically begin the next game with a yellow
card.<o:p></o:p></span></p>

<p class=MsoNormal style='mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-indent:11.25pt;line-height:normal'><span style='font-size:10.0pt;
font-family:"Verdana","sans-serif";mso-fareast-font-family:"Times New Roman";
mso-bidi-font-family:"Times New Roman";color:black;background:white'>If a
player receives two red cards, they will then receive a blue card and will be
banned from the game permanently.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:12.0pt;line-height:normal'><span
style='font-size:12.0pt;font-family:"Times New Roman","serif";mso-fareast-font-family:
"Times New Roman"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal align=center style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
auto;text-align:center;line-height:normal;mso-outline-level:2'><b><span
style='font-size:18.0pt;font-family:"Verdana","sans-serif";mso-fareast-font-family:
"Times New Roman";mso-bidi-font-family:"Times New Roman";color:black;
background:white'>Moderators have final say in any dispute during gameplay.
Moderators may change these rules at any time to improve gameplay.</span></b><b><span
style='font-size:18.0pt;font-family:"Times New Roman","serif";mso-fareast-font-family:
"Times New Roman"'><o:p></o:p></span></b></p>

<p class=MsoNormal><o:p>&nbsp;</o:p></p>

</div>
 
    <!--end content-->
    
    <?php include('php/footer.php'); ?>
  
  

<?php mysqli_close($cxn);?>
</body>
</html>
