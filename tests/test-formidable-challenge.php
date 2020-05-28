<?php
/**
 * The class bootstrap file test.
 *
 * @link https://github.com/jeanpaul4289
 * @since 1.0.0
 * @package Formidable_Challenge
 * @subpackage Formidable_Challenge/tests
 */

/**
 * The test class to test the plugin bootstrap file.
 *
 * @package Formidable_Challenge
 * @subpackage Formidable_Challenge/tests
 * @author Jean Paul Demorizi <jeanpaul4289@gmail.com>
 */
class Formidable_Challenge_Test extends WP_UnitTestCase {

	/**
	 * Test if the request run multiple times an hour?
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function test_request_multiple_times() {
		$frmchal_list = new FrmChal_List_Helper();
		$frmchal_date = get_option('frmchal_date');
		$frmchal_list->prepare_items();
		sleep(2);
		$frmchal_list->prepare_items();
		$frmchal_date_copy = get_option('frmchal_date');
		$this->assertTrue( $frmchal_date == $frmchal_date_copy );
	}

	/**
	 * Test if the table is showing the expected results
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function test_table_showing_expected_results() {
		$frmchal_list = new FrmChal_List_Helper();
		$frmchal_data = get_option('frmchal_data');
		$frmchal_list->prepare_items();
		$refresh = true;
		$frmchal_list->prepare_items($refresh);
		$frmchal_data_copy = get_option('frmchal_data');
		$this->assertTrue( $frmchal_data == $frmchal_data_copy );
	}
}
