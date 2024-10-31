<?php
//disable direct access
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Invalid request.' );
}
//register settings
function mywplogin_register_settings(){

	register_setting(
		'mywplogin_options',
		'mywplogin_options',
		'mywplogin_callback_validate_options'
	);

	add_settings_section(
		'mywplogin_section_login',
		'Customize Wordpress Login Page',
		'mywplogin_callback_section_login',
		'mywplogin'
	);

	add_settings_field(
		'custom_image',
		'Logo',
		'mywplogin_callback_field_upload',
		'mywplogin',
		'mywplogin_section_login',
		['id'=>'custom_image','label'=>esc_html__('Upload your login logo','mywplogin')]

	);

	add_settings_field(
		'custom_width',
		'Logo Width (px)',
		'mywplogin_callback_field_number',
		'mywplogin',
		'mywplogin_section_login',
		['id'=>'custom_width']

	);

	add_settings_field(
		'custom_height',
		'Logo Height (px)',
		'mywplogin_callback_field_number',
		'mywplogin',
		'mywplogin_section_login',
		['id'=>'custom_height']

	);

	add_settings_field(
		'custom_url',
		'Logo Url',
		'mywplogin_callback_field_text',
		'mywplogin',
		'mywplogin_section_login',
		['id'=>'custom_url','label'=>esc_html__('Custom url for the logo link','mywplogin')]

	);

	add_settings_field(
		'custom_title',
		'Logo Title Attribute',
		'mywplogin_callback_field_text',
		'mywplogin',
		'mywplogin_section_login',
		['id'=>'custom_title','label'=>esc_html__('Custom title for the logo link title attribute','mywplogin')]

	);

	add_settings_field(
		'custom_bg_image',
		'Login Background Image',
		'mywplogin_callback_field_upload',
		'mywplogin',
		'mywplogin_section_login',
		['id'=>'custom_bg_image','label'=>esc_html__('Upload a login background image','mywplogin')]

	);

	add_settings_field(
		'custom_bg_color',
		'Background Color',
		'mywplogin_callback_field_bg_color',
		'mywplogin',
		'mywplogin_section_login',
		['id'=>'custom_bg_color']

	);

	add_settings_field(
		'custom_form_bg_color',
		'Form Background Color',
		'mywplogin_callback_field_bg_color',
		'mywplogin',
		'mywplogin_section_login',
		['id'=>'custom_form_bg_color']

	);

	add_settings_field(
		'custom_form_field_color',
		'Form Fields Color',
		'mywplogin_callback_field_bg_color',
		'mywplogin',
		'mywplogin_section_login',
		['id'=>'custom_form_field_color']

	);

	add_settings_field(
		'custom_form_labels_color',
		'Form Labels Color',
		'mywplogin_callback_field_bg_color',
		'mywplogin',
		'mywplogin_section_login',
		['id'=>'custom_form_labels_color']

	);

	add_settings_field(
		'custom_button_bg_color',
		'Button Background Color',
		'mywplogin_callback_field_bg_color',
		'mywplogin',
		'mywplogin_section_login',
		['id'=>'custom_button_bg_color']

	);

	add_settings_field(
			'custom_button_bg_color_hover',
			'Button Background Color (hover)',
			'mywplogin_callback_field_bg_color',
			'mywplogin',
			'mywplogin_section_login',
			['id'=>'custom_button_bg_color_hover']

		);

	add_settings_field(
		'custom_button_text_color',
		'Button Text Color',
		'mywplogin_callback_field_bg_color',
		'mywplogin',
		'mywplogin_section_login',
		['id'=>'custom_button_text_color']

	);

	add_settings_field(
		'custom_button_text_color_hover',
		'Button Text Color (hover)',
		'mywplogin_callback_field_bg_color',
		'mywplogin',
		'mywplogin_section_login',
		['id'=>'custom_button_text_color_hover']

	);
	add_settings_field(
		'custom_style',
		'Custom Style',
		'mywplogin_callback_field_checkbox',
		'mywplogin',
		'mywplogin_section_login',
		['id'=>'custom_style','label'=>esc_html__('Split login page in two vertical views','mywplogin')]

	);

	add_settings_field(
		'custom_message',
		'Custom Message',
		'mywplogin_callback_field_textarea',
		'mywplogin',
		'mywplogin_section_login',
		['id'=>'custom_message','label'=>esc_html__('The text will appear below the logo','mywplogin')]

	);
	add_settings_field(
		'custom_css_styles',
		'Custom CSS',
		'mywplogin_callback_field_textarea',
		'mywplogin',
		'mywplogin_section_login',
		['id'=>'custom_css_styles','label'=>esc_html__('Add your own css','mywplogin')]

	);
}
add_action('admin_init','mywplogin_register_settings');

