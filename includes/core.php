<?php
/**
 * Disable direct access.
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Invalid request.' );
}
/**
 * Custom login logo url
 */

function mywplogin_custom_login_image($url){
	$options = get_option('mywplogin_options', mywplogin_options_default());
	$height = (isset($options['custom_height']) && !empty($options['custom_height'])) ? (int)$options['custom_height'] : 84;
	$width = (isset($options['custom_width']) && !empty($options['custom_width'])) ? (int)$options['custom_width'] : 84;
	if(isset($options['custom_image']) && !empty($options['custom_image'])){
		$image_attributes = wp_get_attachment_image_src($options['custom_image'],'full');
		$url = $image_attributes[0];
	}else{
	    $url = plugin_dir_url( dirname(__FILE__)).'public/img/wordpress.svg';
	    $height =84;
	    $width = 84;
    }
		?>
		<style type="text/css">
			#login h1 a, .login h1 a {
				background-image: url(<?php echo $url ; ?>);
                height: <?php echo $height.'px'?>;
                width: auto;
                background-size: <?php echo $width.'px '?><?php echo $height.'px'?>;
			}
		</style>
    <?php
	return $url;
}
add_action( 'login_enqueue_scripts', 'mywplogin_custom_login_image' );

/**
 * Custom login link
 * @param $url
 * @return string
 */
function mywplogin_custom_logo_url($url){
	$options = get_option('mywplogin_options', mywplogin_options_default());

	if(isset($options['custom_url']) && !empty($options['custom_url'])){
		$url = esc_url($options['custom_url']);
	}
	return $url;
}
add_filter('login_headerurl','mywplogin_custom_logo_url');

/**
 * custom login styles
 */
function mywplogin_custom_login_styles(){
	$styles = false;
	$options = get_option('mywplogin_options', mywplogin_options_default());
	if(isset($options['custom_style']) && !empty($options['custom_style'])){
		$styles =(bool)($options['custom_style']);
	}
	if($styles){
		wp_enqueue_script('mywplogin-login-script',plugin_dir_url(dirname(__FILE__)).'public/js/mywplogin-login.js',array('jquery'),'1.1',true);
		wp_enqueue_style('mywplogin-login-style',plugin_dir_url(dirname(__FILE__)).'public/css/mywplogin-login.css',array(),null,'screen');

		if(isset($options['custom_bg_image']) && !empty($options['custom_bg_image'])){
			$image_attributes = wp_get_attachment_image_src($options['custom_bg_image'], 'full');
			$url = $image_attributes[0];
			?>
        <style type="text/css">
            body.login {
                background-image:none;
            }
            .mywplogin-firt-section {
                background: url(<?php echo $url?>) no-repeat center center;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }

        </style>
		<?php
		}
		if(isset($options['custom_bg_color']) && !empty($options['custom_bg_color'])){
			// Validate Background Color
			$color = trim( $options['custom_bg_color'] );
			$color = strip_tags( stripslashes( $color ) );
			?>
            <style type="text/css">
                .mywplogin-second-section {
                    background-color: <?php echo $color?>;
                }
            </style>
			<?php
		}
	}else{
		if(isset($options['custom_bg_image']) && !empty($options['custom_bg_image'])){
			$image_attributes = wp_get_attachment_image_src($options['custom_bg_image'],'full');
			$url = $image_attributes[0];

			?>
            <style type="text/css">
                body.login {
                    background: url(<?php echo $url?>) no-repeat center center;
                    -webkit-background-size: cover;
                    -moz-background-size: cover;
                    -o-background-size: cover;
                    background-size: cover;
                }

            </style>
			<?php
		}
		if(isset($options['custom_bg_color']) && !empty($options['custom_bg_color'])){
			// Validate Background Color
			$color = trim( $options['custom_bg_color'] );
			$color = strip_tags( stripslashes( $color ) );
			?>
            <style type="text/css">
                body.login {
                    background-color: <?php echo $color?>;
                }
            </style>
			<?php
		}
    }
}
add_action('login_enqueue_scripts','mywplogin_custom_login_styles');

/**
 * Background colors and colors
 */

