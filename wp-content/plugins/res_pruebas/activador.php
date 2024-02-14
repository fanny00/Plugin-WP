<?php
global $wpdb;
$charset = $wpdb->get_charset_collate();
$tabla = $wpdb->prefix . "mitabla";

$wpdb->query( "CREATE TABLE IF NOT EXISTS $tabla (
                id mediumint(9) NOT NULL AUTO_INCREMENT,
                nombre varchar(70) NOT NULL,
                PRIMARY KEY(id)) $charset; ");

require_once ( ABSPATH . 'wp-admin/includes/upgrade.php');