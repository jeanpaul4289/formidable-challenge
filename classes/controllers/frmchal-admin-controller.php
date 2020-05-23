<?php
/**
 * The admin-panel-specific functionality of the plugin.
 *
 * @link https://github.com/jeanpaul4289
 * @since 1.0.0
 *
 * @package Formidable_Challenge
 * @subpackage Formidable_Challenge/controllers
 */

/**
 * The admin-panel-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and adds the menu and settings to the admin panel in WordPress.
 *
 * @package Formidable_Challenge
 * @subpackage Formidable_Challenge/controllers
 * @author Jean Paul Demorizi <jeanpaul4289@gmail.com>
 */
class FrmChal_Admin_Controller {

	/**
	 * The plugin options.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var string $options The plugin options.
	 */
	private $options;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 * @param none
	 */
	public function __construct() {
	}

	/**
	 * Adds a settings page link to a menu
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function add_menu() {
		// Main Menu Item.
		add_menu_page(
			'Formidable Settings',
			'Formidable Settings',
			'manage_options',
			'formidable-endpoint-customization',
			[ $this, 'page_options' ],
			'dashicons-groups',
			1
		);

	}

	/**
	 * Adds custom classes to the admin page body
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public static function add_admin_class( $classes ) {
		$classes .= ' frm-white-body ';
		return $classes;
	}


	/**
	 * Creates the admin page settings that displays the table
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function page_options() {

		$frmchal_list = new FrmChal_List_Helper();

		require(FrmChal_App_Helper::plugin_path() . '/classes/views/frmchal-admin-page-settings.php');
	}

	/**
	 * Register the stylesheets for the plugin in the admin side of the site.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function enqueue_styles() {
		wp_enqueue_style( 'formidable-challenge', FrmChal_App_Helper::plugin_url() . '/css/frmchal-admin.css');
	}

}
