$.ajax({
        url: "server/functions.php",
        type: "post",
        context: document.body,
        data: {'com': 'selectFuelLoad'},
        success: function(response, textStatus, jqXHR){
		if (!response.success) {
			//There was some kind of php error
			alert(response.errors.reason);
		} else {
			//Display the Fuel information
			var fuels = response.data;
			var string = '<div id = "selectFuelContent" name = "selectFuelContent" >';
			$.each(fuels, function(index, value) {
				string = string + '<button onclick="selectFuel(value)" value="' + value.fuelId + '">' + value.name + '</button><br/>'
			});
			string = string + '</div>';
			$('#selectFuelContent').replaceWith(string);
			$('#selectFuelContent').trigger('create');
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

//Selects the Fuel
function selectFuel(value) {
$.ajax({
        url: "server/functions.php",
        type: "post",
        context: document.body,
        data: {'com': 'selectFuelSave', 'fuel': value},
        success: function(response, textStatus, jqXHR){
		//Continue to the submodel page	
		var path = window.location.pathname;
		path = path.substring(0, path.lastIndexOf('/'));
		window.location = path + "/selectSubmodel.html";
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
