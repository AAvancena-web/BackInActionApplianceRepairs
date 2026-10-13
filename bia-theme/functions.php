<?php
/**
 * Back In Action Appliance Repairs theme bootstrap.
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;

define( 'BIA_VERSION', '1.0.0' );
define( 'BIA_DIR', get_template_directory() );
define( 'BIA_URI', get_template_directory_uri() );

require BIA_DIR . '/inc/data.php';
require BIA_DIR . '/inc/helpers.php';
require BIA_DIR . '/inc/icons.php';
require BIA_DIR . '/inc/illustrations.php';
require BIA_DIR . '/inc/setup.php';
require BIA_DIR . '/inc/customizer.php';
require BIA_DIR . '/inc/forms.php';
require BIA_DIR . '/inc/menus.php';
require BIA_DIR . '/inc/activation.php';
