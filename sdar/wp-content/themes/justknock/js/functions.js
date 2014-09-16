$(document).ready(function(){

  gutterFix();

  window.onresize = function(event) {
    gutterFix();
  }

  // loadsidebars();
  if ($('.frontpage').length > 0){
    frontpageload();
  }

  $('footer li:last-of-type').click(contactForm);
  $('.contact-form-overlay-bg').click(contactClose);

});

function contactForm(event) {
  event.preventDefault();
  $('.contact-form-overlay').css('display','block');
  $(window).scrollTop(0);
}

function contactClose() {
  $('.contact-form-overlay').css('display','none');
}

function gutterFix() {
  if (window.innerWidth > 970) {
    var width = (window.innerWidth - 985) / 2;
    $('.left-container').css('width',width+"px");
    $('.right-container').css('width',width+"px");
  } else {
    $('.left-container').css('display','none');
    $('.right-container').css('display','none');
  }
  /*var height = $('.body .container').height() - 10;
  $('.left-container').css('height',height+"px");
  $('.right-container').css('height',height+"px");*/
}

function isValidEmailAddress(emailAddress) {
		var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
		return pattern.test(emailAddress);
};

function eventbriteLoad(neighborhood) {
  if (neighborhood) {
    var lat = neighborhood.split(",")[0].trim();
    var long = neighborhood.split(",")[1].trim();
    var baseUrl = "https://www.eventbriteapi.com/v3/events/search/?sort_by=date&location.latitude=" + lat + "&location.longitude=" + long + "&location.within=5mi&token=N7GZJ3GGWYMGJFPDHYXQ";
  } else {
    var baseUrl = "https://www.eventbriteapi.com/v3/events/search/?sort_by=date&location.address=San+Diego&location.within=50mi&token=N7GZJ3GGWYMGJFPDHYXQ";
  }
  if ($('.neighborhood-events-content')){
    $.ajax({
      url : baseUrl,
      datatype: "json",
      type : "GET",
      error : function(jqXHR, textStatus, errorThrown) {
        console.error(textStatus + ' ' + errorThrown);
      },
      success : function(data) {
        var htmlstring = "";
        for (var i = 0; i < 6; i++) {
          if (data.events[i].name.text.length > 50) {
            var eventname = data.events[i].name.text.slice(0,50);
          } else {
            var eventname = data.events[i].name.text;
          }
          var eventdate = data.events[i].start.local.slice(0,10);
          if (data.events[i].start.local.slice(11,12) > 12) {
            var eventtime = (data.events[i].start.local.slice(11,12) - 12).toString() + (data.events[i].start.local.slice(13,16)).toString();
            var ampm = "PM";
          } else {
            var eventtime = data.events[i].start.local.slice(11,16);
            var ampm = "AM";
          }
          if (i % 2 == 0) {
            htmlstring += '<div class="neighborhood-events-box"><div class="neighborhood-events-single"><h5>'+eventname+'</h5><p><span>When:</span> '+eventdate+' at '+eventtime+' '+ampm+'</p></div>';
          } else {
            htmlstring += '<div class="neighborhood-events-single"><h5>'+eventname+'</h5><p><span>When:</span> '+eventdate+' at '+eventtime+' '+ampm+'</p></div></div>';
          }
        }
        $('.neighborhood-events-content').append(htmlstring);
      }
    });
  }
}

function foursquareLoad(neighborhood) {
  if (neighborhood) {
    var lat = neighborhood.split(",")[0].trim();
    var long = neighborhood.split(",")[1].trim();
    var ll = encodeURIComponent(lat+","+long);
    var baseUrl = "https://api.foursquare.com/v2/venues/search?ll=" + ll + "&radius=5&limit=6&intent=browse&client_id=SQVXHABI34QTZRMO4TNCF3CRMOEM2X3KTPWUN4PBEAIKX0SE&client_secret=OQP3ZKCBIEJTKHNBZ0CZDDKTNY3ZWEPS3AACHEQGJBF1SYOP&v=20140723";
  } else {
    var baseUrl = "https://api.foursquare.com/v2/venues/search?near=San+Diego&radius=10&limit=6&intent=browse&client_id=SQVXHABI34QTZRMO4TNCF3CRMOEM2X3KTPWUN4PBEAIKX0SE&client_secret=OQP3ZKCBIEJTKHNBZ0CZDDKTNY3ZWEPS3AACHEQGJBF1SYOP&v=20140723";
  }
  if ($('.neighborhood-events-content')){
    $.ajax({
      url : baseUrl,
      type : "GET",
      error : function(jqXHR, textStatus, errorThrown) {
        console.error(textStatus + ' ' + errorThrown);
      },
      success : function(data) {
        console.log(data);
      }
    });
  }
}

