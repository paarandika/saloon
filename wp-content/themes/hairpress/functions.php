<?php
/**
 * Hairpress functions and definitions
 *
 * @package Hairpress
 * @author Primoz Ciger <primoz@proteusnet.com>
 */


/**
 * Define the version variable to assign it to all the assets (css and js)
 */
define( "HAIRPRESS_WP_VERSION", wp_get_theme()->get( 'Version' ) );

/**
 * Define the development
 */
define( "HAIRPRESS_DEVELOPMENT", false );


/**
 * Set the content width based on the theme's design and stylesheet.
 * @see http://developer.wordpress.com/themes/content-width/
 */
if ( ! isset( $content_width ) ) {
	$content_width = 870; /* pixels */
}

if( ! function_exists( 'hairpress_adjust_content_width' ) ) {
	function hairpress_adjust_content_width() { // adjust if necessary
		global $content_width;

		if ( is_page_template( 'page-no-sidebar.php' ) ) {
			$content_width = 940;
		}
	}
	add_action( 'template_redirect', 'hairpress_adjust_content_width' );
}



/**
 * Option Tree Plugin
 *
 * - ot_show_pages:      will hide the settings & documentation pages.
 * - ot_show_new_layout: will hide the "New Layout" section on the Theme Options page.
 */

if ( ! HAIRPRESS_DEVELOPMENT ) {
	add_filter( 'ot_show_pages', '__return_false' );
	add_filter( 'ot_show_new_layout', '__return_false' );
}

// Required: set 'ot_theme_mode' filter to true.
add_filter( 'ot_theme_mode', '__return_true' );

// Required: include OptionTree.
load_template( trailingslashit( get_template_directory() ) . 'option-tree/ot-loader.php' );

// Load the options file
if ( ! HAIRPRESS_DEVELOPMENT ) {
	load_template( trailingslashit( get_template_directory() ) . 'inc/theme-options.php' );
}




/**
 * Theme support and thumbnail sizes
 */
