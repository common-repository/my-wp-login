<?php
/**
 * Disable direct access
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Invalid request.' );
}

function mywplogin_callback_section_login(){}

/**
 * File uploads
 * @param $args
 */
function mywplogin_callback_field_upload($args){

	// Set variables
	$id = isset($args['id']) ? $args['id'] : '';
	$label = isset($args['label']) ? $args['label'] : '';
	$options = get_option('mywplogin_options', mywplogin_options_default());
	$default_image = plugin_dir_url(dirname(__FILE__)).'public/img/no-image-placeholder-big.jpg' ;

	if (!empty($options[$id])) {
		$image_attributes = wp_get_attachment_image_src( $options[$id], 'full');
		$src = $image_attributes[0];
		$value = $options[$id];
	} else {
		$src = $default_image;
		$value = '';
	}

	// Print HTML field
	echo '<div class="upload" style="max-width:220px;">'
           .'<img data-src="' . $default_image . '" src="' . $src . '" style="max-width:100%; height:auto;" />'
           .'<div>'
                .'<input type="hidden" name="mywplogin_options['.$id.']" id="mywplogin_options_'.$id.'" value="' . $value . '" />'
               .'<button type="submit" class="upload_image_button button">' . __('Upload', 'mywplogin') . '</button>'
               .'<button type="submit" class="remove_image_button button">&times;</button>'
           .'</div>'
       .'</div>';
}

/**
 * Input fields type number
 * @param $args
 */
function mywplogin_callback_field_number($args){

	$options = get_option('mywplogin_options', mywplogin_options_default());
	$id = isset($args['id']) ? $args['id'] : '';
	$label = isset($args['label']) ? $args['label'] : '';

	$value = isset($options[$id]) ? (int)($options[$id]) : '';
	echo '<label for="mywplogin_options_'.$id.'">'.$label.'</label>';
	echo '<input type="number" id="mywplogin_options_'.$id.'" name="mywplogin_options['.$id.']"
	        value="'.$value.'" ><br/>';


}

/**
 * Input fields type text
 * @param $args
 */
function mywplogin_callback_field_text($args){
	$options = get_option('mywplogin_options', mywplogin_options_default());

	$id = isset($args['id']) ? $args['id'] : '';
	$label = isset($args['label']) ? $args['label'] : '';

	$value = isset($options[$id]) ? sanitize_text_field($options[$id]) : '';

	echo '<input type="text" id="mywplogin_options_'.$id.'" name="mywplogin_options['.$id.']"
	       size="40" value="'.$value.'" ><br/>';
	echo '<label for="mywplogin_options_'.$id.'">'.$label.'</label>';

}
/**
 * Input fields for colors and bg colors
 * @param $args
 */
function mywplogin_callback_field_bg_color($args){
	$options = get_option('mywplogin_options', mywplogin_options_default());
	$id = isset($args['id']) ? $args['id'] : '';

	$val = (isset($options[$id]))? trim($options[$id]) : '';

	echo '<input type="text" name="mywplogin_options['.$id.']" value="' . $val . '" class="cpa-color-picker" >';

}
/**
 * Input fields type textarea
 * @param $args
 */
function mywplogin_callback_field_textarea($args){
	$options = get_option('mywplogin_options', mywplogin_options_default());

	$id = isset($args['id']) ? $args['id'] : '';
	$label = isset($args['label']) ? $args['label'] : '';

	$allowed_tags = wp_kses_allowed_html('post');
	$value = isset($options[$id]) ? wp_kses(stripslashes_deep($options[$id]),$allowed_tags) : '';

	echo '<textarea rows="8" cols="60" id="mywplogin_options_'.$id.'" name="mywplogin_options['.$id.']">'.$value.'</textarea></br>';
	echo '<label for="mywplogin_options_'.$id.'">'.$label.'</label>';
}
/**
 * Input fields type checkbox
 * @param $args
 */
function mywplogin_callback_field_checkbox($args){
	$options = get_option('mywplogin_options', mywplogin_options_default());

	$id = isset($args['id']) ? $args['id'] : '';
	$label = isset($args['label']) ? $args['label'] : '';

	$checked = isset($options[$id]) ? checked($options[$id],1,false) : '';

	echo '<input type="checkbox" id="mywplogin_options_'.$id.'" name="mywplogin_options['.$id.']" size="40" value="1" '.$checked.' >';
	echo '<label for="mywplogin_options_'.$id.'">'.$label.'</label>';
}

/**
 * Load scripts and style sheet for settings page
 */
function mywplogin_load_scripts_admin() {

	wp_enqueue_script('mywplogin',plugin_dir_url(dirname(__FILE__)).'admin/js/upload.js',array('jquery'),'1.1',true);
	// WordPress library
	wp_enqueue_media();
	// Css rules for Color Picker
	wp_enqueue_style( 'wp-color-picker' );
	//styles for MyWPLogin Dashboard
	wp_enqueue_style('mywplogin-dashborad',plugin_dir_url(dirname(__FILE__)).'admin/css/main.css',array(),null,'screen');
	// add the wp-color-picker dependecy to js file
	wp_enqueue_script( 'mywplogin-custom-color-picker', plugin_dir_url(dirname(__FILE__)).'admin/js/color-picker.js', array( 'jquery', 'wp-color-picker' ), '1.1', true  );
}
add_action( 'admin_enqueue_scripts', 'mywplogin_load_scripts_admin' );