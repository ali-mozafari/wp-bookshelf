<?php
/**
 * Plugin Name: WP Bookshelf
 * Description: An Awesome Wordpress Plugin Bookshelf
 * Plugin URI:  https://veronalabs.com
 * Version:     1.0
 * Author:      Ali Mozafari
 * Author URI:  https://mozafari.info
 * License:     MIT
 * Text Domain: bookshelf-wordpress-plugin
 */

// error_reporting(E_ALL);
// ini_set('display_errors', 1);


add_action('plugins_loaded', array(WP_Bookshelf_Plugin::get_instance(), 'plugin_setup'));

class WP_Bookshelf_Plugin
{
    /**
     * Plugin instance.
     *
     * @see get_instance()
     * @type object
     */
    protected static $instance = NULL;
    /**
     * URL to this plugin's directory.
     *
     * @type string
     */
    public $plugin_url = '';
    /**
     * Path to this plugin's directory.
     *
     * @type string
     */
    public $plugin_path = '';

    /**
     * Access this plugin’s working instance
     *
     * @wp-hook plugins_loaded
     * @since   2012.09.13
     * @return  object of this class
     */
    public static function get_instance()
    {
        NULL === self::$instance and self::$instance = new self;
        return self::$instance;
    }

    /**
     * Used for regular plugin work.
     *
     * @wp-hook plugins_loaded
     * @return  void
     */
    public function plugin_setup()
    {
        $this->plugin_url = plugins_url('/', __FILE__);
        $this->plugin_path = plugin_dir_path(__FILE__);
        $this->load_language('wp_bookshelf');

        spl_autoload_register(array($this, 'autoload'));

        // Example: Modify the Contents
        //Actions\Post::addEmojiToContents();
        register_activation_hook( __file__, Installer\Database::create_database() );

        $Bookshelf_Post_Type = new Actions\Bookshelf_Post_Type; 
        $Bookshelf_Menu_Page = new Actions\Bookshelf_Menu_Page;  
 

    }

    /**
     * Constructor. Intentionally left empty and public.
     *
     * @see plugin_setup()
     */
    public function __construct()
    {
    }

    /**
     * Loads translation file.
     *
     * Accessible to other classes to load different language files (admin and
     * front-end for example).
     *
     * @wp-hook init
     * @param   string $domain
     * @return  void
     */
    public function load_language($domain)
    {
        load_plugin_textdomain($domain, FALSE, $this->plugin_path . '/languages');
    }

    /**
     * @param $class
     *
     */
    public function autoload($class)
    {
        $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

        if (!class_exists($class)) {
            $class_full_path = $this->plugin_path . 'includes/' . $class . '.php';

            if (file_exists($class_full_path)) {
                require $class_full_path;
            }
        }
    }
}