function yelpLoad(neighborhood) {
  if (neighborhood) {
    var baseUrl = "http://testing.businesslabkit.com/sdarapi/yelp.php?location=" + encodeURI(neighborhood);
  } else {
    var baseUrl = "http://testing.businesslabkit.com/sdarapi/yelp.php";
  }
  if ($('.neighborhood-restaurants-content')){
    $.ajax({
      url : baseUrl,
      type : "GET",
      error : function(jqXHR, textStatus, errorThrown) {
        console.error(textStatus + ' ' + errorThrown);
      },
      success : function(data) {
        var data = JSON.parse(data);
        var yelpstring = "";
        var counter = 1;
        data.businesses.forEach(function(restaurant){
          if (counter % 2 == 0) {
            yelpstring += "<div class='restaurant-single'><div class='restaurant-single-image'><img src='";
            yelpstring += restaurant.image_url;
            yelpstring += "' alt='Restaurant Image'></div><div class='restaurant-single-content'><h4>";
            yelpstring += restaurant.name;
            yelpstring += "</h4><img src='";
            yelpstring += restaurant.rating_img_url_small;
            yelpstring += "' alt='Restaurant Rating'><p>";
            yelpstring += restaurant.review_count;
            yelpstring += "reviews</p></div></div></div>";
          } else {
            yelpstring += "<div class='restaurant-column'><div class='restaurant-single'><div class='restaurant-single-image'><img src='";
            yelpstring += restaurant.image_url;
            yelpstring += "' alt='Restaurant Image'></div><div class='restaurant-single-content'><h4>";
            yelpstring += restaurant.name;
            yelpstring += "</h4><img src='";
            yelpstring += restaurant.rating_img_url_small;
            yelpstring += "' alt='Restaurant Rating'><p>";
            yelpstring += restaurant.review_count;
            yelpstring += "reviews</p></div></div>";            
          }
          counter += 1;
        });
        $('.neighborhood-restaurants-content').html(yelpstring);
      }
    });
  }
}

function shuffle(array) {
  var currentIndex = array.length
    , temporaryValue
    , randomIndex
    ;

  // While there remain elements to shuffle...
  while (0 !== currentIndex) {

    // Pick a remaining element...
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex -= 1;

    // And swap it with the current element.
    temporaryValue = array[currentIndex];
    array[currentIndex] = array[randomIndex];
    array[randomIndex] = temporaryValue;
  }

  return array;
}

