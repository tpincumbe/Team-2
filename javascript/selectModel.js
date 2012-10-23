$.ajax({
        url: "server/functions.php",
        type: "post",
        context: document.body,
        data: {'com': 'selectModelLoad'},
        success: function(response, textStatus, jqXHR){
		if (!response.success) {
			//There was some kind of php error
			alert(response.errors.reason);
		} else {
			//Display the model information
			var models = response.data;
			var string = '<div id = "selectModelContent" name = "selectModelContent" >';
			$.each(models, function(index, value) {
				string = string + '<button onclick="selectModel(value)" value="' + value.modelId + '">' + value.name + '</button><br/>'
			});
			string = string + '</div>';
			$('#selectModelContent').replaceWith(string);
			$('#selectModelContent').trigger('create');
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

//Selects the model
function selectModel(value) {
$.ajax({
        url: "server/functions.php",
        type: "post",
        context: document.body,
        data: {'com': 'selectModelSave', 'model': value},
        success: function(response, textStatus, jqXHR){
		//Continue to the fuel page	
		var path = window.location.pathname;
		path = path.substring(0, path.lastIndexOf('/'));
		window.location = path + "/selectFuel.html";
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
