<?php /* Template Name: Neighborhoods Template */ ?>
<?php get_header(); ?>
<div class="body">
  <div class="left-container">
  </div>
  <div class="right-container"> 
  </div>
  <!-- <?php include 'fake-sidebars.php'; ?> -->
  <div class="container">
    <div class="row">
      <div class="news-sidebar col-sm-3">
        <div class="row">
          <div class="col-xs-12 col-sm-12 feature">
            <div class="gridbox bg-primary news-header">
              <img src="<?php echo get_template_directory_uri(); ?>/images/icon-home.png" alt="Neighborhoods">
              <p>Neighborhoods</p>
            </div>
          </div>
        </div>
        <div class="row">
        </div>
      </div>
      <div class="news-feed col-sm-9">
      <?php 
        $args = array(
          'post_type' => 'neighborhoods', 'orderby'=> 'title', 'order' => 'ASC'
        );
        $wp_query = new WP_Query($args); 
        $neighborhoodsarray = array();
        while ($wp_query->have_posts()) : $wp_query->the_post();
          array_push($neighborhoodsarray, array(
            "neighborhood_name" => get_the_title(),
            "neighborhood_perma" => get_permalink()
          ));
        endwhile;
      ?>
          <div class="row">
              <div class="neighborhoods-image gridbox">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/neighborhoods-archive.jpg" alt="Neighborhoods Heroshot">
              </div>
          </div>
          <div class="row">
              <div class="neighborhoods-listing">
                  <div class="neighborhoods-alpha">
                      <ul>
                          <li>A</li>
                          <li>B</li>
                          <li>C</li>
                          <li>D</li>
                          <li>E</li>
                          <li>F</li>
                          <li>G</li>
                          <li>H</li>
                          <li>I</li>
                          <li>J</li>
                          <li>K</li>
                          <li>L</li>
                          <li>M</li>
                          <li>N</li>
                          <li>O</li>
                          <li>P</li>
                          <li>Q</li>
                          <li>R</li>
                          <li>S</li>
                          <li>T</li>
                          <li>U</li>
                          <li>V</li>
                          <li>W</li>
                          <li>X</li>
                          <li>Y</li>
                          <li>Z</li>
                          <li>ALL</li>
                      </ul>
                  </div>
                  <div class="neighborhoods-rows">
                  </div>
              </div>
          </div>
      </div>
    </div>
  </div>
</div>
</div>
<script type="text/javascript">
  window.onload = function() {
    var neighborhoods = <?php echo json_encode($neighborhoodsarray); ?>;
    var counter = 0;
    var firstline = true;
    var bigstring = "";
    var columnnum = 0;
    neighborhoods.forEach(function(neighborhood){
      if (firstline == true) {
        bigstring += "<div class='neighborhoods-column'>";
        bigstring += "<a href='";
        bigstring += neighborhood.neighborhood_perma;
        bigstring += "'><span>&raquo;</span> ";
        bigstring += neighborhood.neighborhood_name;
        bigstring += "</a></div>";
        $('.neighborhoods-rows').append(bigstring);
        bigstring = "";
      } else {
        bigstring += "<a href='";
        bigstring += neighborhood.neighborhood_perma;
        bigstring += "'><span>&raquo;</span> ";
        bigstring += neighborhood.neighborhood_name;
        bigstring += "</a>";
        $('.neighborhoods-column').eq(columnnum).append(bigstring);
        bigstring = "";
      }
      counter += 1;
      columnnum += 1;
      if (columnnum > 2) {
        columnnum = 0;
      }
      if (counter > 2) {
        firstline = false;
      }
    });

    $('.neighborhoods-alpha li').click(function(){
      $('.neighborhoods-alpha li.selected').removeClass('selected');
      $(this).addClass('selected');
      $('.neighborhoods-rows').empty();
      var letter = $(this).text();
      var counter = 0;
      var firstline = true;
      var bigstring = "";
      var columnnum = 0;
      neighborhoods.forEach(function(neighborhood){
        if (neighborhood.neighborhood_name[0] == letter || neighborhood.neighborhood_name[0] == letter.toLowerCase() || letter == "ALL"){
          if (firstline == true) {
            bigstring += "<div class='neighborhoods-column'>";
            bigstring += "<a href='";
            bigstring += neighborhood.neighborhood_perma;
            bigstring += "'><span>&raquo;</span> ";
            bigstring += neighborhood.neighborhood_name;
            bigstring += "</a></div>";
            $('.neighborhoods-rows').append(bigstring);
            bigstring = "";
          } else {
            bigstring += "<a href='";
            bigstring += neighborhood.neighborhood_perma;
            bigstring += "'><span>&raquo;</span> ";
            bigstring += neighborhood.neighborhood_name;
            bigstring += "</a>";
            $('.neighborhoods-column').eq(columnnum).append(bigstring);
            bigstring = "";
          }
          counter += 1;
          columnnum += 1;
          if (columnnum > 2) {
            columnnum = 0;
          }
          if (counter > 2) {
            firstline = false;
          }
          }
  });
});

  }
</script>
<?php get_footer(); ?>