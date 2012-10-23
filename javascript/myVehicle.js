//Calls the code to search by serial number
function serialNumberSearch() {
    serialNumber = $('#serialNumber').val();
    $.ajax({
        url: "server/functions.php",
        type: "post",
        context: document.body,
        data: {'com': 'serialsearch', 'serial': serialNumber},
        success: function(response, textStatus, jqXHR){
            var success = response.success;
	    if (!success) {
		alert(response.errors.reason);
	    } else {
		//Check if serial number was found or not
		if (response.data.found) {
			var path = window.location.pathname;
			path = path.substring(0, path.lastIndexOf('/'));
			window.location = path + "/vehicleResults.html";
		} else {
			alert("The serial number does not match any records");      
		}     	
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

//Calls the select vehicle code
function selectVehicle() {
    	var path = window.location.pathname;
	path = path.substring(0, path.lastIndexOf('/'));
	window.location = path + "/selectModel.html";
}
