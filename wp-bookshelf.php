<?php
   /*
   Plugin Name: WP Bookshelf
   Plugin URI: http://mozafari.info
   description: Create Awesome Bookshelf
   Version: 1.0
   Author: Ali Mozafari
   Author URI: http://mozafari.info
   License: GPL2
   */


 function installer(){
    include('installer.php');
}
register_activation_hook( __file__, 'installer' );