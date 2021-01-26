<?php

/**
 * Insert a new address
 *
 * @param  array  $args
 *
 * @return int|WP_Error
 */
function insert_book($args = [])
{
    global $wpdb;

    if (empty($args['name'])) {
        return new \WP_Error('no-name', __('You must provide a Book name.', 'book-store'));
    }

    $defaults = [
        'name'       => '',
        'description'    => '',
        'author'      => '',
        'created_by' => get_current_user_id(),
        'created_at' => current_time('mysql'),
    ];

    $data = wp_parse_args($args, $defaults);

    if ($data['id']) {
        $id = $data['id'];
        unset($data['id']);

        $updated = $wpdb->update(
            $wpdb->prefix . 'books',
            $data,
            ['id' => $id],
            [
                '%s',
                '%s',
                '%s',
                '%d',
                '%s'
            ],
            ['%d']
        );
        return $updated;
    } else {
        $inserted = $wpdb->insert(
            $wpdb->prefix . 'books',
            $data,
            [
                '%s',
                '%s',
                '%s',
                '%d',
                '%s'
            ]
        );
        if (!$inserted) {
            return new \WP_Error('failed-to-store', __('Failed to store book', 'book-store'));
        }
        return $wpdb->insert_id;
    }
}

function get_books($args = [])
{
    global $wpdb;

    $defaults = [
        'number' => 20,
        'offset' => 0,
        'orderby' => 'id',
        'order' => 'ASC'
    ];
    $args = wp_parse_args($args, $defaults);

    $items = $wpdb->get_results($wpdb->prepare(
        "SELECT * FROM {$wpdb->prefix}books
    ORDER BY {$args['orderby']} {$args['order']}
    LIMIT %d, %d",
        $args['offset'],
        $args['number']
    ));
    return $items;
}

function book_count()
{
    global $wpdb;
    return (int) $wpdb->get_var("SELECT COUNT(id) FROM {$wpdb->prefix}books");
}
function get_book($id)
{
    global $wpdb;
    return $wpdb->get_row(
        $wpdb->prepare("SELECT * FROM {$wpdb->prefix}books WHERE id=%d", $id)
    );
}
function delete_book($id)
{
    global $wpdb;
    return $wpdb->delete(
        $wpdb->prefix . 'books',
        ['id' => $id],
        ['%d']
    );
}