$.ajax({
        url: "server/functions.php",
        type: "post",
        context: document.body,
        data: {'com': 'vehicleResultsLoad'},
        success: function(response, textStatus, jqXHR){
		if (!response.success) {
			//There was some kind of php error
			alert(response.errors.reason);
		} else {
			//Display the vehilce information
			var model = response.data.model;
			var fuel = response.data.fuel;
			var submodel = response.data.submodel;
			var year = response.data.year;
			$('#vehicleResultsContent').replaceWith('<div id = "vehicleResultsContent" name = "vehicleResultsContent" > Model: ' + model + '<br/>Fuel: ' + fuel + '<br/>Submodel: ' + submodel + '<br/>Year: ' + year + '</div>');
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

//Cancels the vehicle selection
function cancel() {
$.ajax({
        url: "server/functions.php",
        type: "post",
        context: document.body,
        data: {'com': 'vehicleResultsCancel'},
        success: function(response, textStatus, jqXHR){
		//Return to the my vehicle page		
		var path = window.location.pathname;
		path = path.substring(0, path.lastIndexOf('/'));
		window.location = path + "/myVehicle.html";
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

//Saves the vehicle to the logged in account
function saveToAccount() {
	alert("To be implemented- Save to account");
}

//Save the vehicle to the session and go to the parts page
function shopNow() {
$.ajax({
        url: "server/functions.php",
        type: "post",
        context: document.body,
        data: {'com': 'vehicleResultsSessionSave'},
        success: function(response, textStatus, jqXHR){
		//Transition to the parts page		
		var path = window.location.pathname;
		path = path.substring(0, path.lastIndexOf('/'));
		window.location = path + "/parts.html";
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
