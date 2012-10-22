var map, myOptions, userLoc, zoom;

/*
*	This function initializes the google map
*	It centers the map at Georgia Tech and zooms it to show mainly the campus.
*/
function initialize() {
         if (userLoc == null){
                  userLoc = new google.maps.LatLng(37.6922, 97.3372);
                  zoom = 8;
         }
	 myOptions = {
	 zoom: zoom,
	 //center: new google.maps.LatLng(33.777417,-84.397252),		// Center at GA Tech
         center: userLoc,
	 mapTypeId: google.maps.MapTypeId.ROADMAP
	 }
	 map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);	// Grabs the map element
}

function getUserLocation() { 
//check if the geolocation object is supported, if so get position
if (navigator.geolocation)
	navigator.geolocation.getCurrentPosition(retrieveDealers, displayError);
else
	$('#errors').append("Sorry - your browser doesn't support geolocation!");
}

function retrieveDealers(loc){
        $.ajax({
        url: "server/functions.php",
        type: "post",
        context: document.body,
        data: {'com': 'findDealers', 'lat': loc.coords.latitude, 'lng': loc.coords.longitude, 'zoom': zoom},
        success: function(response, textStatus, jqXHR){
	    //Get the response
	    var resp = response;
            var success = resp.success;
	    //Check for php failer
	    if (!success) {
            	var error = resp.errors.reason;
            	$('#errors').text("Unable to retrieve Dealer list");
	    } else {
                  userLoc = new google.maps.LatLng(loc.coords.latitude, loc.coords.longitude);
                  zoom = 15;
                  map.panTo(userLoc);
                  map.setZoom(zoom);
                  displayDealers(resp.dealers);
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

function displayDealers(dealers){
         var i, marker;
	 var infowindow = new google.maps.InfoWindow();
	 
	 for (i = 0; i < dealers.length; i++){
                  var address_string = dealers[i].address + "<br/>" + dealers[i].city + ", " + dealers[i].state + " " + dealers[i].zip;
                  marker = new google.maps.Marker({
                           position: new google.maps.LatLng(dealers[i].lat,dealers[i].lng),
                           map: map,
                           title:dealers[i].name
                  });
		 google.maps.event.addListener(marker, 'click', (function(marker, i) {
			 return function(){
				 infowindow.setContent(
				 	'<div id="content">'+
					'<div id="siteNotice">'+ '</div>'+
					'<h4 id="firstHeading" class="firstHeading">'+ dealers[i].name + '</h4>'+
					'<div id="bodyContent">'+
						'<p>' + address_string + '</p>' +  
						'<p>' + dealers[i].phone + '</p>' + 
						'<p>' + dealers[i].url + '</p>' + 
					'</div>'+
					'</div>');
				 infowindow.open(map,marker);
			 }
		 })(marker, i));
	 }
}

function displayError(error) { 

//get a reference to the HTML element for writing result
var locationElement = document.getElementById("locationData");

//find out which error we have, output message accordingly
switch(error.code) {
case error.PERMISSION_DENIED:
	$('#errors').append("Permission was denied");
	break;
case error.POSITION_UNAVAILABLE:
	$('#errors').append("Location data not available");
	break;
case error.TIMEOUT:
	$('#errors').append("Location request timeout");
	break;
case error.UNKNOWN_ERROR:
	$('#errors').append("An unspecified error occurred");
	break;
default:
	$('#errors').append("Who knows what happened...");
	break;
}}

/*
*	Once the page is fully loaded we will build the map
*/
$(document).live("pageinit", function() {
  initialize();
  getLocation();
});
