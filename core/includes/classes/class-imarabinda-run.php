<?php


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class Imarabinda_Run
 *
 * Thats where we bring the plugin to life
 *
 * @package		IMARABINDA
 * @subpackage	Classes/Imarabinda_Run
 * @author		Arabinda Baidya
 * @since		1.0.0
 */
class Imarabinda_Run{

	/**
	 * Our Imarabinda_Run constructor 
	 * to run the plugin logic.
	 *
	 * @since 1.0.0
	 */
	function __construct(){
		$this->add_hooks();
	}

	/**
	 * ######################
	 * ###
	 * #### WORDPRESS HOOKS
	 * ###
	 * ######################
	 */

	/**
	 * Registers all WordPress and plugin related hooks
	 *
	 * @access	private
	 * @since	1.0.0
	 * @return	void
	 */
	private function add_hooks(){
	
		add_action( 'plugin_action_links_' . IMARABINDA_PLUGIN_BASE, array( $this, 'add_plugin_action_link' ), 20 );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_backend_scripts_and_styles' ), 20 );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend_scripts_and_styles' ), 20 );

		add_action( 'wp_ajax_nopriv_my_demo_ajax_call', array( $this, 'my_demo_ajax_call_callback' ), 20 );
		add_action( 'wp_ajax_my_demo_ajax_call', array( $this, 'my_demo_ajax_call_callback' ), 20 );
	
	}

	/**
	 * ######################
	 * ###
	 * #### WORDPRESS HOOK CALLBACKS
	 * ###
	 * ######################
	 */

	/**
	* Adds action links to the plugin list table
	*
	* @access	public
	* @since	1.0.0
	*
	* @param	array	$links An array of plugin action links.
	*
	* @return	array	An array of plugin action links.
	*/
	public function add_plugin_action_link( $links ) {

		$links['our_shop'] = sprintf( '<a href="%s" target="_blank title="Buy Me a Coffee" style="font-weight:700;">%s</a>', 'https://facebook.com/imarabinda', __( 'Buy Me a Coffee', 'imarabinda' ) );

		return $links;
	}

	/**
	 * Enqueue the backend related scripts and styles for this plugin.
	 * All of the added scripts andstyles will be available on every page within the backend.
	 *
	 * @access	public
	 * @since	1.0.0
	 *
	 * @return	void
	 */
	public function enqueue_backend_scripts_and_styles() {
		wp_enqueue_style( 'imarabinda-backend-styles', IMARABINDA_PLUGIN_URL . 'assets/admin/css/backend-styles.css', array(), IMARABINDA_VERSION, 'all' );
		wp_enqueue_script( 'imarabinda-backend-scripts', IMARABINDA_PLUGIN_URL . 'assets/admin/js/backend-scripts.js', array( 'jquery' ), IMARABINDA_VERSION, true );
		wp_localize_script( 'imarabinda-backend-scripts', 'imarabinda', array(
			'plugin_name'   	=> __( IMARABINDA_NAME, 'imarabinda' ),
			'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
			'security_nonce'	=> wp_create_nonce( "your-nonce-name" ),
		));
	}


	/**
	 * Enqueue the frontend related scripts and styles for this plugin.
	 *
	 * @access	public
	 * @since	1.0.0
	 *
	 * @return	void
	 */
	public function enqueue_frontend_scripts_and_styles() {
		wp_enqueue_style( 'imarabinda-frontend-styles', IMARABINDA_PLUGIN_URL . 'assets/public/css/frontend-styles.css', array(), IMARABINDA_VERSION, 'all' );
		wp_enqueue_script( 'imarabinda-frontend-scripts', IMARABINDA_PLUGIN_URL . 'assets/public/js/frontend-scripts.js', array( 'jquery' ), IMARABINDA_VERSION, true );
		wp_localize_script( 'imarabinda-frontend-scripts', 'imarabinda', array(
			'demo_var'   		=> __( 'This is some demo text coming from the backend through a variable within javascript.', 'imarabinda' ),
			'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
			'security_nonce'	=> wp_create_nonce( "your-nonce-name" ),
		));
	}


	/**
	 * The callback function for my_demo_ajax_call
	 *
	 * @access	public
	 * @since	1.0.0
	 *
	 * @return	void
	 */
	public function my_demo_ajax_call_callback() {
		check_ajax_referer( 'your-nonce-name', 'ajax_nonce_parameter' );

		$demo_data = isset( $_REQUEST['demo_data'] ) ? sanitize_text_field( $_REQUEST['demo_data'] ) : '';
		$response = array( 'success' => false );

		if ( ! empty( $demo_data ) ) {
			$response['success'] = true;
			$response['msg'] = __( 'The value was successfully filled.', 'imarabinda' );
		} else {
			$response['msg'] = __( 'The sent value was empty.', 'imarabinda' );
		}

		if( $response['success'] ){
			wp_send_json_success( $response );
		} else {
			wp_send_json_error( $response );
		}

		die();
	}

}
