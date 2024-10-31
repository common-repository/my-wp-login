<?php
/*
Plugin Name: My WP Login
Description: Customize your Wordpress Login Page. Upload new logo, change easily background color, and much more!
Plugin URI: https://wordpress.org/plugins/my-wp-login/
Author: Ergest IMAJ
Author URI: https://profiles.wordpress.org/ergest/
Version: 1.0
Text Domain: mywplogin
Domain Path: /languages
License: GPLv2 or later
 */

/**
 * Exit if file is called directly
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Invalid request.' );
}
/**
 * Load text domain.
 */
function mywplogin_load_textdomain(){
    load_plugin_textdomain('mywplogin',false,plugin_dir_path(__FILE__).'languages/');
}
add_action('plugins_loaded','mywplogin_load_textdomain');

/**
 * Admin area.
 */
if(is_admin()){
    require_once plugin_dir_path(__FILE__).'admin/admin-menu.php';
    require_once plugin_dir_path(__FILE__).'admin/settings-page.php';
    require_once plugin_dir_path(__FILE__) .'admin/register-settings.php';
    require_once plugin_dir_path(__FILE__) .'admin/settings-callbacks.php';
    require_once plugin_dir_path(__FILE__) .'admin/settings-validate.php';
}
/**
 * Include dependencies: admin and public.
 */
require_once plugin_dir_path(__FILE__) .'includes/core.php';

/**
 * Default options.
 */
function mywplogin_options_default(){
    return array(
	    'custom_image'   => '',
	    'custom_width'   => 84,
	    'custom_height'  => 84,
	    'custom_url'     => get_site_url(),
	    'custom_title'   => esc_html__('Powered by MyWPLogin','mywplogin'),
	    'custom_bg_image'=> '',
	    'custom_bg_color'=> '#f1f1f1',
	    'custom_form_bg_color'=> '#ffffff',
	    'custom_form_field_color'=> '#ffffff',
	    'custom_form_labels_color'=> '#72777c',
	    'custom_button_bg_color'=> '#008ec2',
	    'custom_button_bg_color_hover'=> '#008ec2',
	    'custom_button_text_color'=> '#ffffff',
	    'custom_button_text_color_hover'=> '#ffffff',
	    'custom_style'   => false,
	    'custom_message' => '<p class="custom_message">'.esc_html__('Insert your login credentials and press login','mywplogin') . '</p>',
	    'custom_css_styles'=>'.custom_message{ text-align:center; }'
    );
}

/**
 * Remove plugin options on uninstall.
 */
function mywplogin_on_uninstall(){
	if(! current_user_can('activate_plugins')) return;
	delete_option('mywplogin_options');
}
register_uninstall_hook(__FILE__,'mywplogin_on_uninstall');