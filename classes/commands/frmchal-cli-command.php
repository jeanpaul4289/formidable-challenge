<?php
class FrmChal_Cli_Command {
	/*
		WP CLI command used to force the refresh of the data the next time the AJAX endpoint is called;
	*/
	public function refresh() {
		$frmchal_list = new FrmChal_List_Helper();
		$frmchal_list->refresh();
		WP_CLI::success( 'Table Refreshed!' );
	}
}
WP_CLI::add_command( 'frmchal', 'FrmChal_Cli_Command' );
?>