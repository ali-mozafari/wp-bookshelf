<?php

namespace Actions;


class Bookshelf_Post_Type
{
    
     
    /* Class constructor */
    public function __construct()
    {
	    add_action( 'init', array( &$this, 'register_post_type' ) );
	    add_action( 'init', array($this , 'create_publisher_taxonomy') , 0 );
	    add_action( 'init', array($this , 'create_authors_taxonomy') , 0 );
	    add_action('add_meta_boxes', array($this , 'bookshelf_add_custom_box') );
	    add_action('save_post', array($this , 'bookshelf_save_postdata') );
         
    }

     
    /* Method which registers the post type */
    public static function register_post_type()
    {

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

   

    function create_publisher_taxonomy() 
     {
     


          $publisher_labels = array(
            'name' => __( 'Publisher', 'taxonomy general name' ),
            'singular_name' => _x( 'Publisher', 'taxonomy singular name' ),
            'search_items' =>  __( 'Search Publishers' ),
            'popular_items' => __( 'Popular Publishers' ),
            'all_items' => __( 'All Publishers' ),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __( 'Edit Publishers' ), 
            'update_item' => __( 'Update Publishers' ),
            'add_new_item' => __( 'Add New Publisher' ),
            'new_item_name' => __( 'New Publisher Name' ),
            'separate_items_with_commas' => __( 'Separate Publishers with commas' ),
            'add_or_remove_items' => __( 'Add or remove Publishers' ),
            'choose_from_most_used' => __( 'Choose from the most used Publishers' ),
            'menu_name' => __( 'Publishers' ),
          );
     
     
          register_taxonomy('publisher','books',array(
            'hierarchical' => false,
            'labels' => $publisher_labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => true,
            'rewrite' => array( 'slug' => 'publisher' ),
          ));
    } 

    function create_authors_taxonomy() 
    {
 

      $authors_labels = array(
        'name' => __( 'Authors', 'taxonomy general name' ),
        'singular_name' => _x( 'Authors', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Authors' ),
        'popular_items' => __( 'Popular Authors' ),
        'all_items' => __( 'All Authors' ),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __( 'Edit Authors' ), 
        'update_item' => __( 'Update Authors' ),
        'add_new_item' => __( 'Add New Author' ),
        'new_item_name' => __( 'New Author Name' ),
        'separate_items_with_commas' => __( 'Separate Authors with commas' ),
        'add_or_remove_items' => __( 'Add or remove Authors' ),
        'choose_from_most_used' => __( 'Choose from the most used Authors' ),
        'menu_name' => __( 'Authors' ),
      );  
 
 
      register_taxonomy('authors','books',array(
        'hierarchical' => false,
        'labels' => $authors_labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'rewrite' => array( 'slug' => 'author' ),
      ));

    }


    function bookshelf_add_custom_box()
    {
        $screens = ['books', 'wporg_cpt'];
        foreach ($screens as $screen) {
            add_meta_box(
                'wporg_box_id',          
                'ISBN',  
                array($this , 'bookshelf_custom_box_html'),
                $screen                   
            );
        }
    }

    function bookshelf_custom_box_html($post)
    {
        ?>
        <label for="isbn_number"><?php echo __('ISBN Number'); ?></label>
        <input type="text" name="isbn_number">

        <?php
    }

    function bookshelf_save_postdata($post_id)
    {
       global $wpdb;
       $table_name = $wpdb->prefix . "books_info";
       
        if (array_key_exists('isbn_number', $_POST)) {
            $wpdb->insert($table_name, array(
                'post_id' => $post_id, 
                'isbn' => $_POST['isbn_number']
             ));
        }
    }

}