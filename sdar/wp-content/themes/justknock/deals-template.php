<?php /* Template Name: Newest Deals Template */ ?>
<?php get_header(); ?>
      <div class="body">
  <div class="left-container">
  </div>
  <div class="right-container"> 
  </div>
  <!-- <?php include 'fake-sidebars.php'; ?> -->
        <div class="container">
          <?php 
	      $args=array(
	        'post_type' => 'deals',
                'showposts' => 1
	      );

	      $blogPosts = new WP_Query($args);

	      while ($blogPosts->have_posts()) : $blogPosts->the_post();
          ?>
          <div class="row deals-faded">
            <div class="deals-header col-sm-9">
              <p><?php echo get_post_meta(get_the_ID(), 'blurb', true); ?></p>
            </div>
            <div class="deals-title col-sm-3">
              <img src="<?php echo get_img_src('companylogo'); ?>" alt="Company Logo">
            </div>
          </div>
          <div class="row deals-faded">
            <div class="col-sm-3 deals-sidebar">
              <div class="gridbox deals-sell">
                <h4>$<?php echo get_post_meta(get_the_ID(), 'price', true); ?></h4>
                <a href="<?php echo get_post_meta(get_the_ID(), 'url', true); ?>"><button>Buy Now</button></a>
              </div>
              <div class="gridbox deals-timer">
                <p>Limited Time Only!</p>
                <h5 class="timer">Ends: <span><?php echo get_post_meta(get_the_ID(), 'dealends', true); ?></span></h5>
              </div>
            </div>
            <div class="col-sm-9 deals-content">
              <?php the_post_thumbnail(); ?>
              <h3><?php echo get_the_title(); ?></h3>
              <p><?php echo get_the_content(); ?></p>
            </div>
          </div>
          <?php endwhile; ?>
            <?php 
	      $args=array(
	        'post_type' => 'deals'
	      );

	      $blogPosts = new WP_Query($args);
              $dealdata = array();
              $counter = 0;
              $total = 1;
              $totalposts = $blogPosts->found_posts;
	      while ($blogPosts->have_posts()) : $blogPosts->the_post();
                array_push($dealdata, array(
                  'name' => get_the_title(),
                  'companylogo' => get_img_src('companylogo'),
                  'image' => wp_get_attachment_url( get_post_thumbnail_id($post->ID) ),
                  'price' => get_post_meta(get_the_ID(), 'price', true),
                  'content' => get_the_content(),
                  'blurb' => get_post_meta(get_the_ID(), 'blurb', true),
                  'dealends' => get_post_meta(get_the_ID(), 'dealends', true),
                  'perma' => get_post_meta(get_the_ID(), 'url', true)
                ));
            ?>
                <?php if ($counter == 0) { ?>
                  <div class="row">
                <?php } ?>
                <div class="other-deals">
                    <p><?php echo get_the_title(); ?></p>
                    <p>$<?php echo get_post_meta(get_the_ID(), 'price', true); ?></p>
                    <div class="other-deals-img">
                        <?php the_post_thumbnail(); ?>
                        <?php echo $counter; ?>
                        <?php echo $total; ?>
                    </div>
                </div>
                <?php if ($counter == 6 || $total == $totalposts) { ?>
                  </div>
                <?php $counter = 0;
                    $total = $total + 1;
                  } else {
                    $counter = $counter + 1;
                    $total = $total + 1;
                  } ?>
            <?php endwhile; ?>
        </div>
      </div>
    </div>
<script type="text/javascript">
  window.onload = function() {
    var dealdata = <?php echo json_encode($dealdata); ?>;
    $('.other-deals').click(function(){
      var rowindex = $(this).parent().index() - 2;
      var itemindex = $(this).index();
      var index = (rowindex * 7) + itemindex;
      var newdata = dealdata[index];
      $('.deals-faded').fadeOut(300,function(){
        $('.deals-header p').text(newdata.blurb);
        $('.deals-sell h4').text("$"+newdata.price);
        $('.deals-sell a').attr("href",newdata.perma);
        $('.deals-content p').eq(0).html(newdata.content);
        $('.timer span').text(newdata.dealends);
        $('.deals-content img').attr('src',newdata.image);
        $('.deals-title img').attr('src',newdata.companylogo);
        $('.deals-content h3').eq(0).text(newdata.name);
        $('.deals-faded').fadeIn(300);
        $('html,body').animate({scrollTop : $('.container').scrollTop()},500);
      });
    });
  }
</script>
<?php get_footer(); ?>