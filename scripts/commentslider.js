//comment insertion
	/*var browserType;

	if (document.layers) {browserType = "nn4"}
	if (document.all) {browserType = "ie"}
	if (window.navigator.userAgent.toLowerCase().match("gecko")) { browserType= "gecko"	}

function hidecomments() {
	if (browserType == "gecko" )
	{ document.poppedLayer = eval('document.getElementById("submitcomment")');	}
	else if (browserType == "ie")
	{ document.poppedLayer = eval('document.getElementById("submitcomment")');	}
	else
	{ document.poppedLayer = eval('document.layers["submitcomment"]');	}
			
		document.poppedLayer.style.display = "none";
	  document.getElementById('showcomments').innerHTML = 'Want to say something? Say it <a href=\"javascript:showcomments()\" class=\"commentlogin\">here.</a>';

}
	
function showcomments() {
	if (browserType == "gecko" )
	{ document.poppedLayer = eval('document.getElementById("submitcomment")');	}
	else if (browserType == "ie")
	{ document.poppedLayer = eval('document.getElementById("submitcomment")');	}
	else
	{ document.poppedLayer = eval('document.layers["submitcomment"]');	}
	
	
	document.getElementById("submitcomment").style.height = '1px';
	documentheight = 1;
	while(documentheight <= 200)
	{
		setTimeout("documentheight = documentheight + 1;", 100);
		document.poppedLayer.style.height = documentheight + 'px';
		
	}
	document.poppedLayer.style.display = "inline";
	  clearTimeout();
	  document.getElementById('showcomments').innerHTML = 'Finished saying something? <a href=\"javascript:hidecomments()\" class=\"commentlogin\">Hide this</a>.';
	}
	*/
	
var timerlen = 5;
var slideAniLen = 250;

var timerID = new Array();
var startTime = new Array();
var obj = new Array();
var endHeight = new Array();
var moving = new Array();
var dir = new Array();

function slidedown(objname){
        if(moving[objname])
                return;

        if(document.getElementById(objname).style.display != "none")
                return; // cannot slide down something that is already visible
		 document.getElementById('showcomments').innerHTML = 'Finished saying something? <a href="javascript:;" onmousedown="slideup(\'submitcomment\');" class="commentlogin">Hide this</a>.';
		
        moving[objname] = true;
        dir[objname] = "down";
        startslide(objname);
}

function slideup(objname){
        if(moving[objname])
                return;

        if(document.getElementById(objname).style.display == "none")
                return; // cannot slide up something that is already hidden
		document.getElementById('showcomments').innerHTML = 'Want to say something? Say it <a href="javascript:;" onmousedown="slidedown(\'submitcomment\');" class="commentlogin">here.</a>';
        moving[objname] = true;
        dir[objname] = "up";
        startslide(objname);
}

function startslide(objname){
        obj[objname] = document.getElementById(objname);

        endHeight[objname] = parseInt(obj[objname].style.height);
        startTime[objname] = (new Date()).getTime();

        if(dir[objname] == "down"){
                obj[objname].style.height = "1px";
        }

        obj[objname].style.display = "inline";

        timerID[objname] = setInterval('slidetick(\'' + objname + '\');',timerlen);
}

function slidetick(objname){
        var elapsed = (new Date()).getTime() - startTime[objname];

        if (elapsed > slideAniLen)
                endSlide(objname)
        else {
                var d =Math.round(elapsed / slideAniLen * endHeight[objname]);
                if(dir[objname] == "up")
                        d = endHeight[objname] - d;

                obj[objname].style.height = d + "px";
        }

        return;
}

