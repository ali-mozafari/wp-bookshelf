<?php 
global $wpdb;
$table_name = $wpdb->prefix . "books_info";
$my_products_db_version = '1.0.0';
$charset_collate = $wpdb->get_charset_collate();

if ( $wpdb->get_var( "SHOW TABLES LIKE '{$table_name}'" ) != $table_name ) {

    $sql = "CREATE TABLE $table_name (
            ID bigint(20) NOT NULL AUTO_INCREMENT,
            `post_id` bigint(20) NOT NULL,
            `isbn` text NOT NULL,
            PRIMARY KEY  (ID)
    )    $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

