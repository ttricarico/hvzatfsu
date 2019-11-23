<?php

	$action = $_REQUEST['action'];
	
	include('php/settings.php');
		global $cxn;
		$cxn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);

	include('php/header.php');
		
		ini_set('display_errors', true);
	    error_reporting(E_ALL ^ E_NOTICE);
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
<?php
	session_start();
	if(!isset($_COOKIE['hvzid']))
	{
		header('Location: http://'.$_SERVER['SERVER_NAME'].'/index.php?talk=You must be logged in to see this page.');
		exit;
	}
	//if human, see human stuff
	// if zombie, see zombie stuff
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=ABQIAAAAD-USr8WLLXNdhEkazqMbihRd0Scajo9cgiYBG1ZaYEngXVG7sBQLDY9bQtnA1k7iLcZdi2tuVrorbQ" type="text/javascript"></script> 
  </head> 
  <body onunload="GUnload()"> 
 
    <div id="map" style="width: 550px; height: 450px"></div> 
   
 
 
    <noscript><b>JavaScript must be enabled in order for you to use Google Maps.</b> 
      However, it seems JavaScript is either disabled or not supported by your browser. 
      To view Google Maps, enable JavaScript by changing your browser options, and then 
      try again.
    </noscript> 
 
 
    <script type="text/javascript"> 
    //<![CDATA[
    
    if (GBrowserIsCompatible()) {
 
      var lastmarker;
      var iwform = 'Enter details:<br>'
                 + '<form action="#" onsubmit="process(this); return false" action="#">'
                 + '  <textarea name="data" rows="5" cols="40"><\/textarea><br>'
                 + '  <input type="submit" value="Submit" />'
                 + '<\/form>';
 
      // == creates a draggable marker with an input form ==
      function createInputMarker(point) {
        var marker = new GMarker(point,{draggable:true, icon:G_START_ICON});
        GEvent.addListener(marker, "click", function() {
          lastmarker = marker;
          marker.openInfoWindowHtml(iwform);
        });
        map.addOverlay(marker);
        marker.openInfoWindowHtml(iwform);
        lastmarker=marker;
        return marker;
      }
 
      // == creates a "normal" marker
      function createMarker(point,text) { 
        var marker = new GMarker(point);
        GEvent.addListener(marker,"click", function() {
          marker.openInfoWindow(document.createTextNode(text));
        });
        map.addOverlay(marker);
        return marker;
      }
 
      // == Display the map, with some controls and set the initial location 
      var map = new GMap2(document.getElementById("map"),{draggableCursor:"default"});
      map.addControl(new GLargeMapControl());
      map.addControl(new GMapTypeControl());
      map.setCenter(new GLatLng(30.442643,-84.298825),15);
 
      // == Listen for map click and add an input marker
      GEvent.addListener(map,"click",function(overlay,point){
        if (!overlay) {
          createInputMarker(point);
        }
      });
 
      function process(form) {
        // == obtain the data
        var details = form.data.value;
        var lat = lastmarker.getPoint().lat();
        var lng = lastmarker.getPoint().lng();
        var url = "myserver.php?lat=" +lat+ "&lng=" +lng+ "&details="+details;
 
        // ===== send the data to the server
        GDownloadUrl(url, function(doc) {    });  
 
        // == remove the input marker and replace it with a completed marker
        map.closeInfoWindow();
        var marker = createMarker(lastmarker.getPoint(),details);
        GEvent.trigger(marker,"click");
 
      }
      
      
      // === Define the function thats going to read the stored data ===
      readData = function(doc) {
        // === split the document into lines ===
        lines = doc.split("\n");
        for (var i=0; i<lines.length; i++) {
          if (lines[i].length > 1) {
            // === split each line into parts separated by "|" and use the contents ===
            parts = lines[i].split("|");
            var lat = parseFloat(parts[0]);
            var lng = parseFloat(parts[1]);
            var details = parts[2];
            var point = new GLatLng(lat,lng);
            // create the marker
            var marker = createMarker(point,details);
          }
        }
      }          
      // === read data entered by previous users ===
      GDownloadUrl("details.txt", readData);      
      
 
 
    }
    
    // display a warning if the browser was not compatible
    else {
      alert("Sorry, the Google Maps API is not compatible with this browser");
    }
 
    // This Javascript is based on code provided by the
    // Community Church Javascript Team
    // http://www.bisphamchurch.org.uk/   
    // http://econym.org.uk/gmap/
 
    //]]>
    </script> 
  </body> 
 
</html> 
