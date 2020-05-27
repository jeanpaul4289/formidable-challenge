<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( 'You are not allowed to call this page directly.' );
}

// TODO - add comments
class FrmChal_List_Helper {
	/**
	 * The current list of items
	 *
	 * @since 1.0.0
	 * @var array
	 * @access public
	 */
	public $items;

	/**
	 * The current quantity of items
	 *
	 * @since 1.0.0
	 * @var int
	 * @access public
	 */
	public $items_qty;


	/**
	 * Construct the table object
	 */
	public function __construct() {

		$this->prepare_items();
	}

	/**
	 * Prepares the list of items for displaying.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function prepare_items() {
		$frmchal_data = get_option('frmchal_data');
		if($this->more_than_one_hour() || !$frmchal_data){
			$frmchal_data = $this->remote_response_handler( FrmChal_App_Helper::$api_url );
			update_option('frmchal_data', $frmchal_data);
			update_option('frmchal_date', FrmChal_App_Helper::current_date());
		} 
		$this->items = json_decode($frmchal_data);
		$this->items_qty = $this->items ? count((array)$this->items->data->rows) : 0;
	}

	/**
	 * Remote response handler for the API endpoint
	 *
	 * @since 1.0.0
	 * @param string $url endpoint url.
	 * @return string $body response body.
	 */
	public function remote_response_handler( $url ) {

		$response = wp_remote_request( $url );
		$code     = wp_remote_retrieve_response_code( $response );
		$body     = wp_remote_retrieve_body( $response );
		if ( 200 !== $code ) {
			$body = 'An error has ocurred.';
		}
		return $body;

	}

	/**
	 * Returns whether the data has been requested in more than one hour or not.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function more_than_one_hour() {
		$frmchal_date    = get_option('frmchal_date') ? get_option('frmchal_date') : FrmChal_App_Helper::current_date();
		$last_date       = strtotime($frmchal_date);
		$current_date    = strtotime(FrmChal_App_Helper::current_date());
		$time_difference = abs($current_date - $last_date)/(60*60);
		return $time_difference > 1;
	} 

	/**
	 * Display rows
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function display_rows() {
		if($this->items && $this->items->data){
			foreach ( $this->items->data->rows as $item ) {
				echo $this->single_row( $item );
			}
		}
	}

	/**
	 * Whether the table has items to display or not
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return bool
	 */
	public function has_items() {
		return ! empty( $this->items );
	}

	/**
	 * Message to be displayed when there are no items
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function no_items() {
		esc_html_e( 'No users found.', 'formidable' );
	}

	/**
	 * Return number of columns
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return int
	 */
	public function get_column_headers() {
		return $this->items ? $this->items->data->headers : [];
	}

	/**
	 * Return number of columns
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return int
	 */
	public function get_column_count() {
		$columns  = $this->get_column_headers();
		return count( $columns );
	}

	/**
	 * Print column headers.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function print_column_headers() {
		$columns = $this->get_column_headers();
		if($columns) {
			foreach ( $columns as $column_key => $column_display_name ) {
				$class = array( 'manage-column', "column-$column_key" );

				$column_display_name = esc_html( $column_display_name );

				echo "<th>$column_display_name</th>"; // WPCS: XSS ok.
			}
		}
	}

	/**
	 * Display the table
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function display() {
		$this->display_tablenav( 'top' );
		?>
		<table class="wp-list-table widefat fixed striped ">
			<thead>
				<tr>
					<?php $this->print_column_headers(); ?>
				</tr>
			</thead>

			<tbody id="the-list">
				<?php $this->display_rows_or_placeholder(); ?>
			</tbody>

			<tfoot>
				<tr>
					<?php $this->print_column_headers( false ); ?>
				</tr>
			</tfoot>

		</table>
		<?php
		$this->display_tablenav( 'bottom' );
	}

	/**
	 * Generate the table navigation above or below the table
	 *
	 * @since 1.0.0
	 * @access protected
	 *
	 * @param string $which
	 */
	protected function display_tablenav( $which ) {
		?>
		<div class="tablenav <?php echo esc_attr( $which ); ?>">
			<div class="tablenav-pages one-page">
				<span class="displaying-num"><?php echo $this->items_qty; ?> users</span>
			</div>
			<?php if ($which == 'top') { ?>
			<div class="view-switch">
				<a href="#" class="view-list current" id="view-switch-list"><span class="screen-reader-text">List View</span></a>
			</div>
			<?php } ?>
			<br class="clear">
		</div>
		<?php
	}


