<?php

/**
 * Shortcode handler for [eckohaus_volume].
 */

class Eckohaus_Vol_Shortcode {

    /**
     * Register shortcode.
     */
    public function __construct() {
        add_shortcode( 'eckohaus_volume', [ $this, 'render_shortcode' ] );
    }


    /**
     * Render shortcode output.
     *
     * Example usage:
     * [eckohaus_volume url="https://…/example.json"]
     */
    public function render_shortcode( $atts ) {

        // Shortcode attributes
        $atts = shortcode_atts(
            [
                'url' => '',
            ],
            $atts
        );

        $json_url = trim( $atts['url'] );

        if ( empty( $json_url ) ) {
            return '<p style="color:#b00;">Eckohaus Viewer: No URL provided.</p>';
        }

        // ---------------------------------------------------------
        // ENQUEUE ASSETS
        // (Assets are registered in class-eckohaus-vol-assets.php)
        // ---------------------------------------------------------
        wp_enqueue_script( 'eckohaus-vol-viewer' );
        wp_enqueue_style( 'eckohaus-vol-style' );

        // Pass JSON URL to viewer.js
        wp_localize_script(
            'eckohaus-vol-viewer',
            'EckohausVolData',
            [
                'url' => esc_url_raw( $json_url ),
            ]
        );

        // ---------------------------------------------------------
        // DEBUG + VISIBLE CONTAINER
        // ---------------------------------------------------------
        $html  = '<div class="eckohaus-vol-debug" style="padding:12px; border:1px solid #ccc; margin:20px 0;">';
        $html .= '<strong>Eckohaus Volumetric Viewer shortcode is active.</strong><br>';
        $html .= 'JSON Source: <code style="font-size:12px;">' . esc_html( $json_url ) . '</code>';
        $html .= '</div>';

        // Main container for viewer.js to attach to
        $html .= '<div id="eckohaus-vol-container" style="width:100%; height:400px; border:1px dashed #999; margin-top:10px;"></div>';

        return $html;
    }
}
