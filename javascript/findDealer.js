var map, myOptions, userLoc, zoom, minZoom = 7, maxZoom = 12;

//Bind enter key to input box
$(document).live("pageinit", function() {
	$('#zipField').keypress(function(event) {
		  if ( event.which == 13 ) {
			  panToZip();
		   }
	});
});

/*
*	This function initializes the google map
*	It centers the map at Georgia Tech and zooms it to show mainly the campus.
*/
function initialize() {
         if (userLoc == null){
                  userLoc = new google.maps.LatLng(37.685921,-97.339725);
                  zoom = 8;
         }
	 myOptions = {
	 zoom: zoom,
	 //center: new google.maps.LatLng(33.777417,-84.397252),		// Center at GA Tech
         center: userLoc,
         zoomControl: true,
         zoomControlOptions: {
                  style: google.maps.ZoomControlStyle.SMALL
         },
	 mapTypeId: google.maps.MapTypeId.ROADMAP
	 }
	 map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);	// Grabs the map element
         
         google.maps.event.addListener(map, 'zoom_changed',
         function() {
              /*if (map.getZoom() < minZoom) {
                  map.setZoom(minZoom);
              }else*/ if (map.getZoom() > maxZoom){
                  map.setZoom(maxZoom);
              };
          });

         getUserLocation();
}

/**
 * Retrieves the user location using HTML 5 geolocations.
 */
function getUserLocation() {
//check if the geolocation object is supported, if so get position
   if (navigator.geolocation)
	navigator.geolocation.getCurrentPosition(retrieveDealers, displayError);
   else
	alert("Sorry - your browser doesn't support geolocation!");
}

/**
 * Makes an ajax call to the databse to retrieve the list of dealers.
 * It will display markers where the dealers are at on the map.
 */
function retrieveDealers(loc){
         userLoc = new google.maps.LatLng(loc.coords.latitude, loc.coords.longitude);
         zoom = 10;
         map.panTo(userLoc);
         map.setZoom(zoom);
                  
        $.ajax({
        url: "server/functions.php",
        type: "post",
        context: document.body,
        data: {'com': 'findDealers', 'lat': loc.coords.latitude, 'lng': loc.coords.longitude, 'zoom': zoom},
        success: function(response, textStatus, jqXHR){
	    //Get the response
	    var resp = jQuery.parseJSON(response);
            var success = resp.success;
	    //Check for php failer
	    if (!success) {
            	var error = resp.errors.reason;
            	$('#errors').text("Unable to retrieve Dealer list");
	    } else {
                  displayDealers(resp.data);
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

/**
 * This takes a list of dealers and places markers with info bubbles with
 * information on teh dealers.
 */
function displayDealers(dealers){
         var i, marker;
	 var infowindow = new google.maps.InfoWindow();
         
	 for (i = 0; i < dealers.length; i++){
                  var address_string = dealers[i].address + "<br/>" + dealers[i].city + ", " + dealers[i].state + " " + dealers[i].zip;
                  var image = "images/ezgo-icon.png";
                  
                  marker = new google.maps.Marker({
                           position: new google.maps.LatLng(dealers[i].lat,dealers[i].lng),
                           map: map,
                           title:dealers[i].name,
                           icon: image
                  });
		 google.maps.event.addListener(marker, 'click', (function(marker, i) {
			 return function(){
				 infowindow.setContent(
				 	'<div id="content" class="infoBubble">'+
					'<div id="siteNotice">'+ '</div>'+
					'<h4 id="firstHeading" class="firstHeading">'+ dealers[i].name + '</h4>'+
					'<div id="bodyContent" class="infoBubble">'+
						'<p>' + address_string + '</p>' +  
						'<p>' + dealers[i].phone + '</p>' + 
						'<p><a class="dealerLink" href="http://' + dealers[i].url + '" target="blank">' + dealers[i].url + '</a></p>' + 
					'</div>'+
					'</div>');
				 infowindow.open(map,marker);
			 }
		 })(marker, i));
	 }
}

function panToZip(){
         var zip = $('#zipField').val();
         var geocoder = new google.maps.Geocoder();
         geocoder.geocode({address: zip},
                  function(results_array, status) { 
                    var lat = results_array[0].geometry.location.lat();
                    var lng = results_array[0].geometry.location.lng();
                    userLoc = new google.maps.LatLng(lat, lng);
                    map.panTo(userLoc);
         });
}

/**
 * Displays an error to the user if retrieving the user's location failed.
 */
function displayError(error) { 

//get a reference to the HTML element for writing result
var locationElement = document.getElementById("locationData");

//find out which error we have, output message accordingly
switch(error.code) {
case error.PERMISSION_DENIED:
	alert("Permission was denied");
	break;
case error.POSITION_UNAVAILABLE:
	alert("Location data not available");
	break;
case error.TIMEOUT:
	alert("Location request timeout");
	break;
case error.UNKNOWN_ERROR:
	alert("An unspecified error occurred");
	break;
default:
	alert("Who knows what happened...");
	break;
}}