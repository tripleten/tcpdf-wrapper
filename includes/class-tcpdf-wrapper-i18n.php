<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.doublewp.com/plugins/tcpdf-wrapper/ *
 * @since      1.0.0
 * @package    DoublewP_TCPDF_Wrapper
 * @subpackage DoublewP_TCPDF_Wrapper/includes
 * @author     DoublewP <support@doublewp.com>
 */
class DoublewP_TCPDF_Wrapper_i18n {

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'tcpdf-wrapper',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
