<?php 

namespace Actions;

class Bookshelf_Hooks
{

	public function __construct() {

		$this->register_bookshelf_hooks();
	
	}


	public function register_bookshelf_hooks() {



		if (function_exists( 'create_book_post_type' ) ) {

			echo "existsssssss";
		add_action( 'init', 'create_book_post_type' );


	} else {

		echo "not_existsssssss";


	}

	}



}