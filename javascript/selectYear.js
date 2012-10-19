$.ajax({
        url: "server/functions.php",
        type: "post",
        context: document.body,
        data: {'com': 'selectYearLoad'},
        success: function(response, textStatus, jqXHR){
		if (!response.success) {
			//There was some kind of php error
			alert(response.errors.reason);
		} else {
			//Display the Year information
			var years = response.data;
			var string = '<div id = "selectYearContent" name = "selectYearContent" >';
			$.each(years, function(index, value) {
				string = string + '<button onclick="selectYear(value)" value="' + value.yearId + '">' + value.name + '</button><br/>'
			});
			string = string + '</div>';
			$('#selectYearContent').replaceWith(string);
			$('#selectYearContent').trigger('create');
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

//Selects the Year
function selectYear(value) {
$.ajax({
        url: "server/functions.php",
        type: "post",
        context: document.body,
        data: {'com': 'selectYearSave', 'year': value},
        success: function(response, textStatus, jqXHR){
		//Continue to the results page	
		var path = window.location.pathname;
		path = path.substring(0, path.lastIndexOf('/'));
		window.location = path + "/vehicleResults.html";
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
