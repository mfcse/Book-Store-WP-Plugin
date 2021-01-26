<?php

namespace Book\Store;

/**
 * The admin class
 */
class Admin
{

    /**
     * Initialize the class
     */
    function __construct()
    {
        $book = new Admin\Bookstore();

        $this->dispatch_actions($book);

        new Admin\Menu($book);
    }

    /**
     * Dispatch and bind actions
     *
     * @return void
     */
    public function dispatch_actions($book)
    {
        add_action('admin_init', [$book, 'form_handler']);
        add_action('admin_post_delete-book', [$book, 'delete_book']);
    }
}