function frontpageloader(finalblockles) {
  var frontpagestring = "";

  for (var z = 0; z < 17; z++) {
    if (z == 0) {
      var imageurl = finalblockles[z].image ? finalblockles[z].image : "http://testing.businesslabkit.com/sdar/wp-content/themes/justknock/images/Default-image-square.jpg";
      frontpagestring += "<a href='" + finalblockles[z].perma + "'><div class='col-xs-12 col-sm-6 feature'><div class='gridbox'><img src='" + imageurl + "' alt=''>";
      frontpagestring = checkcover(frontpagestring,finalblockles[z].name,z);
      frontpagestring = checkloadtype(frontpagestring,finalblockles[z]);
      frontpagestring = checkback(frontpagestring,finalblockles[z].name);
      frontpagestring += "</div></div></a>";
    } else if (z == 1) {
      var imageurl = finalblockles[z].image ? finalblockles[z].image : "http://testing.businesslabkit.com/sdar/wp-content/themes/justknock/images/Default-image-square.jpg";
      frontpagestring += "<a href='" + finalblockles[z].perma + "'><div class='col-xs-6 col-sm-3 feature'><div class='gridbox'><img src='" + imageurl + "' alt=''>";
      frontpagestring = checkcover(frontpagestring,finalblockles[z].name,z);
      frontpagestring = checkloadtype(frontpagestring,finalblockles[z]);
      frontpagestring = checkback(frontpagestring,finalblockles[z].name);
      frontpagestring += "</div></div></a>";
    } else if (z == 2) {
      var imageurl = finalblockles[z].image ? finalblockles[z].image : "http://testing.businesslabkit.com/sdar/wp-content/themes/justknock/images/Default-image-square.jpg";
      frontpagestring += "<a href='" + finalblockles[z].perma + "'><div class='col-xs-6 col-sm-3 feature'><div class='gridbox'><img src='" + imageurl + "' alt=''>";
      frontpagestring = checkcover(frontpagestring,finalblockles[z].name,z);
      frontpagestring = checkloadtype(frontpagestring,finalblockles[z]);
      frontpagestring = checkback(frontpagestring,finalblockles[z].name);
      frontpagestring += "</div></div></a>";
    } else if (z == 3) {
      var imageurl = finalblockles[z].image ? finalblockles[z].image : "http://testing.businesslabkit.com/sdar/wp-content/themes/justknock/images/Default-image-square.jpg";
      frontpagestring += "<a href='" + finalblockles[z].perma + "'><div class='col-xs-3 feature'><div class='gridbox padbot'><img src='" + imageurl + "' alt=''>";
      frontpagestring = checkcover(frontpagestring,finalblockles[z].name,z);
      frontpagestring = checkloadtype(frontpagestring,finalblockles[z]);
      frontpagestring = checkback(frontpagestring,finalblockles[z].name);
      frontpagestring += "</div></a>";
    } else if (z == 4) {
      var imageurl = finalblockles[z].image ? finalblockles[z].image : "http://testing.businesslabkit.com/sdar/wp-content/themes/justknock/images/Default-image-square.jpg";
      frontpagestring += "<a href='" + finalblockles[z].perma + "'><div class='gridbox'><img src='" + imageurl + "' alt=''>";
      frontpagestring = checkcover(frontpagestring,finalblockles[z].name,z);
      frontpagestring = checkloadtype(frontpagestring,finalblockles[z]);
      frontpagestring = checkback(frontpagestring,finalblockles[z].name);
      frontpagestring += "</div></div></a>";
    } else if (z == 5) {
      var imageurl = finalblockles[z].image ? finalblockles[z].image : "http://testing.businesslabkit.com/sdar/wp-content/themes/justknock/images/Default-image-square.jpg";
      frontpagestring += "<a href='" + finalblockles[z].perma + "'><div class='col-xs-6 feature'><div class='col-xs-6'><div class='gridbox'><img src='" + imageurl + "' alt=''>";
      frontpagestring = checkcover(frontpagestring,finalblockles[z].name,z);
      frontpagestring = checkloadtype(frontpagestring,finalblockles[z]);
      frontpagestring = checkback(frontpagestring,finalblockles[z].name);
      frontpagestring += "</div></div></a>";
    } else if (z == 6) {
      var imageurl = finalblockles[z].image ? finalblockles[z].image : "http://testing.businesslabkit.com/sdar/wp-content/themes/justknock/images/Default-image-square.jpg";
      frontpagestring += "<a href='" + finalblockles[z].perma + "'><div class='col-xs-6'><div class='gridbox'><img src='" + imageurl + "' alt=''>";
      frontpagestring = checkcover(frontpagestring,finalblockles[z].name,z);
      frontpagestring = checkloadtype(frontpagestring,finalblockles[z]);
      frontpagestring = checkback(frontpagestring,finalblockles[z].name);
      frontpagestring += "</div></div></a>";
    } else if (z == 7) {
      var imageurl = finalblockles[z].image ? finalblockles[z].image : "http://testing.businesslabkit.com/sdar/wp-content/themes/justknock/images/Default-image-square.jpg";
      frontpagestring += "<a href='" + finalblockles[z].perma + "'><div class='col-xs-12 padfix'><div class='gridbox wide fix'><img src='" + imageurl + "' alt=''>";
      frontpagestring = checkcover(frontpagestring,finalblockles[z].name,z);
      frontpagestring = checkloadtype(frontpagestring,finalblockles[z]);
      frontpagestring = checkback(frontpagestring,finalblockles[z].name);
      frontpagestring += "</div></div></div></a>";
    } else if (z == 8) {
      var imageurl = finalblockles[z].image ? finalblockles[z].image : "http://testing.businesslabkit.com/sdar/wp-content/themes/justknock/images/Default-image-square.jpg";
      frontpagestring += "<a href='" + finalblockles[z].perma + "'><div class='col-xs-3 feature'><div class='gridbox tall'><img src='" + imageurl + "' alt=''>";
      frontpagestring = checkcover(frontpagestring,finalblockles[z].name,z);
      frontpagestring = checkloadtype(frontpagestring,finalblockles[z]);
      frontpagestring = checkback(frontpagestring,finalblockles[z].name);
      frontpagestring += "</div></div></a>";
    } else if (z == 9) {
      var imageurl = finalblockles[z].image ? finalblockles[z].image : "http://testing.businesslabkit.com/sdar/wp-content/themes/justknock/images/Default-image-landscape.jpg";
      frontpagestring += "<a href='" + finalblockles[z].perma + "'><div class='col-xs-12 col-sm-6 feature'><div class='gridbox wide'><img src='" + imageurl + "' alt=''>";
      frontpagestring = checkcover(frontpagestring,finalblockles[z].name,z);
      frontpagestring = checkloadtype(frontpagestring,finalblockles[z]);
      frontpagestring = checkback(frontpagestring,finalblockles[z].name);
      frontpagestring += "</div></div></a>";
    } else if (z == 10) {
      var imageurl = finalblockles[z].image ? finalblockles[z].image : "http://testing.businesslabkit.com/sdar/wp-content/themes/justknock/images/Default-image-landscape.jpg";
      frontpagestring += "<a href='" + finalblockles[z].perma + "'><div class='col-xs-12 col-sm-6 feature'><div class='gridbox wide'><img src='" + imageurl + "' alt=''>";
      frontpagestring = checkcover(frontpagestring,finalblockles[z].name,z);
      frontpagestring = checkloadtype(frontpagestring,finalblockles[z]);
      frontpagestring = checkback(frontpagestring,finalblockles[z].name);
      frontpagestring += "</div></div></a>";
    } else if (z == 11) {
      var imageurl = finalblockles[z].image ? finalblockles[z].image : "http://testing.businesslabkit.com/sdar/wp-content/themes/justknock/images/Default-image-portrait.jpg";
      frontpagestring += "<a href='" + finalblockles[z].perma + "'><div class='col-xs-3 feature'><div class='gridbox tall'><img src='" + imageurl + "' alt=''>";
      frontpagestring = checkcover(frontpagestring,finalblockles[z].name,z);
      frontpagestring = checkloadtype(frontpagestring,finalblockles[z]);
      frontpagestring = checkback(frontpagestring,finalblockles[z].name);
      frontpagestring += "</div></div></a>";
    } else if (z == 12) {
      var imageurl = finalblockles[z].image ? finalblockles[z].image : "http://testing.businesslabkit.com/sdar/wp-content/themes/justknock/images/Default-image-square.jpg";
      frontpagestring += "<a href='" + finalblockles[z].perma + "'><div class='col-xs-3 feature'><div class='gridbox padbot'><img src='" + imageurl + "' alt=''>";
      frontpagestring = checkcover(frontpagestring,finalblockles[z].name,z);
      frontpagestring = checkloadtype(frontpagestring,finalblockles[z]);
      frontpagestring = checkback(frontpagestring,finalblockles[z].name);
      frontpagestring += "</div></a>";
    } else if (z == 13) {
      var imageurl = finalblockles[z].image ? finalblockles[z].image : "http://testing.businesslabkit.com/sdar/wp-content/themes/justknock/images/Default-image-square.jpg";
      frontpagestring += "<a href='" + finalblockles[z].perma + "'><div class='gridbox'><img src='" + imageurl + "' alt=''>";
      frontpagestring = checkcover(frontpagestring,finalblockles[z].name,z);
      frontpagestring = checkloadtype(frontpagestring,finalblockles[z]);
      frontpagestring = checkback(frontpagestring,finalblockles[z].name);
      frontpagestring += "</div></div></a>";
    } else if (z == 14) {
      var imageurl = finalblockles[z].image ? finalblockles[z].image : "http://testing.businesslabkit.com/sdar/wp-content/themes/justknock/images/Default-image-square.jpg";
      frontpagestring += "<a href='" + finalblockles[z].perma + "'><div class='col-xs-6 feature'><div class='gridbox tall'><img src='" + imageurl + "' alt=''>";
      frontpagestring = checkcover(frontpagestring,finalblockles[z].name,z);
      frontpagestring = checkloadtype(frontpagestring,finalblockles[z]);
      frontpagestring = checkback(frontpagestring,finalblockles[z].name);
      frontpagestring += "</div></div></a>";
    } else if (z == 15) {
      var imageurl = finalblockles[z].image ? finalblockles[z].image : "http://testing.businesslabkit.com/sdar/wp-content/themes/justknock/images/Default-image-square.jpg";
      frontpagestring += "<a href='" + finalblockles[z].perma + "'><div class='col-xs-3 feature'><div class='gridbox'><img src='" + imageurl + "' alt=''>";
      frontpagestring = checkcover(frontpagestring,finalblockles[z].name,z);
      frontpagestring = checkloadtype(frontpagestring,finalblockles[z]);
      frontpagestring = checkback(frontpagestring,finalblockles[z].name);
      frontpagestring += "</div></div></a>";
    } else if (z == 16) {
      var imageurl = finalblockles[z].image ? finalblockles[z].image : "http://testing.businesslabkit.com/sdar/wp-content/themes/justknock/images/Default-image-square.jpg";
      frontpagestring += "<a href='" + finalblockles[z].perma + "'><div class='col-xs-9 feature'><div class='gridbox wider'><img src='" + imageurl + "' alt=''>";
      frontpagestring = checkcover(frontpagestring,finalblockles[z].name,z);
      frontpagestring = checkloadtype(frontpagestring,finalblockles[z]);
      frontpagestring = checkback(frontpagestring,finalblockles[z].name);
      frontpagestring += "</div></div></a>";
    }
  }
  $('.frontpage-container').append(frontpagestring);
}


