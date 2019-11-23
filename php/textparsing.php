<?php
	/*********************************
	 *	(c) 2011 Thomas Tricarico and others
	 *	textparsing.php - used in message, about me, comment, forum posts, and blog post text formatting
	 *
	 *		parsetext($content, $forwhat) = parses the text ($content) for the specific reason $forwhat
	 *			-	$forwhat currently supports: forum_post, message, blog_post, about_me, index_post, no_formatting	-	default is no_formatting
	 *		bbcode_colors($content) = changes bb code for colors to span style
	 *		http_to_link($content) = changes http://something.com to a link to something.com
	 *		wordfilter($text) = checks if there is a word filter enabled. and if so, checks for specified words
	 *		
	 **********************************/
	 
	 /////////	FILES TO CHANGE	///////////////////
	 //		new.hvzatfsu.com/ajax/index_getcomments.php
	 //		new.hvzatfsu.com/php/notifmessages.php
	 //		new.hvzatfsu.com/ajax/aboutmechg.php
	 //		new.hvzatfsu.com/php/profile.php
	 //		new.hvzatfsu.com/blog/viewblog.php
	 //		new.hvzatfsu.com/forums/php/post.php
	 
	 
	 function parsetext($content, $forwhat = 'no_formatting')
	 {
	 	global $cxn;
		
		switch($forwhat)
		{
			case 'forum_post':
				$bbcode = array('[b]', '[/b]', '[i]', '[/i]', '[u]', '[/u]', '[center]', '[/center]', '[s]', '[/s]');	//simple conversion bb code
				$htmlcode = array('<strong>', '</strong>', '<em>', '</em>', '<span style="text-decoration:underline;">', '</span>', '<center>', '</center>', '<span style="text-decoration:line-through;">', '</span>');	//bbcode to easy html ([b] -> <strong>)
				$content = str_replace($bbcode, $htmlcode, $content);
				
				//bbcode into html that changes styles ([quote] -> <div style>)
				$bbcode2 = array('[quote]', '[/quote]', '[code]', '[/code]');
				$htmlcode2 = array('<div class="quote"><span class="codequotehead">Quote:</span>', '</div>', 
									'<div class="code"><span class="codequotehead">Code view:</span><pre>', '</pre>');
				$content = str_replace($bbcode2, $htmlcode2, $content);
				//bbcode font-size to style ([size=1] -> <span style="font-size:8px;">
				$bbcode3 = array('[size=1]', '[size=2]', '[size=3]', '[size=4]', '[size=5]', '[size=6]', '[size=7]', '[size=8]', '[size=9]', '[size=10]', '[/size]');
				$htmlcode3 = array('<span style="font-size:10px;">', '<span style="font-size:12px;">', '<span style="font-size:14px;">', '<span style="font-size:16px;">', '<span style="font-size:20px;">', '<span style="font-size:24px;">', '<span style="font-size:28px;">','<span style="font-size:32px;">','<span style="font-size:36px;">','<span style="font-size:42px;">', '</span>');
				$content = str_replace($bbcode3, $htmlcode3, $content);
				
				/** profile to link ([profile id=XXX] -> <a href=profile.php?hvzid=XXX>)	**/
				$content = preg_replace("#\[profile id=(.+?)\](.+?)\[/profile\]#is", 
							"<a href=\"".$_SERVER['SERVER_NAME']."/profile.php?hvzid=\"\\1\">\\2</a>", $content );
				/** market id to link ([market id=XXX] -> <a href=marketplace/viewitem.php?item=XXX>)**/
				$content = preg_replace("#\[market id=(.+?)\](.+?)\[/market\]#is", 
							"<a href=\"".$_SERVER['SERVER_NAME']."/marketplace/viewitem.php?item=\"\\1\">\\2</a>", $content );
							
				/** url to link ([url]link[/url] -> <a href="link">http://link</a>) **/
				$content = preg_replace("#\[url\](.+?)\[/url\]#is", 
							"<a href=\"http://".$_SERVER['SERVER_NAME']."/link.php?lnk=\\1\" class=\"forumlink\" target=\"_blank\">\\1</a>", $content );
				/** url with http:// to link ([url]http://link[/url] -> <a href="link">http://link</a>) **/
				$content = preg_replace("#\[url\]http://(.+?)\[/url\]#is", 
							"<a href=\"http://".$_SERVER['SERVER_NAME']."/link.php?lnk=\\1\" class=\"forumlink\" target=\"_blank\">\\1</a>", $content );
				/** url with https:// to link ([url]http://link[/url] -> <a href="link">http://link</a>) **/
				$content = preg_replace("#\[url\]https://(.+?)\[/url\]#is", 
							"<a href=\"https://".$_SERVER['SERVER_NAME']."/link.php?lnk=\\1\" class=\"forumlink\" target=\"_blank\">\\1</a>", $content );
				/** img to actual linked image ([img]link[/img] -> <img src="link" />) **/
				$content = preg_replace("#\[img\](.+?)\[/img\]#is", 
							"<img src=\"\\1\" />", $content );
							/**** COLOR -> strreplace
				
				
							
				/** link to profiles by @Firstname Lastname **/
				preg_match_all("#(@(.+?)\b (.+?)\b)#is", $content, $matches, PREG_PATTERN_ORDER);
			
				$query = "SELECT COUNT(id) FROM members WHERE firstname='".$matches[2][0]."' AND lastname='".$matches[3][0]."' GROUP BY id";
				$result = mysqli_query($cxn, $query);
				$row = mysqli_fetch_assoc($result);
				if($row['COUNT(id)'] != 0)	//if its not tagging a specific person, dont put it in
				{	
					$content = preg_replace("#(@(.+?)\b (.+?)\b)#is","<a href=\"http://".$_SERVER['SERVER_NAME']."/profile.php?s=lookup&firstname=\\2&lastname=\\3\" class=\"forumlink\">\\2 \\3</a>",$content);
				}
				
				/** Link to other posts **/
				$content = preg_replace("#(\#(.+?)\b)#is", 
							"<a href=\"\\1\" class=\"forumlink\" />\\1</a>", $content );
				
				$content = http_to_link($content);	//add links
							
				$content = bbcode_colors($content);	//add colors

				
			break;	//end 'forum_post'



			case 'message':
				if($content == '[internal firstmessage]')
				{
					/** Future firstmessage get
						$query = "SELECT firstmessage FROM administrative WHERE school='".$_COOKIE['school_short']."'";
						$result = mysqli_query($cxn, $query);
						$x = mysqli_fetch_assoc($result);
						$txt = $x['firstmessage'];
					**/
					$content = "Welcome to hvzatfsu.com,".PHP_EOL."We have changed a lot since the first time we opened. And we have opened a lot of new things. Each member has a <a href=\"profile.php\">profile,</a> and a <a href=\"http://blog.hvzatfsu.com\">blog</a>. The basics are all still there, and if you have played before, your HvZID shouldn't have changed.".PHP_EOL."Welcome to the site. Don't hesitatie to <a href=\"feedback.php\">contact</a> us if you have help, or check out the <a href=\"help.php\">help pages</a>".PHP_EOL;
					
				}
				
				
				//bbcode to easy html ([b] -> <strong>)
				$bbcode = array('[b]', '[/b]', '[i]', '[/i]', '[u]', '[/u]', '[center]', '[/center]', '[s]', '[/s]');	//simple conversion bb code
				$htmlcode = array('<strong>', '</strong>', '<em>', '</em>', '<span style="text-decoration:underline;">', '</span>', '<center>', '</center>', '<span style="text-decoration:line-through;">', '</span>');					
				$content = str_replace($bbcode, $htmlcode, $content);
				
				
				$content = http_to_link($content);	//add links
				
				$content = bbcode_colors($content);	//add colors
				
			break;	//end case 'message'



			case 'blog_post':
			//insert code
			break;	//end case 'blog_post'



			case 'about_me':
				//bbcode to easy html ([b] -> <strong>)
				$bbcode = array('[b]', '[/b]', '[i]', '[/i]', '[u]', '[/u]', '[center]', '[/center]');	//simple conversion bb code
				$htmlcode = array('<strong>', '</strong>', '<em>', '</em>', '<span style="text-decoration:underline;">', '</span>', '<center>', '</center>');			
				$content = str_replace($bbcode, $htmlcode, $content);
				
				$content = http_to_link($content);	//add links								
				
			break;	//end case 'about_me'



			case 'index_post':
				$content = http_to_link($content);
			break;	//end case 'index_post';


			default:
			case 'no_formatting':
				//do nothing
			break;
		}	
		
		$query = "SELECT allow_smileys, word_filter FROM administrative WHERE school='".$_COOKIE['school_short']."'";
		$result = mysqli_query($cxn, $query);
		$x = mysqli_fetch_assoc($result);
		
		$allow_smileys = $x['allow_smileys'];
		$word_filter = $x['word_filter'];
		if($allow_smileys == 1)
		{
		
		}
		if($word_filter == 1)
		{
			$content = wordfilter($content);
		}
		
		return $content;
	 } //end function

	function bbcode_colors($content)
	{
		/** color to style color ([color= ]-> <span style="font-color: "></span>) **/
		$content = preg_replace("#\[color=(.+?)\]#is", 
							"<span style=\"color:\\1\">", $content );
		$content = str_replace("[/color]","</span>",$content);
				
		//codes for colors
		$colorwords = array('color:blue', 'color:red', 'color:limegreen', 'color:yellow', 'color:black', 	//color names
							'color:orange', 'color:pink', 'color:purple', 'color:teal', 'color:silver', 
							'color:brown', 'color:green', 'color:cyan', 'darkblue', 'color:garnet',
							'color:gold', 'color:lightgrey', 'color:darkgrey', 'color:magenta', 'color:darkpurple');
							
		$htmlcolors = array('color:#0000FF', 'color:#FF0000', 'color:#00FF00', 'color:#FFFF00', 'color:#000000',	//color codes
							'color:#FFA500', 'color:#FF91A4', 'color:#800080', 'color:#008080', 'color:#C0C0C0', 	//color:#rrggbb
							'color:#964B00', 'color:#008000', 'color:#00FFFF', 'color:#00008B', 'color:#8B0000',
							'color:#FFD700', 'color:#BEBEBE', 'color:#808080', 'color:#FF1DCE', 'color:#682860');
		
		$content = str_replace($colorwords, $htmlcolors, $content);	//change words to colors
		
		return $content;
	}	//end function
	
	function http_to_link($content)
	{
		/** url with http:// to link ([http://link -> <a href="link">http://link</a>) **/
	//	$content = preg_replace("@(http(s)?://([\w+?\.\w+])+([a-zA-Z0-9\~\!\@\#\$\%\^\&amp;\*\(\)_\-\=\+\\\/\?\.\:\;\'\,]*)?)@", "<a href=\"\\1\" class=\"playerinfo\" target=\"_blank\" link=\"outlink\">\\1</a>", $content);
		
		preg_match_all("@(http(s)?://([\w+?\.\w+])+([a-zA-Z0-9\~\!\@\#\$\%\^\&amp;\*\(\)_\-\=\+\\\/\?\.\:\;\'\,]*)?)@", $content, $matches, PREG_PATTERN_ORDER);
		$replace =  "<a href=\"http://".$_SERVER['SERVER_NAME']."/link.php?lnk=".rawurlencode(html_entity_decode($matches[1][0]))."\" class=\"playerinfo\" target=\"_blank\">".rawurldecode($matches[1][0])."</a>";
		
		$content = preg_replace("@(http(s)?://([\w+?\.\w+])+([a-zA-Z0-9\~\!\@\#\$\%\^\&amp;\*\(\)_\-\=\+\\\/\?\.\:\;\'\,]*)?)@", $replace, $content);
				
		return $content;
	}	//end function
	
	function wordfilter($text)
	{
		global $cxn;
		
		return $text;
	}


?>