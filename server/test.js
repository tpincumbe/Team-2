var command = "login";
function testone(){
    var uname = "tim";
    var pwd = "abc";
    login(uname, pwd)
}

function testtwo(){
    var uname = "trey";
    var pwd = "bca";
    login(uname, pwd)
}

function testthree(){
    var uname = "trey";
    var pwd = "abc";
    login(uname, pwd);
}

function login(uname, pwd){
    $.ajax({
        url: "login.php",
        type: "post",
        context: document.body,
        data: {'com': 'login', 'username': uname, 'password': pwd},
        success: function(response, textStatus, jqXHR){
            //Finsih this function to parse json response.
            var success = response.success;
	    if (!success) {
            	var error = response.errors.reason;
            	$('#result').text(success + " " + error);
	    } else {
            	$('#result').text(success);
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
