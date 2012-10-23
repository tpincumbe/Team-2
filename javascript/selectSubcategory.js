$.ajax({
        url: "server/functions.php",
        type: "post",
        context: document.body,
        data: {'com': 'selectSubcategoryLoad'},
        success: function(response, textStatus, jqXHR){
		if (!response.success) {
			//There was some kind of php error
			alert(response.errors.reason);
		} else {
			//Display the Subcategory information
			var fuels = response.data;
			var string = '<div id = "partSubategoryList" name = "partSubategoryList" >';
			$.each(fuels, function(index, value) {
				string = string + '<button onclick="selectSubcategory(value)" value="' + value.subcategoryId + '">' + value.name + '</button><br/>'
			});
			string = string + '</div>';
			$('#partSubategoryList').replaceWith(string);
			$('#partSubategoryList').trigger('create');
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

//Selects the Subcategory
function selectSubcategory(value) {
$.ajax({
        url: "server/functions.php",
        type: "post",
        context: document.body,
        data: {'com': 'selectSubcategorySave', 'subcategory': value},
        success: function(response, textStatus, jqXHR){
		//Continue to the results page	
		var path = window.location.pathname;
		path = path.substring(0, path.lastIndexOf('/'));
		window.location = path + "/partsSearchResults.html";
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