function endSlide(objname){
        clearInterval(timerID[objname]);

        if(dir[objname] == "up")
                obj[objname].style.display = "none";

        obj[objname].style.height = endHeight[objname] + "px";

        delete(moving[objname]);
        delete(timerID[objname]);
        delete(startTime[objname]);
        delete(endHeight[objname]);
        delete(obj[objname]);
        delete(dir[objname]);

        return;
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////\/////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////

function AnimationFrame(left, top, width, height, time)
{
  this.Left = left;
  this.Top = top;
  this.Width = width;
  this.Height = height;
  this.Time = time;
 
  this.Copy = function(frame)
  {
    this.Left = frame.Left;
    this.Top = frame.Top;
    this.Width = frame.Width;
    this.Height = frame.Height;
    this.Time = frame.Time;
  }
 
  this.Apply = function(element)
  {
    element.style.left = Math.round(this.Left) + 'px';
    element.style.top = Math.round(this.Top) + 'px';
    element.style.width = Math.round(this.Width) + 'px';
    element.style.height = Math.round(this.Height) + 'px';
  }
}

function AnimationObject(element)
{
  if(typeof(element) == "string")
    element = document.getElementById(element);
 
  var frames = null; 
  var timeoutID = -1;
  var running = 0;
  var currentFI = 0;
  var currentData = null;
  var lastTick = -1;
  var callback = null;
 
  var prevDir = 0;
 
  this.AddFrame = function(frame)
  {
    frames.push(frame);
  }
 
  this.SetCallback = function(cb)
  {
    callback = cb;
  }
 
  this.ClearFrames = function()
  {
    if(running != 0)
      this.Stop();
    frames = new Array();
    frames.push(new AnimationFrame(0,0,0,0,0));
    frames[0].Time = 0;
    frames[0].Left = parseInt(element.style.left);
    frames[0].Top = parseInt(element.style.top);
    frames[0].Width = parseInt(element.style.width);
    frames[0].Height = parseInt(element.style.height);
    currentFI = 0;
    prevDir = 0;
    currentData = new AnimationFrame(0,0,0,0,0);   
  }
 
  this.ResetToStart = function()
  {
    if(running != 0)
      this.Stop();
    currentFI = 0;
    prevDir = 0;
    currentData = new AnimationFrame(0,0,0,0,0);
    frames[0].Apply(element);
  }
 
  this.ResetToEnd = function()
  {
    if(running != 0)
      this.Stop();
    currentFI = 0;
    prevDir = 0;
    currentData = new AnimationFrame(0,0,0,0,0);
    frames[frames.length - 1].Apply(element);
  }
 
  this.Stop = function()
  {
    if(running == 0)
      return;
    if(timeoutID != -1)
      clearTimeout(timeoutID);
    prevDir = running;
    running = 0;
  }
 
  this.RunForward = function()
  {
    if(running == 1)
      return;
    if(running == -1)
      this.Stop();
    if(frames.length == 1 || element == null)
      return; 
     
    lastTick = new Date().getTime();

    //Start from the begining
    if(prevDir == 0)
    {
      currentFI = 1;
      currentData.Time = 0;
      currentData.Left = parseInt(element.style.left);
      currentData.Top = parseInt(element.style.top);
      currentData.Width = parseInt(element.style.width);
      currentData.Height = parseInt(element.style.height);
      frames[0].Copy(currentData);
    }
    else if(prevDir != 1)
    {
      currentFI++;
      currentData.Time =
          frames[currentFI].Time - currentData.Time;
    }
     
    running = 1;
    animate();
  }
 
  this.RunBackward = function()
  {
    if(running == -1)
      return;
    if(running == 1)
      this.Stop();
    if(frames.length == 1 || element == null)
      return;
       
    lastTick = new Date().getTime();
   
    //Start from the end
    if(prevDir == 0)
    {
      currentFI = frames.length-2;
      currentData.Left = parseInt(element.style.left);
      currentData.Top = parseInt(element.style.top);
      currentData.Width = parseInt(element.style.width);
      currentData.Height = parseInt(element.style.height);
      currentData.Time = frames[frames.length-1].Time;
      frames[frames.length-1].Copy(currentData);
      currentData.Time = 0;
    }
    else if(prevDir != -1)
    {
      currentData.Time =
          frames[currentFI].Time - currentData.Time;
      currentFI--;
    }
     
    running = -1;
    animate();
  }
   
  function animate()
  {
    if(running == 0)
      return;
    var curTick = new Date().getTime();
    var tickCount = curTick - lastTick;
    lastTick = curTick;
   
    var timeLeft =
       frames[((running == -1) ? currentFI+1 : currentFI)].Time
       - currentData.Time;
   
    while(timeLeft <= tickCount)
    {
      currentData.Copy(frames[currentFI]);
      currentData.Time = 0;
      currentFI += running;
      if(currentFI>= frames.length || currentFI <0)
      {
        currentData.Apply(element);
        lastTick = -1;
        running = 0;
        prevDir = 0;
        if(callback != null)
          callback();
        return;
      }
      tickCount = tickCount - timeLeft;
      timeLeft =
        frames[((running == -1) ? currentFI+1 : currentFI)].Time
        - currentData.Time;
    }
   
    if(tickCount != 0)
    {
      currentData.Time += tickCount;
      var ratio = currentData.Time/
        frames[((running == -1) ? currentFI+1 : currentFI)].Time;

      currentData.Left = frames[currentFI-running].Left +
         (frames[currentFI].Left
         - frames[currentFI-running].Left)
         * ratio;

      currentData.Top = frames[currentFI-running].Top +
         (frames[currentFI].Top
         - frames[currentFI-running].Top)
         * ratio;
      currentData.Width = frames[currentFI-running].Width +
         (frames[currentFI].Width
         - frames[currentFI-running].Width)
         * ratio;

      currentData.Height = frames[currentFI-running].Height +
         (frames[currentFI].Height
         - frames[currentFI-running].Height)
         * ratio;
    }
   
    currentData.Apply(element);

    timeoutID = setTimeout(animate, 33);
  }
 
  this.ClearFrames();
}


















/////////////////////////////////////////////////////////////////////////////////////////////
var Hide = "";
var varHt = 0;
var Ht = "";
var x = 0;
var y = 10;
var z = 5;
var foo = new Array();
var Speed = "";

function setup() {
	Hide = document.getElementById("submitcomment");
	Ht = document.getElementById('submitcomment').offsetHeight;
	document.getElementById('submitcomment').style.height = '0px';
	document.getElementById('showcomments').style.display = 'inline';
}

function toggle() {

	if (x === 0) {
		document.getElementById('submitcomment').style.height = varHt+'px';
		if (((Ht-varHt) < z) && (varHt !== Ht)) {
			varHt = Ht;
		} else {
			varHt = varHt+z;
		}
		if (varHt <= Ht) {
			setTimeout('toggle()',y);
		}
		if (varHt > Ht) {
			varHt = Ht;
			x = 1;
			document.getElementById('showcomments').innerHTML = "<a href=\"javascript://\" onclick=\"toggle();\" id=\"toggle\">Hide</a>";
		}
	} else {
		document.getElementById('submitcomment').style.height = varHt+'px';
		varHt = varHt-z;
		if ((Ht-varHt) <= Ht) {
			setTimeout('toggle()',y);
		}
		if ((Ht-varHt) > Ht) {
			varHt = 0;
			document.getElementById('submitcomment').style.height = varHt+'px';
			document.getElementById('showcomments').innerHTML = '<a href="javascript://" onclick="toggle();" id="toggle">Show</a>';
			x = 0;
		}

	}
}