function mywplogin_login_form_bg_color(){

	$options = get_option('mywplogin_options', mywplogin_options_default());
	if(isset($options['custom_form_bg_color']) && !empty($options['custom_form_bg_color'])){
		// Validate Background Color
		$color = trim( $options['custom_form_bg_color'] );
		$color = strip_tags( stripslashes( $color ) );
		?>
        <style type="text/css">
            .login form {
                background-color: <?php echo $color?> !important;
            }
        </style>
		<?php
	}

	if(isset($options['custom_form_field_color']) && !empty($options['custom_form_field_color'])){
		// Validate Background Color
		$color = trim( $options['custom_form_field_color'] );
		$color = strip_tags( stripslashes( $color ) );
		?>
        <style type="text/css">
            .login form .input, .login form input[type=checkbox], .login input[type=text] {
                background-color: <?php echo $color?> !important;
            }
        </style>
		<?php
	}
	if(isset($options['custom_button_bg_color']) && !empty($options['custom_button_bg_color'])){
		// Validate Background Color
		$color = trim( $options['custom_button_bg_color'] );
		$color = strip_tags( stripslashes( $color ) );
		?>
        <style type="text/css">
            .wp-core-ui .button-primary,.wp-core-ui .button-primary {
                background: <?php echo $color?> !important;
                border-color:  <?php echo $color?> !important;
                text-shadow: none !important;
                -webkit-text-shadow: none !important;
                -moz-text-shadow: none !important;
                box-shadow: none !important;
                -webkit-box-shadow: none !important;
                -moz-box-shadow: none !important;
                -webkit-transition: background-color .1s ease-in-out;
                -moz-transition: background-color .1s ease-in-out;
                -o-transition: background-color .1s ease-in-out;
                transition: background-color .1s ease-in-out;
            }
        </style>
		<?php
	}
	if(isset($options['custom_button_bg_color_hover']) && !empty($options['custom_button_bg_color_hover'])){
		// Validate Background Color On Hover
		$color = trim( $options['custom_button_bg_color_hover'] );
		$color = strip_tags( stripslashes( $color ) );
		?>
        <style type="text/css">
            .wp-core-ui .button-primary:hover,.wp-core-ui .button-primary:hover {
                background: <?php echo $color?> !important;
                border-color:  <?php echo $color?> !important;
                text-shadow: none !important;
                -webkit-text-shadow: none !important;
                -moz-text-shadow: none !important;
                box-shadow: none !important;
                -webkit-box-shadow: none !important;
                -moz-box-shadow: none !important;
                -webkit-transition: background-color .1s ease-out;
                -moz-transition: background-color .1s ease-out;
                -o-transition: background-color .1s ease-out;
                transition: background-color .1s ease-out;
            }
        </style>
		<?php
	}
	if(isset($options['custom_button_text_color']) && !empty($options['custom_button_text_color'])){
		// Validate Text Color
		$color = trim( $options['custom_button_text_color'] );
		$color = strip_tags( stripslashes( $color ) );
		?>
        <style type="text/css">
            .wp-core-ui .button-primary,.wp-core-ui .button-primary {
                color:  <?php echo $color?> !important;
                -webkit-transition: color .1s ease-out;
                -moz-transition: color .1s ease-out;
                -o-transition: color .1s ease-out;
                transition: color .1s ease-out;
            }
        </style>
		<?php
	}
	if(isset($options['custom_button_text_color_hover']) && !empty($options['custom_button_text_color_hover'])){
		// Validate Text Color On Hover
		$color = trim( $options['custom_button_text_color_hover'] );
		$color = strip_tags( stripslashes( $color ) );
		?>
        <style type="text/css">
            .wp-core-ui .button-primary:hover,.wp-core-ui .button-primary:hover {
                color:  <?php echo $color?> !important;
                -webkit-transition: color .1s ease-out;
                -moz-transition: color .1s ease-out;
                -o-transition: color .1s ease-out;
                transition: color .1s ease-out;
            }
        </style>
		<?php
	}
	if(isset($options['custom_form_labels_color']) && !empty($options['custom_form_labels_color'])){
		// Validate Labels Color
		$color = trim( $options['custom_form_labels_color'] );
		$color = strip_tags( stripslashes( $color ) );
		?>
        <style type="text/css">
            .login label {
                color:  <?php echo $color?> !important;
            }
        </style>
		<?php
	}

	if(isset($options['custom_css_styles']) && !empty($options['custom_css_styles'])){
		?>
        <style type="text/css">
            <?php echo $options['custom_css_styles'] ?>
        </style>
		<?php
	}

}
add_action('login_enqueue_scripts','mywplogin_login_form_bg_color');

/**
 * Custom login logo title
 * @param $title
 *
 * @return string|void
 */
function mywplogin_custom_logo_title($title){
	$options = get_option('mywplogin_options', mywplogin_options_default());

	if(isset($options['custom_title']) && !empty($options['custom_title'])){
		$title = esc_attr($options['custom_title']);
	}
	return $title;
}
add_filter('login_headertitle','mywplogin_custom_logo_title');

/**
 * Custom login message
 * @param $message
 *
 * @return string
 */

function mywplogin_custom_login_message($message){

	$options = get_option('mywplogin_options', mywplogin_options_default());

	if(isset($options['custom_message']) && !empty($options['custom_message'])){
		$message = wp_kses_post($options['custom_message']) . $message;
	}
	return $message;
}
add_filter('login_message','mywplogin_custom_login_message');



