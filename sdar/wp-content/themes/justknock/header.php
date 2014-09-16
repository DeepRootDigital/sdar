<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Just Knock</title>
  <?php wp_head(); ?>

  <!-- Bootstrap -->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
  <link href="<?php echo get_template_directory_uri(); ?>/css/normalize.css" rel="stylesheet">
  <link href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo get_template_directory_uri(); ?>/style.css" rel="stylesheet">

  <script src="<?php echo get_template_directory_uri(); ?>/components/platform/platform.js"></script>
  <link rel="import" href="<?php echo get_template_directory_uri(); ?>/components/google-map/google-map.html">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    </head>
    <body>
<header>
  <div class="container">
    <div class="row">
      <a href="http://testing.businesslabkit.com/sdar/" class="logolink">
          <img src="<?php echo get_template_directory_uri(); ?>/images/justknock.png" alt="Just Knock Logo" class="logo">
      </a>
      <?php wp_nav_menu(array('theme_location' => 'Header Nav',)); ?>
      <a href="http://testing.businesslabkit.com/sdar/search-all/"><button class="search"></button></a>
      <?php if (is_user_logged_in()) { ?>
          <button class="logout">
            <a href="<?php echo wp_logout_url('http://testing.businesslabkit.com/sdar/'); ?>">
              <img src="<?php echo get_template_directory_uri(); ?>/images/login.png" alt="Logout Icon">
              Log Out
            </a>
          </button>
      <?php } else { ?>
          <button class="login">
            <a href="http://testing.businesslabkit.com/sdar/register/?action=registeruser&subscription=1">
                <img src="<?php echo get_template_directory_uri(); ?>/images/login.png" alt="Login Icon">
                Log In / Sign Up
            </a>
            <div class="login-submenu">
              <form action="<?php echo site_url('wp-login.php') ?>" method="post">
                <input class="field" type="text" name="log" id="log" value="<?php echo wp_specialchars(stripslashes($user_login), 1) ?>" size="23" placeholder="Username" />
                <input class="field" type="password" name="pwd" id="pwd" size="23" placeholder="Password" />
                <a href="http://testing.businesslabkit.com/sdar/register/?action=registeruser&subscription=1">Sign Up</a>
                <input type="submit" name="submit" value="Login" class="bt_login" />
                <input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>"/>
              </form>
            </div>
          </button>
      <?php } ?>
    </div>
  </div>
</header>