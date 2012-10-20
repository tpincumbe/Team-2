//Calls the login code
function login() {
    uname = $('#usernameField').val();
    pwd = $('#passwordField').val(); 
    $.ajax({
        url: "server/functions.php",
        type: "post",
        context: document.body,
        data: {'com': 'login', 'username': uname, 'password': pwd},
        success: function(response, textStatus, jqXHR){
            //Finsih this function to parse json response.
            var success = response.success;
	    if (!success) {
            	var error = response.errors.reason;
            	$('#loginResult').text("Unable to log in");
	    } else {
		//Continue to the account page
		/*var authorized = response.data.auth;
		var accountID = "";
		if (authorized == true)
		    accountID = response.data.accountID;*/
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
}
