<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! class_exists( 'Imarabinda' ) ) :

	/**
	 * Main Imarabinda Class.
	 *
	 * @package		IMARABINDA
	 * @subpackage	Classes/Imarabinda
	 * @since		1.0.0
	 * @author		Arabinda Baidya
	 */
	final class Imarabinda {

		/**
		 * The real instance
		 *
		 * @access	private
		 * @since	1.0.0
		 * @var		object|Imarabinda
		 */
		private static $instance;

		/**
		 * IMARABINDA helpers object.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @var		object|Imarabinda_Helpers
		 */
		public $helpers;

		/**
		 * IMARABINDA settings object.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @var		object|Imarabinda_Settings
		 */
		public $settings;

		/**
		 * Throw error on object clone.
		 *
		 * Cloning instances of the class is forbidden.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @return	void
		 */
		public function __clone() {
			_doing_it_wrong( __FUNCTION__, __( 'You are not allowed to clone this class.', 'imarabinda' ), '1.0.0' );
		}

		/**
		 * Disable unserializing of the class.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @return	void
		 */
		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, __( 'You are not allowed to unserialize this class.', 'imarabinda' ), '1.0.0' );
		}

		/**
		 * Main Imarabinda Instance.
		 *
		 * Insures that only one instance of Imarabinda exists in memory at any one
		 * time. Also prevents needing to define globals all over the place.
		 *
		 * @access		public
		 * @since		1.0.0
		 * @static
		 * @return		object|Imarabinda	The one true Imarabinda
		 */
		public static function instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Imarabinda ) ) {
				self::$instance					= new Imarabinda;
				self::$instance->base_hooks();
				self::$instance->autoloader();
				self::$instance->includes();
				self::$instance->helpers		= new Imarabinda_Helpers();
				self::$instance->settings		= new Imarabinda_Settings();

				//Fire the plugin logic
				new Imarabinda_Run();

				/**
				 * Fire a custom action to allow dependencies
				 * after the successful plugin setup
				 */
				do_action( 'imarabinda/plugin_loaded' );
			}

			return self::$instance;
		}

		/**
		 * Include autoload files.
		 *
		 * @access  private
		 * @since   1.0.0
		 * @return  void
		 */
		private function autoloader() {
			require_once IMARABINDA_PLUGIN_DIR . 'vendor/autoload.php';
		}


		/**
		 * Include required files.
		 *
		 * @access  private
		 * @since   1.0.0
		 * @return  void
		 */
		private function includes() {
			require_once IMARABINDA_PLUGIN_DIR . 'core/includes/classes/class-imarabinda-helpers.php';
			require_once IMARABINDA_PLUGIN_DIR . 'core/includes/classes/class-imarabinda-settings.php';
			require_once IMARABINDA_PLUGIN_DIR . 'core/includes/classes/class-imarabinda-run.php';
		}

		/**
		 * Add base hooks for the core functionality
		 *
		 * @access  private
		 * @since   1.0.0
		 * @return  void
		 */
		private function base_hooks() {
			add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );
		}

		/**
		 * Loads the plugin language files.
		 *
		 * @access  public
		 * @since   1.0.0
		 * @return  void
		 */
		public function load_textdomain() {
			load_plugin_textdomain( 'imarabinda', FALSE, dirname( plugin_basename( IMARABINDA_PLUGIN_FILE ) ) . '/languages/' );
		}

	}

endif; // End if class_exists check.