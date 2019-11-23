<?php //basic page stuff
define('hvz', 1); //prevent hacking to sub pages
session_start();
if(function_exists('ini_set'))//disable session id in url
{
//Use cookies to store the session ID on the client side
@ini_set ('session.use_only_cookies', 1);
//Disable transparent Session ID support
@ini_set ('session.use_trans_sid', 0);
}

//header time!
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header ('Cache-Control: no-cache, must-revalidate'); // HTTP/1.1
header ('Pragma: no-cache'); // HTTP/1.0

/*****Header Stuff*****/
global $title;
$title = ":: Report Kill";
include('php/header.php');

/****MySQL Login***/
include('php/settings.php');
global $cxn;
$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);

$action = $_REQUEST['action'];

$actionArray = array( //'$action=' array variables 'action name' => array('File function is in..', 'Function name')
'reportkill' => array('report', 'report_kill')
);

if (!isset($_REQUEST['action']) || !isset($actionArray[$_REQUEST['action']]))
{
//do nothing
}
else
{
$file = $actionArray[$_REQUEST['action']][0];
$function = $actionArray[$_REQUEST['action']][1];
include_once('php/'.$file.'.php');
$function();
}

htmlheader();


?>
<link rel="stylesheet" href="styles/reportkill.css" type="text/css" />

<script language="javascript">
<!--//

/*Population Retrieval*/
$(document).ready(function(){
$.ajax({
type: "GET",
url: "apps/ajax_populations.php",
dataType: "xml",
success: parsepopXml
});
});

/*Top 5 Zombie Retrieval*/
$(document).ready(function(){
$.ajax({
type: "GET",
url: "apps/ajax_top5zombies.php",
datatype: "xml",
success: parsetop5Xml
});
});

//-->
</script>
<script language="javascript">
<!--//Population Retrieval
$(document).ready(function(){
$("#updatepop").click(function(){
$.ajax({
type: "GET",
url: "apps/ajax_populations.php",
dataType: "xml",
success: parsepopXml
});
});
});

function parsepopXml(xml)
{
$(xml).find("population").each(function()
{
$("#human").html($(this).find("human").text());
$("#zombie").html($(this).find("zombie").text());
$("#date").html($(this).find("date").text());
});
}
-->
</script>
<script language="javascript">
<!--//Top 5 Zombie Retrieval
$(document).ready(function(){
$("#updatetop5").click(function(){
$.ajax({
type: "GET",
url: "apps/ajax_top5zombies.php",
dataType: "xml",
success: parsetop5Xml
});
});
});

function parsetop5Xml(xml)
{
var rownum = 1;
$(xml).find("zombie").each(function()
{
$("#z"+rownum).html($(this).find("name").text());
/*$("#z"+rownum+"pl")*///Changing profile link of playet
$("#z"+rownum+"k").html($(this).find("killnum").text());
$("#z"+rownum+"lk").html($(this).find("lastkill").text());
rownum++;
});
}
-->
</script>
<!--googlemap stuff-->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false">
</script>

<script type="text/javascript">

function updateMarkerPosition(latLng) {
document.getElementById('info').innerHTML = [
latLng.lat(),
latLng.lng()
].join(', ');
}


function initialize() {

<!-- var latlng = new google.maps.LatLng();-->


var latLng = new google.maps.LatLng(30.442643,-84.298825);


var myOptions = {
zoom: 15,
center: latLng,
mapTypeId: google.maps.MapTypeId.ROADMAP
}
var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

var marker = new google.maps.Marker({
Draggable: true,
position: latLng,
map: map,
title:"Hello World!"
});

updateMarkerPosition(latLng);

google.maps.event.addListener(marker, 'drag', function() {
 updateMarkerPosition(marker.getPosition());
});

google.maps.event.addDomListener(window, 'load', initialize);


layer = new google.maps.FusionTablesLayer(591781);
layer.setMap(map);
}

</script>


<!--end googlemap stuff-->
<style type="text/css">

div.zo{
background-color:#00FFFF;
padding-left: 10px;
}
div.zo:hover{
background-color:#990000;
}
div.ze{
background-color:#FFFFCC;
padding-left: 10px;
}
div.ze:hover{
background-color:#990000;
}
div.tzh{
background-color:#FFFF99;
padding-left: 10px;
}
span.tzn{
width: 40%;
text-align:center;
float:left;
}
span.tzk{
text-align:center;
width:10%;
}
span.tzlk{
width:40%;
float:right;
text-align:center;
}
div.top5zombies{
width:90%;
}
</style>

<style type="text/css">
html {
height: 100%
}

