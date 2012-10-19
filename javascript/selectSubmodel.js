$.ajax({
        url: "server/functions.php",
        type: "post",
        context: document.body,
        data: {'com': 'selectSubmodelLoad'},
        success: function(response, textStatus, jqXHR){
		if (!response.success) {
			//There was some kind of php error
			alert(response.errors.reason);
		} else {
			//Display the Submodel information
			var submodels = response.data;
			var string = '<div id = "selectSubmodelContent" name = "selectSubmodelContent" >';
			$.each(submodels, function(index, value) {
				string = string + '<button onclick="selectSubmodel(value)" value="' + value.submodelId + '">' + value.name + '</button><br/>'
			});
			string = string + '</div>';
			$('#selectSubmodelContent').replaceWith(string);
			$('#selectSubmodelContent').trigger('create');
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

//Selects the Submodel
function selectSubmodel(value) {
$.ajax({
        url: "server/functions.php",
        type: "post",
        context: document.body,
        data: {'com': 'selectSubmodelSave', 'submodel': value},
        success: function(response, textStatus, jqXHR){
		//Continue to the year page	
		var path = window.location.pathname;
		path = path.substring(0, path.lastIndexOf('/'));
		window.location = path + "/selectYear.html";
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
