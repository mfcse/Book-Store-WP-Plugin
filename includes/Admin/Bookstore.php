<?php

namespace Book\Store\Admin;

use Book\Store\Traits\Form_Error;

/**
 * bookbook Handler class
 */
class Bookstore
{
    use Form_Error;

    /**
     * Plugin page handler
     *
     * @return void
     */
    public function plugin_page()
    {
        $action = isset($_GET['action']) ? $_GET['action'] : 'list';
        $id = isset($_GET['id']) ? $_GET['id'] : 0;

        switch ($action) {
            case 'new':
                $template = __DIR__ . '/views/book-new.php';
                break;

            case 'edit':
                $book = get_book($id);
                $template = __DIR__ . '/views/book-edit.php';
                break;

            case 'view':
                $template = __DIR__ . '/views/book-view.php';
                break;

            default:
                $template = __DIR__ . '/views/book-list.php';
                break;
        }

        if (file_exists($template)) {
            include $template;
        }
    }

    /**
     * Handle the form
     *
     * @return void
     */
    public function form_handler()
    {
        if (!isset($_POST['submit_book'])) {
            return;
        }

        if (!wp_verify_nonce($_POST['_wpnonce'], 'new-book')) {
            wp_die('Are you cheating?');
        }

        if (!current_user_can('manage_options')) {
            wp_die('Are you cheating?');
        }
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $name    = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
        $description = isset($_POST['description']) ? sanitize_textarea_field($_POST['description']) : '';
        $author   = isset($_POST['author']) ? sanitize_text_field($_POST['author']) : '';

        if (empty($name)) {
            $this->errors['name'] = __('Please provide a Book name', 'book-store');
        }

        if (empty($author)) {
            $this->errors['author'] = __('Please provide a Author name.', 'book-store');
        }

        if (!empty($this->errors)) {
            return;
        }
        $args = [
            'name'    => $name,
            'description' => $description,
            'author'   => $author
        ];
        if ($id) {
            $args['id'] = $id;
        }
        $insert_id = insert_book($args);

        if (is_wp_error($insert_id)) {
            wp_die($insert_id->get_error_message());
        }

        if ($id) {
            $redirected_to = admin_url('admin.php?page=book-store&action=edit&book-updated=true&id=' . $id);
        } else {
            $redirected_to = admin_url('admin.php?page=book-store&inserted=true');
        }
        wp_redirect($redirected_to);
        exit;
    }
    public function delete_book()
    {
        if (!wp_verify_nonce($_REQUEST['_wpnonce'], 'delete-book')) {
            wp_die('Are you cheating?');
        }

        if (!current_user_can('manage_options')) {
            wp_die('Are you cheating?');
        }
        $id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;

        if (delete_book($id)) {
            $redirected_to = admin_url('admin.php?page=book-store&book-deleted=true');
        } else {
            $redirected_to = admin_url('admin.php?page=book-store&book-deleted=false');
        }
        wp_redirect($redirected_to);
        exit;
    }
}