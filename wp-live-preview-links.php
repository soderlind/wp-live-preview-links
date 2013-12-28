<?php
/*
Plugin Name: WP Live Preview Links
Plugin URI: http://soderlind.no/
Description: WP Live Preview Links allows you to see a live scaled preview of the site you are linking to in a pop-up dialog style window prior to clicking on it.
Version: 1.0.1
Author: Per Soderlind
Author URI: http://soderlind.no
*/




defined( 'WPINC' ) or die;

if ( is_admin() ) {
	include_once dirname( __FILE__ ) ."/admin/settings.php";
	add_action( 'plugins_loaded', 'wp_live_preview_links_init' );
	new WP_Live_Preview_Links_Settings ();
}


function wp_live_preview_links_init() {
	load_plugin_textdomain( 'wp-live-preview-links', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );;
}


function wp_live_preview_links_styles() {
	// Register the style like this for a plugin:
	wp_register_style( 'live-preview', plugins_url( '/lib/css/livepreview-demo.css', __FILE__ ), array(), '1.0', 'all' );
	wp_register_style( 'wp-live-preview', plugins_url( '/lib/css/wp-live-preview.css', __FILE__ ), array('live-preview'), '0.8', 'all' );

	wp_enqueue_style( 'live-preview' );
	wp_enqueue_style( 'wp-live-preview' );

}
add_action( 'wp_enqueue_scripts', 'wp_live_preview_links_styles' );

function wp_live_preview_links_scripts() {
	wp_register_script( 'jquery-live-preview', plugins_url( '/lib/js/jquery-live-preview.min.js', __FILE__ ), array( 'jquery' ), '0.8',true );
	wp_register_script( 'wp-live-preview-links', plugins_url( '/lib/js/jquery-wp-live-preview-links.js', __FILE__ ), array( 'jquery', 'jquery-live-preview' ), '0.8',true );
	wp_enqueue_script( 'jquery-live-preview' );
	wp_enqueue_script( 'wp-live-preview-links' );

	$arr_options = get_option( 'WP_Live_Preview_Links_Settings' );

	wp_localize_script( 'wp-live-preview-links', 'wp_live_preview_links_vars', array(
			'link' => ( isset( $arr_options['wp_live_preview_links_options']['options']['link'] ) ) 	
						? $arr_options['wp_live_preview_links_options']['options']['link'] 
						: 'class',
			'viewWidth' => ( isset( $arr_options['wp_live_preview_links_options']['options']['dialog']['width']['size'] ) ) 	
						? $arr_options['wp_live_preview_links_options']['options']['dialog']['width']['size'] 
						: '300',
			'viewHeight' => ( isset( $arr_options['wp_live_preview_links_options']['options']['dialog']['height']['size'] ) ) 
						? $arr_options['wp_live_preview_links_options']['options']['dialog']['height']['size'] 
						: '200',
			'targetWidth' => ( isset( $arr_options['wp_live_preview_links_options']['options']['target']['width']['size'] ) ) 
						? $arr_options['wp_live_preview_links_options']['options']['target']['width']['size'] 
						: '1000',
			'targetHeight' => ( isset( $arr_options['wp_live_preview_links_options']['options']['target']['height']['size'] ) ) 
						? $arr_options['wp_live_preview_links_options']['options']['target']['height']['size'] 
						: '800',
			'scale' => ( isset( $arr_options['wp_live_preview_links_options']['options']['scale'] ) ) 
						? $arr_options['wp_live_preview_links_options']['options']['scale'] 
						: '0',
			'positionOffset' => ( isset( $arr_options['wp_live_preview_links_options']['options']['offset']['size'] ) ) 
						? $arr_options['wp_live_preview_links_options']['options']['offset']['size'] 
						: '50',
			'position' => ( isset( $arr_options['wp_live_preview_links_options']['options']['position'] ) ) 
						? $arr_options['wp_live_preview_links_options']['options']['position'] 
						: 'auto'
		)
	);

}
add_action( 'wp_enqueue_scripts', 'wp_live_preview_links_scripts', 5 );
