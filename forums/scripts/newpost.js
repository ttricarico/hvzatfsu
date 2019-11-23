// JavaScript Document
//(c) 2011 Thomas Tricarico

/*** Form Submit Function ***/
function newpost_submit(){
	var postcontent = $("#popup_postcontent").val();
	var hvzid = $("#hvzid").val();
	var threadid = getUrlVars()['threadid'];
	if(postcontent == "")
	{	$("span#posterror").show();	return false;}
	else{
		var dataString = 'name='+ name + '&hvzid=' + hvzid + '&ipaddr=' + ipaddr + '&threadid=' + threadid + '&postcontent=' + postcontent;  
		$(".loading").show();	//show loading circle
		$(".formtext").attr("disabled", "true");	//disable text fields
		$("input#newpostbtn").attr("disabled", "true"); //disable button
		$.ajax({
			type: "POST",
			url: "index.php?action=newpost2",
			data: dataString,
			success:function(){
				$('#popupframebody').html("<h1 align=\"center\">Message Posted</h1>");
				$('#popupframe').delay(1500).fadeOut(500);
				$("input#newpostbtn").removeAttr("disabled"); //enable button
				$("div#getnewpost").slideDown(100);
			},
			error: function(){
				$(".loading").hide();	//hide loading circle
				$(".formtext").removeAttr("disabled");	//enable text
				$("input#newpostbtn").removeAttr("disabled"); //enable button
				$("span#posterror").html("There was a problem, please try again").show();
			}
		});
		return false;
	}
}


