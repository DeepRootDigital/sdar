<?php get_header(); ?>
<div class="body">
  <div class="left-container">
  </div>
  <div class="right-container"> 
  </div>
  <?php include 'fake-sidebars.php'; ?>
  <div class="container">
    <div class="row">
      <div class="news-sidebar col-sm-3">
        <div class="row">
          <div class="col-xs-12 col-sm-12 feature">
            <div class="gridbox bg-primary news-header">
              <img src="<?php echo get_template_directory_uri(); ?>/images/icon-top.png" alt="News">
              <p>News</p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-12 feature">
            <div class="gridbox newssidebar">
              <div class="sidebar-triangle"></div>
              <!-- <?php dynamic_sidebar( 'blog-sidebar' ); ?> -->
            </div>
          </div>
        </div>
      </div>
      <div class="news-feed col-sm-9">
      <?php 
        $temp = $wp_query; 
        $wp_query = null; 
        $wp_query = new WP_Query(); 
        $wp_query->query('&paged='.$paged.'&posts_per_page=6'); 

        while ($wp_query->have_posts()) : $wp_query->the_post();				
      ?>
        <div class="news-single col-sm-12">
          <div class="news-single-bg">
            <img src="<?php echo get_template_directory_uri(); ?>/images/news1.png" alt="Lestat's Coffee">
          </div>
          <div class="news-single-cover">
            <div class="news-single-cover-halfcircle">
              <img src="<?php echo get_template_directory_uri(); ?>/images/icon-arrow.png" alt="Arrow">
            </div>
            <h3><?php echo get_the_title(); ?></h3>
            <p><?php echo get_the_excerpt(); ?><br /><a href="<?php the_permalink(); ?>">Read More</a></p>
            <h6><?php echo get_the_date(); ?></h6>
          </div>
        </div>
        <?php endwhile; ?>
        <div class="pagination">
          <?php posts_nav_link( ' ', '< Previous', 'Next >' ); ?>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<?php get_footer(); ?>