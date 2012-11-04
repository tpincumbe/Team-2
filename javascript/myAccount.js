//Redirects to the update account page
function updateAccount() {
    	var path = window.location.pathname;
	path = path.substring(0, path.lastIndexOf('/'));
	window.location = path + "/updateAccount.html";
}

//Redirects to the account vehicles page
function accountVehicles() {
    	var path = window.location.pathname;
	path = path.substring(0, path.lastIndexOf('/'));
	window.location = path + "/accountVehicles.html";
}

//Redirects to the shopping cart page
function shoppingCart() {
    	var path = window.location.pathname;
	path = path.substring(0, path.lastIndexOf('/'));
	window.location = path + "/shoppingCart.html";
}

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
