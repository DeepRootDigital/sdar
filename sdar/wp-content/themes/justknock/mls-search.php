<?php /* Template Name: MLS Search Template */ ?>
<?php get_header(); ?>
<div class="body">
  <div class="left-container">
  </div>
  <div class="right-container"> 
  </div>
  <!-- <?php include 'fake-sidebars.php'; ?> -->
  <div class="container">
    <div class="search-area">
      <h2>Find a SDAR REALTOR&#8482; in San Diego County</h2>
      <p>Find the best agents and brokers in your area</p>
      <div class="search-form">
        <form onsubmit="event.preventDefault(); submitform();">
          <input name="name" type="text" placeholder="Agent Name" class="namequery">
          <span>OR</span>
          <input name="location" type="text" placeholder="City, Zip, or Office Name" class="otherquery">
          <input type="submit">
        </form>
      </div>
    </div>
    <div class="search-results">
      <div class="search-results-container">
      </div>
      <div class="search-results-pagination">
      </div>
    </div>
  </div>
</div>
      <?php
          if ($_GET['namequery'] || $_GET['otherquery']) {
            $database=mysqli_connect("localhost","blk_sdarmlslist","freelancevps123","blk_sdarmlslist");

            // Check connection
            if (mysqli_connect_errno()) {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
            } else {
              if ($_GET['namequery'] && !$_GET['otherquery']) {
                $namequery = $_GET['namequery'];
                $querystring = "SELECT * FROM sdarmlslist WHERE FullName LIKE '" . $namequery . "%' OR FirstName='" . $namequery . "' OR Nickname='" . $namequery . "' OR LastName='" . $namequery . "'";
              } elseif (!$_GET['namequery'] && $_GET['otherquery']) {
                $otherquery = $_GET['otherquery'];
                $querystring = "SELECT * FROM sdarmlslist WHERE City='" . $otherquery . "' OR Zip='" . $otherquery . "' OR OfficeName='" . $otherquery . "'";
              } elseif ($_GET['namequery'] && $_GET['otherquery']) {
                $namequery = $_GET['namequery'];
                $otherquery = $_GET['otherquery'];
                $querystring = "SELECT * FROM sdarmlslist WHERE (FullName LIKE '" . $namequery . "%' OR FirstName='" . $namequery . "' OR Nickname='" . $namequery . "' OR LastName='" . $namequery . "') AND (City='" . $otherquery . "' OR Zip='" . $otherquery . "' OR OfficeName='" . $otherquery . "')";
              }
              $result = mysqli_query($database,$querystring);
              $tempArray = array();
              $myArray = array();
              while($row = $result->fetch_object()) {
                  $tempArray = $row;
                  array_push($myArray, $tempArray);
              }
            }
          }
      ?>
