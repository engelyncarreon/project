function myFunction1() {
	$.ajax({
		url: "../otherFiles/navigation/view_notification.php",
		type: "POST",
		processData:false,
		success: function(data){
			$("#notification-count").remove();					
			$("#notification-latest").show();$("#notification-latest").html(data);
		},
		error: function(){}           
	});
    	 
$(document).ready(function() {
	$('body').click(function(e){
		if ( e.target.id != 'notification-icon'){
			$("#notification-latest").hide();
		}
	});
});
}

function myFunction2() {
	$.ajax({
		url: "../otherFiles/navigation/instrNotif.php",
		type: "POST",
		processData:false,
		success: function(data){
			$("#notification-count").remove();					
			$("#notification-latest").show();$("#notification-latest").html(data);
		},
		error: function(){}           
	});
    	 
$(document).ready(function() {
	$('body').click(function(e){
		if ( e.target.id != 'notification-icon'){
			$("#notification-latest").hide();
		}
	});
});
}
	 
function myFunction3() {
	$.ajax({
		url: "../otherFiles/navigation/studNotif.php",
		type: "POST",
		processData:false,
		success: function(data){
			$("#notification-count").remove();					
			$("#notification-latest").show();$("#notification-latest").html(data);
		},
		error: function(){}           
	});
    	 
$(document).ready(function() {
	$('body').click(function(e){
		if ( e.target.id != 'notification-icon'){
			$("#notification-latest").hide();
		}
	});
});
}
