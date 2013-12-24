<?php
/* 
    Plugin Name: WP Live Preview Links
    Plugin URI: http://soderlind.no/
    Description: lorem ipsum dolores est
    Author: Per Soderlind
    Author URI: http://soderlind.no
*/

include_once(dirname( __FILE__ ) ."/admin/settings.php");

if ( is_admin() ) {
	add_action('plugins_loaded', 'wp_live_preview_links_init');
	new WP_Live_Preview_Links_Settings ();
} 	

function wp_live_preview_links_init() {
	load_plugin_textdomain( 'wp-live-preview-links', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );; 
}


function wp_live_preview_links_styles()
{
	// Register the style like this for a plugin:
	wp_register_style( 'live-preview', plugins_url( '/lib/css/livepreview-demo.css', __FILE__ ), array(), '1.0', 'all' );
	wp_enqueue_style( 'live-preview' );
}
add_action( 'wp_enqueue_scripts', 'wp_live_preview_links_styles' );

function wp_live_preview_links_scripts()
{
	wp_register_script( 'jquery-live-preview', plugins_url( '/lib/js/jquery-live-preview.js', __FILE__ ),array( 'jquery'),'1.1' );
	wp_register_script( 'wp-live-preview-links-js', plugins_url( '/lib/js/jquery-wp-live-preview-links.js', __FILE__ ),array( 'jquery','jquery-live-preview' ),'1.1' );	
	wp_enqueue_script( 'jquery-live-preview' );
	wp_enqueue_script( 'wp-live-preview-links-js' );	

}
add_action( 'wp_enqueue_scripts', 'wp_live_preview_links_scripts', 5 );



