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
				$('#myAccountLink').css('display', 'inline-block');
				$('#loginLink').text("Logout");
			} else {
			//Otherwise, just display login
				$('.myAccountLink').hide();
			}
        },
        error: function(jqXHR, textStatus, errorThrown){
            // log the error to the console
            console.log(
                "The following error occured: "+
                textStatus, errorThrown
            );
		//Cancel login
		$('.logout').remove(); 
		//$('#headerBar').trigger('create');
		$(document).trigger('pagecreate');
        }
    });

//Logs out the user
function logout() {
	window.location() = "login.html";
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
