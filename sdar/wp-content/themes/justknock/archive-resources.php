<?php get_header(); ?>
<div class="body">
  <div class="left-container">
  </div>
  <div class="right-container"> 
  </div>
  <!-- <?php include 'fake-sidebars.php'; ?> -->
  <div class="container">

    <iframe style='width:100%;height:580px' src='http://online.fliphtml5.com/oozd/odbx/'  seamless='seamless' scrolling='no' frameborder='0' allowtransparency='true' allowfullscreen='true' ></iframe>

    <!--<div class="search-area">
      <h2>Find the right SDAR resources for you</h2>
      <div class="search-form">
        <form onsubmit="event.preventDefault(); submitform();">
          <input name="name" type="text" placeholder="Searchquery" class="query">
          <input type="submit">
        </form>
      </div>
    </div>
    <div class="search-results">
      <div class="search-results-container">
      </div>
      <div class="search-results-pagination">
      </div>
    </div> -->
  </div>
</div>
<!-- <?php 
  $args = array(
    'post_type' => 'resources'
  );
  $wp_query = new WP_Query($args); 
  $resourcesarray = array();
  while ($wp_query->have_posts()) : $wp_query->the_post();
    array_push($resourcesarray, array(
      "resource_name" => get_the_title(),
      "resource_category" => get_post_meta(get_the_ID(), 'category', true),
      "resource_person" => get_post_meta(get_the_ID(), 'person', true),
      "resource_address" => get_post_meta(get_the_ID(), 'stadd', true),
      "resource_citystzip" => get_post_meta(get_the_ID(), 'citystzip', true),
      "resource_email" => get_post_meta(get_the_ID(), 'email', true),
      "resource_website" => get_post_meta(get_the_ID(), 'website', true),
      "resource_phone" => get_post_meta(get_the_ID(), 'phone', true)
    ));
  endwhile;
?>
<script type="text/javascript">
var resources = <?php echo json_encode($resourcesarray); ?>;
window.onload = function() {
  console.log(resources);
  var codestring = '<div class="filter-area"><button class="sortbyname">Sort By Name</button></div>';
  $('.search-results').prepend(codestring);
  $('.sortbyname').click(function(){
    resources = flipOrder(resources);
  });
  loadingSpinner();
  var pagedresults = paginateData(resources);
  displayResults(pagedresults[0]);
}
function displayResults(results) {
  var codestring = "";
  results.forEach(function(result){
    codestring += "<div class='resource-single'><div class='resource-single-left'><h4>";
    codestring += result.resource_name;
    codestring += "</h4><h5>";
    codestring += result.resource_category;
    codestring += "</h5><a href='http://";
    codestring += result.resource_website;
    codestring += "'>";
    codestring += result.resource_website;
    codestring += "</a><p>";
    codestring += result.resource_phone;
    codestring += "</p></div><div class='resource-single-right'><h4>";
    codestring += result.resource_person;
    codestring += "</h4><a href='mailto:";
    codestring += result.resource_email;
    codestring += "'>";
    codestring += result.resource_email;
    codestring += "</a><p>";
    codestring += result.resource_address;
    codestring += "</p><p>";
    codestring += result.resource_citystzip;
    codestring += "</p></div></div>";
  });
  $('.search-results-container').html(codestring);
}
function loadingSpinner() {
  var loadingstring = '<div class="spinner"><div class="double-bounce1"></div><div class="double-bounce2"></div></div>';
  $('.search-results-container').html(loadingstring);
}
function paginateData(data) {
  var pagedresults = new Array();
  var pagecounter = 0;
  var individualcounter = 0;
  var paginationstring = "<ul><li>" + (pagecounter+1) + "</li>";
  data.forEach(function(resource){
    if (individualcounter == 0) {
      pagedresults[pagecounter] = [resource]; 
    } else {
      pagedresults[pagecounter].push(resource);
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
  var pagedresults = paginateData(data);
  displayResults(pagedresults[0]);
  return data;
}
function changetopage(data,number) {
  var pagedresults = paginateMLS(data);
  displayResults(pagedresults[number]);
  $('html,body').animate({scrollTop : $('.search-results-container').scrollTop()},200);
  $('.selectedpage').removeClass('selectedpage');
  $('.search-results-pagination li').eq(number).addClass('selectedpage');
}
function submitform() {
  if ($('.filter-area').length == 0) {
    var codestring = '<div class="filter-area"><button class="sortbyname">Sort By Name</button></div>';
    $('.search-results').prepend(codestring);
    $('.sortbyname').click(function(){
      resources = flipOrder(resources);
    });
  }
  var searchquery = $('.query').val();
  if (searchquery.length > 0) {
    loadingSpinner();
    var results = [];
    var regex = new RegExp(searchquery.toLowerCase());
    resources.forEach(function(resource){
      if (JSON.stringify(resource).toLowerCase().match(regex)) {
        results.push(resource);
      }
    });
    var pagedresults = paginateData(results);
    displayResults(pagedresults[0]);
  }
}
</script> -->
<?php get_footer(); ?>