/** Edit Post functions **/
$(document).ready(function(){
	$('a#btn_bold').live('click', function(){	$('textarea#popup_postcontent').insertRoundCaret('b','b');	});
	$('a#btn_italic').live('click', function(){	$('textarea#popup_postcontent').insertRoundCaret('i', 'i');	});
	$('a#btn_ul').live('click', function(){	$('textarea#popup_postcontent').insertRoundCaret('u', 'u');	});
	$('a#btn_st').live('click', function(){	$('textarea#popup_postcontent').insertRoundCaret('s', 's');	});
	$('a#btn_link').live('click', function(){	$('textarea#popup_postcontent').insertRoundCaret('url', 'url');	});
	$('a#btn_img').live('click', function(){	$('textarea#popup_postcontent').insertRoundCaret('img=*insert link*', 'img');	});
	$('a#btn_center').live('click', function(){	$('textarea#popup_postcontent').insertRoundCaret('center', 'center');	});
	$('a#btn_quote').live('click', function(){	$('textarea#popup_postcontent').insertRoundCaret('quote', 'quote');	});
	$('a#btn_fontsize_1').live('click', function(){	$('textarea#popup_postcontent').insertRoundCaret('size=1', 'size');	});
	$('a#btn_fontsize_2').live('click', function(){	$('textarea#popup_postcontent').insertRoundCaret('size=2', 'size');	});
	$('a#btn_fontsize_3').live('click', function(){	$('textarea#popup_postcontent').insertRoundCaret('size=3', 'size');	});
	$('a#btn_fontsize_4').live('click', function(){	$('textarea#popup_postcontent').insertRoundCaret('size=4', 'size');	});
	$('a#btn_fontsize_5').live('click', function(){	$('textarea#popup_postcontent').insertRoundCaret('size=5', 'size');	});
	$('a#btn_fontsize_6').live('click', function(){	$('textarea#popup_postcontent').insertRoundCaret('size=6', 'size');	});
	$('a#btn_fontsize_7').live('click', function(){	$('textarea#popup_postcontent').insertRoundCaret('size=7', 'size');	});
	$('a#btn_fontsize_8').live('click', function(){	$('textarea#popup_postcontent').insertRoundCaret('size=8', 'size');	});
	$('a#btn_fontsize_9').live('click', function(){	$('textarea#popup_postcontent').insertRoundCaret('size=9', 'size');	});
	$('a#btn_fontsize_10').live('click', function(){	$('textarea#popup_postcontent').insertRoundCaret('size=10', 'size');	});
	$('a#btn_black').live('click', function(){	$('textarea#popup_postcontent').insertRoundCaret('color=black', 'color');	})
	$('a#btn_blue').live('click', function(){	$('textarea#popup_postcontent').insertRoundCaret('color=blue', 'color'); })
	$('a#btn_brown').live('click', function(){	$('textarea#popup_postcontent').insertRoundCaret('color=brown', 'color'); });
	$('a#btn_cyan').live('click', function(){	$('textarea#popup_postcontent').insertRoundCaret('color=cyan', 'color'); });
	$('a#btn_darkblue').live('click', function(){	$('textarea#popup_postcontent').insertRoundCaret('color=darkblue', 'color'); });
	$('a#btn_darkgrey').live('click', function(){	$('textarea#popup_postcontent').insertRoundCaret('color=darkgrey', 'color'); });
	$('a#btn_darkpurple').live('click', function(){	$('textarea#popup_postcontent').insertRoundCaret('color=darkpurple', 'color'); });
	$('a#btn_garnet').live('click', function(){	$('textarea#popup_postcontent').insertRoundCaret('color=garnet', 'color'); });
	$('a#btn_gold').live('click', function(){	$('textarea#popup_postcontent').insertRoundCaret('color=gold', 'color'); });
	$('a#btn_green').live('click', function(){	$('textarea#popup_postcontent').insertRoundCaret('color=green', 'color'); });
	$('a#btn_lightgrey').live('click', function(){	$('textarea#popup_postcontent').insertRoundCaret('color=lightgrey', 'color'); });
	$('a#btn_limegreen').live('click', function(){	$('textarea#popup_postcontent').insertRoundCaret('color=limegreen', 'color'); });
	$('a#btn_magenta').live('click', function(){	$('textarea#popup_postcontent').insertRoundCaret('color=magenta', 'color'); });
	$('a#btn_orange').live('click', function(){	$('textarea#popup_postcontent').insertRoundCaret('color=orange', 'color'); });
	$('a#btn_pink').live('click', function(){	$('textarea#popup_postcontent').insertRoundCaret('color=pink', 'color'); });
	$('a#btn_purple').live('click', function(){	$('textarea#popup_postcontent').insertRoundCaret('color=purple', 'color'); });
	$('a#btn_red').live('click', function(){	$('textarea#popup_postcontent').insertRoundCaret('color=red', 'color'); });
	$('a#btn_silver').live('click', function(){	$('textarea#popup_postcontent').insertRoundCaret('color=silver', 'color'); });
	$('a#btn_teal').live('click', function(){	$('textarea#popup_postcontent').insertRoundCaret('color=teal', 'color'); });
	$('a#btn_yellow').live('click', function(){	$('textarea#popup_postcontent').insertRoundCaret('color=yellow', 'color');	});
	
	
	/** View Post Before Submitted **/
	$('input#viewpost').live('click', function(){
		var postcontent = $('textarea#popup_postcontent').val();
		$.ajax({
			   type: 'POST',
			   url: 'ajax/view_unposted_post.php',
			   cache: false,
			   data: 'pc=' + postcontent,
			   dataType: 'html',
			   beforeSend: function(){
					$('div#popupframefooter').show();
				 	$('div#popupframefoooter').html('<div id="popupfooter_loader"><br /><center><img src="../images/loadingicons/redloader.gif" title="Loading..." /></center><br /></div>').show();
			   },
			   complete: function(){
				   
			   },
			   success: function(html){
				   $('div#popupframefooter').html('');
				   $(html).appendTo('div#popupframefooter');
				   $('div#popupframefooter').append('<div><strong>To go back to writing your post, <a href="javascript://" id="back_to_writing" class="playerinfo">click here</a></strong></div>');
				   $('div#popupframebody').hide();
			   },
			   error: function(ex){
				   
			   }
		});
	});
	
	/** Back to editing post **/
	$('a#back_to_writing').live('click', function(){
		$('div#popupframefooter').fadeOut(500);
		$('div#popupframebody').delay(500).slideDown(500);
	});
	
	
	// Fade in frame box for new post
	$("#newpostbtn").click(function(){
		$.ajax({
				type:'GET',
				url: 'ajax/newpost.php',
				cache: false,
				dataType: 'html',
				beforeSend: function(){
					$('div#popupframe').fadeIn(500);
				},
				success: function(html){
					$('div#head_left').html('New Post');
					$('div#popupframebody').html('');
					$(html).appendTo('div#popupframebody');
					$('div#popupframefooter').html('');

					
				},
				error: function(){
					$('div#head_left').html('Error');
					$('div#popupframebody').html('There was a problem loading the frame. Please Try again.');
				}
		});
	});
});