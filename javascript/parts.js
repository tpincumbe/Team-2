$.ajax({
        url: "server/functions.php",
        type: "post",
        context: document.body,
        data: {'com': 'partsLoad'},
        success: function(response, textStatus, jqXHR){
		if (!response.success) {
			//There was some kind of php error
			alert(response.errors.reason);
		} else {
			if (response.data.found) {
				//Display the vehilce information
				var model = response.data.model;
				var fuel = response.data.fuel;
				var submodel = response.data.submodel;
				var year = response.data.year;
				$('#partsOverviewContent').replaceWith('<div id = "partsOverviewContent" name = "partsOverviewContent" > Currently Selected Vehicle: <br> Model: ' + model + '<br/>Fuel: ' + fuel + '<br/>Submodel: ' + submodel + '<br/>Year: ' + year + '<button onClick="cancel()" id="removeFilterButton" name="removeFilterButton">Remove Vehicle Filter</button></div>');
				$('#partsOverviewContent').trigger('create');
			} else {
				//Display general parts info
				$('#partsOverviewContent').replaceWith('<div id = "partsOverviewContent" name = "partsOverviewContent" > Parts!</div>');
				$('#partsOverviewContent').trigger('create');
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

//Cancels the vehicle selection
function cancel() {
$.ajax({
        url: "server/functions.php",
        type: "post",
        context: document.body,
        data: {'com': 'vehicleFilterCancel'},
        success: function(response, textStatus, jqXHR){
		//Return to the my vehicle page		
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
