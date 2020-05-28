<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * Dashboard. This file also includes all of the dependencies used by the plugin
 * and defines a function that starts the plugin.
 *
 * @author Jean Paul Demorizi
 * @link https://github.com/jeanpaul4289
 * @since 1.0.0
 * @package Formidable_Challenge
 *
 * @wordpress-plugin
 * Plugin Name: Formidable Challenge
 * Plugin URI: https://github.com/jeanpaul4289/plugins/formidable-challenge/
 * Description: WordPress Plugin that shows a custom html table in the Dashboard Admin Panel.
 * Version: 1.0.0
 * Author: Jean Paul Demorizi
 * Author URI: https://github.com/jeanpaul4289/
 * License: GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain: formidable-challenge
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'You are not allowed to call this page directly.' );
}

// Used for referring to the plugin file or basename.
if ( ! defined( 'FORMIDABLE_CHALLENGE_FILE' ) ) {
	define( 'FORMIDABLE_CHALLENGE_FILE', plugin_basename( __FILE__ ) );
}

/**
 * The core plugin class that is used to define admin-facing site hooks.
 *
 * @since 1.0.0
 */
function frmchal_class_autoloader() {
	require_once plugin_dir_path( __FILE__ ) . 'classes/controllers/class-frmchal-controller.php';
}

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since 1.0.0
 */
function run_formidable_challenge() {
	$plugin = new FrmChal_Controller();
	$plugin->run();
}
add_action( 'plugins_loaded', 'run_formidable_challenge', 0 );

frmchal_class_autoloader();
