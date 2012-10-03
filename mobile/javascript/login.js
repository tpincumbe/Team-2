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
            	$('#loginResult').text("Welcome, " + uname);
		$('.loginLink').replaceWith('<p align="right" class="loginLink"> Welcome ' + uname + '  <a href="login.html">Login to Different User</a></p>');
		$('#headerBar').trigger('create');
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
