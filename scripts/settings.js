/*** Javascript for settings page ***/

// clears password field
$(document).ready(function(){
	$("#password").click(function(){
		$(this).val("");	
	}); 
}); 

//clears phone number field
$(document).ready(function(){
	$("#phonenum").click(function(){
		$(this).val("");	
	}); 
}); 

// clears email field
$(document).ready(function(){
	$("#email").click(function(){
		$(this).val("");	
	}); 
}); 

$(document).ready(function(){
	$("#accountsubmit").click(function(){
		if($("#email").val() == null) {
			$(this).val(varphone);
			return false;
		}
	});
});