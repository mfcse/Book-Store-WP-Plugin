<?php

namespace Book\Store\Frontend;

/**
 * Shortcode handler class
 */
class Shortcode
{

    /**
     * Initializes the class
     */
    function __construct()
    {
        add_shortcode('book-store', [$this, 'render_shortcode']);
    }

    /**
     * Shortcode handler class
     *
     * @param  array $atts
     * @param  string $content
     *
     * @return string
     */
    public function render_shortcode($atts, $content = '')
    {
        return 'Hello from Shortcode';
    }
}