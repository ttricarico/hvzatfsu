// JavaScript Document
/*****
$(window).bind('hashchange', function() {
	var hash = window.location.hash;
	hash = hash.replace('#!/', '');
	
	switch(hash)
	{
		default:
		case 'adminmenu':
			$('div#admin_frame').load('ajax/adminframe.php #adminmenu');
			/**
			$.ajax({
				   type: 'GET',
				   url: 'ajax/adminframe.php',
				   dataType: 'html',
				   beforeSend: function(){
					   $('div#loading').show();
				   },
				   success: function(html){
						$('div#loading').hide();
						$(html).find('div').each(function(){
						//	  if($(this).attr('id') == 'adminmenu')
						//	  {
									$('div#admin_frame').html($(this).html());
						//	  }
						});
					},
				   error: function(ex){
					   $('div#popupframe').html('<div id="popupframehead"></div>');			//create popup box frame with head
					   $('div#popupframe').append('<div id="popupframebody"></div>');		// and body
					   
					   //fill in frame head
					   $('div#popupframehead').html('<span id="popupframehead_left"></span><span id="popupframehead_right"></span>');
					   $('span#popupframehead_left').html('Oh no!');
					   $('span#popupframehead_right').html('<a href="javascript://" id="closepopupframe" onclick="closepopupframe();" title="Close">X</a>');
					   
					   // fill in frame body
					   $('div#popupframebody').html('<blockquote>Oh no! There was an error loading the menu. This can be caused by a number of things. If this is the first time you tried, please wait a minute and try again. If this has happened multiple times, please <a href="siteproblems.php">contact</a> us.<br />The computer returned this error: ' + ex + '<br /><br /></blockquote>');
					   
				   }	//end error
			});
		break;
		
		case 'gamemenu':
			$('div#admin_frame').load('ajax/adminframe.php #gamemenu');
		break;
		
		case 'membermenu':
			$('div#admin_frame').load('ajax/adminframe.php #membermenu');
		break;
		
		case 'ozmenu':
			$('div#admin_frame').load('ajax/adminframe.php #ozmenu');
		break;
		
		case 'webprob':
		
		break;
	}
	
});
***/

function showwidgets()
{
	$('div#widgets_installed').slideDown(1000);
	$('div#show-hide_widgets').html('<a href="javascript://" class="admin" onclick="hidewidgets();">Hide Widgets</a>');
}

function hidewidgets()
{
	$('div#widgets_installed').slideUp(1000);
	$('div#show-hide_widgets').html('<a href="javascript://" class="admin" onclick="showwidgets();">Show Widgets</a>');
}
