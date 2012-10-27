//https://gdata.youtube.com/feeds/api/users/ezgotv/uploads
var videos = new Array();
var numVideos = 0;
$(document).live("pageinit", function() {
  retrieveVideoList();
});

/**
 * Makes an ajax call to the youtube api to retrieve a list of
 * videos made by e-z-go
 */
function retrieveVideoList(){
    $.ajax({
        url: "https://gdata.youtube.com/feeds/api/users/ezgotv/uploads",
        type: "get",
        context: document.body,
        dataType: "xml",
        success: function(xml){
            $(xml).find("entry").each(function(){
                var id = $(this).find("id").text();
                var title = $(this).find("title").text();
                var content = $(this).find("content").text();
                var mlink = "";
                $(this).find("link").each(function(){
                    var index = $(this).attr('rel').indexOf('#') + 1;
                    var str = $(this).attr('rel').substring(index);
                    if (str == "mobile"){
                        mlink = $(this).attr("href");
                    }
                });
                var i = 0;
                var thumbnail = "";
                var height = 0, width = 0;
                //This will only work on chrome
                $(this).find("group").find("thumbnail").each(function(){
                    if (i == 2){
                        thumbnail = $(this).attr("url");
                        height = $(this).attr("height");
                        width = $(this).attr("width");
                    }else {
                        i++;
                    }
                });
                var vid = new Video(id, title, content, mlink, thumbnail, height, width);
                videos[numVideos++] = vid;
            });
            printVideos();
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

/**
 * Will write a thumbnail image and link onto the page for a user to click on
 */
function printVideos(){
    var table = '<table>\n';
    for(var i = 0; i < videos.length; i++){
        var str = '<tr><td>\n'
        str += '<a href="' + videos[i].mlink +'">\n';
        str += '<img src="' + videos[i].thumbnail +'"/></a></td>\n';
        str += '<td><a href="' + videos[i].mlink +'">\n';
        str += videos[i].title + '\n';
        str +=  '</a></td></tr>\n';
        table  += str;
    }
    table += '</table>\n';
    $('.videos').append(table);
    
    //
}

function showInstallation(){
  alert("Installations");
}

function showFeatured(){
  alert("Featured");
}

function showPerformance(){
  alert("Performance");
}

function showMaintenance(){
  alert("Maintenance");
}