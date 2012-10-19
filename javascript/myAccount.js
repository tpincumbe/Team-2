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
