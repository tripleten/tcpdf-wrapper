<?php

/**
 * The file that defines the core plugin class
 * @link       https://www.doublewp.com/plugins/tcpdf-wrapper/
 *
 * @since      1.0.0
 * @package    TCPDF_Wrapper
 * @subpackage TCPDF_Wrapper/public
 * @author     DoublewP <support@doublewp.com>
 */

class DoublewP_TCPDF_Wrapper_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;


	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * When plugins are activated, make sure that TCPDF is first.
	 *
	 * @since    1.0.0
	 */
	public function load_tcpdf_wrapper_first() {
		$path            = __FILE__;
		$path            = str_replace( trailingslashit( WP_PLUGIN_DIR ), '', $path );
		$path            = str_replace( WP_CONTENT_DIR . '/mu-plugins/', '', $path );
		$active_plugins  = get_option( 'active_plugins' );
		$this_plugin_key = array_search( $path, $active_plugins );
		if ( $this_plugin_key ) {
			array_splice( $active_plugins, $this_plugin_key, 1 );
			array_unshift( $active_plugins, $path );
			update_option( 'active_plugins', $active_plugins );
		}
	}

}
