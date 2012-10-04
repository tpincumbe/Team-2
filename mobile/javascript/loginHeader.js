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
			$('.loginLink').replaceWith('<p align="right" class="loginLink"> Welcome ' + userName + '  <a href="login.html">Login to Different User</a></p>');
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
