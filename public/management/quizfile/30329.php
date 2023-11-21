<?php
/**
 * Astra functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Define Constants
 */
define( 'ASTRA_THEME_VERSION', '3.7.3' );
define( 'ASTRA_THEME_SETTINGS', 'astra-settings' );
define( 'ASTRA_THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'ASTRA_THEME_URI', trailingslashit( esc_url( get_template_directory_uri() ) ) );


/**
 * Minimum Version requirement of the Astra Pro addon.
 * This constant will be used to display the notice asking user to update the Astra addon to the version defined below.
 */
define( 'ASTRA_EXT_MIN_VER', '3.6.0' );

/**
 * Setup helper functions of Astra.
 */
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-theme-options.php';
require_once ASTRA_THEME_DIR . 'inc/core/class-theme-strings.php';
require_once ASTRA_THEME_DIR . 'inc/core/common-functions.php';
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-icons.php';

/**
 * Update theme
 */
require_once ASTRA_THEME_DIR . 'inc/theme-update/class-astra-theme-update.php';
require_once ASTRA_THEME_DIR . 'inc/theme-update/astra-update-functions.php';
require_once ASTRA_THEME_DIR . 'inc/theme-update/class-astra-theme-background-updater.php';
require_once ASTRA_THEME_DIR . 'inc/theme-update/class-astra-pb-compatibility.php';


/**
 * Fonts Files
 */
require_once ASTRA_THEME_DIR . 'inc/customizer/class-astra-font-families.php';
if ( is_admin() ) {
	require_once ASTRA_THEME_DIR . 'inc/customizer/class-astra-fonts-data.php';
}

require_once ASTRA_THEME_DIR . 'inc/lib/webfont/class-astra-webfont-loader.php';
require_once ASTRA_THEME_DIR . 'inc/customizer/class-astra-fonts.php';

require_once ASTRA_THEME_DIR . 'inc/dynamic-css/custom-menu-old-header.php';
require_once ASTRA_THEME_DIR . 'inc/dynamic-css/container-layouts.php';
require_once ASTRA_THEME_DIR . 'inc/dynamic-css/astra-icons.php';
require_once ASTRA_THEME_DIR . 'inc/dynamic-css/block-editor-compatibility.php';
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-walker-page.php';
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-enqueue-scripts.php';
require_once ASTRA_THEME_DIR . 'inc/core/class-gutenberg-editor-css.php';
require_once ASTRA_THEME_DIR . 'inc/dynamic-css/inline-on-mobile.php';
require_once ASTRA_THEME_DIR . 'inc/dynamic-css/content-background.php';
require_once ASTRA_THEME_DIR . 'inc/class-astra-dynamic-css.php';
require_once ASTRA_THEME_DIR . 'inc/class-astra-global-palette.php';

/**
 * Custom template tags for this theme.
 */
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-attr.php';
require_once ASTRA_THEME_DIR . 'inc/template-tags.php';

require_once ASTRA_THEME_DIR . 'inc/widgets.php';
require_once ASTRA_THEME_DIR . 'inc/core/theme-hooks.php';
require_once ASTRA_THEME_DIR . 'inc/admin-functions.php';
require_once ASTRA_THEME_DIR . 'inc/core/sidebar-manager.php';

/**
 * Markup Functions
 */
require_once ASTRA_THEME_DIR . 'inc/markup-extras.php';
require_once ASTRA_THEME_DIR . 'inc/extras.php';
require_once ASTRA_THEME_DIR . 'inc/blog/blog-config.php';
require_once ASTRA_THEME_DIR . 'inc/blog/blog.php';
require_once ASTRA_THEME_DIR . 'inc/blog/single-blog.php';

/**
 * Markup Files
 */
require_once ASTRA_THEME_DIR . 'inc/template-parts.php';
require_once ASTRA_THEME_DIR . 'inc/class-astra-loop.php';
require_once ASTRA_THEME_DIR . 'inc/class-astra-mobile-header.php';

/**
 * Functions and definitions.
 */
require_once ASTRA_THEME_DIR . 'inc/class-astra-after-setup-theme.php';

// Required files.
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-admin-helper.php';

require_once ASTRA_THEME_DIR . 'inc/schema/class-astra-schema.php';

if ( is_admin() ) {

	/**
	 * Admin Menu Settings
	 */
	require_once ASTRA_THEME_DIR . 'inc/core/class-astra-admin-settings.php';
	require_once ASTRA_THEME_DIR . 'inc/lib/astra-notices/class-astra-notices.php';

	/**
	 * Metabox additions.
	 */
	require_once ASTRA_THEME_DIR . 'inc/metabox/class-astra-meta-boxes.php';
}

require_once ASTRA_THEME_DIR . 'inc/metabox/class-astra-meta-box-operations.php';

/**
 * Customizer additions.
 */
require_once ASTRA_THEME_DIR . 'inc/customizer/class-astra-customizer.php';

/**
 * Astra Modules.
 */
require_once ASTRA_THEME_DIR . 'inc/modules/related-posts/class-astra-related-posts.php';

/**
 * Compatibility
 */
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-gutenberg.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-jetpack.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/woocommerce/class-astra-woocommerce.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/edd/class-astra-edd.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/lifterlms/class-astra-lifterlms.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/learndash/class-astra-learndash.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-beaver-builder.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-bb-ultimate-addon.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-contact-form-7.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-visual-composer.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-site-origin.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-gravity-forms.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-bne-flyout.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-ubermeu.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-divi-builder.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-amp.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-yoast-seo.php';
require_once ASTRA_THEME_DIR . 'inc/addons/transparent-header/class-astra-ext-transparent-header.php';
require_once ASTRA_THEME_DIR . 'inc/addons/breadcrumbs/class-astra-breadcrumbs.php';
require_once ASTRA_THEME_DIR . 'inc/addons/heading-colors/class-astra-heading-colors.php';
require_once ASTRA_THEME_DIR . 'inc/builder/class-astra-builder-loader.php';

// Elementor Compatibility requires PHP 5.4 for namespaces.
if ( version_compare( PHP_VERSION, '5.4', '>=' ) ) {
	require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-elementor.php';
	require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-elementor-pro.php';
	require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-web-stories.php';
}

// Beaver Themer compatibility requires PHP 5.3 for anonymus functions.
if ( version_compare( PHP_VERSION, '5.3', '>=' ) ) {
	require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-beaver-themer.php';
}

require_once ASTRA_THEME_DIR . 'inc/core/markup/class-astra-markup.php';

/**
 * Load deprecated functions
 */
require_once ASTRA_THEME_DIR . 'inc/core/deprecated/deprecated-filters.php';
require_once ASTRA_THEME_DIR . 'inc/core/deprecated/deprecated-hooks.php';
require_once ASTRA_THEME_DIR . 'inc/core/deprecated/deprecated-functions.php';

function account_button() { 

// Things that you want to do. 
if ( is_user_logged_in() ) {
$html =    '<div class="elementor-element elementor-element-0f886d7 elementor-mobile-align-center elementor-widget elementor-widget-button" data-id="0f886d7" data-element_type="widget" data-widget_type="button.default">
				<div class="elementor-widget-container">
					<div class="elementor-button-wrapper">
			<a href=https://orisefinance.com/my-account/ class="custom_button_account elementor-button-link elementor-button elementor-size-sm elementor-animation-push" role="button">
						<span class="elementor-button-content-wrapper">
						<span class="elementor-button-text">My Account</span>
		</span>
					</a>
		</div>
				</div>
				</div>';
} else {
$html =    '<div class="elementor-element elementor-element-0f886d7 elementor-mobile-align-center elementor-widget elementor-widget-button" data-id="0f886d7" data-element_type="widget" data-widget_type="button.default">
				<div class="elementor-widget-container">
					<div class="elementor-button-wrapper">
			<a href=https://orisefinance.com/log-in/ class="custom_button_account elementor-button-link elementor-button elementor-size-sm elementor-animation-push" role="button">
						<span class="elementor-button-content-wrapper">
						<span class="elementor-button-text">SIGN UP/LOGIN</span>
		</span>
					</a>
		</div>
				</div>
				</div>';
}

// Output needs to be return

return $html; }
// register shortcode
add_shortcode('account_button', 'account_button');

add_filter ( 'woocommerce_account_menu_items', 'misha_one_more_link' );
function misha_one_more_link( $menu_links ){

	// we will hook "anyuniquetext123" later
	$new = array( 'uploads' => 'Uploads Documents' );

	
	// array_slice() is good when you want to add an element between the other ones
	$menu_links = array_slice( $menu_links, 0, 1, true ) 
	+ $new 
	+ array_slice( $menu_links, 1, NULL, true );


	return $menu_links;
  
}
add_filter( 'woocommerce_get_endpoint_url', 'misha_hook_endpoint', 10, 4 );
function misha_hook_endpoint( $url, $endpoint, $value, $permalink ){
 
	if( $endpoint === 'uploads' ) {
 
		// ok, here is the place for your custom URL, it could be external
		$url = site_url().'/'.'files-uploads/';
 
	}
	return $url;
 
}
           add_filter ( 'woocommerce_account_menu_items', 'misha_one_more_link2' );
function misha_one_more_link2( $menu_links ){

	// we will hook "anyuniquetext123" later
	$new = array( 'upload' => 'My Documents' );

	// or in case you need 2 links
	// $new = array( 'link1' => 'Link 1', 'link2' => 'Link 2' );

	// array_slice() is good when you want to add an element between the other ones
	$menu_links = array_slice( $menu_links, 0, 1, true ) 
	+ $new 
	+ array_slice( $menu_links, 1, NULL, true );


	return $menu_links;
 
 
}

add_filter( 'woocommerce_get_endpoint_url', 'misha_hook_endpoint2', 10, 4 );
function misha_hook_endpoint2( $url, $endpoint, $value, $permalink ){
 
	if( $endpoint === 'upload' ) {
 
		// ok, here is the place for your custom URL, it could be external
		$url = site_url().'/'.'my-uploads-file/';
 
	}
	return $url;
 
} 
    
function Users_data(){
    add_menu_page( 
        __( 'Users Information Title', 'textdomain' ),
        'User Details',
        'manage_options',
        'user',
        'users_information',
        'https://orisefinance.com/wp-content/uploads/2021/10/user.png',6
        
    ); 
}
add_action( 'admin_menu', 'Users_data' );

function users_information(){ ?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
    .f-16 {
        font-size: 16px;
    }
    </style>
        
	<div class="container-fluid px-3 my-4">
    
	<table class="table f-16">
		<thead>
			<tr>
				<th scope="col">Name</th>
			</tr>
		</thead>
		<tbody>
				<?php


    $i =1;
	foreach ( $users as $user )   { ?>
	  <tr>
      <td class="p-0">
      <div class="accordion" id="accordionExample">
  <div class="card p-0 my-2" style = "max-width: 100%;">
    <div class="card-header " id="headingThree">
      <h2 class="mb-0">
        <button class="text-decoration-none btn w-100 btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#wow<?php echo $i; ?>" aria-expanded="false" aria-controls="wow<?php echo $i; ?>">
         
          <span class="text-dark mx-3"><?php echo $user->user_login; ?></span>  
          <span class="text-dark mx-3"><?php echo $user->user_email; ?></span>  
          <span class="float-right">
          <span class="text-dark mx-3"> 
          <?php if($user->active == 1){
				  echo "Activated";
				  }
				  else{
					echo "Not-Activated";
				  } ?>
              </span>
               <span class="text-dark mx-3"><?php echo $user->registered; ?></span>  </span>
        </button>
      </h2>
    </div>
    <div id="wow<?php echo $i; ?>" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body p-0">
            <div class="woocommerce-MyAccount-content">
	<div class="woocommerce-notices-wrapper"></div>
	<div class="woocommerce-Message woocommerce-Message--info woocommerce-info">
      <?php 
    	global $wpdb;
		$users = $wpdb->get_results( "SELECT * FROM wpm1_signups");
    if($users){

    	?>
      <table class="table table-striped">
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Document Type</th>
			      <th scope="col">Document</th>
			    </tr>
			  </thead>
  <tbody>
  <?php
    $my_documents = $wpdb->get_results( "SELECT * FROM wpm1_user_document WHERE `user_email` = '{$user->user_email}'");
  foreach ( $my_documents as $my_document )   { ?>
    <tr>
      <th scope="row">3</th>
      <td> <?php echo $my_document->document_type ; ?></td>
      <td>
      <a href="<?php echo $my_document->document ; ?>" target="_blank"><?php echo $my_document->document ; ?></a>
      </td>
      
    </tr>
     <?php   } ?>
  </tbody>
</table>
<?php } else{ ?>
<p>NO RECORD FOUND</p>
<?php } ?>
</div>
</div>
</div>
      </div>
    </div>
  </div>
</div>
      
      </td>
			 
<!--<td>                <a href="https://orisefinance.com/user-detail/?email=<?php echo $user->user_email; ?>"> <button type="button" class="btn btn-primary btn-sm">View</button></a></td> -->
	  </tr>
	  <?php 
       $i++;
      }
  ?>
			
		</tbody>
	</table>
</div>


<?php   
}