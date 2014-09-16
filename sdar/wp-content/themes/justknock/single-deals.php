<?php get_header(); ?>
      <div class="body">
  <div class="left-container">
  </div>
  <div class="right-container"> 
  </div>
  <!-- <?php include 'fake-sidebars.php'; ?> -->
        <div class="container">
          <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <div class="row">
            <div class="deals-header col-sm-9">
              <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor.</p>
            </div>
            <div class="deals-title col-sm-3">
              <h3>Company Logo</h3>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3 deals-sidebar">
              <div class="gridbox deals-sell">
                <h4>$599</h4>
                <p>per night</p>
                <button>Buy Now</button>
              </div>
              <div class="gridbox deals-timer">
                <p>Limited Time Only!</p>
                <h5 class="timer">1 day 07:06:05</h5>
              </div>
            </div>
            <div class="col-sm-9 deals-content">
              <img src="<?php echo get_template_directory_uri(); ?>/images/deal-feat.png" alt="Deals">
              <h3>Short &amp; Simple</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
              <h3 class="deal-details">The Details</h3>
              <ul>
                <li>&raquo; Contemporary Style</li>
                <li>&raquo; White faux-leather upholstery</li>
                <li>&raquo; Grid turfing</li>
                <li>&raquo; Low Profile Design</li>
                <li>&raquo; Hardwood, plywood and MDF frame</li>
                <li>&raquo; Foam Padding</li>
                <li>&raquo; Shiny chrome-plated steel legs</li>
              </ul>
            </div>
          </div>
          <?php endwhile; endif; ?>
          <div class="row">
            <?php 
	      $args=array(
	        'post_type' => 'deals',
                'showposts' => 7
	      );

	      $blogPosts = new WP_Query($args);

	      while ($blogPosts->have_posts()) : $blogPosts->the_post();
            ?>
            <?php endwhile; ?>
          </div>
        </div>
      </div>
    </div>
<?php get_footer(); ?>