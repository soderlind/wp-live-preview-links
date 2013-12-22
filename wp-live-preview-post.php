<?php
/* 
    Plugin Name: WP Live Preview Post
    Plugin URI: http://soderlind.no/
    Description: lorem ipsum dolores est
    Author: Per Soderlind
    Author URI: http://soderlind.no
*/

 include_once(dirname( __FILE__ ) ."/admin/settings.php");

if ( is_admin() ) {

	add_action('plugins_loaded', 'wp_live_preview_post_init');
 	new WP_Live_Preview_Post_Settings ();
} 	

function wp_live_preview_post_init() {
  load_plugin_textdomain( 'wp-live-preview-post', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );; 
}
