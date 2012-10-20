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
	    var resp = jQuery.parseJSON(response);
            var success = resp.success;
	    
	    if (!success) {
            	var error = resp.errors.reason;
            	$('#loginResult').text("Unable to log in");
	    } else {
		//Continue to the account page
		var authorized = resp.data.auth;
		var accountID = "";
		var uname = "";
		
		if (authorized == true){
		    accountID = resp.data.accountID;
		    uname = resp.data.userName;
		}
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