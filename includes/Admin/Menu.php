<?php

namespace Book\Store\Admin;

/**
 * The Menu handler class
 */
class Menu
{

    public $book;

    /**
     * Initialize the class
     */
    function __construct($book)
    {
        $this->book = $book;

        add_action('admin_menu', [$this, 'admin_menu']);
    }

    /**
     * Register admin menu
     *
     * @return void
     */
    public function admin_menu()
    {
        $parent_slug = 'book-store';
        $capability = 'manage_options';

        add_menu_page(__('Book Store', 'book-store'), __('Book Store', 'book-store'), $capability, $parent_slug, [$this->book, 'plugin_page'], 'dashicons-welcome-write-blog');
        add_submenu_page($parent_slug, __('Book', 'book-store'), __('Book', 'book-store'), $capability, $parent_slug, [$this->book, 'plugin_page']);
        // add_submenu_page($parent_slug, __('Settings', 'book-store'), __('Settings', 'book-store'), $capability, 'book-store-settings', [$this, 'settings_page']);
    }

    /**
     * Handles the settings page
     *
     * @return void
     */
    // public function settings_page()
    // {
    //     echo 'Settings Page';
    // }
}