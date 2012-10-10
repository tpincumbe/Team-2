var userName = null;
$.ajax({
        url: "server/createJsonSession.php",
        type: "post",
        context: document.body,
        data: {'com': 'loginHeader'},
        success: function(response, textStatus, jqXHR){
		if (response.userName != undefined) {
			userName = response.userName;
		}
		//If login was successful, display name
		if (userName != null) {
			$('.loginLink').replaceWith('<p align="right" class="loginLink"> Welcome ' + userName + ' <a href="myAccount.html">My account</a> <a onClick="logout()" href="login.html">Logout</a></p>');
		} else {
		//Otherwise, just display login
			$('.loginLink').replaceWith('<p align="right" class="loginLink"><a href="login.html" id>Login</a></p>');
		}
		$('#headerBar').trigger('create');
        },
        error: function(jqXHR, textStatus, errorThrown){
            // log the error to the console
            console.log(
                "The following error occured: "+
                textStatus, errorThrown
            );
		//Cancel login
		$('.loginLink').replaceWith('<p align="right" class="loginLink"><a href="login.html" id>Login</a></p>');
		$('#headerBar').trigger('create');
        }
    });

//Logs out the user
function logout() {
$.ajax({
        url: "server/functions.php",
        type: "post",
        context: document.body,
        data: {'com': 'logout'},
        success: function(response, textStatus, jqXHR){
		//Return to the login page	
		var path = window.location.pathname;
		path = path.substring(0, path.lastIndexOf('/'));
		window.location = path + "/login.html";
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
