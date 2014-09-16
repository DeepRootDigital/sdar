<footer>
    <?php wp_nav_menu(array('theme_location' => 'Footer Nav',)); ?>
</footer>
<div class="contact-form-overlay">
  <div class="contact-form-overlay-bg"></div>
  <div class="contact-form-overlay-form">
    <h4>Contact us, we want to hear from you.</h4>
    <input type="text" name="fname" placeholder="First Name" required>
    <input type="text" name="lname" placeholder="Last Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="phone" placeholder="Phone (ex: 888-888-8888)">
    <textarea name="message" placeholder="Message"></textarea>
    <input type="submit" value="Submit Now">
  </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/functions.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/chart.js"></script>
</body>
</html>