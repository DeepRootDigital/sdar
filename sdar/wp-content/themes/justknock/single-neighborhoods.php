<?php get_header(); ?>
      <div class="body">
  <div class="left-container">
  </div>
  <div class="right-container"> 
  </div>
  <!-- <?php include 'fake-sidebars.php'; ?> -->
        <div class="container">
          <div class="row">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="news-area col-sm-12">
              <div class="row">
                <div class="col-xs-3 col-sm-3 feature">
                  <div class="gridbox bg-primary news-header neighborhood neighborhood-title tall">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/icon-home.png" alt="Neighborhood Icon">
                    <p><?php the_title(); ?></p>
                  </div>
                </div>
                <div class="neighborhood col-sm-9">
                  <div class="row">
                    <div class="neighborhood-images">
                      <?php autoc_get_img('featuredimages'); ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="gridbox neighborhood-description">
                      <?php the_content(); ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-3 col-sm-3 feature">
                  <div class="gridbox neighborhood-stats neighborhood-three">
                    <p>Community<br />Profile</p>
                  </div>
                </div>
                <?php if (current_user_has_subscription()) { ?>
                <div class="col-sm-9 neighborhood-stats-content neighborhood-three">
                </div>
                <?php } else { ?>
                <div class="col-sm-9 neighborhood-stats-content-blocked neighborhood-three">
                  <p>You need to have a subscription to access this content.</p>
                  <a href="http://testing.businesslabkit.com/sdar/register/?action=registeruser&subscription=1">Click here to Sign up</a>
                  <p>or</p>
                  <a href="http://testing.businesslabkit.com/sdar/search/">Find a Realtor&#8482;</a>
                </div>
                <?php } ?>
              </div>
              <div class="row">
                <div class="col-xs-3 col-sm-3 feature">
                  <div class="gridbox neighborhood-school neighborhood-two">
                    <p>Schools</p>
                  </div>
                </div>
                <div class="col-sm-9 neighborhood-schools-content neighborhood-two">
                </div>
              </div>
              <div class="row">
                <div class="col-xs-3 col-sm-3 feature">
                  <div class="gridbox neighborhood-poi neighborhood-three">
                    <p>What's in your neighborhood?</p>
                  </div>
                </div>
                <div class="col-sm-9 neighborhood-poi-content neighborhood-three">
                  <div class="gridbox neighborhood-poi-icons col-xs-12">
                    <div class="neighborhood-poi-icon-single">
                      <div class="neighborhood-poi-icon-single-icon drinking"></div>
                      <p>Bars &amp; Nightclubs</p>
                    </div>
                    <div class="neighborhood-poi-icon-single">
                      <div class="neighborhood-poi-icon-single-icon banks"></div>
                      <p>Banks</p>
                    </div>
                    <div class="neighborhood-poi-icon-single">
                      <div class="neighborhood-poi-icon-single-icon shopping"></div>
                      <p>Shopping</p>
                    </div>
                    <div class="neighborhood-poi-icon-single">
                      <div class="neighborhood-poi-icon-single-icon health"></div>
                      <p>Health</p>
                    </div>
                    <div class="neighborhood-poi-icon-single">
                      <div class="neighborhood-poi-icon-single-icon localgov"></div>
                      <p>Public Services</p>
                    </div>
                    <div class="neighborhood-poi-icon-single">
                      <div class="neighborhood-poi-icon-single-icon sports"></div>
                      <p>Sports &amp; Recreation</p>
                    </div>
                    <div class="neighborhood-poi-icon-single">
                      <div class="neighborhood-poi-icon-single-icon eating"></div>
                      <p>Restaurants</p>
                    </div>
                    <div class="neighborhood-poi-icon-single">
                      <div class="neighborhood-poi-icon-single-icon markets"></div>
                      <p>Groceries &amp; Markets</p>
                    </div>
                    <div class="neighborhood-poi-icon-single">
                      <div class="neighborhood-poi-icon-single-icon entertainment"></div>
                      <p>Entertainment</p>
                    </div>
                  </div>
                </div>
              </div>
              <!-- <div class="row">
                <div class="col-xs-3 col-sm-3 feature">
                  <div class="gridbox neighborhood-activelistings">
                    <p>Active Listings</p>
                  </div>
                </div>
              </div> -->
              <div class="row">
                <div class="col-xs-3 col-sm-3 feature">
                  <div class="gridbox neighborhood-events">
                    <p>Neighborhood<br />Events</p>
                  </div>
                </div>
                <div class="col-xs-9 neighborhood-events-content">
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 col-sm-12 feature">
                  <p style="text-align:center;margin:0;">Powered by: Onboard Informatics</p>
                </div>
              </div>                  
            </div>
            <?php endwhile; endif; ?>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      window.onload = function() {
        var neighborhood = "<?php echo get_post_meta(get_the_ID(), 'apilocation', true); ?>";
        var latlong = "<?php echo get_post_meta(get_the_ID(), 'latlong', true); ?>";
        eventbriteLoad(latlong);
        // foursquareLoad(latlong);
        // yelpLoad(neighborhood);
        onboardinformatics(latlong,neighborhood);
      }
    </script>
<?php get_footer(); ?>