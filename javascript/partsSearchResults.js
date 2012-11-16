getResults(0);

//Loads the results
function getResults(start) {
$.ajax({
        url: "server/functions.php",
        type: "post",
        context: document.body,
        data: {'com': 'partsSearchLoadResults', 'start': start},
        success: function(response, textStatus, jqXHR){
		if (!response.success) {
			//There was some kind of php error
			$('#partsSearchResultsContent').append('No Parts Found');
		} else {
			//Display the Part information
			var parts = response.data;
			var string = '<div id = "partsSearchResultsContent" name = "partsSearchResultsContent" align="center">';
			$.each(parts, function(index, value) {
				if (value.image != null) {
					string = string + '<img src = "' + value.image + '"/><br/>';
				}
				string = string + 'Name: ' + value.name + '<br/>Number: ' + value.partNumber + '<br>Price: $' + value.price + '<button onclick="selectPart(value)" value="' + value.partNumber + '">' + 'View ' + value.name + '</button><br/>'
			});
			//Add the previous and next button if necesary
			if (start > 0) {
				string = string + '<button onclick="getResults(' + (start - 10) + ')"> Previous 10 </button>'
			}
			if (parts.length == 10) {
					string = string + '<button onclick="getResults(' + (start + 10) + ')"> Next 10 </button>'	
			}
			string = string + '</div>';
			$('#partsSearchResultsContent').replaceWith(string);
			$('#partsSearchResultsContent').trigger('create');
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

//Selects the Part
function selectPart(value) {
$.ajax({
        url: "server/functions.php",
        type: "post",
        context: document.body,
        data: {'com': 'partsSearchSelectPart', 'part': value},
        success: function(response, textStatus, jqXHR){
		//Continue to the part page	
		var path = window.location.pathname;
		path = path.substring(0, path.lastIndexOf('/'));
		window.location = path + "/partInfo.html";
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
