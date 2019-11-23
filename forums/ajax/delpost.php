<?php header('Content-type: text/xml'); ?>


<div id="popupframebody">
	<div id="popupframebody_title">Delete Thread</div>
	<br /><br /><center>
    <font style="color:#FF0000; font-weight:bold;">Are you SURE you want to delete this thread?</font>
    <br /><br />
	<input type="button" value="Yes" class="framebtn" style="width:100px;" onclick="delconfirm();" />
	&nbsp;&nbsp;
	<input type="button" value="No" class="framebtn" id="closepopupframe" style="width:100px;" /><br />
    <span class="loading" style="display:none;padding-left:5px;"><img src="ajax/redloader.gif" title="Sending" /></span>
    </center>
    <br /><br /><br /><br />
</div>
<div id="popupframefooter">

</div>
