//Bind enter key to input box
$(document).live("pageinit", function() {
	$('#usernameField').keypress(function(event) {
		  if ( event.which == 13 ) {
			  $('#passwordField').focus();
		   }
	});
	
	$('#passwordField').keypress(function(event) {
		  if ( event.which == 13 ) {
			  $('#addressField').focus();
		   }
	});
	
	$('#confirmPasswordField').keypress(function(event) {
		  if ( event.which == 13 ) {
			  $('#addressField').focus();
		   }
	});
	
	$('#addressField').keypress(function(event) {
		  if ( event.which == 13 ) {
			  $('#zipField').focus();
		   }
	});
	
	$('#zipField').keypress(function(event) {
		  if ( event.which == 13 ) {
			  $('#emailField').focus();
		   }
	});
	
	$('#emailField').keypress(function(event) {
		  if ( event.which == 13 ) {
			  register();
		   }
	});
});

function register(){
    var uname = $('#usernameField').val();
    var password = $('#passwordField').val();
    var confirmPassword = $('#confirmPasswordField').val();
    var address = $('#addressField').val();
    var city = $('#cityField').val();
    var state = $('#stateField').val();
    var zip = $('#zipField').val();
    var email = $('#emailField').val();
    var offers = 'N';
    if ($('#offersField').is(':checked')) {
        offers = 'Y'
    }
    
    var valid = $("#registration").validate().checkForm();
    
    if (password == confirmPassword && valid){
        $.ajax({
	        url: "server/functions.php",
	        type: "post",
	        context: document.body,
	        data: {'com': 'register', 'username': uname, 'password': password, 'address': address,
	                'city': city, 'state': state, 'zip': zip, 'email': email, 'offers': offers},
	        success: function(response, textStatus, jqXHR){
		    //Get the response
		    var resp = response;
	            var success = resp.success;
		    //Check for php failer
		    if (!success) {
	            	var error = resp.errors.reason;
			alert(error);
		    } else {
			var path = window.location.pathname;
			path = path.substring(0, path.lastIndexOf('/'));
			window.location = path + "/myAccount.html";
		    }
	        },
	        error: function(jqXHR, textStatus, errorThrown){
	            // log the error to the console
	            console.log(
	                "The following error occured: "+
	                textStatus, errorThrown
	            );				$('#offersField').prop('checked', false).checkboxradio('refresh');
	        }
        });
    }else {
    	if (!valid){
    		alert("Please fill out entire form.");
    	}else {
    		alert("Passwords do not match");
    	}
    }
}

//Updates the checkbox and dropdown reset
function checkboxDropdownReset() {
	$('#offersField').prop('checked', false).checkboxradio('refresh');
        $('#stateField').val('AL').selectmenu('refresh');
}
