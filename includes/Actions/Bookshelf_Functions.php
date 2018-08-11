<?php 

namespace Actions;

class Bookshelf_Functions
{

	public function __construct() {

		//$this->create_book_post_type();

		// $this->add_bookshelf_functions();
	
	}


	public function add_bookshelf_functions() {

		//Create Books post-type


	}

	public static function create_book_post_type() {

		  register_post_type( 'books',
		    array(
		      'labels' => array(
		        'name' => __( 'Books' ),
		        'singular_name' => __( 'Books' )
		      ),
		      'public' => true,
		      'has_archive' => false,
		    )
		  );
		}


}