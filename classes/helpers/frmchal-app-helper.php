<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( 'You are not allowed to call this page directly.' );
}
/*
* Also maintains the unique identifier of this plugin as well as the current
* version of the plugin.
*/
class FrmChal_App_Helper {

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string $plugin_name The string used to uniquely identify this plugin.
	 */
	public static $plugin_name = 'formidable-challenge';

	/**
	 * The current version of the plugin.
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string $version The current version of the plugin.
	 */
	public static $version = '1.0.0';

	/**
	 * The api url that will be consumed.
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string $api_url The api url that will be consumed..
	 */
	public static $api_url   = 'http://api.strategy11.com/wp-json/challenge/v1/1';

	
	/**
	 * @since 1.0.0
	 * @access public
	 * @param none
	 * @return string The name of the plugin
	 */
	public static function plugin_name() {
		return self::$plugin_name;
	}

	/**
	 * @since 1.0.0
	 * @access public
	 * @param none
	 * @return string The version of this plugin
	 */
	public static function plugin_version() {
		return self::$version;
	}

	/**
	 * @since 1.0.0
	 * @access public
	 * @param none
	 * @return string The api url that will be consumed
	 */
	public static function api_url() {
		return self::$api_url;
	}

	public static function plugin_folder() {
		return basename( self::plugin_path() );
	}

	public static function plugin_path() {
		return dirname( dirname( dirname( __FILE__ ) ) );
	}

	public static function plugin_url() {
		// Prevously FRM_URL constant.
		return plugins_url( '', self::plugin_path() . '/formidable.php' );
	}

	public static function relative_plugin_url() {
		return str_replace( array( 'https:', 'http:' ), '', self::plugin_url() );
	}

	/**
	 * @return string Site URL
	 */
	public static function site_url() {
		return site_url();
	}

	/**
	 * Get the name of this site
	 * Used for [sitename] shortcode
	 *
	 * @since 2.0
	 * @return string
	 */
	public static function site_name() {
		return get_option( 'blogname' );
	}

}
