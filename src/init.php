<?php
/**
 * Blocks Initializer
 *
 * Enqueue CSS/JS of all the blocks.
 *
 * @since   1.0.0
 * @package CGB
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
function demo_cgb_block_assets() { // phpcs:ignore
	// Register block styles for both frontend + backend.
	wp_register_style('demo-cgb-style-css', plugins_url( 'dist/blocks.style.build.css', dirname( __FILE__ ) ), 	is_admin() ? array( 'wp-editor' ) : null, 	BTS_VER );

	// Register block editor script for backend.
	wp_register_script(	'demo-cgb-block-js', plugins_url( '/dist/blocks.build.js', dirname( __FILE__ ) ), array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'jquery' ),BTS_VER, true );

	// Register block editor styles for backend.
	wp_register_style('demo-cgb-block-editor-css', 	plugins_url( 'dist/blocks.editor.build.css', dirname( __FILE__ ) ), array( 'wp-edit-blocks' ), 	BTS_VER);

	// WP Localized globals. Use dynamic PHP stuff in JavaScript via `cgbGlobal` object.
	wp_localize_script(
		'demo-cgb-block-js',
		'cgbGlobal', // Array containing dynamic data for a JS Global.
		[
			'pluginDirPath' => plugin_dir_path( __DIR__ ),
			'pluginDirUrl'  => plugin_dir_url( __DIR__ ),
			// Add more data here that you want to access from `cgbGlobal` object.
		]
	);

	 /**
	  * This script/style for my testimonial sldier
	  */
	  wp_register_style('bts-style' ,plugin_dir_url(__FILE__) . '../assets/css/style.css', array('wp-edit-blocks'), filemtime(plugin_dir_path(__FILE__) . 'assets/css/editor.style.css'));

	  
	  wp_register_style('bplugins-owl-carousel' ,plugin_dir_url(__FILE__) . '../assets/css/carousel.min.css', array('wp-edit-blocks'), filemtime(plugin_dir_path(__FILE__) . '../assets/css/carousel.min.css'));

	  wp_register_script('bplugins-editor-owl-carousel' ,plugin_dir_url(__FILE__) . '../assets/js/carousel.min.js', null, filemtime(plugin_dir_path(__FILE__) . '../assets/js/carousel.min.js'));

	//   wp_register_script('bts-editor-js' ,plugin_dir_url(__FILE__) . 'assets/js/script.js', array('bts-carousel-js','wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor','wp-auth-check'), filemtime(plugin_dir_path(__FILE__) . 'assets/js/script.js'));

	
	wp_register_style('bts-template-style', plugin_dir_url(__FILE__).'./assets/css/template.style.css', array(), BTS_VER);
	
    wp_register_script('bts-block-script' ,plugin_dir_url(__FILE__) . 'assets/js/script.js', array('bplugins-owl-carousel', 'bplugins-editor-owl-carousel', 'jquery'), filemtime(plugin_dir_path(__FILE__) . 'assets/js/script.js'));

    register_block_type(
		'bplugins/b-testimonial', array(
			// Enqueue blocks.style.build.css on both frontend & backend.
			'style'         => array('demo-cgb-style-css','bplugins-owl-carousel', 'bts-template-style', 'bts-style'),
			'script'        => array( 'bts-block-script'),
			// Enqueue blocks.build.js in the editor only.
			'editor_script' => array( 'demo-cgb-block-js', 'bplugins-editor-owl-carousel'),
			// Enqueue blocks.editor.build.css in the editor only.
			'editor_style'  => array('bts-editor-style'),
		)
	);

	
}


// Hook: Block assets.
add_action( 'init', 'demo_cgb_block_assets' );