if( ! function_exists( 'hairpress_setup' ) ) {

	function hairpress_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Hairpress, use a find and replace
		 * to change 'proteusthemes' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'proteusthemes', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// WooCommerce basic support
		add_theme_support( 'woocommerce' );

		// Custom Backgrounds
		add_theme_support( 'custom-background', array(
			'default-color'          => 'ffffff',
			'default-image'          => ''
		) );


		/**
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		add_image_size( 'services-front', 270, 172, true );
		add_image_size( 'slider', 1500, 530, true );
		add_image_size( 'team-large', 270, 370, true );
		add_image_size( 'team-small', 170, 233, true );


		// Menus
		add_theme_support( 'menus' );
		register_nav_menu( "main-menu", "Main Menu" );

		// featured image size
		set_post_thumbnail_size( 200, 167, true );
	}
	add_action( 'after_setup_theme', 'hairpress_setup' );
}



/**
 * Register styles
 */
if( ! function_exists( 'register_hairpress_styles' ) ) {
	function register_hairpress_styles() {
		// main style
		wp_register_style( 'main-css', get_template_directory_uri() . "/assets/stylesheets/main.css", array( 'bootstrap' ), HAIRPRESS_WP_VERSION );
		// bootstrap css
		wp_register_style( 'bootstrap', get_template_directory_uri() . "/assets/stylesheets/bootstrap.css", false, '2.2.1' );
		// jquery UI theme
		wp_register_style( 'jquery-ui-hairpress', get_template_directory_uri() . "/assets/jquery-ui/css/smoothness/jquery-ui-1.10.2.custom.min.css", false, '1.10.2' );
	}
	add_action( "init", "register_hairpress_styles" );
}

/**
 * Enqueue styles
 */
if( ! function_exists( 'hairpress_styles' ) ) {
	function hairpress_styles() {
		if ( ! is_admin() && ! is_login_page() ) {
			wp_enqueue_style( 'main-css' );
			wp_enqueue_style( 'jquery-ui-hairpress' );
		}
	}
	add_action( "wp_enqueue_scripts", "hairpress_styles" );
}



/**
 * Enqueue scripts
 */
if( ! function_exists( 'hairpress_scripts' ) ) {
	function hairpress_scripts() {
		if ( ! is_admin() && ! is_login_page() ) {
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'jquery-ui-datepicker' );
			wp_enqueue_script( 'jquery-ui-slider' );
			wp_enqueue_script( 'jquery-ui-datetimepicker', get_template_directory_uri() . "/assets/js/jquery-ui-timepicker.js", array( 'jquery-ui-datepicker', 'jquery-ui-slider' ), FALSE, TRUE );
			wp_enqueue_script( 'jquery-ui-touch-fix', get_template_directory_uri() . "/assets/jquery-ui/touch-fix.min.js", array( 'jquery-ui-datetimepicker' ), FALSE, TRUE );
			wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . "/assets/js/bootstrap.min.js", array( 'jquery' ), FALSE, TRUE );
			wp_enqueue_script( 'carousel-js', get_template_directory_uri() . "/assets/js/jquery.carouFredSel-6.1.0-packed.js", array( 'jquery' ), FALSE, TRUE );
			wp_enqueue_script( 'custom-js', get_template_directory_uri() . "/assets/js/custom.js", array(
				'jquery',
				'carousel-js',
				'bootstrap-js',
				'jquery-ui-datepicker'
				), HAIRPRESS_WP_VERSION, TRUE );

			// add gmaps js only if we have a contact us page
			if ( is_page_template( 'contact-page.php' ) || is_page_template( 'contact-page-no-sidebar.php' ) ) {
				wp_enqueue_script( 'hairpress-gmaps', "http://maps.google.com/maps/api/js?sensor=false", array( 'custom-js' ), FALSE, TRUE );
			}

			wp_localize_script( 'custom-js', 'HairpressJS', array(
				'theme_slider_delay'         => intval( (double)ot_get_option( 'theme_slider_delay', 8 ) * 1000 ),
				'datetimepicker_date_format' => ot_get_option( 'js_date_format', 'mm/dd/yy' ),
				'gmapsLocations'             => hairpress_maps_array(),
				'latLng'                     => ot_get_option( 'gm_lat_lng', '0,0' ),
				'mapType'                    => get_theme_mod( 'map_type' ) == false ? 'ROADMAP' : get_theme_mod( 'map_type' ),
				'zoomLevel'                  => get_theme_mod( 'zoom_level' ) == false ? 15 : get_theme_mod( 'zoom_level' ),
				) );
		}
	}
	add_action( "wp_enqueue_scripts", "hairpress_scripts" );
}



/**
 * Load OT variables
 */
if( ! function_exists( 'load_ot_settings' ) ) {
	function load_ot_settings() {
		global $content_divider;
		if ( function_exists( 'ot_get_option' ) ) {
			$content_divider = ot_get_option( 'content_divider', 'scissors' );
		}
	}
	add_action( 'init', 'load_ot_settings' );
}



/**
 * Require the files in the folder /inc/
 */
$files_to_require = array(
	'helpers',
	'post-types',
	'ot-meta-boxes',
	'shortcodes',
	'twitter-bootstrap-nav-walker',
	'theme-widgets',
	'register-sidebars',
	'filters',
	'theme-customizer',
	'custom-comments',
	'woocommerce',
);

// Conditionally require the includes files, based if they exist in the child theme or not
foreach( $files_to_require as $file ) {
	locate_template ( "inc/{$file}.php" , true, true );
}


/**
 * Plugin activation class
 */
require_once( trailingslashit( get_template_directory() ) . 'tgm-plugin-activation/load.php' );



/**
 * Trigger automatic theme updates notifications
 */
if ( ! function_exists( 'hairpress_check_for_updates' ) ) {
	function hairpress_check_for_updates() {
		load_template( trailingslashit( get_template_directory() ) . 'wp-theme-upgrader/envato-wp-theme-updater.php' );
		$username = trim( ot_get_option( 'tf_username', '' ) );
		$api_key  = trim( ot_get_option( 'tf_api_key', '' ) );

		if ( ! empty( $username ) && ! empty( $api_key ) ) {
			Envato_WP_Theme_Updater::init( $username, $api_key, 'ProteusThemes' );
		}
	}
	add_action( 'after_setup_theme', 'hairpress_check_for_updates' );
}
