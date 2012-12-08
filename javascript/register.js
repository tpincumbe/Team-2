function register(){
    var uname = $('#usernameField').val();
    var password = $('#passwordField').val();
    var confirmPassword = $('#confirmPasswordField').val();
    var address = $('#addressField').val();
    var city = $('#cityField').val();
    var state = $('#stateField').val();
    var zip = $('#zipField').val();
    var email = $('#emailField').val();
    var offers = 'N';
    if ($('#offersField').is(':checked')) {
        offers = 'Y'
    }
    
    var valid = $("#registration").validate().checkForm();
    
    if (password == confirmPassword && valid){
        $.ajax({
	        url: "server/functions.php",
	        type: "post",
	        context: document.body,
	        data: {'com': 'register', 'username': uname, 'password': password, 'address': address,
	                'city': city, 'state': state, 'zip': zip, 'email': email, 'offers': offers},
	        success: function(response, textStatus, jqXHR){
		    //Get the response
		    var resp = response;
	            var success = resp.success;
		    //Check for php failer
		    if (!success) {
	            	var error = resp.errors.reason;
			alert(error);
		    } else {
			var path = window.location.pathname;
			path = path.substring(0, path.lastIndexOf('/'));
			window.location = path + "/myAccount.html";
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
    }else {
    	if (!valid){
    		alert("Please fill out entire form.");
    	}else {
    		alert("Passwords do not match");
    	}
    }
}