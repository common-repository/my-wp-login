<?php
//disable direct access
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Invalid request.' );
}

function mywplogin_add_toplevel_menu(){
	add_menu_page(
		'My WP Login',
		'MyWPLogin',
		'manage_options',
		'mywplogin',
		'mywplogin_display_settings_page',
		'dashicons-share-alt',
		null
	);
}
add_action('admin_menu','mywplogin_add_toplevel_menu');