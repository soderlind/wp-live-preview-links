<?php
/* 
    Plugin Name: WP Live Preview Post
    Plugin URI: http://soderlind.no/
    Description: lorem ipsum dolores est
    Author: Per Soderlind
    Author URI: http://soderlind.no
*/

 include_once(dirname( __FILE__ ) ."/admin/settings.php");

 if ( is_admin() )
 	new WP_Live_Preview_Post_Settings ();