var oldEmail = '';
$.ajax({
        url: "server/functions.php",
        type: "post",
        context: document.body,
        data: {'com': 'loadAccountInfo'},
        success: function(response, textStatus, jqXHR){
		if (!response.success) {
			//There was some kind of php error
			alert("Error:" + response.errors.reason);
		} else {
			//Put the email and the offers into their field
				$('#emailField').val(response.data.email);
				oldEmail = response.data.email;
			if (response.data.offers == 'Y') {
				$('#offersField').prop('checked', true);
			} else {
				$('#offersField').prop('checked', false);
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

//Updates account information
function updateAccount() {
   var oldPassword = $('#oldPasswordField').val();
   var newPassword = $('#newPasswordField').val();
   var confirmPassword = $('#confirmPasswordField').val();
   var email = $('#emailField').val();
   var offers = 'N';
   if ($('#offersField').is(':checked')) {
	offers = 'Y'
   }
   
   if ((newPassword != '') && (newPassword != confirmPassword)){
	alert("New password does not match. Please try again.");
   }else {
	$.ajax({
	     url: "server/functions.php",
	     type: "post",
	     context: document.body,
	     data: {'com': 'updateAccount', 'oldPassword': oldPassword, 'newPassword': newPassword,
		      'email': email, 'offers': offers},
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
