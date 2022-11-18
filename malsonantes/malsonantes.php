<?php
/**
 * Plugin Name:       MALSONANTES
 * Description:       Cambia las palabras malsonantes por otras
 * Version:           1.0
 * Author:            Roi Martínez
 */

function crearTablas() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $table_name1 = $wpdb->prefix . 'palabras_malsonantes';
    $table_name2 = $wpdb->prefix . 'palabras_reemplazo';

    $sql = "CREATE TABLE $table_name1 (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        text text NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    $sql2 = "CREATE TABLE $table_name2 (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        text text NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
    dbDelta( $sql2 );
}
add_action('plugins_loaded', 'crearTablas');



function insertValoresTablas() {
    global $wpdb;
    $table_name1 = $wpdb->prefix . 'palabras_malsonantes';
    $table_name2 = $wpdb->prefix . 'palabras_reemplazo';

    $sql11 = "INSERT INTO $table_name1 (text) VALUES ('pailán')";
    $sql12 = "INSERT INTO $table_name1 (text) VALUES ('imbécil')";
    $sql13 = "INSERT INTO $table_name1 (text) VALUES ('cabrón')";
    $sql14 = "INSERT INTO $table_name1 (text) VALUES ('gilipollas')";
    $sql15 = "INSERT INTO $table_name1 (text) VALUES ('hijo de puta')";

    $sql21 = "INSERT INTO $table_name2 (text) VALUES ('guapo')";
    $sql22 = "INSERT INTO $table_name2 (text) VALUES ('genio')";
    $sql23 = "INSERT INTO $table_name2 (text) VALUES ('cabrón')";
    $sql24 = "INSERT INTO $table_name2 (text) VALUES ('precioso')";
    $sql25 = "INSERT INTO $table_name2 (text) VALUES ('hermosa persona')";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql11);
    dbDelta( $sql12);
    dbDelta( $sql13);
    dbDelta( $sql14);
    dbDelta( $sql15);

    dbDelta( $sql21);
    dbDelta( $sql22);
    dbDelta( $sql23);
    dbDelta( $sql24);
    dbDelta( $sql25);
}
add_action('plugins_loaded', 'insertValoresTablas');


function renym_wordpress_typo_fix( $text ) {
    return str_replace( array("pailán", "imbécil", "cabrón", "gilipollas", "hijo de puta"), '*******', $text );
}

add_filter( 'the_content', 'renym_wordpress_typo_fix' );