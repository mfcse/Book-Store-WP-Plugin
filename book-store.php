<?php

/**
 * Plugin Name: Book Store
 * Description: A Basic Plugin
 * Plugin URI: 
 * Author: Abdullah Al Maruf
 * Author URI: 
 * Version: 1.0
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

if (!defined('ABSPATH')) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * The main plugin class
 */
final class Book_Store
{

    /**
     * Plugin version
     *
     * @var string
     */
    const version = '1.0';

    /**
     * Class construcotr
     */
    private function __construct()
    {
        $this->define_constants();

        register_activation_hook(__FILE__, [$this, 'activate']);
        register_deactivation_hook(__FILE__, [$this, 'deactivate']);

        add_action('plugins_loaded', [$this, 'init_plugin']);
    }

    /**
     * Initializes a singleton instance
     *
     * @return \Book_Store
     */
    public static function init()
    {
        static $instance = false;

        if (!$instance) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Define the required plugin constants
     *
     * @return void
     */
    public function define_constants()
    {
        define('PLUGIN_VERSION', self::version);
        define('PLUGIN_FILE', __FILE__);
        define('PLUGIN_PATH', __DIR__);
        define('PLUGIN_URL', plugins_url('', PLUGIN_FILE));
        define('PLUGIN_ASSETS', PLUGIN_URL . '/assets');
    }

    /**
     * Initialize the plugin
     *
     * @return void
     */
    public function init_plugin()
    {

        if (is_admin()) {
            new Book\Store\Admin();
        } else {
            new Book\Store\Frontend();
        }
    }

    /**
     * Do stuff upon plugin activation
     *
     * @return void
     */
    public function activate()
    {
        flush_rewrite_rules();
        $installer = new Book\Store\Installer();
        $installer->run();
    }
    /**
     * Do stuff upon plugin deactivation
     *
     * @return void
     */
    public function deactivate()
    {
        flush_rewrite_rules();
    }
}

/**
 * Initializes the main plugin
 *
 * @return \Book_Store
 */
function book_store()
{
    return Book_Store::init();
}

// kick-off the plugin
book_store();