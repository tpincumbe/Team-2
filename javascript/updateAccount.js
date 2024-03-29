//Bind enter key to input box
$(document).live("pageinit", function() {	
	$('#oldPasswordField').keypress(function(event) {
		  if ( event.which == 13 ) {
			  $('#newPasswordField').focus();
		   }
	});
	
	$('#newPasswordField').keypress(function(event) {
		  if ( event.which == 13 ) {
			  $('#confirmPasswordField').focus();
		   }
	});
	
	$('#confirmPasswordField').keypress(function(event) {
		  if ( event.which == 13 ) {
			  $('#addressField').focus();
		   }
	});
	
	$('#addressField').keypress(function(event) {
		  if ( event.which == 13 ) {
			  $('#zipField').focus();
		   }
	});
	
	$('#zipField').keypress(function(event) {
		  if ( event.which == 13 ) {
			  $('#emailField').focus();
		   }
	});
	
	$('#emailField').keypress(function(event) {
		  if ( event.which == 13 ) {
			  updateAccount();
		   }
	});
	
	$.ajax({
	    url: "server/functions.php",
	    type: "post",
	    context: document.body,
	    data: {'com': 'loadAccountInfo'},
	    success: function(response, textStatus, jqXHR){
		var resp = jQuery.parseJSON(response);
		if (!resp.success) {
			//There was some kind of php error
			alert("Error:" + resp.errors.reason);
		} else {
			//Put the email and the offers into their field
			$('#emailField').val(resp.data.email);
			$('#addressField').val(resp.data.address);
			$('#cityField').val(resp.data.city);
			$('#stateField').val(resp.data.state);
			$('#stateField').selectmenu('refresh');
			$('#zipField').val(resp.data.zip);
			if (resp.data.offers == 'Y') {
				$('#offersField').prop('checked', true).checkboxradio('refresh');
			} else {
				$('#offersField').prop('checked', false).checkboxradio('refresh');
			}
		}
	    },
	    error: function(jqXHR, textStatus, errorThrown){
	        // log the error to the console
	        console.log(
	            "The following error occured: "+
	            textStatus, errorThrown
	        );
	    }
	});
});


//Updates account information
function updateAccount() {
   var oldPassword = $('#oldPasswordField').val();
   var newPassword = $('#newPasswordField').val();
   var confirmPassword = $('#confirmPasswordField').val();
   var email = $('#emailField').val();
   var address = $('#addressField').val();
   var city = $('#cityField').val();
   var state = $('#stateField').val();
   var zip = $('#zipField').val();
   var offers = 'N';
   if ($('#offersField').is(':checked')) {
	offers = 'Y'
   }
   
   if ((newPassword != '') && (newPassword != confirmPassword) ){
	alert("New password does not match. Please try again.");
   }else {
	$.ajax({
	     url: "server/functions.php",
	     type: "post",
	     context: document.body,
	     data: {'com': 'updateAccount', 'oldPassword': oldPassword, 'newPassword': newPassword, 'email': email,
		      'offers': offers, 'address': address, 'city': city, 'state': state, 'zip': zip},
	     success: function(response, textStatus, jqXHR){
		var resp = jQuery.parseJSON(response);
		var success = resp.success;
		if (!success) {
		     alert(resp.errors.reason);
		} else {
		     if (resp.data.updated){
			alert("Update Successful!");
		     }
		     var path = window.location.pathname;
		     path = path.substring(0, path.lastIndexOf('/'));
		     window.location = path + "/updateAccount.html";
		}
	     },
	     error: function(jqXHR, textStatus, errorThrown){
		 // log the error to the console
		 console.log(
		     "The following error occured: "+
		     textStatus, errorThrown
		 );
	     }
	 });
   }
}