	/**
	 * Generate the tbody element for the list table.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function display_rows_or_placeholder() {
		if ( $this->has_items() ) {
			$this->display_rows();
		} else {
			echo '<tr class="no-items"><td class="colspanchange" colspan="' . esc_attr( $this->get_column_count() ) . '">';
			$this->no_items();
			echo '</td></tr>';
		}
	}

	/**
	 * Generates content for a single row of the table
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param object $item The current item
	 */
	public function single_row( $item ) {
		echo '<tr>';
		$this->single_row_columns( $item );
		echo '</tr>';
	}

	/**
	 * Generates the columns for a single row of the table
	 *
	 * @since 1.0.0
	 * @access protected
	 *
	 * @param object $item The current item
	 */
	protected function single_row_columns( $item ) {
		$columns = $this->get_column_headers();
		foreach($item as $key => $value ) {
			echo "<td $attributes>"; // WPCS: XSS ok.
			echo $value;
			echo "</td>";
		}
	}

	/**
	 * Generate the top bar element for the list table.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function display_top_bar() {
		?>
		<div id="frm_top_bar">
			<div id="frm-publishing"></div>
			<a href="#" class="frm-header-logo">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 599.68 601.37" width="35" height="35">
					<path fill="#f05a24" d="M289.6 384h140v76h-140z"></path>
					<path fill="#4d4d4d" d="M400.2 147h-200c-17 0-30.6 12.2-30.6 29.3V218h260v-71zM397.9 264H169.6v196h75V340H398a32.2 32.2 0 0 0 30.1-21.4 24.3 24.3 0 0 0 1.7-8.7V264zM299.8 601.4A300.3 300.3 0 0 1 0 300.7a299.8 299.8 0 1 1 511.9 212.6 297.4 297.4 0 0 1-212 88zm0-563A262 262 0 0 0 38.3 300.7a261.6 261.6 0 1 0 446.5-185.5 259.5 259.5 0 0 0-185-76.8z"></path>
				</svg>
			</a>
			<div class="frm_top_left frm_top_wide">
				<h1>
					Formidable Challenge						
					<a id="refresh" ref="#" class="button button-primary frm-button-primary">Refresh</a>
				</h1>
			</div>
			<div style="clear:right;"></div>
		</div>
		<?php
	}

	public function display_sub_bar() {
		?>
		<ul class="subsubsub">
            <li class="published">
                <a href="#" class="current">Users <span class="count">(<?php echo $this->items_qty; ?>)</span></a><br/>
            </li>
		</ul>
		<?php
	}

	/**
	 * Handling ajax requests
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function get_table() {
		$this->prepare_items();
		ob_start();
		
		$this->display();

		$table = ob_get_clean();

		$response = array( 
			'table' => $table,
			'items_qty' => $this->items_qty,
			'current_date' => get_option('frmchal_date')
		);
		die( wp_json_encode( $response ) );
	}

	public function get_table_shortcode() {
		wp_enqueue_style('frmchal_style');
		wp_enqueue_script('frmchal_script');
		
		ob_start();
		$frmchal_list = new FrmChal_List_Helper();

		require(FrmChal_App_Helper::plugin_path() . '/classes/views/frmchal-page-settings.php');
		return ob_get_clean();
	}

}
