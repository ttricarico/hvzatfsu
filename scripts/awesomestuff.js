/***  Email and Password Login Box Activation Crap ***/
	$(document).ready(function(){
		$("#loginemail").focus(function(){
			$("#loginemail").attr("style", "color:#000000;width:125px;");
			$("#loginemail").attr("value", "");
		});
		$("#loginemail").focusout(function(){
			if($("#loginemail").val() == false)
			{	$("#loginemail").attr("style", "color:#606060; width:125px;");
				$("#loginemail").attr("value", "Email");
			}
			else
			{	/**do nothing**/ }
		});
		
		$("#loginpass").focus(function(){
			$("#loginpass").attr("style", "color:#000000;width:125px;");
			$("#loginpass").attr("value", "");
		});
		
		$("#loginpass").focusout(function(){
			if($("#loginpass").val() == false)
			{	$("#loginpass").attr("style", "color:#606060 ; width:125px;");
				$("#loginpass").attr("value", "Password"); 
			}
			else
			{	/**do nothing**/ }
		});

	});
	
	//Get url variables
	function getUrlVars() {
		var vars = {};
		var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
			vars[key] = value;
		});
		return vars;
	}
	function closepopupframe(){
			$("#popupframe").fadeOut(1500);
			$("#popupframebody").html('<h2>Loading...</h2><center><img src="images/icons/redloader.gif" title="Loading..." alt="Loading..." /></center><br /><br />');

	}

	//Search Box Clearer
	$(document).ready(function(){
		$("#search").click(function(){
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
	});
