<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>bbCode Window</title>
<link rel="stylesheet" href="http://<?php echo $_SERVER['SERVER_NAME'];?>/styles/basestyle.css" type="text/css" />
<link rel="stylesheet" href="style/categories.css" type="text/css" />
<link rel="stylesheet" href="style/threads.css" type="text/css" />
<link rel="stylesheet" href="style/forums.css" type="text/css" />
<style>
	#popupwindowframe{
		width: auto;
		background-color:#FFFFFF;
	}
</style>
</head>

<body>
<div id="popupwindowframe">
<table border="0"> 
      <tr> 
        <td colspan="4"><p>We use a modified form of bbCode in the forums. You can use any of the bbCode below to format your post.<br /> 
          HTML, CSS, JavaScript is all forbidden, and will be stripped before posting</p></td> 
      </tr> 
      <tr> 
        <td colspan="4"><center> 
          Quotes and Code Blocks
          </center></td> 
      </tr> 
      <tr> 
        <td colspan="2">[quote]Some text that will be quoted in the post.[/quote]</td> 
        <td colspan="2">[code]Other Text that will be in code form[/code]</td> 
      </tr> 
      <tr> 
        <td colspan="2"><div class="quote"><span class="quotecodehead">Quote View:</span>Some text that will be quoted in the post.</div></td> 
        <td colspan="2"><div class="code"><span class="quotecodehead">Code View:</span> 
              <pre>Other Text that will be in code form</pre> 
          </div></td> 
      </tr> 
      <tr> 
        <td height="21" colspan="4">&nbsp;</td> 
      </tr> 
 
      <tr> 
        <td width="127" height="27">[b][/b]</td> 
        <td width="238"><strong>Bold Text</strong></td> 
        <td width="324">[url]http://hvzatfsu.com[/url]</td> 
        <td width="192"><a href="http://hvzatfsu.com/" class="forumlink">http://hvzatfsu.com</a></td> 
      </tr> 
      <tr> 
        <td>[i][/i]</td> 
        <td><em>Italic Text</em></td> 
        <td>You can use the @ symbol to tag someone:</td> 
        <td>@Firstname Lastname -> Links to their profile</td> 
      </tr> 
      <tr> 
        <td>[u][/u]</td> 
        <td><span style="text-decoration:underline;">Underlined Text</span></td> 
        <td>[center][/center]</td> 
        <td><center> 
          Centered Text
          </center></td> 
      </tr> 
      <tr> 
        <td>[size={1-10}][/size]</td> 
        <td><p>Text sizes 1-10<br /> 
          You can also use pixel sizes, too.</p>        </td> 
        <td >[img]http://hvzatfsu.com/images/homebutton.png[/img]</td> 
        <td><img src="http://new.hvzatfsu.com/images/homebutton.png" width="110" height="35" /></td> 
      </tr> 
    <tr> 
      <td>&nbsp;</td> 
        <td><center>[color=name][/color]</center></td> 
        <td><center>Text colors from below.</center></td> 
        <td>&nbsp;</td> 
      </tr> 
    <tr> 
        <td colspan="4"><table width="100%" border="0"> 
          <tr> 
            <td><div align="center"><span style="color:#0000FF;">blue </span></div></td> 
            <td><div align="center"><span style="color:#FF0000;"> red </span></div></td> 
            <td><div align="center"><span style="color:#00FF00;"> limegreen </span></div></td> 
            <td><div align="center"><span style="color:#FFFF00;"> yellow </span></div></td> 
            <td><div align="center"><span style="color:#FFD700;"> gold </span></div></td> 
          </tr> 
          <tr> 
            <td><div align="center"><span style="color:#FFA500;"> orange</span></div></td> 
            <td><div align="center"><span style="color:#FF91A4;"> pink </span></div></td> 
            <td><div align="center"><span style="color:#800080;">purple </span></div></td> 
            <td><div align="center"><span style="color:#00008B;"> darkblue </span></div></td> 
            <td><div align="center"><span style="color:#8B0000;"> garnet </span></div></td> 
          </tr> 
          <tr> 
            <td><div align="center"><span style="color:#008080;"> teal </span></div></td> 
            <td><div align="center"><span style="color:#964B00;"> brown </span></div></td> 
            <td><div align="center"><span style="color:#00FFFF;"> cyan </span></div></td> 
            <td><div align="center"><span style="color:#FF1DCE;"> magenta </span></div></td> 
            <td><div align="center"><span style="color:#682860;"> darkpurple</span></div></td> 
          </tr> 
          <tr> 
            <td><div align="center"><span style="color:#C0C0C0;"> silver </span></div></td> 
            <td><div align="center"><span style="color:#008000;"> green </span></div></td> 
            <td><div align="center"><span style="color:#BEBEBE;"> lightgrey </span></div></td> 
            <td><div align="center"><span style="color:#808080;"> darkgrey </span></div></td> 
            <td><div align="center"><span style="color:#000000;"> black </span></div></td> 
          </tr> 
        </table></td> 
      </tr> 
    </table>
 </div>
</body>
</html>
