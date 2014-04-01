<?php 
/*
    Plugin Name: Watermark
    Plugin URI: http://www.alticreation.com/en/alti-watermark/
    Description: Add a watermark on all your pictures even the one which are already uploaded. You can setup this plugin through the Media category in the side menu.
    Author: Alexis Blondin
    Version: 0.1
    Author URI: http://www.alticreation.com
*/

require_once('paths.php');

// Admin Page
add_action( 'admin_menu', 'altiwatermark_page' );

function altiwatermark_page(){
  global $acw_plugins;
  add_submenu_page( 'upload.php', 'Watermark', 'Watermark', 'manage_options', $acw_plugins['subdir'].'/admin-page.php' );
}

// Deactivation plugin
register_deactivation_hook( __FILE__, 'altiwatermark_deactivate' );

function altiwatermark_deactivate() {

  global $acw_uploads;
  if( file_exists($acw_uploads['basedir'].'/'.'.htaccess') ) {
    
    unlink( $acw_uploads['basedir'].'/'.'.htaccess' );
    
  }
  
}