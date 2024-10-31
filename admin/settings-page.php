<?php
/**
 * Disable direct access
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Invalid request.' );
}

/**
 * Display the plugin settings page
 */
function mywplogin_display_settings_page() {
//check if user is allowed access
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	?>

	<div class="wrap">
        <h1 class="mywplogin-title"><?php echo esc_html( get_admin_page_title() ); ?></h1>
    <div class="mywplogin-wrap">
            <form action="options.php" method="post">
                <div class="mywplogin-form-elements">
                    <?php
                    //output security fields
                    settings_fields( 'mywplogin_options' );

                    do_settings_sections( 'mywplogin' );
                    submit_button();
                    ?>
                </div>
            </form>
        </div>
	</div>
	<?php
}

/**
 * Display default admin notice
 */
function mywplogin_add_settings_errors() {
	settings_errors();
}
add_action('admin_notices', 'mywplogin_add_settings_errors');

