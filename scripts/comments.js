// Javascript Document - comments.js
// (c)2011 Thomas Tricarico and others


$(document).ready(function(){
	$('input#submit').click(function(){
		submitcomment();
	});
});

function submitcomment()
{
	var comment = $('textarea#commenttext').val();
	if(comment.length > 450)
	{
		//change to a more elegant popupbox
		alert('You must have less than 450 characters');
	}
	else if(comment.length < 1)
	{
		//change to a more elegant popupbox
		alert('You may not submit an empty post.');
	}
	else
	{
		var dataString = 'c=' + comment;
		dataString = encodeURI(dataString);
		$.ajax({
			type:'POST',
			url: 'ajax/index_postcomment.php',
			dataType: 'html',
			data: dataString,
			cache: false,
			beforeSend: function(){
				$('span#loader_commentpost').show();
				$('textarea#commenttext').attr('disabled', 'true');
				$('input#submit').attr('disabled', 'true');
			},
			complete: function(){
				$('textarea#commenttext').removeAttr('disabled');
				$('input#submit').removeAttr('disabled');
				$('span#loader_commentpost').hide();
			},
			success: function(html){
				$('textarea#commenttext').val('');
				$('div#submitcomment').fadeOut(100);
				$('div#actualcomments').prepend(html);
			},
			error: function(ex){
				alert('Error: '+ ex);	//replace with more elegant error
			}
		});
	}
}
