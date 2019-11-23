<?php header('Content-type: text/xml'); ?>


<div id="popupframebody">
	<div id="popupframebody_title">New Post</div>
	<form action="" name="newthread" method="post">
    <input type="text" name="name" value="<?php echo $_COOKIE['firstname']." ".$_COOKIE['lastname'];?>" class="formtext" readonly="readonly" />&nbsp;::&nbsp;<input type="text" name="hvzid" value="<?php echo $_COOKIE['hvzid']; ?>" class="formtext" readonly="readonly"/>
    <br />
    Thread title: <input type="text" name="nttitle" id="nttitle" style="width:300px;" maxlength="100" />
    <span id="threaderror">You must include a title</span><br />
    <div id="postinginfo">
    <span id="postingleft">Post Content:<span id="posterror">You cannot submit a blank post</span></span>
    <span id="postingright">
    	<a href="javascript://" id="showforums_whatcanipost" onclick="loadforumrules()">What can I post?</a> | <a href="javascript://" onclick="open_bbcodeinfo()">View bbCode Options</a>
    </span>
    <br class="clearfloat" />
    </div>
    <textarea style="width:99%;" rows="10" name="postcontent" id="postcontent" class="formtext"></textarea>
    <br /><input type="submit" id="newpostbtn" class="newpostbtn" value="Submit New Post" onclick="threadformsubmit();return false;" /><br /><span class="loading" style="display:none;padding-left:5px;"><img src="ajax/redloader.gif" title="Sending" /></span>
    </form>
    	
</div>

<div id="popupframefooter">
	First, <a href="?action=search&q=forum rules">read the Forum Rules</a>
    <br />
    You can use some forms of bbCode to format your post.
    <table width="100%" border="0">
        <tr><td colspan="2">Basic Text Tools:</td>
        </tr>
        <tr>
          <td>[b][/b]</td>
          <td><strong>Bold Text</strong></td>
        </tr>
        <tr><td width="50%">[i] [/i]</td><td width="50%"><span style="font-style:italic">Italic Text</span></td>
        </tr>
        <tr><td>[u] [/u]</td><td><span style="text-decoration:underline;">Underlined Text</span></td>
        </tr>
        <tr>
          <td>[url]hvzatfsu.com[/url]</td>
          <td><a href="http://hvzatfsu.com/" class="forumlink">hvzatfsu.com</a></td>
        </tr>
        <tr>
          <td>[img]http://hvzatfsu.com/image/homebutton.png[/img]</td>
          <td><img src="../../../images/homebutton.png" width="110" height="35" /></td>
        </tr>
        <tr>
          <td colspan="2"><a href="javascript://" onclick="open_bbcodeinfo()">View More Formatting Options</a></td>
        </tr>
    </table>
</div>