$.ajax({
        url: "server/functions.php",
        type: "post",
        context: document.body,
        data: {'com': 'partInfoLoad'},
        success: function(response, textStatus, jqXHR){
		if (!response.success) {
			//There was some kind of php error
			alert(response.errors.reason);
		} else {
			//Display the vehilce information
			var part = response.data;
			var partName = part.name;
			var description = part.description;
			var price = part.price;
			var category = part.categoryName;
			var subcategory = part.subcategoryName;
			var availability = part.availability
			$('#partInfoResultContent').replaceWith('<div id = "partInfoResultContent" name = "partInfoResultContent" > Name: ' + partName + '<br/>Description: ' + description + '<br/>Price: ' + price + '<br/>Category: ' + category + '<br/>Subcategory: ' + subcategory + '<br/>Availability: ' + availability + '</div>');
			$('#partInfoResultContent').trigger('create');
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

//Save the part to the account
function addToCart() {
$.ajax({
        url: "server/functions.php",
        type: "post",
        context: document.body,
        data: {'com': 'addToCart'},
        success: function(response, textStatus, jqXHR){
		//Transition to the parts page		
		var path = window.location.pathname;
		path = path.substring(0, path.lastIndexOf('/'));
		window.location = path + "/shoppingCart.html";
        },
        error: function(jqXHR, textStatus, errorThrown){
            // log the error to the console
		alert("You must be logged in to use the shopping cart.");
        }
    });
}
