<?php

/**
 * The file that defines the core plugin class
 * @link       https://www.doublewp.com/plugins/tcpdf-wrapper/
 *
 * @since      1.0.0
 * @package    TCPDF_Wrapper
 * @subpackage TCPDF_Wrapper/admin
 * @author     DoublewP <support@doublewp.com>
 */

class DoublewP_TCPDF_Wrapper_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	
	/**
	 * Add the top level menu in Settings
	 *
	 * @since    1.0.0
	 */
	public function tcpdf_wrapper_options_page() {
		 add_options_page(
			 __('TCPDF Wrapper Options', $this->plugin_name),
			 __('TCPDF Wrapper', $this->plugin_name),
			 'manage_options',
			 'tcpdf-wrapper-options',
			 [$this, 'tcpdf_wrapper_options_page_html']
		 );
	}

	/**
	 * Custom options & settings for the admin area.
	 *
	 * @since    1.1.0
	 */
	 public function tcpdf_wrapper_settings_init() {
		register_setting( 'tcpdf_wrapper', DOUBLEWP_TCPDF_WRAPPER_OPTIONS);
		add_settings_section(
			'tcpdf_wrapper_section_options', __( '', 'tcpdf_wrapper' ), [$this, 'tcpdf_wrapper_section_options_heading'], 'tcpdf_wrapper'
		);
		
		add_settings_field(
			'tcpdf_wrapper_field_include_globally', __( "Include Globally", 'tcpdf_wrapper' ), [$this,'tcpdf_wrapper_field_include_global_manual'], 'tcpdf_wrapper', 'tcpdf_wrapper_section_options', ['label_for' => 'tcpdf_wrapper_fld_inc_type', 'id' => 'tcpdf_wrapper_fld_inc_type_global', 'value' => 'global', 'class' => 'row', 'checked' => 'checked']
		);

		add_settings_field(
			'tcpdf_wrapper_field_include_manually', __( "Include Manually", 'tcpdf_wrapper' ), [$this,'tcpdf_wrapper_field_include_global_manual'], 'tcpdf_wrapper', 'tcpdf_wrapper_section_options', ['label_for' => 'tcpdf_wrapper_fld_inc_type', 'id' => 'tcpdf_wrapper_fld_inc_type_manual', 'value' => 'manual', 'class' => 'row', 'checked' => '']
		);
		
		add_settings_field(
			'tcpdf_wrapper_field_include_samplecode', __( "", 'tcpdf_wrapper' ), [$this,'tcpdf_wrapper_field_include_samplecode'], 'tcpdf_wrapper', 'tcpdf_wrapper_section_options', ['label_for' => 'tcpdf_wrapper_field_include_samplecode', 'id' => 'tcpdf_wrapper_field_include_samplecode']
		);

		

	}

	public function tcpdf_wrapper_section_options_heading( $args ) {
		?>
		<p id="<?php echo esc_attr( $args['id'] ); ?>">
			<?php esc_html_e( 'Please choose the way you would like to include the TCPDF library.', 'tcpdf_wrapper' ); ?>
		</p>
		<?php
	}

	
	public function tcpdf_wrapper_field_include_global_manual( $args ) {
		$options = get_option(DOUBLEWP_TCPDF_WRAPPER_OPTIONS);

		if(!empty($options[ $args['label_for'] ])){
			$args['checked'] = '';
		}
		?>
		<input type="radio" id="<?php echo esc_attr( $args['id'] ); ?>" name="doublewp_tcpdf_wrapper_options[tcpdf_wrapper_fld_inc_type]"
		value="<?php echo $args['value'];?>" <?php echo (!empty($options[ $args['label_for'] ]) && ($options[ $args['label_for'] ] == $args['value'])) ? "checked" : "" ?> <?php echo $args['checked'];?>/>
		<?php
	}

	public function tcpdf_wrapper_field_include_samplecode( $args ) {
		
		?>
		<div id="tcpdf-wrapper-samplecode" style="display:none">
			<strong><?php esc_html_e('Copy the below code and paste it in your plugin/ theme to include the library','tcpdf_wrapper');?></strong>
			<div style="margin-top:15px;background-color:#fff;padding:15px;color:#ff3399">require ( WP_PLUGIN_DIR.'/tcpdf-wrapper/lib/tcpdf/tcpdf.php' )</div>
		</div>
		<?php
	}
	
	/**
	 * top level menu:
	 * callback functions
	 */
	public function tcpdf_wrapper_options_page_html() {
		 // check user capabilities
		 if ( ! current_user_can( 'manage_options' ) ) {
			return;
		 }
		
		 if ( isset( $_GET['settings-updated'] ) ) {
			add_settings_error( 'tcpdf_wrapper_messages', 'tcpdf_wrapper_message', __( 'Settings Saved', 'tcpdf_wrapper' ), 'updated' );
		 }
		 ?>
		 <div class="wrap">
			<h3><?php echo esc_html( get_admin_page_title() ); ?></h3>
			 <form action="options.php" method="post">
			 <?php
			 settings_fields( 'tcpdf_wrapper' );
			 do_settings_sections( 'tcpdf_wrapper' );
			 submit_button( __('Save Settings','tcpdf_wrapper') );
			 ?>
			 </form>
		 </div>
		<script type="text/javascript">
		var samplecode = document.getElementById("tcpdf-wrapper-samplecode");
		document.getElementById("tcpdf_wrapper_fld_inc_type_manual").addEventListener("change", function(){
			 samplecode.style.display = "block";
		});

		document.getElementById("tcpdf_wrapper_fld_inc_type_global").addEventListener("change", function(){
			 samplecode.style.display = "none";
		});

		</script>
		 <?php
	}

}