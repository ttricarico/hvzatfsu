<?php header('Content-type: text/html');

if(isset($_COOKIE['hvzid']))
{?>

    <div id="popupframebody">
    
	<form action="" name="newpost" method="post">
    
    	<div id="newpost_buttons"><!--Holds all the formatting buttons-->
        	<table width="100%" border="0">
            	<tr>
                	<td></td>
                    <td align="center"><span class="desc">Font Sizes</span></td>
                    <td align="center"><span class="desc">Font Colors</span></td>
                </tr>
                <tr>
                	<td>
                        <a href="javascript://" class="postbtn" id="btn_bold"><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/famfamfam/text_bold.png" title="Bold Text" /></a>
                        <a href="javascript://" class="postbtn" id="btn_italic"><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/famfamfam/text_italic.png" title="Italic Text" /></a>
                        <a href="javascript://" class="postbtn" id="btn_ul"><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/famfamfam/text_underline.png" title="Underline Text" /></a>
                        <a href="javascript://" class="postbtn" id="btn_st"><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/famfamfam/text_strikethrough.png" title="Strikethrough Text" /></a>
                        <a href="javascript://" class="postbtn" id="btn_link"><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/famfamfam/world_link.png" title="Hyperlink" /></a>
                        <a href="javascript://" class="postbtn" id="btn_img"><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/famfamfam/photo_add.png" title="Image Link" /></a>
                        <a href="javascript://" class="postbtn" id="btn_center"><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/famfamfam/text_align_center.png" title="Center Text" /></a>
                        <a href="javascript://" class="postbtn" id="btn_quote"><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/famfamfam/comment_add.png" title="Quote" /></a>
                    </td>
                    <td>
                        <a href="javascript://" class="postbtn" id="btn_fontsize_1"><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/buttons/1.png" title="Font Size 1" /></a>
                        <a href="javascript://" class="postbtn" id="btn_fontsize_2"><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/buttons/2.png" title="Font Size 2" /></a>
                        <a href="javascript://" class="postbtn" id="btn_fontsize_3"><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/buttons/3.png" title="Font Size 3" /></a>
                        <a href="javascript://" class="postbtn" id="btn_fontsize_4"><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/buttons/4.png" title="Font Size 4" /></a>
                        <a href="javascript://" class="postbtn" id="btn_fontsize_5"><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/buttons/5.png" title="Font Size 5" /></a>
                        <a href="javascript://" class="postbtn" id="btn_fontsize_6"><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/buttons/6.png" title="Font Size 6" /></a>
                        <a href="javascript://" class="postbtn" id="btn_fontsize_7"><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/buttons/7.png" title="Font Size 7" /></a>
                        <a href="javascript://" class="postbtn" id="btn_fontsize_8"><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/buttons/8.png" title="Font Size 8" /></a>
                        <a href="javascript://" class="postbtn" id="btn_fontsize_9"><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/buttons/9.png" title="Font Size 9" /></a>
                        <a href="javascript://" class="postbtn" id="btn_fontsize_10"><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/buttons/10.png" title="Font Size 10" /></a>
                    </td>
                    <td>
                        <a href="javascript://" class="postbtn" id="btn_brown"><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/buttons/brown.png" title="Brown" /></a>
                        <a href="javascript://" class="postbtn" id="btn_garnet"><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/buttons/garnet.png" title="Garnet" /></a>
                        <a href="javascript://" class="postbtn" id="btn_red"><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/buttons/red.png" title="Red" /></a>
                        <a href="javascript://" class="postbtn" id="btn_pink"><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/buttons/pink.png" title="Pink" /></a>
                        <a href="javascript://" class="postbtn" id="btn_orange"><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/buttons/orange.png" title="Orange" /></a>
                        <a href="javascript://" class="postbtn" id="btn_gold"><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/buttons/gold.png" title="Gold" /></a>
                        <a href="javascript://" class="postbtn" id="btn_yellow"><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/buttons/yellow.png" title="Yellow" /></a>
                        <a href="javascript://" class="postbtn" id="btn_green"><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/buttons/green.png" title="Green" /></a>
                        <a href="javascript://" class="postbtn" id="btn_limegreen"><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/buttons/limegreen.png" title="Lime Green" /></a>
                        <a href="javascript://" class="postbtn" id="btn_cyan"><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/buttons/cyan.png" title="Cyan" /></a>
                        <a href="javascript://" class="postbtn" id="btn_teal"><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/buttons/teal.png" title="Teal" /></a>
                        <a href="javascript://" class="postbtn" id="btn_blue"><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/buttons/blue.png" title="Blue" /></a>
                        <a href="javascript://" class="postbtn" id="btn_darkblue"><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/buttons/darkblue.png" title="Dark Blue" /></a>
                        <a href="javascript://" class="postbtn" id="btn_magenta"><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/buttons/magenta.png" title="Magenta" /></a>
                        <a href="javascript://" class="postbtn" id="btn_purple"><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/buttons/purple.png" title="Purple" /></a>                        
                        <a href="javascript://" class="postbtn" id="btn_darkpurple"><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/buttons/darkpurple.png" title="Dark Purple" /></a>
                        <a href="javascript://" class="postbtn" id="btn_lightgrey"><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/buttons/lightgrey.png" title="Light Grey" /></a>
                        <a href="javascript://" class="postbtn" id="btn_silver"><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/buttons/silver.png" title="Silver" /></a>
                        <a href="javascript://" class="postbtn" id="btn_darkgrey"><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/buttons/darkgrey.png" title="Dark Grey" /></a>                       
                        <a href="javascript://" class="postbtn" id="btn_black"><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/images/icons/buttons/black.png" title="Black" /></a>
                   </td>
               </tr>
            </table>
        </div>
        <div id="errors">
	    	<span class="error" id="newpost_cant_be_empty">You cannot submit a blank post.</span>
	        <span class="error" id="newpost_too_long">You cannot have a post longer than 2500 characters. Please shorten it and try again.</span>
         </div>
        <textarea id="popup_postcontent" rows="10" style="width:95%; margin-left:auto; margin-right:auto;"></textarea>
		<input type="submit" onclick="quickformsubmit();" value="Submit New Post" class="newpostbtn" id="newpostbtn" style="float:left;">
        <input type="button"  value="View Post" class="newpostbtn" id="viewpost" style="float:right;">
        <div class="clearer"></div>
    </form>
    	
</div>

    

<?php }//end if
	else{?>
	<div id="popupframebody">
	<div id="popupframebody_title">New Post</div>
	<br /></br />
    <center><h2>You must be <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/reglogin.php">logged in</a> to post a comment</h2></center>
    	
</div>

    <?php }//end else?>