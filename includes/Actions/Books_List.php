<?php

	if(!class_exists('WP_List_Table')){
	    
	    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
	}

	class Books_List extends WP_List_Table {

    /**
	 *  Associative array of columns
	 *
	 * @return array
	 */
	function get_columns() {
	 
	  $columns = array(
        'ID' => __('#'),
        'post_id' => __('Post ID'),
        'isbn' => __('ISBN')
    	);

	  return $columns;
	}

    public function get_books( $per_page = 5, $page_number = 1 ) {

      global $wpdb;

      $sql = "SELECT * FROM {$wpdb->prefix}books_info";

      if ( ! empty( $_REQUEST['orderby'] ) ) {
        $sql .= ' ORDER BY ' . esc_sql( $_REQUEST['orderby'] );
        $sql .= ! empty( $_REQUEST['order'] ) ? ' ' . esc_sql( $_REQUEST['order'] ) : ' ASC';
      }

      $sql .= " LIMIT $per_page";

      $sql .= ' OFFSET ' . ( $page_number - 1 ) * $per_page;


      $result = $wpdb->get_results( $sql, 'ARRAY_A' );

      return $result;
    }

    function prepare_items() {
      $columns = $this->get_columns();
      $hidden = array();
      $sortable = array();
      $this->_column_headers = array($columns, $hidden, $sortable);
      $this->items = self::get_books();
    }


    function column_default( $item, $column_name ) {
      switch( $column_name ) { 
      	case 'ID':
        case 'post_id':
        case 'isbn':
          return $item[ $column_name ];
        default:
          return print_r( $item, true ) ; 
      }
    }

    public function get_sortable_columns()
	{
    $sortable = array(
        'ID' => array('ID', true),
        'post_id' => array('post_id', true),
        'isbn' => array('isbn', true)
    );
    return $sortable;
	}

}
