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

if ( ! defined( 'ABSPATH' ) ) {
	die( 'You are not allowed to call this page directly.' );
}
/**
 * The admin-panel-specific functionality of the plugin.
 *
 * Adds the menu and settings to the admin panel in WordPress.
 *
 * @package Formidable_Challenge
 * @subpackage Formidable_Challenge/controllers
 * @author Jean Paul Demorizi <jeanpaul4289@gmail.com>
 */
class FrmChal_Admin_Controller {

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
			FrmChal_App_Helper::$plugin_name,
			[ $this, 'page_options' ],
			'dashicons-groups',
			1
		);

	}

	/**
	 * Adds custom classes to the admin page body
	 *
	 * @since 1.0.0
	 * @param string $classes Current css classes the admin body is using.
	 * @return string
	 */
	public static function add_admin_class( $classes ) : string {
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

		require FrmChal_App_Helper::plugin_path() . '/classes/views/frmchal-page-settings.php';
	}

	/**
	 * Register the stylesheets for the plugin in the admin side of the site.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function enqueue_styles() {
		wp_register_style( 'frmchal_style', FrmChal_App_Helper::plugin_url() . '/css/frmchal-admin.css' );
		if ( isset( $_REQUEST['page'] ) ) { // input var okay.
			if ( FrmChal_App_Helper::$plugin_name === $_REQUEST['page'] ) { // input var okay.
				wp_enqueue_style( 'frmchal_style' );
			}
		}
	}

	/**
	 * Register the scripts for the plugin in the admin side of the site.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function enqueue_scripts() {
		wp_register_script( 'frmchal_script', FrmChal_App_Helper::plugin_url() . '/js/frmchal-app.js', array( 'jquery' => 'jquery' ) );
		wp_localize_script( 'frmchal_script', 'my_script', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

		if ( isset( $_REQUEST['page'] ) ) { // input var okay.
			if ( FrmChal_App_Helper::$plugin_name === $_REQUEST['page'] ) { // input var okay.
				wp_enqueue_script( 'frmchal_script' );
			}
		}
	}

}
