/*
*	This function initializes the google map
*	It centers the map at Georgia Tech and zooms it to show mainly the campus.
*/
function initialize() {
	 var myOptions = {
	 zoom: 15,
	 center: new google.maps.LatLng(33.777417,-84.397252),		// Center at GA Tech
	 mapTypeId: google.maps.MapTypeId.ROADMAP
	 }
	 var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);	// Grabs the map element
	 
	 /*var i, marker, printers = window.printers;
	 var infowindow = new google.maps.InfoWindow();
	 
	 for (i = 0; i < printers.length; i++){
		 marker = new google.maps.Marker({
		 	position: new google.maps.LatLng(printers[i].latitude,printers[i].longitude),
		  	map: map,
		 	title:printers[i].name
		 });
		
		 google.maps.event.addListener(marker, 'click', (function(marker, i) {
			 return function(){
				 infowindow.setContent(
				 	'<div id="content">'+
					'<div id="siteNotice">'+ '</div>'+
					'<h2 id="firstHeading" class="firstHeading">'+ printers[i].building + '</h2>'+
					'<div id="bodyContent">'+
						'<p>Printer Type: ' + printers[i].printer_type + '</p>' +  
						'<p>Location: ' + printers[i].location + '</p>' + 
						'<p>Uses Free Printer Funds: ' + printers[i].free + '</p>' + 
					'</div>'+
					'</div>');
				 infowindow.open(map,marker);
			 }
		 })(marker, i));
	 }*/
}

/*
*	This function queries the printer database and returns an array of all the printer data
*/
function getPrinters() {
    var printerData;
    $.ajax({
       url: "../../api/david/printer_locations",	// Location of database functions
	    context: document.body,
        success: function(data)				// Returns data if database was sucesfully queried
        {
			window.printers = jQuery.parseJSON(data);
			loadScript();
        }
    });
}

/*
*	Once the page is fully loaded we will build the map
*/
$(document).ready(function() {
   initialize();
});
