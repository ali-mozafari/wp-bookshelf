<?php

namespace Actions;


class Bookshelf_Menu_Page
{
     
    /* Class constructor */
    public function __construct()
    {

        add_action( 'admin_menu', array($this , 'bookshelf_admin_menu' ) );

    }

    function bookshelf_admin_menu() {

        add_submenu_page('edit.php?post_type=books', __('Books info','wp-bookshelf'), __('Books info','wp-bookshelf'), 'manage_options', 'books_info' , array($this , 'bookshelf_admin_page') );

    }


    function bookshelf_admin_page(){
       ?>
       <div class="wrap">
          <h2>Welcome To ‌Bookshelf Plugin</h2>
       </div>
    <?php
    }

}