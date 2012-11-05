//Loads the filter
$.ajax({
        url: "server/functions.php",
        type: "post",
        context: document.body,
        data: {'com': 'partsFilterLoad'},
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
				var image = response.data.image;
				var div = '<div id = "partsOverviewContent" name = "partsOverviewContent" > Currently Selected Vehicle: <br/>';
				if (image != null) {
					div = div + '<img src = "' + image + '"/><br/>';
				}
				div = div + 'Model: ' + model + '<br/>Fuel: ' + fuel + '<br/>Submodel: ' + submodel + '<br/>Year: ' + year + '<button onClick="cancel()" id="removeFilterButton" name="removeFilterButton">Remove Vehicle Filter</button>' + '</div>';
				$('#partsOverviewContent').replaceWith(div);
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

//Loads all the parts categories
$.ajax({
        url: "server/functions.php",
        type: "post",
        context: document.body,
        data: {'com': 'partCategoryLoad'},
        success: function(response, textStatus, jqXHR){
		if (!response.success) {
			alert(response.errors.reason);
		} else {
			//Display the Category information
			var categories = response.data;
			var string = '<div id = "partCategoryList" name = "partCategoryList" >';
			$.each(categories, function(index, value) {
				string = string + '<button onclick="selectCategory(value)" value="' + value.categoryId + '">' + value.name + '</button><br/>'
			});
			string = string + '</div>';
			$('#partCategoryList').replaceWith(string);
			$('#partCategoryList').trigger('create');
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

//Searches for parts
function partsSearch() {
partNumber = $('#partSearch').val();
$.ajax({
        url: "server/functions.php",
        type: "post",
        context: document.body,
        data: {'com': 'partsSearch', 'part': partNumber},
        success: function(response, textStatus, jqXHR){
            var success = response.success;
	    if (!success) {
		//There were no results		
		alert(response.errors.reason);
	    } else {
		var path = window.location.pathname;
		path = path.substring(0, path.lastIndexOf('/'));
		window.location = path + "/partsSearchResults.html";
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

function selectCategory(value) {
$.ajax({
        url: "server/functions.php",
        type: "post",
        context: document.body,
        data: {'com': 'selectCategorySave', 'category': value},
        success: function(response, textStatus, jqXHR){
		//Continue to the fuel page	
		var path = window.location.pathname;
		path = path.substring(0, path.lastIndexOf('/'));
		window.location = path + "/selectSubcategory.html";
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
