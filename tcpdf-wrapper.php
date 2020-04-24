<?php

/**
 *
 * @link              https://www.doublewp.com/plugins/tcpdf-wrapper/
 * @since             1.0.0
 * @package           TCPDF_Wrapper
 *
 * @wordpress-plugin
 * Plugin Name:       TCPDF Wrapper
 * Plugin URI:        https://www.doublewp.com/plugins/tcpdf-wrapper/
 * Description:       A Wordpress wrapper for the popular PHP based TCPDF Library to generate PDF document on the fly.
 * Version:           1.0.0
 * Author:            DoublewP
 * Author URI:        https://www.doublewp.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tcpdf-wrapper
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'TCPDF_WRAPPER_VERSION', '1.0.0' );
define( 'DOUBLEWP_TCPDF_WRAPPER_OPTIONS', 'doublewp_tcpdf_wrapper_options' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-tcpdf-wrapper.php';

/**
 * Begins execution of the plugin.
 * @since    1.0.0
 */
function run_doublewp_tcpdf_wrapper() {

	$plugin = new DoublewP_TCPDF_Wrapper();
	$plugin->run();

}

run_doublewp_tcpdf_wrapper();
