<?php

if(is_wp_error($error) && method_exists($error, 'get_error_code')) {
	$anyerrors = $error->get_error_code();
	if( !empty($anyerrors) ) {
		// we have an error - output
		$messages = $error->get_error_messages();
		$errormessages = "<div class='alert alert-error'>";
		$errormessages .= implode('<br/>', $messages);
		$errormessages .= "</div>";
	} else {
		$errormessages = '';
	}
} else {
	$errormessages = '';
}

?>

<div id='membership-wrapper'>
<?php
	if(!empty($errormessages)) {
		echo $errormessages;
	}
?>
<form class="form-membership" action="<?php echo get_permalink(); ?>" method="post">

	<?php do_action( "signup_hidden_fields" ); ?>

	<input type='hidden' name='subscription' value='<?php if(isset($_REQUEST['subscription'])) echo esc_attr($_REQUEST['subscription']); ?>' id="sub-type" />

	<fieldset>
		<legend><?php _e( 'Create an Account', 'membership' ) ?></legend>
<div class="chooserealtor">
<img src="<?php echo get_template_directory_uri(); ?>/agents/generic.png" alt="Generic Realtor">
</div>
<?php if(isset($_POST['mlsid'])) { 
        $mlsid = esc_attr($_POST['mlsid']); 
      } else { 
        if (isset($_GET['mid'])) { 
          $mlsid = $_GET['mid']; 
        } else { 
          $mlsid = ""; 
        } 
      }
      if(isset($_POST['mlsname'])) { 
        $mname = esc_attr($_POST['mlsname']); 
      } else { 
        if (isset($_GET['mname'])) { 
          $mname = $_GET['mname']; 
        } else { 
          $mname = ""; 
        } 
      }
?>
<div class="chooserealtor-right">
<p>Choose Your Representative</p>
                        
					<input type="text" class="input-xlarge" id="mlsname" name="mlsname" placeholder="SDAR Member Name" value="<?php echo $mname; ?>">

					<input type="text" class="input-xlarge" id="mlsid" name="mlsid" placeholder="Member ID Number" value="<?php echo $mlsid; ?>">

<p>Don't have a representative? <a href="http://testing.businesslabkit.com/sdar/search/">Find One Now</a></p>
</div>

<div class="register-other">
  <img src="<?php echo get_template_directory_uri(); ?>/images/register-icon.png" alt="Registration Icon">
</div>
<div class="register-other-right">
                        <div class="form-element">
				<label class="control-label" for="user_fname"><?php _e('First Name','membership'); ?></label>
				<div class="element">
					<input type="text" class="input-xlarge" id="user_fname" name="user_fname" placeholder="First Name" value="<?php if(isset($_POST['user_fname'])) echo esc_attr($_POST['user_fname']); ?>">
				</div>
			</div>
                        <div class="form-element">
				<label class="control-label" for="user_lname"><?php _e('Last Name','membership'); ?></label>
				<div class="element">
					<input type="text" class="input-xlarge" id="user_lname" name="user_lname" placeholder="Last Name" value="<?php if(isset($_POST['user_lname'])) echo esc_attr($_POST['user_lname']); ?>">
				</div>
			</div>
                        <div class="form-element">
				<label class="control-label" for="user_login"><?php _e('Choose a Username','membership'); ?></label>
				<div class="element">
					<input type="text" class="input-xlarge" id="user_login" name="user_login" placeholder="Username" value="<?php if(isset($_POST['user_login'])) echo esc_attr($_POST['user_login']); ?>">
				</div>
			</div>
			<div class="form-element">
				<label class="control-label" for="user_email"><?php _e('Email Address','membership'); ?></label>
				<div class="element">
					<input type="text" class="input-xlarge" id="user_email" name="user_email" placeholder="Email" value="<?php if(isset($_POST['user_email'])) echo esc_attr($_POST['user_email']); ?>">
				</div>
			</div>
			<div class="form-element">
				<label class="control-label" for="password"><?php _e('Password','membership'); ?></label>
				<div class="element">
					<input type="password" class="input-xlarge" id="password" name="password" placeholder="Password" autocomplete="off">
				</div>
			</div>

			<div class="form-element">
				<label class="control-label" for="password2"><?php _e('Confirm Password','membership'); ?></label>
				<div class="element">
					<input type="password" class="input-xlarge" id="password2" name="password2" placeholder="Repeat Password" autocomplete="off">
				</div>

			</div>

		<?php
			do_action('membership_subscription_form_registration_presubmit_content');

			do_action( 'signup_extra_fields', $error );
		?>           

		<p><input type="submit" value="<?php _e('Register My Account','membership'); ?>" class="registration-button alignright button <?php echo apply_filters('membership_subscription_button_color', 'blue'); ?>" name="register"></p>
		<input type="hidden" name="action" value="validatepage1" />
                <input type="hidden" name="validated" value="false" class="form-valid" />
		<a title="Login »" href="<?php echo wp_login_url( add_query_arg('action', 'registeruser', get_permalink()) ); ?>" class="alignleft" id="login_right"><?php _e('Already have an account?' ,'membership'); ?></a>
                <p class="mls-error" style="color:blue;text-align:center;font-weight:700;float:left;width:100%;"></p>

</div>

		</fieldset>
</form>
</div>
<script type="text/javascript">
window.onload = function() {
  $('.form-membership').submit(function(event){
    if ($('.form-valid').val() == "false") {
      event.preventDefault();
      $('.mls-error').text("");
      if ($('#mlsid').val().length > 0 || $('#mlsname').val().length > 0) {
        $.ajax({
          data: {
            mlsid: $('#mlsid').val(),
            mlsname: $('#mlsname').val()
          },
          url: "http://testing.businesslabkit.com/sdarapi/checkregistration.php",
          type: "POST"
        }).done(function(data){
          var results = JSON.parse(data);
          if (results.length == 1) {
            $('#sub-type').val('2');
            var info = {
                "Email": $('#user_email').val(),
                "Password": $('#password').val(),
                "FirstName": $('#user_fname').val(),
                "LastName": $('#user_lname').val(),
                "UserType": "HomeBuyer",
                "Country": "US",
                "State": "CA",
                "City": "San Diego",
                "UserIdentifier": $('#user_login').val(),
                "ApiKey": "261b1859-5150-43e8-aa1b-253127cf68fb"
            };
            console.log(info);
            $.ajax({
              data: info,
              url: "https://secure.api.point2portal.com/ManageUsers/Create",
              type: "POST"
            }).done(function(data){
              console.log(data);
              // $('.form-valid').val('true');
              // $('.form-membership').submit();
            });
          } else {
            $('.mls-error').text("The member name and number that you entered do not match our records.");
          }
        });
      } else {
        $('#sub-type').val('1');
        $.ajax({
          data: {
            "Email": $('#user_email').val(),
            "Password": $('#password').val(),
            "FirstName": $('#user_fname').val(),
            "LastName": $('#user_lname').val(),
            "UserType": "HomeBuyer",
            "Country": "US",
            "State": "CA",
            "City": "San Diego",
            "UserIdentifier": $('#user_login').val(),
            "ApiKey": "261b1859-5150-43e8-aa1b-253127cf68fb"
          },
          url: "https://secure.api.point2portal.com/ManageUsers/Create",
          type: "POST"
        }).done(function(data){
          console.log(data);
          // $('.form-valid').val('true');
          // $('.form-membership').submit();
        });
      }
    }
  });
}
</script>
<?php
?>