body{
height: 100%;
margin: 0px;
padding: 0px
}

#map_canvas{
height: 300px;
width:600px;
margin-left:150px;
margin-bottom:500px;
}
</style>


<?php visheader(); ?>


<div id="content">



<div id="output"> <!-- if the computer has anything important for the player, it goes here-->
<?php
if(isset($_REQUEST['talk']))
{
$talk = $_REQUEST['talk'];

echo $talk.PHP_EOL;
echo "<hr size=\"1px\" width=\"80%\" />".PHP_EOL;
}
?>
</div>
<!--end talk-->

<table align="center" width="90%" border="0">
<tr>
<td colspan="2">
<div class="top5zombies">
Top 5 Zombies:<br />
<div class="tzh"><span class="tzn">Name</span><span class="tzk">Kills</span><span class="tzlk">Latest Kill</span></div>

<div class="zo">
<span id="z1" class="tzn">---</span>
<span id="z1k" class="tzk">---</span>
<span id="z1lk" class="tzlk">---</span>
</div>
<div class="ze">
<span id="z2" class="tzn">---</span>
<span id="z2k" class="tzk">---</span>
<span id="z2lk" class="tzlk">---</span>
</div>
<div class="zo">
<span id="z3" class="tzn">---</span>
<span id="z3k" class="tzk">---</span>
<span id="z3lk" class="tzlk">---</span>
</div>
<div class="ze">
<span id="z4" class="tzn">---</span>
<span id="z4k" class="tzk">---</span>
<span id="z4lk" class="tzlk">---</span>
</div>
<div class="zo">
<span id="z5" class="tzn">---</span>
<span id="z5k" class="tzk">---</span>
<span id="z5lk" class="tzlk">---</span>
</div>
<font style="font-size:10px;"><a href="javascript://" class="helplinks" id="updatetopz">Update Top Zombies</a></font>
</div>

</td>
</tr>
<tr>
<td width="44%">

<div id="reportkill">

<span class="reporthead">Report Kill:</span><br />

<table align="center" width="100%" border="0">
<form action="" onSubmit="return checkkill(this);" method="post">
<tr>
<td>Your HVZID:</td>
<td><input name="yourhvzid" type="text" size="17" maxlength="8" class="rktextbox" <?php
if(!isset($_COOKIE['hvzid']))
{ echo "readonly=\"true\" value=\"Not logged in\""; }
if(isset($_COOKIE['hvzid']))
{ echo "value=\"".$_COOKIE['hvzid']."\""; }

?> />
</td>
</tr>
<tr>
<td>Their HVZID:&nbsp;</td>
<td><input name="theirhvzid" type="text" size="10" maxlength="8" class="rktextbox"/>&mdash;<input name="hvzidext" type="text" size="3" maxlength="3" class="rktextbox" /></td>
</tr>
<tr>
<td colspan="2" align="center"><?php
if(isset($_COOKIE['hvzid']))
{ echo "<input type=\"submit\" name=\"button\" id=\"rksubmit\" value=\"Report!\" />"; }
else
{ echo "<font style=\"font-weight:bold; color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:10px;\">You must be logged in to report a kill</font>"; }
?>
</td>
</tr>
</form>
</table>
</div>
</td>
<td width="56%" valign="top">


<div id="killcount">
<span class="reporthead">Current Populations:</span><br />
<span class="populations">Humans:&nbsp;</span><span class="popnum" id="human">Loading...</span>
<br />
<span class="populations">Zombies:&nbsp;</span><span class="popnum" id="zombie">Loading...</span>
<br /><br />
<span class="populations">Populations as of:</span> <span class="popnum" id="date"><?php echo date('g:i:s a \o\n m.d.Y',time()); ?></span>
<br /><font style="font-size:10px;"><a href="javascript://" class="helplinks" id="updatepop">Update Population</a></font>
</div>
</td>
</tr>

</table>

<br /><br /><br /><br /><br /><br />
<!--stuff for maps-->



<body onLoad="initialize()">

<div id="map_canvas"</div>



<style>
#infopanel{
	margin: 30px 30px 30px 30px;
	}
</style>
<div id="infoPanel">
<b>Marker status:</b>
<div id="markerStatus"><i>Click and drag the marker.</i></div>
<b>Current position:</b>
<div id="info"></div>
<b>Closest matching address:</b>
<div id="address"></div>
</div>
<!--end stuff for maps-->



</div><!--end content-->

<?php include('php/footer.php'); ?>

<br class="clearfloat" />

</div> <!--end frame-->
<br /><br /><br /><br />
</body>
</html>
<?php mysqli_close($cxn);?>  