<?php 
/*
Plugin Name: Watermark
Plugin URI: http://www.alticreation.com/en/alti-watermark/
Description: Add a watermark on all your pictures even the one which are already uploaded. You can setup this plugin through the Media category in the side menu.
Author: Alexis Blondin
Version: 0.2.7
Author URI: http://www.alticreation.com
*/

// Translation
function altiwatermark_i18n()
{
load_plugin_textdomain('altiwatermark', false, basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action('plugins_loaded', 'altiwatermark_i18n');

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
    preg_match('/^(.+)\# BEGIN alti\-watermark/s', file_get_contents( $acw_uploads['basedir'].'/'.'.htaccess' ), $htaccessContentPreviousContent);
    if($htaccessContentPreviousContent[1] != '')  {
      file_put_contents( $acw_uploads['basedir'].'/'.'.htaccess', $htaccessContentPreviousContent[1] );
    } else {
      unlink( $acw_uploads['basedir'].'/'.'.htaccess' );
    }


  }

}

// Setting link
function altiwatermark_settings_link($links) { 
  global $acw_plugins;
  $settings_link = '<a href="'.get_admin_url().'upload.php?page='.$acw_plugins['subdir'].'/admin-page.php">'.__("Settings").'</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}

$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'altiwatermark_settings_link' );