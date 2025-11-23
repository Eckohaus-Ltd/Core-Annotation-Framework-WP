<?php

class Eckohaus_Vol_Fetcher {
    public static function fetch_json( $url ) {
        $response = wp_remote_get( $url );

        if ( is_wp_error( $response ) ) {
            return false;
        }

        return json_decode( wp_remote_retrieve_body( $response ), true );
    }
}
