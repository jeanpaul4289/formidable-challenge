<?php
/**
 * The public side functionality of the plugin.
 *
 * @link https://github.com/jeanpaul4289
 * @since 1.0.0
 *
 * @package Formidable_Challenge
 * @subpackage Formidable_Challenge/controllers
 */

/**
 * The public side functionality of the plugin.
 *
 * Defines the plugin name, version, and adds the menu and settings to the admin panel in WordPress.
 *
 * @package Formidable_Challenge
 * @subpackage Formidable_Challenge/controllers
 * @author Jean Paul Demorizi <jeanpaul4289@gmail.com>
 */
class FrmChal_Public_Controller {

	/**
	 * Register the stylesheets for the plugin in the admin side of the site.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function enqueue_styles() {
		wp_register_style( 'frmchal_style', FrmChal_App_Helper::plugin_url() . '/css/frmchal-public.css');
	}

	/**
	 * Register the scripts for the plugin in the admin side of the site.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 'frmchal_script', FrmChal_App_Helper::plugin_url() .  '/js/frmchal-app.js', array('jquery' => 'jquery', ) );
		wp_localize_script( 'frmchal_script', 'my_script', array( 'ajax_url' => admin_url( 'admin-ajax.php' )) );
	}

}
