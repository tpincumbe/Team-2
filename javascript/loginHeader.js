function myAccount() {
$.ajax({
        url: "server/createJsonSession.php",
        type: "post",
        context: document.body,
        data: {'com': 'loginHeader'},
        success: function(response, textStatus, jqXHR){
		var userName = null;
		if (response.userName != undefined) {
			userName = response.userName;
		}
		//If login was successful, go to my account page
		if (userName != null) {
			var path = window.location.pathname;
			path = path.substring(0, path.lastIndexOf('/'));
			window.location = path + "/myAccount.html";
		} else {
		//Otherwise, go to login page
			var path = window.location.pathname;
			path = path.substring(0, path.lastIndexOf('/'));
			window.location = path + "/login.html";
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