function checkloadtype(frontpagestring,object) {
  if (object.name == "Point2") {
    frontpagestring += "<p>Find Your Dream Home</p>";
    return frontpagestring;
  } else if (object.name == "Ask The Expert") {
    frontpagestring += "<div class='circle'><img src='http://testing.businesslabkit.com/sdar/wp-content/themes/justknock/images/icon-ask.png' alt='Ask the Expert' class='icon-ask'></div><p>" + object.name + "</p>";
    return frontpagestring;
  } else if (object.name == "Most Popular") {
    frontpagestring += "<div class='circle'><img src='http://testing.businesslabkit.com/sdar/wp-content/themes/justknock/images/icon-star.png' alt='Most Popular' class='icon-star'></div><p>" + object.name + "</p>";
    return frontpagestring;
  } else if (object.name == "Top Stories") {
    frontpagestring += "<div class='circle'><img src='http://testing.businesslabkit.com/sdar/wp-content/themes/justknock/images/icon-top.png' alt='Top Stories' class='icon-top'></div><p>" + object.name + "</p>";
    return frontpagestring;
  } else if (object.name == "Just Knock") {
    frontpagestring += "<p>" + object.name + "</p>";
    return frontpagestring;
  } else if (object.name == "Area Map") {
    frontpagestring += '<google-map latitude="32.7092205" longitude="-117.1468064"></google-map>';
    return frontpagestring;
  } else if (object.name == "Location Report") {
    frontpagestring += "<p>" + object.name + "</p>";
    return frontpagestring;
  } else if (object.name.slice(0,5) == "Video") {
    frontpagestring += "<img src='http://testing.businesslabkit.com/sdar/wp-content/themes/justknock/images/icon-play.png' alt='Play Icon' class='icon-play'>";
    return frontpagestring;
  } else {
    if (object.name.length > 15) {
        frontpagestring += "<div class='circle'><img src='http://testing.businesslabkit.com/sdar/wp-content/themes/justknock/images/icon-home.png' alt='' class='icon-home'></div><p>" + object.name.slice(0,13) + "...</p>";
    } else {
        frontpagestring += "<div class='circle'><img src='http://testing.businesslabkit.com/sdar/wp-content/themes/justknock/images/icon-home.png' alt='' class='icon-home'></div><p>" + object.name + "</p>";
    }
    return frontpagestring;
  }
}

function checkcover(frontpagestring,name,index) {
  var covercolors = ["red","teal","red opposite","teal","red","pink","skyblue","purple opposite","pink","teal","red","teal","red","purple opposite","teal","skyblue","red"];
  if (name == "Point2") {
    frontpagestring += "<div class='cover point2'>";
    return frontpagestring;
  } else if (name == "Just Knock" || name == "Area Map" || name == "Location Report" || name.slice(0,5) == "Video") {
    return frontpagestring;
  } else {
    frontpagestring += "<div class='cover " + covercolors[index] + "'>";
    return frontpagestring;
  }
}

function checkback(frontpagestring,name) {
  if (name == "Point2") {
    frontpagestring += "</div>";
    return frontpagestring;
  } else if (name == "Just Knock" || name == "Area Map" || name == "Location Report" || name.slice(0,5) == "Video") {
    return frontpagestring;
  } else {
    frontpagestring += "</div>";
    return frontpagestring;
  }
}

