<?php

/**
 * The file that defines the core plugin class
 * @link       https://www.doublewp.com/plugins/tcpdf-wrapper/
 *
 * @since      1.0.0
 * @package    TCPDF_Wrapper
 * @subpackage TCPDF_Wrapper/includes
 * @author     DoublewP <support@doublewp.com>
 */
class DoublewP_TCPDF_Wrapper {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      TCPDF_Wrapper_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	* Define the core functionality of the plugin.
	*
	* @since    1.0.0
	*/
	public function __construct() {
		if ( defined( 'TCPDF_WRAPPER_VERSION' ) ) {
			$this->version = TCPDF_WRAPPER_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'tcpdf-wrapper';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-tcpdf-wrapper-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-tcpdf-wrapper-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-tcpdf-wrapper-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-tcpdf-wrapper-public.php';

		$this->loader = new DoublewP_TCPDF_Wrapper_Loader();

		/*
		 * Include TCPDF Wrapper is global option is enabled
		 */
		$options = get_option(DOUBLEWP_TCPDF_WRAPPER_OPTIONS);

		if(trim($options['tcpdf_wrapper_fld_inc_type']) == 'global') {
			require( WP_PLUGIN_DIR."/".$this->plugin_name . '/lib/tcpdf/tcpdf.php' );
		}

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Door_Sign_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new DoublewP_TCPDF_Wrapper_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new DoublewP_TCPDF_Wrapper_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_init', $plugin_admin, 'tcpdf_wrapper_settings_init' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'tcpdf_wrapper_options_page' );


	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new DoublewP_TCPDF_Wrapper_Public( $this->get_plugin_name(), $this->get_version());
		$this->loader->add_action( 'activated_plugin', $plugin_public, 'load_tcpdf_wrapper_first');
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    DoublewP_TCPDF_Wrapper_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
