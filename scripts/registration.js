// JavaScript Document

	function checkform(){
		
		var filter = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
	
		
		$(document).ready(function(){
			$("input#firstname").focusout(function(){
				if($("input#firstname").val() == "")
				{
					$("span.fnerror").show();
					return false;	
				}
				if($("input#firstname").val() != "")
				{
					$("span.fnerror").hide();	
				}
			});
			
			$("input#lastname").focusout(function(){
				if($("input#lastname").val() == "")
				{
					$("span.lnerror").show();
					return false;	
				}
				if($("input#lastname").val() != "")
				{
					$("span.lnerror").hide();	
				}
			});
			
			$("input#password").focusout(function(){
				if($("input#password").val() == "")
				{
					$("span.passerror").show();
					return false;	
				}
				if($("input#lastname").val() != "")
				{
					$("span.passerror").hide();	
				}
				if($("input#password").val() != $("input#repeatpassword").val())
				{
					$("span.passerror2").show();	
					return false;	
				}
				if($("input#password").val() == $("input#repeatpassword").val())
				{
					$("span.passerror2").hide();	
				}
			});
			
			$("input#day").focusout(function(){
				switch($("input#month").val())
				{
					case 1:	
					case 3:
					case 5:	
					case 7:
					case 8:	
					case 10:
					case 12:
						if($("input#day").val() >31)
						{
							$("span.dateerror").show();
							return false;	
						}
					break;
					
					case 4:
					case 6:
					case 9:
					case 11:
						if($("input#day").val() >30)
						{
							$("span.dateerror").show();
							return false;	
						}
					break;
					
					default:
					break;
				}
	
				if($("input#month").val() == 2)
				{
					if($("input#year").val()%4 != 0)
					{
						if($("input#day").val() == 29)
						{
							$("span.dateerror").show();
							return false;	
						}	
					}
					if($("input#day").val() >29)
					{
						$("span.dateerror").show();
						return false;	
					}
				}
	
			});
			
			$("input#email").focusout(function(){
				
				if(!filter.test($("input#email").val()))
				{
					$("span.emailerror").show();
					return false;	
				}
				else if($("input#email").val() == "")
				{
					$("span.emailerror").show();
					return false;	
				}
				else if($("input#email").val() != "")
				{
					$("span.emailerror").hide();
				}
			});
			
			$("input#phone").focusout(function(){
				if($("input#phone").val().length != 10)
				{
					$("span.phoneerror").show();
					return false;	
				}
				if($("input#phone").val().length == 10)
				{
					$("span.phoneerror").hide();
				}
			});
			$("input#secretq").focusout(function(){
				if($("input#secretq").val() == "")
				{
					$("span.sqerror").show();
					return false;	
				}
				if($("input#secretq").val() != "")
				{
					$("span.sqerror").hide();
				}
			});
			
			$("input#secreta").focusout(function(){
				if($("input#secreta").val().length == "")
				{
					$("span.saerror").show();
					return false;	
				}
				if($("input#secreta").val().length != "")
				{
					$("span.saerror").hide();
				}
			});
		});
	}