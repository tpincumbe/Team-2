//Bind enter key to input box
$(document).live("pageinit", function() {
	$('#usernameField').keypress(function(event) {
		  if ( event.which == 13 ) {
			  $('#passwordField').focus();
		   }
	});
	
	$('#passwordField').keypress(function(event) {
		  if ( event.which == 13 ) {
			  login();
		   }
	});
});

//Calls the login code
function login() {
    uname = $('#usernameField').val();
    pwd = $('#passwordField').val(); 
    if (uname == null || pwd == null || uname=="" || pwd==""){
    	alert("Please fill out your user name and password");
    }else {
	    $.ajax({
	        url: "server/functions.php",
	        type: "post",
	        context: document.body,
	        data: {'com': 'login', 'username': uname, 'password': pwd},
	        success: function(response, textStatus, jqXHR){
			    //Get the response
			    var resp = response;
		            var success = resp.success;
			    //Check for php failer
			    if (!success) {
		            	var error = resp.errors.reason;
				alert(error);
		            	$('#loginResult').text("Unable to log in");
			    } else {
					//Check for successful login
					var authorized = resp.data.auth;
					if (authorized == true){
					        //Continue to the account page
						var path = window.location.pathname;
						path = path.substring(0, path.lastIndexOf('/'));
						window.location = path + "/myAccount.html";
					} else {
						alert("Invalid login");
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
    }
}
