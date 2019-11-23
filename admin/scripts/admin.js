// JavaScript Document

$(document).ready(function(){
	$('input#create_attendance').live('click', function(){
		$.ajax({
			type: 'GET',
			url: 'ajax/create_attendance_list.php',
			cache: false,
			beforeSend: function(){
				$('div#create_attendance').show();
				$('input#create_attendance').attr('disabled', 'true');
			},
			complete: function(){
				$('div#create_attendance').hide();
				$('input#create_attendance').removeAttr('disabled');
			},
			success: function(){
				//window.location='?action=enterattendance';
			},
			error: function(){
				
			}
		});
	});
});

function create_attendance()
{
	$.ajax({
		type: 'GET',
		url: 'ajax/create_attendance_list.php',
		cache: false,
		beforeSend: function(){
			$('div#create_attendance').show();
			$('input#create_attendance').attr('disabled', 'true');
		},
		complete: function(){
			$('div#create_attendance').hide();
			$('input#create_attendance').removeAttr('disabled');
		},
		success: function(){
			window.location='?action=enterattendance';
		},
		error: function(){
			
		}
	});
			
}