<?php
/**
 * Disable direct access
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Invalid request.' );
}
/**
 * Validate plugin settings
 * @param $input
 *
 * @return mixed
 */
function mywplogin_callback_validate_options($input){
	//custom url
	$input['custom_url'] = (isset($input['custom_url'])) ? esc_url($input['custom_url']) : '';
	// Validate Background Color
	$colors = [
		$input['custom_bg_color'],
		$input['custom_form_bg_color'],
		$input['custom_form_field_color'],
		$input['custom_form_labels_color'],
		$input['custom_button_bg_color'],
		$input['custom_button_bg_color_hover'],
		$input['custom_button_text_color'],
		$input['custom_button_text_color_hover'],

	];
	foreach ( $colors as $color ) {
		$background = trim( $color );
		$background = strip_tags( stripslashes( $background ) );
		// Check if is a valid hex color
		if( FALSE === check_color( $background ) ) {
			// Set the error message
			add_settings_error( 'mywplogin_options', 'custom_bg_color', 'Insert a valid color', 'error' );
			// Get the previous valid value
			$color = '';
		} else {
			$color = $background;
		}
	}
	//custom title
	$input['custom_title'] = isset($input['custom_title']) ? sanitize_text_field($input['custom_title']) : '' ;

	//custom styles
	if(! isset($input['custom_style'])){
		$input['custom_style']= null;
	}
	$input['custom_style']= ($input['custom_style'] == 1 ? 1 : 0);

	//validate height and width
	$options['custom_height'] = (isset($options['custom_height']) && !empty($options['custom_height'])) ? (int)$options['custom_height'] : '';//validate height
	$options['custom_width'] = (isset($options['custom_width']) && !empty($options['custom_width'])) ? (int)$options['custom_width'] : '';
	//custom message
	$input['custom_message'] = (isset($input['custom_message'])) ? wp_kses_post($input['custom_message']) : '';

	return $input;
}

/**
 * Function that will check if value is a valid HEX color.
 * @param $value
 *
 * @return bool
 */
 function check_color( $value ) {
 	if($value === ''){
 		return true;
    }
	elseif ( preg_match( '/^#[a-f0-9]{6}$/i', $value ) ) { // if user insert a HEX color with #
		return true;
	}

	return false;
}