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
        id mediumint(9) NOT NULL,
        text text NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    $sql2 = "CREATE TABLE $table_name2 (
        id mediumint(9) NOT NULL,
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

    $sql11 = "INSERT INTO $table_name1 (id, text) VALUES (1, 'pailán')";
    $sql12 = "INSERT INTO $table_name1 (id, text) VALUES (2, 'imbécil')";
    $sql13 = "INSERT INTO $table_name1 (id, text) VALUES (3, 'cabrón')";
    $sql14 = "INSERT INTO $table_name1 (id, text) VALUES (4, 'gilipollas')";
    $sql15 = "INSERT INTO $table_name1 (id, text) VALUES (5, 'hijo de puta')";

    $sql21 = "INSERT INTO $table_name2 (id, text) VALUES (1, 'guapo')";
    $sql22 = "INSERT INTO $table_name2 (id, text) VALUES (2, 'genio')";
    $sql23 = "INSERT INTO $table_name2 (id, text) VALUES (3, 'cabrón')";
    $sql24 = "INSERT INTO $table_name2 (id, text) VALUES (4, 'precioso')";
    $sql25 = "INSERT INTO $table_name2 (id, text) VALUES (5, 'hermosa persona')";

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


function reescribir_malsonantes( $text ) {
    global $wpdb;
    $table_malsonantes = $wpdb->prefix . 'palabras_malsonantes';
    $table_reemplazo = $wpdb->prefix . 'palabras_reemplazo';

    $queryMalsonantes = $wpdb->get_results( "SELECT text FROM $table_malsonantes");
    $queryReemplazos = $wpdb->get_results("SELECT text FROM $table_reemplazo");

    $malsonantes = array();
    for ($i = 0; $i < sizeof($queryMalsonantes); $i++) {
        $malsonantes[] = $queryMalsonantes[$i]->text;
    }

    $reemplazos = array();
    for ($i = 0; $i < sizeof($queryReemplazos); $i++) {
        $reemplazos[] = $queryReemplazos[$i]->text;
    }

    return str_replace( $malsonantes, $reemplazos, $text);
}
add_filter('the_content', 'reescribir_malsonantes');
