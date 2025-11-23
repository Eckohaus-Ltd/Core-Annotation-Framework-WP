<?php

class Eckohaus_Vol_Shortcode {

    public function __construct() {
        add_shortcode( 'eckohaus_volume', [ $this, 'render_shortcode' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'register_assets' ] );
    }

    public function register_assets() {
        wp_register_script(
            'eckohaus-vol-viewer',
            ECKOHAUS_VOL_VIEWER_URL . 'assets/js/viewer.js',
            [],
            '0.1.0',
            true
        );

        wp_register_style(
            'eckohaus-vol-style',
            ECKOHAUS_VOL_VIEWER_URL . 'assets/css/viewer.css',
            [],
            '0.1.0'
        );
    }

    public function render_shortcode( $atts ) {
        $atts = shortcode_atts([
            'url' => '',
        ], $atts );

        if ( empty( $atts['url'] ) ) {
            return '<p>No volumetric data URL supplied.</p>';
        }

        wp_enqueue_script( 'eckohaus-vol-viewer' );
        wp_enqueue_style( 'eckohaus-vol-style' );

        // Pass URL to JS
        wp_localize_script(
            'eckohaus-vol-viewer',
            'EckohausVolData',
            [ 'url' => esc_url_raw( $atts['url'] ) ]
        );

        return '<div id="eckohaus-vol-container"></div>';
    }
}
