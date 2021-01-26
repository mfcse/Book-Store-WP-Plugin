<?php


//Trigger this file on Plugin uninstall


if (!defined('WP_UNINSTALL_PLUGIN')) {
	die;
}

// Clear Database stored data



global $wpdb;
$wpdb->query("DROP TABLE {$wpdb->prefix}books");
