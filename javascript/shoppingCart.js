$.ajax({
        url: "server/functions.php",
        type: "post",
        context: document.body,
        data: {'com': 'shoppingCartLoad'},
        success: function(response, textStatus, jqXHR){
		if (response.success) {
			//Display the parts information
			var parts = response.data;
			var sum = 0;
			if (parts.length > 0) {
				var string = '<div id = "productList" name = "productList" >';
				string = string + '<div id = "totalCost" name = "totalCost" style = "font-size:200%;font-weight:bold;text-align:center">' + "Total: sumGoesHere </div>" + '<br/><button onClick="checkout()">Checkout</button>' + "<br/><br/>";
				string = string + "Items in Cart: <br/><br/>";
				$.each(parts, function(index, value) {
					if (value.image != null) {
						string = string + '<img src = "' + value.image + '"/><br/>';
					}
					string = string + 'Name: ' + value.name + '<br/>Price: '+ value.price;
					string = string + '<button onclick="removePart(value)" value="' + value.partNumber + '">Remove Part</button><br/>';
					sum = sum + parseFloat(value.price);
				});
				string = string + '</div>';
				string = string.replace("sumGoesHere", "$" + sum);
			} else {
				var string = '<div id = "productList" name = "productList" >' + 'No items currently in the cart.' + '</div>';
			}			
			$('#productList').replaceWith(string);
			$('#productList').trigger('create');
		} else {
			var string = '<div id = "productList" name = "productList" >' + 'No items currently in the cart.' + '</div>';
			$('#productList').replaceWith(string);
			$('#productList').trigger('create');
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

//Checks out
function checkout() {
   $.ajax({
        url: "server/functions.php",
        type: "post",
        context: document.body,
        data: {'com': 'checkout'},
        success: function(response, textStatus, jqXHR){
		//Transition to the account vehicles page		
		var path = window.location.pathname;
		path = path.substring(0, path.lastIndexOf('/'));
		window.location = path + "/shoppingCart.html";
        },
        error: function(jqXHR, textStatus, errorThrown){
            //Alert the user they must log in
            console.log(
                "The following error occured: "+
                textStatus, errorThrown
            );
        }
    });
}

//Removes the Part
function removePart(value) {
   $.ajax({
        url: "server/functions.php",
        type: "post",
        context: document.body,
        data: {'com': 'shoppingCartRemove', 'part': value},
        success: function(response, textStatus, jqXHR){
		//Transition to the account vehicles page		
		var path = window.location.pathname;
		path = path.substring(0, path.lastIndexOf('/'));
		window.location = path + "/shoppingCart.html";
        },
        error: function(jqXHR, textStatus, errorThrown){
            //Alert the user they must log in
            console.log(
                "The following error occured: "+
                textStatus, errorThrown
            );
        }
    });
}
