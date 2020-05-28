<?php
/**
 * The helper class for common used functions used in the plugin.
 *
 * @link https://github.com/jeanpaul4289
 * @since 1.0.0
 *
 * @package Formidable_Challenge
 * @subpackage Formidable_Challenge/helpers
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'You are not allowed to call this page directly.' );
}
/**
 * The helper class for common used functions used in the plugin.
 *
 * Provides the plugin name, version, url, path and current date.
 *
 * @package Formidable_Challenge
 * @subpackage Formidable_Challenge/helpers
 * @author Jean Paul Demorizi <jeanpaul4289@gmail.com>
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
	 * @var string $api_url The api url that will be consumed.
	 */
	public static $api_url = 'http://api.strategy11.com/wp-json/challenge/v1/1';


	/**
	 * The plugin name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string The name of the plugin
	 */
	public static function plugin_name() : string {
		return self::$plugin_name;
	}

	/**
	 * The plugin version
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string The version of this plugin
	 */
	public static function plugin_version() : string {
		return self::$version;
	}

	/**
	 * Returns the api url that will be consumed
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string The api url that will be consumed
	 */
	public static function api_url() : string {
		return self::$api_url;
	}

	/**
	 * The plugin folder name
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string The plugin folder name
	 */
	public static function plugin_folder() : string {
		return basename( self::plugin_path() );
	}

	/**
	 * The plugin folder path
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string The plugin folder path
	 */
	public static function plugin_path() : string {
		return dirname( dirname( dirname( __FILE__ ) ) );
	}

	/**
	 * Retrieves a URL within the plugin
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string URL within the plugin
	 */
	public static function plugin_url() : string {
		return plugins_url( '', self::plugin_path() . '/formidable.php' );
	}

	/**
	 * Return current date in format Y-m-d H:i:s
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string current date
	 */
	public static function current_date() : string {
		return date( 'Y-m-d H:i:s' );
	}

}
