<?php
	define('hvz', 1);
	include('../php/post.php');
	
?>
   <div class="post" id="XX">
        <div class="posthead">
            <span class="postheadleft">
            	<a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/profile.php?hvzid=<?php $_COOKIE['hvzid']; ?>" class="prolink"><?php echo $_COOKIE['firstname']." ".$_COOKIE['lastname']; ?></a>
            </span>
            <span class="postheadright">Post: <a href="javascript://" class="postidlink">#XX</a></span>
            <br class="clearfloat">
        </div>
       
        <div class="postmiddle">
            <div class="postleft">
                <a href="http://new.hvzatfsu.com/profile.php?hvzid=<?php $_COOKIE['hvzid']; ?>" class="imgprolink">
                	<img class="propicthumb" src="http://<?php echo $_SERVER['SERVER_NAME'];?>/uploads/images/index.php?action=profile&img=<?php echo $_COOKIE['hvzid'];?>&h=150&w=150">
                </a><br />
            </div>
            
            <div class="postcontent">
                <?php echo nl2br(rawcontenttoformatted($_REQUEST['pc']));	?>
            </div>
            
            <br class="clearfloat" />
        </div>
        
        <div class="postfooter">
            <span class="postfooterleft">
                Posted on: <?php echo date('F j, Y \a\t g:i:s a', time()); ?> &bull; IP Address Logged
            </span>
            <span class="postfooterright">
                <a href="javascript://">Edit Post</a> &bull; <a href="javascript://">Delete Post</a> | <a href="javascript://">Report Post</a>
            </span>
            <br class="clearfloat" />
        </div>
        
		<div class="clearer"></div>                        
    </div><!-- end post-->
    


