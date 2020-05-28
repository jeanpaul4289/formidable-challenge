<?php
/**
 * The WP_CLI functionality of the plugin.
 *
 * @link https://github.com/jeanpaul4289
 * @since 1.0.0
 *
 * @package Formidable_Challenge
 * @subpackage Formidable_Challenge/commands
 */

/**
 * The WP_CLI functionality of the plugin.
 *
 * @package Formidable_Challenge
 * @subpackage Formidable_Challenge/commands
 * @author Jean Paul Demorizi <jeanpaul4289@gmail.com>
 */
class FrmChal_Cli_Command {

	/**
	 * WP CLI command used to force the refresh of the data the next time the AJAX endpoint is called;
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function refresh() {
		$frmchal_list = new FrmChal_List_Helper();
		$frmchal_list->refresh();
		WP_CLI::success( 'Table Refreshed!' );
	}
}


/**
 * Adds the custom WordPress command that can be used to force the refresh of the data display
 * in the table.
 */
WP_CLI::add_command( 'frmchal', 'FrmChal_Cli_Command' );

