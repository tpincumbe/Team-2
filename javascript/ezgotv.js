//https://gdata.youtube.com/feeds/api/users/ezgotv/uploads
var numVideos = 0;
var installations, featured, maintenance, performance, misc;

$(document).live("pageinit", function() {
  retrieveVideoList();
  $('#videoCategories').change(function(){
	  var cat = $('#videoCategories').val();
	  
	  if (cat == "inst"){
		  showInstallation();
	  }else if (cat == "feat"){
		  showFeatured();
	  }else if (cat == "perf"){
		  showPerformance();
	  }else if (cat == "maint"){
		  showMaintenance();
	  }
  });
});

/**
 * Makes an ajax call to the youtube api to retrieve a list of
 * videos made by e-z-go
 */
function retrieveVideoList(){
  if (installations == null){
    $.ajax({
        url: "server/functions.php",
        type: "get",
        context: document.body,
        data: {'com': 'retrieveVideos'},
        success: function(response, textStatus, jqXHR){
	    //Get the response
	    var resp = jQuery.parseJSON(response);
            var success = resp.success;
	    //Check for php failer
	    if (!success) {
            	var error = resp.errors.reason;
            	$('#errors').text("Unable to retrieve video list");
	    } else {
                  parseList(resp.data);
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
}

/**
 * object that represents a single video
 */
function Video(id, title, content, mlink, thumbnail, height, width){
    this.id = id;
    this.title = title;
    this.content = content;
    this.mlink = mlink;
    this.thumbnail = thumbnail;
    this.height = height;
    this.width = width;
}

function parseList(videos){
  installations = "<table align='center'><tr>";
  featured = "<table align='center'><tr>";
  maintenance = "<table align='center'><tr>";
  performance = "<table align='center'><tr>";
  misc = "<table align='center'><tr>";
  
  for (var i = 0; i < videos.length; i++){
    var str = '<tr><td>\n'
        str += '<a href="' + videos[i].URL +'">\n';
        str += '<img src="' + videos[i].Image +'"/></a></td>\n';
        str += '<td><a href="' + videos[i].URL +'" class="video" id="video">\n';
        str += videos[i].Title + '\n';
        str +=  '</a></td></tr>\n';
    
    if (videos[i].Category == "Installation"){
      installations += str;
    }else if (videos[i].Category == "Featured"){
      featured += str;
    }else if (videos[i].Category == "Maintenance"){
      maintenance += str;
    }else if (videos[i].Category == "Performance"){
      performance += str;
    }else if (videos[i].Category == "Misc"){
      misc += str;
    }
  }
  
  installations += "</table><br/>";
  featured += "</table><br/>";
  maintenance += "</table><br/>";
  performance += "</table><br/>";
  misc += "</table><br/>";
  
  showInstallation();
}

function showInstallation(){
  $('.videos').empty();
  $('.videos').append(installations);
}

function showFeatured(){
  $('.videos').empty();
  $('.videos').append(featured);
}

function showPerformance(){
  $('.videos').empty();
  $('.videos').append(performance);
}

function showMaintenance(){
  $('.videos').empty();
  $('.videos').append(maintenance);
}