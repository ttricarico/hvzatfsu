// JavaScript Document

//Get url variables
	function getUrlVars() {
		var vars = {};
		var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
			vars[key] = value;
		});
		return vars;
	}
	
	function rawurlencode(str)
	{
		// URL-encodes string  
		// 
		// version: 1103.1210
		// discuss at: http://phpjs.org/functions/rawurlencode    // +   original by: Brett Zamir (http://brett-zamir.me)
		// +      input by: travc
		// +      input by: Brett Zamir (http://brett-zamir.me)
		// +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +      input by: Michael Grier    // +   bugfixed by: Brett Zamir (http://brett-zamir.me)
		// +      input by: Ratheous
		// +      reimplemented by: Brett Zamir (http://brett-zamir.me)
		// +   bugfixed by: Joris
		// +      reimplemented by: Brett Zamir (http://brett-zamir.me)    // %          note 1: This reflects PHP 5.3/6.0+ behavior
		// %        note 2: Please be aware that this function expects to encode into UTF-8 encoded strings, as found on
		// %        note 2: pages served as UTF-8
		// *     example 1: rawurlencode('Kevin van Zonneveld!');
		// *     returns 1: 'Kevin%20van%20Zonneveld%21'    // *     example 2: rawurlencode('http://kevin.vanzonneveld.net/');
		// *     returns 2: 'http%3A%2F%2Fkevin.vanzonneveld.net%2F'
		// *     example 3: rawurlencode('http://www.google.nl/search?q=php.js&ie=utf-8&oe=utf-8&aq=t&rls=com.ubuntu:en-US:unofficial&client=firefox-a');
		// *     returns 3: 'http%3A%2F%2Fwww.google.nl%2Fsearch%3Fq%3Dphp.js%26ie%3Dutf-8%26oe%3Dutf-8%26aq%3Dt%26rls%3Dcom.ubuntu%3Aen-US%3Aunofficial%26client%3Dfirefox-a'
		str = (str + '').toString(); 
		// Tilde should be allowed unescaped in future versions of PHP (as reflected below), but if you want to reflect current
		// PHP behavior, you would need to add ".replace(/~/g, '%7E');" to the following.
		return encodeURIComponent(str).replace(/!/g, '%21').replace(/'/g, '%27').replace(/\(/g, '%28').
		replace(/\)/g, '%29').replace(/\*/g, '%2A');
	}
	
	function reset_popupframe()
	{
		 //set up basic template
		$('div#popupframe').html('<div id="popupframehead"><div class="clearer"></div></div><div id="popupframebody"><div class="clearer"></div></div><div id="popupframefooter"><div class="clearer"></div></div>');

		// Now fill in template
		$('div#popupframehead').prepend('<div id="head_left"><h2>Loading...</h2></div><div id="head_right"><a href="javascript://" id="closepopupframe" onclick="closepopupframe();" title="Close">X</a></div>');
		$('div#popupframebody').prepend('<center><img src="images/icons/redloader.gif" title="Loading..." alt="Loading..." /></center><br /><br /><br />');
		$('div#popupframefooter').prepend('<center>Please wait a moment while we fetch your content</center>');
	}
	

	
	$(document).ready(function(){
		//Search Box Clearer
		$("#search").bind('click', function(){
			$("#search").attr("style", "color:#000000;width:250px;");
			$(this).val("");	
		}); 
		$("#search").focusout(function(){
			if($("#search").val() == false)
			{	$("#search").attr("style", "color:#606060; width:250px;");
				$("#search").attr("value", "Search by name or HvZID");
			}
			else
			{	/**do nothing**/ }
		});
		
		//popupframe closer
		$('a#closepopupframe').live('click', function(){
			$('div#popupframe').fadeOut(500);
			reset_popupframe();
		});
	});