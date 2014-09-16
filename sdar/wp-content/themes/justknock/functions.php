<?php

// Re-define meta box path and URL
define('RWMB_URL', trailingslashit(get_stylesheet_directory_uri() . '/autocracy/API/'));
define('RWMB_DIR', trailingslashit(get_template_directory() . '/autocracy/API/'));
// Include the meta box script
require_once RWMB_DIR . '/meta-box.php';
include get_template_directory() . '/autocracy/demo.php';

add_theme_support('post-thumbnails');
add_theme_support('menus');
register_nav_menu('Header Nav', 'Header Nav');
register_nav_menu('Footer Nav', 'Footer Nav');

function autoc_get_img($id) {

	global $wpdb;
	$images = get_post_meta( get_the_ID(), $id, false );
	$images = implode( ',' , $images );

// Re-arrange images with 'menu_order'
	$images = $wpdb->get_col( "
		SELECT ID FROM {$wpdb->posts}
		WHERE post_type = 'attachment'
		AND ID in ({$images})
		ORDER BY menu_order ASC
		" );

	foreach ( $images as $att )
	{
    // Get image's source based on size, can be 'thumbnail', 'medium', 'large', 'full' or registed post thumbnails sizes
		$src = wp_get_attachment_image_src( $att, 'full' );
		$src = $src[0];
    // Show image
		echo "<div class='img-container'><img src='{$src}' /></div>";
	}

}

function get_img_src($id) {
        global $wpdb;
	$images = get_post_meta( get_the_ID(), $id, false );
	$images = implode( ',' , $images );

        // Re-arrange images with 'menu_order'
	$images = $wpdb->get_col( "
		SELECT ID FROM {$wpdb->posts}
		WHERE post_type = 'attachment'
		AND ID in ({$images})
		ORDER BY menu_order ASC
		" );

	foreach ( $images as $att )
	{
        // Get image's source based on size, can be 'thumbnail', 'medium', 'large', 'full' or registed post thumbnails sizes
		$src = wp_get_attachment_image_src( $att, 'full' );
		$src = $src[0];
        // Show image
		return $src;
	}
}

// WIDGET SPACES

function arphabet_widgets_init() {

	register_sidebar( array(
		'name' => 'Blog Sidebar',
		'id' => 'blog_sidebar',
		'before_widget' => '<div class="footer-sidebar">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="rounded">',
		'after_title' => '</h2>',
		) );

}
add_action( 'widgets_init', 'arphabet_widgets_init' );

// GET USER ROLE

function get_user_role() {
	global $current_user;

	$user_roles = $current_user->roles;
	$user_role = array_shift($user_roles);

	return $user_role;
}

/* Register Custom Post Types */

function create_post_type() {
	register_post_type('Neighborhoods', array(
		'labels' => array(
			'name' => __('Neighborhoods'),
			'singular_name' => __('Neighborhood')
			),
		'public' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'neighborhoods'),
		'supports' => array('title','editor','thumbnail')
		)
	);
	register_post_type('Deals', array(
		'labels' => array(
			'name' => __('Deals'),
			'singular_name' => __('Deal')
			),
		'public' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'deals'),
		'supports' => array('title','editor','thumbnail')
		)
	);
        register_post_type('Resources', array(
		'labels' => array(
			'name' => __('Resources'),
			'singular_name' => __('Resource')
			),
		'public' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'resources'),
		'supports' => array('title','editor','thumbnail')
		)
	);
}
add_action('init', 'create_post_type');


// CUSTOM USER FIELDS

add_action ( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action ( 'edit_user_profile', 'my_show_extra_profile_fields' );
 
function my_show_extra_profile_fields ( $user )
{
?>
    <h3>Extra profile information</h3>
    <table class="form-table">
        <tr>
            <th><label for="mlsname">Representative's Name</label></th>
            <td>
                <input type="text" name="mlsname" id="mlsname" value="<?php echo esc_attr( get_the_author_meta( 'mlsname', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description">Please enter your representative's name.</span>
            </td>
        </tr>
    </table>
    <table class="form-table">
        <tr>
            <th><label for="mlsid">Representative Member ID</label></th>
            <td>
                <input type="text" name="mlsid" id="mlsid" value="<?php echo esc_attr( get_the_author_meta( 'mlsid', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description">Please enter representative's member id.</span>
            </td>
        </tr>
    </table>
<?php
}

add_action ( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action ( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

function my_save_extra_profile_fields( $user_id )
{
    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;
    /* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
    update_usermeta( $user_id, 'mlsname', $_POST['mlsname'] );
    update_usermeta( $user_id, 'mlsid', $_POST['mlsid'] );
}

add_action('register_form','show_first_name_field');
add_action('register_post','check_fields',10,3);
add_action('user_register', 'register_extra_fields');
 
function show_first_name_field()
{
?>
    <p>
    <label>Representative's Name<br/>
    <input id="mlsname" type="text" tabindex="30" size="25" value="<?php echo $_POST['mlsname']; ?>" name="mlsname" />
    </label>
    </p>
    <p>
    <label>Representative's Member ID<br/>
    <input id="mlsid" type="text" tabindex="30" size="25" value="<?php echo $_POST['mlsid']; ?>" name="mlsid" />
    </label>
    </p>
<?php
}

function check_fields ( $login, $email, $errors )
{
    global $mlsname;
    if ( $_POST['mlsname'] == '' )
    {
        $errors->add( 'empty_mlsname', "<strong>ERROR</strong>: Please Enter your representative's name." );
    }
    else
    {
        $mlsname = $_POST['mlsname'];
    }
    global $mlsid;
    if ( $_POST['mlsid'] == '' )
    {
        $errors->add( 'empty_mlsid', "<strong>ERROR</strong>: Please Enter your representative's member ID." );
    }
    else
    {
        $mlsid = $_POST['mlsid'];
    }
}

function register_extra_fields ( $user_id, $password = "", $meta = array() )
{
    update_user_meta( $user_id, 'mlsname', $_POST['mlsname'] );
    update_user_meta( $user_id, 'mlsid', $_POST['mlsid'] );
}



// LOGIN SCREEN CODE

function my_login_logo() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/justknock.png);
            background-size: 100%;
            height: 44px;
            width: 110px;
            padding-bottom: 30px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'Just Knock by SDAR';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );


?>