function onboardinformatics(longlat,neighborhoodname) {
  if (longlat && longlat.length > 0) {
    var lat = longlat.split(",")[0].trim();
    var long = longlat.split(",")[1].trim();
  } else {
    var lat = "32.8245525";
    var long = "-117.0951632";
  }
  var token;
  var housestats = "";
  var neighborhoodid = "";
  $.ajax({
    url : "http://testing.businesslabkit.com/sdarapi/onboardinformatics/auth.php",
    type : "POST",
    data : {
      uid : "colpan"
    },
    error : function(jqXHR, textStatus, errorThrown) {
      console.error(textStatus + ' ' + errorThrown);
    },
    success : function(data) {
      token = data;
      $.ajax({
        url : "http://testing.businesslabkit.com/sdarapi/onboardinformatics/getlocation.php",
        type : "POST",
        data : {
          longitude : long,
          latitude : lat,
          token : token
        },
        error : function(jqXHR, textStatus, errorThrown) {
          console.error(textStatus + ' ' + errorThrown);
        },
        success : function(data) {
          data = JSON.parse(data).response.result.package;
          console.log(data);
          data.item.every(function(areas){
            if (areas.name == neighborhoodname) {
              neighborhoodid = areas.id;
              return false;
            }
          });
          if (neighborhoodid.length == 0) {
            neighborhoodid = data.item[0].id;
          }
          $.ajax({
            url : "http://testing.businesslabkit.com/sdarapi/onboardinformatics/locationinfo.php",
            type : "POST",
            data : {
              aid : neighborhoodid,
              token : token
            },
            error : function(jqXHR, textStatus, errorThrown) {
              console.error(textStatus + ' ' + errorThrown);
            },
            success : function(data) {
              if ($('.neighborhood-stats-content').length) {
              housing = JSON.parse(data).response.result.package.item[0];
              housestats += "<div class='stats-graphs-one col-xs-8 gridbox'><div class='stats-graphs-one-tabs'><button class='selected'>Resident Ages</button><button>Careers &amp; Professions</button><button>Household Income</button></div><div class='stats-graphs-container'><div class='ra'><canvas id='ra' height='150'></canvas></div><div class='cp hidden'><canvas id='cp' height='150'></canvas></div><div class='hi hidden'><canvas id='hi' height='150'></canvas></div></div></div>";
              housestats += "<div class='stats-numbers col-xs-4 gridbox'><div class='stats-numbers-single population'><p>Population:</p><p><span>";
              housestats += housing.popcy;
              housestats += " residents</span></p></div><div class='stats-numbers-single malepop'><p>Male Residents:</p><p><span>";
              housestats += housing.popmale;
              housestats += " men</span></p></div><div class='stats-numbers-single femalepop'><p>Female Residents:</p><p><span>";
              housestats += housing.popfemale;
              housestats += " women</span></p></div><div class='stats-numbers-single medage'><p>Median Age:</p><p><span>";
              housestats += housing.medianage;
              housestats += " yo.</span></p></div></div><div class='stats-map col-xs-6 gridbox'><div id='polymap'></div></div>";
              housestats += "<div class='stats-pie col-xs-6 gridbox'><div class='stats-pie-tabs'><button class='selected'>Education</button><button>Marital Status</button><button>Households</button><button>Commute</button></div><div class='stats-pie-content'><div class='edu'><canvas id='edu' height='150'></canvas></div><div class='ms hidden'><canvas id='ms' height='150'></canvas></div><div class='households hidden'><canvas id='households' height='150'></canvas></div><div class='commute hidden'><canvas id='commute' height='150'></canvas></div></div></div>";
              housestats += "<div class='stats-numbers-two col-xs-4 gridbox'><div class='stats-numbers-two-single avgsale'><p>Average Sale Price:</p><p><span>$";
              housestats += housing.avgsaleprice;
              housestats += "</span></p></div><div class='stats-numbers-two-single turnover'><p>Annual Housing Turnover:</p><p><span>";
              housestats += housing.lorturn;
              housestats += "%</span></p></div><div class='stats-numbers-two-single residence'><p>Median Years of Residence:</p><p><span>";
              housestats += housing.lormed;
              housestats += " years</span></p></div><div class='stats-numbers-two-single fiveyears'><p>In Residence 5+ Years:</p><p><span>";
              housestats += housing.lorstab;
              housestats += "%</span></p></div></div>";
              housestats += "<div class='stats-graphs-two col-xs-8 gridbox'><div class='stats-graphs-two-tabs'><button class='selected'>Market Action</button><button>Average Sale Price</button><button>Average Days on Market</button></div><div class='stats-graphs-container'><canvas id='ma'></canvas><canvas id='sp'></canvas><canvas id='dm'></canvas></div></div>";
              
              $('.neighborhood-stats-content').html(housestats);

              var canvaswidth = $('.stats-graphs-container').width() * .9;
              // Generate Age Distribution Bar Chart
              document.getElementById('ra').width = canvaswidth;
              var agebarctx = document.getElementById('ra').getContext('2d');
              var agebardata = {
                labels: ["Under 20","20 - 29","30 - 39","40 - 49","50 - 64","65+"],
                datasets: [
                {
                  label:"Average Age",
                  fillColor: "rgb(143,196,203)",
                  strokeColor: "rgb(143,196,203)",
                  highlightFill: "rgba(143,196,203,.6)",
                  highlightStroke: "rgba(143,196,203,.6)",
                  data: [parseInt(housing.age00_04)+parseInt(housing.age05_09)+parseInt(housing.age10_14)+parseInt(housing.age15_19),parseInt(housing.age20_24)+parseInt(housing.age25_29),parseInt(housing.age30_34)+parseInt(housing.age35_39),parseInt(housing.age40_44)+parseInt(housing.age45_49),parseInt(housing.age50_54)+parseInt(housing.age55_59)+parseInt(housing.age60_64),parseInt(housing.age65_69)+parseInt(housing.age70_74)+parseInt(housing.age75_79)+parseInt(housing.age80_84)+parseInt(housing.agegt85)]
                }
                ]
              };
              var agebar = new Chart(agebarctx).Bar(agebardata,{animation: false});

              // Generate Career Distribution Bar Chart
              document.getElementById('cp').width = canvaswidth;
              var careerctx = document.getElementById('cp').getContext('2d');
              var careerdata = {
                labels: ["Design","Business","Labor / Prod","Health","Sci & Eng","Legal","Other"],
                datasets: [
                {
                  label:"Careers",
                  fillColor: "rgb(143,196,203)",
                  strokeColor: "rgb(143,196,203)",
                  highlightFill: "rgba(143,196,203,.6)",
                  highlightStroke: "rgba(143,196,203,.6)",
                  data: [parseInt(housing.occarts),parseInt(housing.occyexec)+parseInt(housing.occsalpr)+parseInt(housing.occbfin),parseInt(housing.occprim)+parseInt(housing.occmater)+parseInt(housing.occlabor)+parseInt(housing.occprod)+parseInt(housing.occtran),parseInt(housing.occhcsp)+parseInt(housing.occhlth)+parseInt(housing.occhtch)+parseInt(housing.occpcar),parseInt(housing.occcomp)+parseInt(housing.occcons)+parseInt(housing.occengr)+parseInt(housing.occscns),parseInt(housing.occlegal),parseInt(housing.occprot)+parseInt(housing.occclero)+parseInt(housing.occbgmt)+parseInt(housing.occeduc)+parseInt(housing.occfood)+parseInt(housing.occcsrv)]
                }
                ]
              };
              var careerbar = new Chart(careerctx).Bar(careerdata,{animation: false});

              // Generate Income Bar Graph
              document.getElementById('hi').width = canvaswidth;
              var incomectx = document.getElementById('hi').getContext('2d');
              var incomedata = {
                labels: ["Under 25k","25k - 50k","50k - 75k", "75k - 100k","100k - 250k","250k - 500k", "500k+"],
                datasets: [
                {
                  label: "Household Income",
                  fillColor: "rgb(143,196,203)",
                  strokeColor: "rgb(143,196,203)",
                  highlightFill: "rgba(143,196,203,.6)",
                  highlightStroke: "rgba(143,196,203,.6)",
                  data: [parseInt(housing.hincy00_10)+parseInt(housing.hincy10_15)+parseInt(housing.hincy15_20)+parseInt(housing.hincy20_25),parseInt(housing.hincy25_30)+parseInt(housing.hincy30_35)+parseInt(housing.hincy35_40)+parseInt(housing.hincy40_45)+parseInt(housing.hincy45_50),parseInt(housing.hincy50_60)+parseInt(housing.hincy60_75),parseInt(housing.hincy75_100),parseInt(housing.hincy100_125)+parseInt(housing.hincy125_150)+parseInt(housing.hincy150_200)+parseInt(housing.hincy200_250),parseInt(housing.hincy250_500),parseInt(housing.hincygt_500)]
                }
                ]
              };
              var incomebar = new Chart(incomectx).Bar(incomedata,{animation: false});

              canvaswidth = $('.stats-pie-content').width() * .6;

              // Generate Education Pie Chart
              document.getElementById('edu').width = canvaswidth;
              var educationctx = document.getElementById('edu').getContext('2d');
              var educationdata = [
              {
                value: parseInt(housing.edultgr9)+parseInt(housing.edushsch)+parseInt(housing.eduhsch),
                color: "rgb(230, 31, 41)",
                highlight: "rgba(230, 31, 41,.6)",
                label: "High School or Lower"
              },{
                value: parseInt(housing.eduscoll),
                color: "rgb(143,196,203)",
                highlight: "rgba(143,196,203,.6)",
                label: "Some College"
              },{
                value: parseInt(housing.eduassoc),
                color: "rgb(225,53,108)",
                highlight: "rgba(225,53,108,.6)",
                label: "Associate Degree"
              },{
                value: parseInt(housing.edubach),
                color: "rgb(146,39,143)",
                highlight: "rgba(146,39,143,.6)",
                label: "Bachelors Degree"
              },{
                value: parseInt(housing.edugrad),
                color: "rgb(17,175,184)",
                highlight: "rgba(17,175,184,.6)",
                label: "Graduate Degree"
              }
              ];
              var educationoptions = {
                animation: false,
                legendTemplate : "<h2>Education</h2><ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"> </span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
              }
              var educationpie = new Chart(educationctx).Pie(educationdata,educationoptions);
              $('.edu').append(educationpie.generateLegend());

              //Generate Marital Status Pie Graph
              document.getElementById('ms').width = canvaswidth;
              var maritalctx = document.getElementById('ms').getContext('2d');
              var maritaldata = [
              {
                value: parseInt(housing.marnever),
                color: "rgb(230, 31, 41)",
                highlight: "rgba(230, 31, 41,.6)",
                label: "Never Married"
              },{
                value: parseInt(housing.marmarr),
                color: "rgb(143,196,203)",
                highlight: "rgba(143,196,203,.6)",
                label: "Currently Married"
              },{
                value: parseInt(housing.marsep),
                color: "rgb(225,53,108)",
                highlight: "rgba(225,53,108,.6)",
                label: "Separated"
              },{
                value: parseInt(housing.mardivor),
                color: "rgb(146,39,143)",
                highlight: "rgba(146,39,143,.6)",
                label: "Divorced"
              },{
                value: parseInt(housing.marwidow),
                color: "rgb(17,175,184)",
                highlight: "rgba(17,175,184,.6)",
                label: "Widowed"
              }
              ];
              var maritaloptions = {
                animation: false,
                legendTemplate : "<h2>Marital Status</h2><ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"> </span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
              }
              var maritalpie = new Chart(maritalctx).Pie(maritaldata,maritaloptions);
              $('.ms').append(maritalpie.generateLegend());

              //Generate House Type Pie Graph
              document.getElementById('households').width = canvaswidth;
              var housetypectx = document.getElementById('households').getContext('2d');
              var housetypedata = [
              {
                value: parseInt(housing.hhdfam),
                color: "rgb(230, 31, 41)",
                highlight: "rgba(230, 31, 41,.6)",
                label: "Family Household"
              },{
                value: parseInt(housing.hhdnfm),
                color: "rgb(17,175,184)",
                highlight: "rgba(17,175,184,.6)",
                label: "Non-Family Household"
              }
              ];
              var housetypeoptions = {
                animation: false,
                legendTemplate : "<h2>Households</h2><ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"> </span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
              }
              var housetypepie = new Chart(housetypectx).Pie(housetypedata,housetypeoptions);
              $('.households').append(housetypepie.generateLegend());

              //Generate Commute Pie Graph
              document.getElementById('commute').width = canvaswidth;
              var commutectx = document.getElementById('commute').getContext('2d');
              var commutedata = [
              {
                value: parseInt(housing.trwpublic),
                color: "rgb(230, 31, 41)",
                highlight: "rgba(230, 31, 41,.6)",
                label: "Public Transport"
              },{
                value: parseInt(housing.trwdrive),
                color: "rgb(146,39,143)",
                highlight: "rgba(146,39,143,.6)",
                label: "Car or Motorcycle"
              },{
                value: parseInt(housing.trwself),
                color: "rgb(225,53,108)",
                highlight: "rgba(225,53,108,.6)",
                label: "Walk or Bike"
              },{
                value: parseInt(housing.trwhome),
                color: "rgb(17,175,184)",
                highlight: "rgba(17,175,184,.6)",
                label: "Work at Home"
              }
              ];
              var commuteoptions = {
                animation: false,
                legendTemplate : "<h2>Commute</h2><ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"> </span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
              }
              var commutepie = new Chart(commutectx).Pie(commutedata,commuteoptions);
              $('.commute').append(commutepie.generateLegend());

              }

              $.ajax({
                url : "http://testing.businesslabkit.com/sdarapi/onboardinformatics/getPOI.php",
                type : "POST",
                data : {
                  longitude : long,
                  latitude : lat,
                  token : token
                },
                error : function(jqXHR, textStatus, errorThrown) {
                  console.error(textStatus + ' ' + errorThrown);
                },
                success : function(data) {
                  var schoolstring = "";
                  var schoollist = "";
                  var schooldata = JSON.parse(data).response.result.package.item;
                  schoolstring += '<google-map class="col-xs-8" latitude="';
                  schoolstring += lat;
                  schoolstring += '" longitude="';
                  schoolstring += long;
                  schoolstring += '" fitToMarkers>';
                  schoollist += "<div class='schoollist-container col-xs-4 neighborhood-two'>";
                  schooldata.forEach(function(school){
                    schoolstring += "<google-map-marker icon='http://testing.businesslabkit.com/sdar/wp-content/themes/justknock/images/icons/Cap-Pin.png' latitude='";
                    schoolstring += school.geo_latitude;
                    schoolstring += "' longitude='";
                    schoolstring += school.geo_longitude;
                    schoolstring += "' title='";
                    schoolstring += school.name;
                    schoolstring += "'><h4 style='font-size:16px;margin:0;line-height:22px;color:#e61f29;font-family:Open Sans, sans-serif;font-weight: 600;'>";
                    schoolstring += school.name;
                    schoolstring += "</h4><p style='font-size:12px;margin:0;line-height:18px;color:#464646;font-family:Open Sans,sans-serif;font-weight:600;'>";
                    schoolstring += school.industry.toLowerCase();
                    schoolstring += "</p><p style='font-size:12px;margin:0;line-height:18px;color:#464646;font-family:Open Sans,sans-serif;font-weight:400;'>";
                    schoolstring += school.street.toLowerCase();
                    schoolstring += "</p><p style='font-size:12px;margin:0;line-height:18px;color:#464646;font-family:Open Sans,sans-serif;font-weight:400;'>";
                    schoolstring += school.phone;
                    schoolstring += "</p></google-map-marker>";
                    schoollist += "<div class='schoollist-single'><h4>";
                    schoollist += school.name.toLowerCase();
                    schoollist += "</h4><p><span>";
                    schoollist += school.industry.toLowerCase();
                    schoollist += "</span></p><p>";
                    schoollist += school.street.toLowerCase();
                    schoollist += "</p><p>";
                    schoollist += school.phone;
                    schoollist += "</div>";
                  });
                  schoollist += "</div>";
                  schoolstring += '</google-map>';
                  $('.neighborhood-schools-content').append(schoolstring);
                  $('.neighborhood-schools-content').append(schoollist);

                  $.ajax({
                    url : "http://testing.businesslabkit.com/sdarapi/onboardinformatics/getPOItypes.php",
                    type : "POST",
                    data : {
                      longitude : long,
                      latitude : lat,
                      token : token
                    },
                    error : function(jqXHR, textStatus, errorThrown) {
                      console.error(textStatus + ' ' + errorThrown);
                    },
                    success : function(data) {
                      var poidata = JSON.parse(data);
                      var poistring = "<div class='poi-container col-xs-12 neighborhood-two'>";
                      var poimapicons = ["Drinks-Pin.png","Banks-Pin.png","Shopping-Pin.png","Health-Pin.png","Government-Pin.png","Sports-Pin.png","Eating-Pin.png","Groceries-Pin.png","Entertainment-Pin.png"];
                      var poicounter = 0;
                      poidata.forEach(function(poi){
                        console.log(poi);
                      if (poi.response.result) {
                        poistring += "<div class='poi-single'><div class='poi-single-map gridbox'><google-map class='col-xs-12' latitude='";
                        poistring += lat;
                        poistring += "' longitude='";
                        poistring += long;
                        poistring += "' fitToMarkers>";
                        poi.response.result.package.item.forEach(function(single){
                          poistring += "<google-map-marker icon='http://testing.businesslabkit.com/sdar/wp-content/themes/justknock/images/icons/";
                          poistring += poimapicons[poicounter];
                          poistring += "' latitude='";
                          poistring += single.geo_latitude;
                          poistring += "' longitude='";
                          poistring += single.geo_longitude;
                          poistring += "' title='";
                          poistring += single.name;
                          poistring += "'>";
                          poistring += single.name;
                          poistring += "</google-map-marker>";
                        });
                        poistring += "</google-map></div><div class='poi-single-results gridbox'>";
                        poi.response.result.package.item.forEach(function(single){
                          poistring += "<div class='poilist-single'><h4>";
                          poistring += single.name.toLowerCase();
                          poistring += "</h4><p><span>";
                          poistring += single.industry.toLowerCase();
                          poistring += "</span></p><p>";
                          poistring += single.street.toLowerCase();
                          poistring += "</p><p>";
                          poistring += single.phone;
                          poistring += "</div>";
                        });
                        poistring += "</div></div>";
                        poicounter += 1;
                      } else { poistring += "<div class='poi-single'>Sorry, no results returned. :(</div>"; poicounter += 1; }
                      });
                      poistring += "</div>";
                      $('.neighborhood-poi-content').append(poistring);



                      // Add click events
                      $('.stats-graphs-one-tabs button').click(changeDataPanel);
                      $('.stats-pie-tabs button').click(changeDataPanel);
                      $('.stats-graphs-two-tabs button').click(changeDataPanel);
                      $('.neighborhood-poi-icon-single').click(changeDataPanel);

                      $.ajax({
                        url : "http://testing.businesslabkit.com/sdarapi/onboardinformatics/getBoundary.php",
                        type : "POST",
                        data : {
                          aid: neighborhoodid,
                          token : token
                        },
                        error : function(jqXHR, textStatus, errorThrown) {
                          console.error(textStatus + ' ' + errorThrown);
                        },
                        success : function(data) {
                          var coords = JSON.parse(data).response.result.package.item[0].boundary.split("((")[1].split("))")[0].split(",");
                          createboundrymap(coords,long,lat);
                        }
                      });
                    }
                  });
                }
              });
            }
          });
        }
      });
    }
  });
}

