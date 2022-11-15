<?php

/**
 * Plugin Name: MALSONANTES
 */

function cambiar_malsonantes( $text ) {
    return str_replace( array("pailán", "imbécil", "cabrón", "gilipollas", "hijo de puta"), '*******', $text );
}

add_filter( 'the_content', 'cambiar_malsonantes' );
