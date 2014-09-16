<?php /* Template Name: Frontpage Template */ ?>
<?php get_header(); ?>
<div class="body frontpage">
  <div class="left-container">
  </div>
  <div class="right-container"> 
  </div>
  <!-- <?php include 'fake-sidebars.php'; ?> -->
  <div class="container frontpage-container">
  </div>
</div>
<?php 
  $args = array(
    'post_type' => 'neighborhoods'
  );
  $wp_query = new WP_Query($args); 
  $blockles = array();
  while ($wp_query->have_posts()) : $wp_query->the_post();
    array_push($blockles, array(
      "name" => get_the_title(),
      "perma" => get_permalink(),
      "image" => wp_get_attachment_url( get_post_thumbnail_id($post->ID) )
    ));
  endwhile;
  $args = array(
    'post_type' => 'deals'
  );
  $wp_query = new WP_Query($args);
  while ($wp_query->have_posts()) : $wp_query->the_post();
    array_push($blockles, array(
      "name" => get_the_title(),
      "perma" => "http://testing.businesslabkit.com/sdar/new-deals/",
      "image" => wp_get_attachment_url( get_post_thumbnail_id($post->ID) )
    ));
  endwhile;
?>
<?php is_page('Frontpage'); ?>
<script type="text/javascript">
function frontpageload() {
    var blockles = <?php echo json_encode($blockles); ?>;
    var finalblockles = new Array();
    var openblockles = [1,2,3,4,5,9,10,11,12,15];
    finalblockles[0] = {
      name: "Point2",
      perma: "http://www.sdar.point2portal.com/",
      image: "http://testing.businesslabkit.com/sdar/wp-content/themes/justknock/images/point2-map.jpg"
    };
    finalblockles[6] = {
      name: "Ask The Expert",
      perma: "http://testing.businesslabkit.com/sdar/ask/ask/ask-the-expert/",
      image: "http://testing.businesslabkit.com/sdar/wp-content/themes/justknock/images/6.jpg"
    };
    finalblockles[7] = {
      name: "Top Stories",
      perma: "http://testing.businesslabkit.com/sdar/news-page/",
      image: "http://testing.businesslabkit.com/sdar/wp-content/themes/justknock/images/9.jpg"
    };
    finalblockles[8] = {
      name: "Most Popular",
      perma: "http://testing.businesslabkit.com/sdar/news-page/",
      image: "http://testing.businesslabkit.com/sdar/wp-content/themes/justknock/images/7.jpg"
    };
    finalblockles[13] = {
      name: "Just Knock",
      perma: "",
      image: "http://testing.businesslabkit.com/sdar/wp-content/themes/justknock/images/15.png"
    };
    finalblockles[14] = {
      name: "Area Map",
      perma: "",
      image: "http://testing.businesslabkit.com/sdar/wp-content/themes/justknock/images/15.png"
    };
    finalblockles[16] = {
      name: "Find a REALTOR&#8482;",
      perma: "http://testing.businesslabkit.com/sdar/search/",
      image: "http://testing.businesslabkit.com/sdar/wp-content/themes/justknock/images/16.jpg"
    };
    var tempblockles = new Array();
    for (var i = 0; i < 10; i++) {
      var selecao = Math.floor((Math.random() * (blockles.length)));
      if (selecao == blockles.length) {
        selecao = blockles.length - 1;
      }
      tempblockles.push(blockles[selecao]);
      blockles.splice(selecao,1);
    }
    for (var i = 0; i < 10; i++) {
      finalblockles[openblockles[i]] = tempblockles[i];
    }
    frontpageloader(finalblockles);
}
</script>
<?php get_footer(); ?>