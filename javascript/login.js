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
	    alert("Response: " + response);
            //Finsih this function to parse json response.
	    //alert(JQuery.parseJSON(response));
            var success = response.success;
	    alert("Success: " + success);
	    if (!success) {
            	var error = response.errors.reason;
            	$('#loginResult').text("Unable to log in");
	    } else {
		//Continue to the account page
		var path = window.location.pathname;
		var authorized = response.data.auth;
		var accountID = "";
		alert("Success: " + success + " auth: " + authorized);
		if (authorized == true)
		    accountID = response.data.accountID;
		
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