<script type="text/javascript">
var results = <?php echo json_encode($myArray); ?>;
window.onload = function() {
  if (results && results.length > 0) {
    var pagedresults = paginateMLS(results);
    displayMLS(pagedresults[0]);
  }
}
function loadingSpinner() {
  var loadingstring = '<div class="spinner"><div class="double-bounce1"></div><div class="double-bounce2"></div></div>';
  $('.search-results-container').html(loadingstring);
}
function UrlExists(url)
{
    var http = new XMLHttpRequest();
    http.open('HEAD', url, false);
    http.send();
    return http.status!=404;
}
function displayMLS(data) {
  var codestring = "";
  data.forEach(function(single){
    if (UrlExists("http://testing.businesslabkit.com/sdar/wp-content/themes/justknock/agents/" + single.MemberNumber + ".jpg")) {
      codestring += '<div class="search-results-single"><div class="search-results-single-image"><div class="member-pic"><img src="http://testing.businesslabkit.com/sdar/wp-content/themes/justknock/agents/' + single.MemberNumber + '.jpg" alt="Member Picture" class="real-pic"></div><div class="search-plus">+</div></div><div class="search-results-single-content"><div class="search-results-single-content-first"><h4>';
      codestring += single.FullName;
      codestring += '</h4><p><span>';
      codestring += single.OfficeName;
      codestring += '</span></p><p><span>';
      codestring += single.OfficePhoneNumber ? single.OfficePhoneNumber.replace("-",".").replace("-",".") : "";
      codestring += '</p></span></div><div class="search-results-single-content-second"><p>Servicing areas around:</p><p><span>San Diego, Chula Vista, Vista, and Santee</span></p><button class="choose-realtor">This is my Realtor&#8482;</button><div><input type="email" placeholder="Your Email"><button class="member-email" mid="';
      codestring += single.MemberNumber;
      codestring += '" mname="';
      codestring += encodeURI(single.FullName);
      codestring += '">Choose Member</button><p></p></div></div></div></div>';    
    } else {
      codestring += '<div class="search-results-single"><div class="search-results-single-image"><div class="member-pic"><img src="http://testing.businesslabkit.com/sdar/wp-content/themes/justknock/agents/generic.png" alt="Member Picture"></div><div class="search-plus">+</div></div><div class="search-results-single-content"><div class="search-results-single-content-first"><h4>';
      codestring += single.FullName;
      codestring += '</h4><p><span>';
      codestring += single.OfficeName;
      codestring += '</span></p><p><span>';
      codestring += single.OfficePhoneNumber ? single.OfficePhoneNumber.replace("-",".").replace("-",".") : "";
      codestring += '</p></span></div><div class="search-results-single-content-second"><p>Servicing areas around:</p><p><span>San Diego, Chula Vista, Vista, and Santee</span></p><button class="choose-realtor">This is my Realtor&#8482;</button><div><input type="email" placeholder="Your Email"><button class="member-email" mid="';
      codestring += single.MemberNumber;
      codestring += '" mname="';
      codestring += encodeURI(single.FullName);
      codestring += '">Choose Member</button><p></p></div></div></div></div>';
    }
  });
  $('.search-results-container').html(codestring);
  $('.choose-realtor').click(function(){
    $(this).siblings('div').addClass('showarea');
  });
  $('.member-email').click(function(){
    var thisone = $(this);
    $(this).siblings('p').text("");
    var email = $(this).siblings('input').val();
    if (email && email.length > 0 && isValidEmailAddress(email)) {
      var mid = $(this).attr('mid');
      var mname = $(this).attr('mname');
      $(this).siblings('p').text('Processing... Please wait.');
      $(this).addClass('animate');
      $.ajax({
        url: "http://testing.businesslabkit.com/sdarapi/sendmail.php",
        type: "POST",
        data: {
          'mid': mid,
          'email': email,
          'mname': mname
        }
      }).done(function(data){
        thisone.removeClass('animate');
        thisone.siblings('p').text("Successful submission. Please check your email.");
      });
    } else {
      $(this).siblings('p').text("Please enter your email to get access through your realtor&#8482;.");
    }
  });
}
function paginateMLS(data) {
  var pagedresults = new Array();
  var pagecounter = 0;
  var individualcounter = 0;
  var paginationstring = "<ul><li>" + (pagecounter+1) + "</li>";
  data.forEach(function(realtor){
    if (individualcounter == 0) {
      pagedresults[pagecounter] = [realtor]; 
    } else {
      pagedresults[pagecounter].push(realtor);
    }
    individualcounter += 1;
    if (individualcounter > 9) {
      pagecounter += 1;
      individualcounter = 0;
      paginationstring += "<li>";
      paginationstring += (pagecounter+1);
      paginationstring += "</li>";
    }
  });
  paginationstring += "</ul>";
  $('.search-results-pagination').html(paginationstring);
  $('.search-results-pagination li:first-of-type').addClass('selectedpage');
  $('.search-results-pagination li').click(function(){
    var number = $(this).text();
    changetopage(data,number-1);
  });
  return pagedresults;
}
function flipOrder(data) {
  data.reverse();
  var pagedresults = paginateMLS(data);
  displayMLS(pagedresults[0]);
  return data;
}
function changetopage(data,number) {
  var pagedresults = paginateMLS(data);
  displayMLS(pagedresults[number]);
  $('html,body').animate({scrollTop : $('.search-results-container').scrollTop()},200);
  $('.selectedpage').removeClass('selectedpage');
  $('.search-results-pagination li').eq(number).addClass('selectedpage');
}
function submitform() {
  if ($('.filter-area').length == 0) {
    var codestring = '<div class="filter-area"><button class="sortbyname">Sort By Name</button></div>';
    $('.search-results').prepend(codestring);
    $('.sortbyname').click(function(){
      results = flipOrder(results);
    });
  }
  if ($('.namequery').val().length > 0 || $('.otherquery').val().length > 0) {
    var namequery = $('.namequery').val();
    var otherquery = $('.otherquery').val();
    var urlstring = "http://testing.businesslabkit.com/sdarapi/mlsresult.php?namequery="+namequery+"&otherquery="+otherquery;
    loadingSpinner();
    $.ajax({
      type: "GET",
      url: urlstring
    }).done(function(res){
      results = JSON.parse(res);
      if (results && results.length > 0) {
        var pagedresults = paginateMLS(results);
        displayMLS(pagedresults[0]);
      } else {
        $('.search-results-container').html("<p class='results-error'>Sorry, we were not able to find anyone that matches your search.</p>");
        $('.search-results-pagination').html("");
      }
    });
  }
}
</script>
<?php get_footer(); ?>