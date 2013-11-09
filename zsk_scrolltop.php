<?php
/*
Plugin Name: zsk Scroll to Top
Description: Simple scroll to top plugin
Author: Javier Monrove
Version: 1.0
*/

define('ZSK_TOP_PLUGIN_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
/* enqeue Plugin's javascript functions */
wp_enqueue_script('zsk-scrolltop-active', ZSK_TOP_PLUGIN_PATH.'includes/zsk_scrolltop.js', array( 'jquery' ), '',  true );
/* enqeue Plugin's CSS */
wp_enqueue_style('zsk-scrolltop-style', ZSK_TOP_PLUGIN_PATH.'includes/zsk_scrolltop.css');


require  ZSK_TOP_PLUGIN_PATH.'includes/adminpage.class.php';



function zsk_scrolltop_footer(){	
	$options=get_option('zsk_scrolltop');
	$background_image=$options["zsk_scrolltop_image"];
	if ($background_image==""){
		$background_image=ZSK_TOP_PLUGIN_PATH.'images/arrow_up.png';
		}
	echo  "<div  id=\"zskscrolltop\" style=\"background-image:url('".$background_image."')\" title=\"Top\"></div>";
}
// run function in footer
add_action('wp_footer','zsk_scrolltop_footer');

if( is_admin() )
    $zsk_settings_page = new zskSettingsPage();

?>
