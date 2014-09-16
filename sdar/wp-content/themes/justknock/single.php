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
                    <img src="<?php echo get_template_directory_uri(); ?>/images/icon-top.png" alt="News">
                    <a href="http://testing.businesslabkit.com/sdar/news-page/"><p>News</p></a>
                  </div>
                </div>
              </div>
              <div class="row">
                <?php include 'sidebar-single.php'; ?>
              </div>
            </div>
            <div class="news-feed col-sm-9">
              <?php wp_reset_query(); ?>
              <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
              <div class="news-article col-sm-12">
                <h2><?php echo get_the_title(); ?></h2>
                <img src="<?php echo get_template_directory_uri(); ?>/images/news1.png" alt="Lestats">
                <div class="newspost-single-info">
                  <p><?php the_date(); ?></p>
                  <p>By: <?php the_author(); ?></p>
                </div>
                <div class="newspost-single-content">
                  <h2><?php the_title(); ?></h2>
                  <?php the_content(); ?>
                  <div class="newspost-single-social">
                    <p>Share this article</p>
                    <div class="fb-share-button" data-href="<?php the_permalink(); ?>" data-type="button"></div>
                    <a href="<?php the_permalink(); ?>" class="twitter-share-button" data-lang="en">Tweet</a>
                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                    <script src="//platform.linkedin.com/in.js" type="text/javascript">
                      lang: en_US
                    </script>
                    <script type="IN/Share" data-url="<?php the_permalink(); ?>"></script>
                    <div class="g-plus" data-action="share" data-annotation="none" data-href="<?php the_permalink(); ?>"></div>
                    <script type="text/javascript">
                      (function() {
                        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                        po.src = 'https://apis.google.com/js/platform.js';
                        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                      })();
                    </script>
                  </div>
                </div>  
              </div>
              <?php endwhile; endif; ?>
              <div class="newspost-single-comments">
                <!--
                <?php comments_template(); ?>
                -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php get_footer(); ?>