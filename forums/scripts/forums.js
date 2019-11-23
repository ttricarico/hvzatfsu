// JavaScript Document
// (c) 2011 Thomas Tricarico

$(window).bind('hashchange', function() {		//if someone clicks a post link in the thread, it highlights that post
	var hash = window.location.hash;
	hash = hash.replace('#', '');
	$('div.post').css('background-color', '#FFFFFF');
	$('div#' + hash).css('background-color', '#FFFFA8');
});

/*** Quick Post Form Submit Function ***/
function quickformsubmit(){
	var postcontent = $("#postcontent").val();
	var threadid = getUrlVars()['threadid'];
	if(postcontent.length == 0)
	{	$("span#qperror").show();	return false;}
	else{
		var dataString = 'threadid=' + threadid + '&postcontent=' + postcontent;  
		$.ajax({
			type: "POST",
			url: "ajax/new_quickpost.php",
			data: dataString,
			dataType: 'html',
			beforeSend: function(){
				$(".qploading").show();	//show loading circle
				$(".formtext").attr("disabled", "true");	//disable text fields
				$("input#newpostbtn").attr("disabled", "true"); //disable button
			},
			complete: function(){
				$('textarea#postcontent').removeAttr('disabled'); //enable text area
				$(".formtext").removeAttr("disabled");	//enable text
				$("input#newpostbtn").removeAttr("disabled"); //enable button
				$('span.qploading').hide();
			},
			success:function(html){
				$(html).appendTo('div#allposts').fadeIn(1000);
				$('textarea#postcontent').val('');	//clear textbox
			},
			error: function(){
				$("span#qperror").html("There was a problem, please try again").show();
			}
		});
		return false;
	}
}


