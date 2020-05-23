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
		$this->items = json_decode($this->remote_response_handler( FrmChal_App_Helper::$api_url ));
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
		esc_html_e( 'No items found.', 'formidable' );
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
	 * Return number of items
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return int
	 */
	public function get_items_count() {
		echo $this->items_qty;
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

				echo "<th $class>$column_display_name</th>"; // WPCS: XSS ok.
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
				<span class="displaying-num"><?php echo $this->items_qty; ?> items</span>
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
	 * Handling ajax requests
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function ajax_response() {
		// TODO
	}

}
