<?php get_header(); ?>
<div class="body">
  <div class="left-container">
  </div>
  <div class="right-container"> 
  </div>
  <div class="container">
    <div class="search-area">
      <h2>Looking for something around the site?</h2>
      <p>Search for deals, neighborhoods and more!</p>
      <?php get_search_form(); ?>
    </div>
    <div class="search-results searchpage">
    <?php
      global $query_string;

      $query_args = explode("&", $query_string);
      $search_query = array();

      foreach($query_args as $key => $string) {
        $query_split = explode("=", $string);
        $search_query[$query_split[0]] = urldecode($query_split[1]);
      } // foreach

      $search = new WP_Query($search_query);
    ?>
      <div class="search-results-container">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <div class="search-results-single">
            <div class="search-results-single-image">
              <?php 
                if ( has_post_thumbnail() ) {
                  the_post_thumbnail('full', array('class' => " featured-image"));
                }  
              ?>
            </div>
            <div class="search-results-single-content">
              <div class="search-results-single-content-first">
                <h4><?php the_title(); ?></h4>
                <a href="<?php the_permalink(); ?>" class="search-permalink"><button>Go to Page</button></a>
              </div>
              <div class="search-results-single-content-second">
                <?php the_excerpt(); ?>
              </div>
            </div>
          </div>
        <?php endwhile; endif; ?>
      </div>
      <div class="search-results-pagination">
      </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>