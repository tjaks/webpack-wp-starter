<?php
/**
 * Theme Functions &
 * Functionality
 *
 */


/* =========================================
		ACTION HOOKS & FILTERS
   ========================================= */

/**--- Actions ---**/

add_action( 'after_setup_theme',  'theme_setup' );

add_action( 'wp_enqueue_scripts', 'theme_styles' );

add_action( 'wp_enqueue_scripts', 'theme_scripts' );

// expose php variables to js. just uncomment line
// below and see function theme_scripts_localize
// add_action( 'wp_enqueue_scripts', 'theme_scripts_localize', 20 );

/**--- Filters ---**/



/* =========================================
		HOOKED Functions
   ========================================= */

/**--- Actions ---**/


/**
 * Setup the theme
 *
 * @since 1.0
 */
if ( ! function_exists( 'theme_setup' ) ) {
	function theme_setup() {

		// Let wp know we want to use html5 for content
		add_theme_support( 'html5', array(
			'comment-list',
			'comment-form',
			'search-form',
			'gallery',
			'caption'
		) );


		// Let wp know we want to use post thumbnails
		/*
		add_theme_support( 'post-thumbnails' );
		*/
		
		// Add Custom Logo Support.
		/*
		add_theme_support( 'custom-logo', array(
			'width'       => 181, // Example Width Size
			'height'      => 42,  // Example Height Size
			'flex-width'  => true,
		) );
		*/

		// Register navigation menus for theme
		/*
		register_nav_menus( array(
			'primary' => 'Main Menu',
			'footer'  => 'Footer Menu'
		) );
		*/


		// Let wp know we are going to handle styling galleries
		/*
		add_filter( 'use_default_gallery_style', '__return_false' );
		*/


		// Stop WP from printing emoji service on the front
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );


		// Remove toolbar for all users in front end
		show_admin_bar( false );


		// Add Custom Image Sizes
		/*
		add_image_size( 'ExampleImageSize', 1200, 450, true ); // Example Image Size
		...
		*/


		// Contact Form 7 Configuration needs to be done
		// in wp-config.php. add the following snippet
		// under the line:
		// define( 'WP_DEBUG', false );
		/*
		//Contact Form 7 Plugin Configuration
		define ( 'WPCF7_LOAD_JS',  false ); // Added to disable JS loading
		define ( 'WPCF7_LOAD_CSS', false ); // Added to disable CSS loading
		define ( 'WPCF7_AUTOP',    false ); // Added to disable adding <p> & <br> in form output
		*/


		// Register Autoloaders Loader
		$theme_dir = get_template_directory();
		include "$theme_dir/includes/includes-loader.php";
	}
}


/**
 * Register and/or Enqueue
 * Styles for the theme
 *
 * @since 1.0
 */
if ( ! function_exists( 'theme_styles' ) ) {
	function theme_styles() {
		$theme_dir = get_stylesheet_directory_uri();

		wp_enqueue_style( 'main', get_stylesheet_directory_uri() . '/dist/main.css', array(), null, 'all' );
	}
}


/**
 * Register and/or Enqueue
 * Scripts for the theme
 *
 * @since 1.0
 */
if ( ! function_exists( 'theme_scripts' ) ) {
	function theme_scripts() {
		$theme_dir = get_stylesheet_directory_uri();
		wp_enqueue_script( 'bundle', get_stylesheet_directory_uri() . '/dist/bundle.js', array(), 1, false );
	}
}


/**
 * Attach variables we want
 * to expose to our JS
 *
 * @since 3.12.0
 */
if ( ! function_exists( 'theme_scripts_localize' ) ) {
	function theme_scripts_localize() {
		$ajax_url_params = array();

		wp_localize_script( 'main', 'urls', array(
			'home'  => home_url(),
			'theme' => get_stylesheet_directory_uri(),
			'ajax'  => add_query_arg( $ajax_url_params, admin_url( 'admin-ajax.php' ) )
		) );
	}
}
