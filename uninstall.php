<?php

/**
 * Fired when the plugin is uninstalled.

 * @link       https://www.doublewp.com/plugins/tcpdf-wrapper/
 * @since      1.0.0
 *
 * @package    TCPDF_Wrapper
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}
 
delete_option(DOUBLEWP_TCPDF_WRAPPER_OPTIONS);
 
// for site options in Multisite
delete_site_option(DOUBLEWP_TCPDF_WRAPPER_OPTIONS);