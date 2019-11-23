// JavaScript Document

function checkkill(form)
	{
		var error, err;
			error = "";
			err=0;
		if(form.yourhvzid.value == "")
		{
			error += "       Your HvZID\n";
			err=1;
			form.focus();
		}
		if(form.theirhvzid.value == "")
		{
			error += "       Your HvZID\n";
			err=1;
			form.focus();
		}
		if(form.hvzidext.value == "")
		{
			error += "       Their HvZID Extension\n";
			err=1;
			form.focus();
		}
		if(form.theirhvzid.value == "")
		{
			error += "       Their HvZID\n";
			err=1;
			form.focus();
		}
		
		if(error != 0)
		{
			alert("You are missing information: \r\n"+error);
			return false;
		}



		else {return true;}
	}