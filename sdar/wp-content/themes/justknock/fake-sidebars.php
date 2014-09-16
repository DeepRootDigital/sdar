<?php
  $args = array(
    'post_type' => 'neighborhoods'
  );
  $wp_query = new WP_Query($args); 
  $sidebars = array();
  while ($wp_query->have_posts()) : $wp_query->the_post();
    array_push($sidebars, array(
      "name" => get_the_title(),
      "image" => wp_get_attachment_url( get_post_thumbnail_id($post->ID) )
    ));
  endwhile;
  wp_reset_query();
?>
<script type="text/javascript">
function loadsidebars() {
    var sidebars = <?php echo json_encode($sidebars); ?>;
    var homedir = "<?php echo get_template_directory_uri(); ?>";
    shuffle(sidebars);
    var finalsidebar = [];
    for (var j = 0; j < 14; j++) {
      if (sidebars[j]) {
        finalsidebar.push(sidebars[j]);
      } else {
        finalsidebar.push(sidebars[j-sidebars.length]);
      }
    }
    for (var k = 0; k < 14; k++) {
      if (k < 7) {
        $('.left-container').append('<div class="row"><div class="feature"><div class="gridbox bg-success"><img src="' + finalsidebar[k].image + '" alt="Sidebar Image"><div class="cover teal"><div class="circle"><img src="' + homedir + '/images/icon-home.png" alt="Home Icon" class="icon-home"></div><p>' + finalsidebar[k].name + '</p></div></div></div></div>');
      } else {
        $('.right-container').append('<div class="row"><div class="feature"><div class="gridbox bg-success"><img src="' + finalsidebar[k].image + '" alt="Sidebar Image"><div class="cover teal"><div class="circle"><img src="' + homedir + '/images/icon-home.png" alt="Home Icon" class="icon-home"></div><p>' + finalsidebar[k].name + '</p></div></div></div></div>');
      }
    }
}
</script>
<div class="left-container">
  <div class="side-cover">
  </div>
</div>
<div class="right-container">
  <div class="side-cover">
  </div>   
</div>