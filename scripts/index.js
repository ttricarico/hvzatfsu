// Javascript Document - index.js
// (c)2011 Thomas Tricarico and others


$(document).ready(function(){
	$('a#editevents').click(function(){
		$.ajax({
			type: 'GET',
			url: 'ajax/getevents.php',
			dataType: 'html',
			beforeSend: function(){
				$('div#popupframe').fadeIn(500);
			},
			success: function(html){
				$('div#head_left').html('Edit Events');
				$('div#popupframebody').html(html);
			},
			error: function(){
				$('div#head_left').html('Edit Events');				
				$('div#popupframebody').html('There was a problem loading the events. Please wait a moment and try again.');
			}

		});
	});

	$.ajax({
		type: 'GET',
		url: 'ajax/index_getcomments.php',
		dataType: 'html',
		beforeSend: function(){
			$('div#actualcomments').html('<br /><center>Loading...</center><br /><br />');
		},
		success: function(html){
			$('div#actualcomments').html($(html).html());
		}
	});
});




$('div#newposts').click(function(){

});
