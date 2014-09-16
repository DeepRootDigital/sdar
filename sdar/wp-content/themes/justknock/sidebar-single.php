<div class="col-xs-12 col-sm-12">
  <div class="gridbox newssidebar">
    <div class="sidebar-triangle"></div>
    <div class="latestposts-widget">
      <h3>Latest Articles</h3>
      <div class="latestposts-posts">
        <?php query_posts('posts_per_page=7'); ?>
        <?php while (have_posts()) : the_post(); ?>
          <div class="sidebar-single">
            <a href="<?php the_permalink(); ?>"><h5><?php the_title(); ?></h5></a>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
</div>