<?php

namespace Actions;

require_once(plugin_dir_path( __FILE__) . 'Books_List.php');

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

      $myListTable = new \Books_List();
      ?>
      <div class="wrap">
        <h2>My Bookshelf Info</h2>

        <div id="poststuff">
          <div id="post-body" class="metabox-holder columns-2">
            <div id="post-body-content">
              <div class="meta-box-sortables ui-sortable">
                <form method="post">
                  <?php
                  $myListTable->prepare_items();
                  $myListTable->display(); ?>
                </form>
              </div>
            </div>
          </div>
          <br class="clear">
        </div>
      </div>
    <?php
    }

}