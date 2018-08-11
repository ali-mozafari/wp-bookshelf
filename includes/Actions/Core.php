<?php 

namespace Actions;

class Core
{

	public $bookshelf_hooks;
	public $bookshelf_functions;

	public static function initialize_classes() {

		$bookshelf_functions   = new Bookshelf_Functions();
		$bookshelf_hooks       = new Bookshelf_Hooks();

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