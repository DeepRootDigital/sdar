<div class="leave-a-comment">
  <h3>Leave a Comment</h3>
  <form action="http://testing.businesslabkit.com/sdar/wp-comments-post.php" method="post" id="commentform" class="comment-form">
    <p class="comment-form-author"><input id="author" name="author" type="text" value="" size="30" aria-required="true" placeholder="Name"></p>
    <p class="comment-form-email"><input id="email" name="email" type="text" value="" size="30" aria-required="true" placeholder="Email"></p>
    <p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>
    <p class="form-submit">
      <input name="submit" type="submit" id="submit" value="Post Comment">
      <input type="hidden" name="comment_post_ID" value="8" id="comment_post_ID">
      <input type="hidden" name="comment_parent" id="comment_parent" value="0">
    </p>
  </form>
</div>
<?php if ( have_comments() ) : ?>
<div class="comments-list">
  <h3 id="comments"><?php comments_number('No Comments', 'One Comment', '% Comments' );?></h3> 
  <div class="navigation">
    <div class="alignleft"><?php previous_comments_link() ?></div>
    <div class="alignright"><?php next_comments_link() ?></div>
  </div> 
  <ol class="commentlist">
    <?php wp_list_comments(); ?>
  </ol> 
  <div class="navigation">
    <div class="alignleft"><?php previous_comments_link() ?></div>
    <div class="alignright"><?php next_comments_link() ?></div>
  </div>
</div>
<?php else : // this is displayed if there are no comments so far ?> 
<?php if ('open' == $post->comment_status) : ?>
<?php else : // comments are closed ?>
<p class="nocomments">Comments are closed.</p>
<?php endif; ?>
<?php endif; ?>
<?php if ('open' == $post->comment_status) : ?>
<?php endif; // if you delete this the sky will fall on your head ?>