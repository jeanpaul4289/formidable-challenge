<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin side.
 *
 * @link https://github.com/jeanpaul4289
 * @since 1.0.0
 *
 * @package Formidable_Challenge
 * @subpackage Formidable_Challenge/controllers
 */

/**
 * The core plugin class.
 *
 * This is used to define dashboard-specific hooks, and public-facing site hooks.
 *
 * @since 1.0.0
 * @package Formidable_Challenge
 * @subpackage Formidable_Challenge/controllers
 * @author Jean Paul Demorizi <jeanpaul4289@gmail.com>
 */
class FrmChal_Controller {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @var FrmChal_Loader_Controller $loader Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * Instance of the admin class.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var object|FrmChal_Admin_Controller
	 */
	private static $admin_instance;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Load the dependencies, and set the hooks for the admin panel and
	 * the public-facing side of the site.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		$this->load_dependencies();
		$this->define_admin_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - FrmChal_App_Helper. App helper for functions that are used a lot.
	 * - FrmChal_List_Helper. List helper to build the displayed table.
	 * - FrmChal_Loader_Controller. Orchestrates the hooks of the plugin.
	 * - FrmChal_Admin_Controller. Defines all actions for the admin panel.
	 * - FrmChal_Public_Controller. Defines all actions for the public facing side.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible to provide helper functions to the other classes.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helpers/frmchal-app-helper.php';

		/**
		 * The class responsible to provide helper functions to display the tables.
		 */
		require_once FrmChal_App_Helper::plugin_path() . '/classes/helpers/frmchal-list-helper.php';
		
		/**
		 * The class responsible for orchestrating the actions and filters of the core plugin.
		 */
		require_once FrmChal_App_Helper::plugin_path() . '/classes/controllers/frmchal-loader-controller.php';

		/**
		 * The class responsible for defining all actions that occur in the Admin Panel.
		 */
		require_once FrmChal_App_Helper::plugin_path() . '/classes/controllers/frmchal-admin-controller.php';


		$this->loader = new FrmChal_Loader_Controller();

	}

	/**
	 * Register all of the hooks related to the dashboard functionality
	 * of the plugin.
	 *
	 * @since 1.0.0
	 * @access private
	 * @return void
	 */
	private function define_admin_hooks() {

		$plugin_admin         = new FrmChal_Admin_Controller();
		self::$admin_instance = $plugin_admin;

		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_menu' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
		$this->loader->add_filter( 'admin_body_class', $plugin_admin, 'add_admin_class', 999 );
	}


	/**
	 * Get admin instance.
	 *
	 * @since 1.0.0
	 * @return object|FrmChal_Admin_Controller
	 */
	public function get_admin_instance() {

		if ( is_null( self::$admin_instance ) ) {
			self::$admin_instance = new FrmChal_Admin_Controller();
		}
		return self::$admin_instance;

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since 1.0.0
	 * @return FrmChal_Loader_Controller Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {

		return $this->loader;

	}

}