var changeDataPanel = function(data) {
  var number = $(this).index();
  $(this).siblings('.selected').removeClass('selected');
  $(this).addClass('selected');
  $(this).parent().next().children().addClass('hidden');
  $(this).parent().next().children().eq(number).removeClass('hidden');
}

function createboundrymap(data,long,lat) {
  var stylesArray = [
  {
    "elementType": "geometry",
    "stylers": [
      { "saturation": -100 }
    ]
  },{
    "featureType": "road.highway",
    "elementType": "geometry",
    "stylers": [
      { "color": "#9CD7DE" }
    ]
  }
  ];

  var styledMap = new google.maps.StyledMapType(stylesArray,{name: "Styled Map"});

  var mapOptions = {
    zoom: 12,
    center: new google.maps.LatLng(parseFloat(lat), parseFloat(long)),
    mapTypeControlOptions: {
      mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
    }
  };

  var bermudaTriangle;

  var map = new google.maps.Map(document.getElementById('polymap'),
    mapOptions);

  map.mapTypes.set('map_style', styledMap);
  map.setMapTypeId('map_style');

  // Define the LatLng coordinates for the polygon's path.
  var triangleCoords = [];

  data.forEach(function(singleset){
    var longlat = singleset.trim().split(" ");
    var string =  new google.maps.LatLng( parseFloat(longlat[1].trim()),parseFloat(longlat[0].trim()));
    triangleCoords.push(string);
  });

  // Construct the polygon.
  bermudaTriangle = new google.maps.Polygon({
    paths: triangleCoords,
    strokeColor: 'rgb(230,31,41)',
    strokeOpacity: 0.8,
    strokeWeight: 2,
    fillColor: 'rgb(230,31,41)',
    fillOpacity: 0.35
  });

  bermudaTriangle.setMap(map);
}