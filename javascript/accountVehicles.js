$.ajax({
        url: "server/functions.php",
        type: "post",
        context: document.body,
        data: {'com': 'accountVehiclesLoad'},
        success: function(response, textStatus, jqXHR){
		if (!response.success) {
			//There was some kind of php error
			alert(response.errors.reason);
		} else {
			//Display the vehicle information
			var vehicles = response.data;
			var string = '<div id = "accountVehiclesContent" name = "accountVehiclesContent" >';
			$.each(vehicles, function(index, value) {
				if (value.image != null) {
					string = string + '<img src = "' + value.image + '"/><br/>';
				}
				string = string + 'Model: ' + value.model + '<br/>Fuel: ' + value.fuel 
					+ '<br/>Submodel: '+ value.submodel + '<br/>Year: ' + value.year;
				string = string + '<button onclick="selectVehicle(value)" value="' + value.serialNumber + '">Select Vehicle</button><br/>';
				string = string + '<button onclick="removeVehicle(value)" value="' + value.serialNumber + '">Remove Vehicle</button><br/>';
			});
			string = string + '</div>';
			$('#accountVehiclesContent').replaceWith(string);
			$('#accountVehiclesContent').trigger('create');
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

//Selects the vehicles
function selectVehicle(value) {
    $.ajax({
	url: "server/functions.php",
        type: "post",
        context: document.body,
        data: {'com': 'accountVehicleSessionSave', 'serialNumber': value},
        success: function(response, textStatus, jqXHR){
		//Continue to the parts page	
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

//Removes the vehicles
function removeVehicle(value) {
   $.ajax({
        url: "server/functions.php",
        type: "post",
        context: document.body,
        data: {'com': 'accountVehicleRemove', 'serial': value},
        success: function(response, textStatus, jqXHR){
		//Transition to the account vehicles page		
		var path = window.location.pathname;
		path = path.substring(0, path.lastIndexOf('/'));
		window.location = path + "/accountVehicles.html";
        },
        error: function(jqXHR, textStatus, errorThrown){
            //Alert the user they must log in
		alert("You must be logged in to save a vehicle.");
        }
    });
}
