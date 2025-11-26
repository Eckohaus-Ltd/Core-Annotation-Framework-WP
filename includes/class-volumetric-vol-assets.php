<?php
/**
 * Handles registration and enqueueing of public assets
 * for the Eckohaus Volumetric Viewer plugin.
 *
 * @package Eckohaus_Volumetric_Viewer
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Eckohaus_Vol_Assets' ) ) {

    class Eckohaus_Vol_Assets {

        /**
         * Set up hooks.
         */
        public static function init() {
            // Register scripts/styles early.
            add_action( 'init', array( __CLASS__, 'register' ) );

            // Enqueue on the front-end.
            add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue' ) );
        }

        /**
         * Register scripts and styles.
         *
         * Uses plugin constants if defined, otherwise falls back.
         */
        public static function register() {

            $plugin_url  = defined( 'ECKOHAUS_VOL_PLUGIN_URL' )
                ? ECKOHAUS_VOL_PLUGIN_URL
                : plugin_dir_url( dirname( __FILE__ ) );

            $version     = defined( 'ECKOHAUS_VOL_VERSION' )
                ? ECKOHAUS_VOL_VERSION
                : '0.1.0';

            // JS: main volumetric viewer script.
            wp_register_script(
                'eckohaus-vol-viewer',
                $plugin_url . 'assets/js/volviewer.js',
                array( 'jquery' ),
                $version,
                true
            );

            // CSS: main viewer styles.
            wp_register_style(
                'eckohaus-vol-style',
                $plugin_url . 'assets/css/volviewer.css',
                array(),
                $version
            );
        }

        /**
         * Enqueue previously registered assets on the public-facing side.
         */
        public static function enqueue() {

            // Avoid loading in admin screens.
            if ( is_admin() ) {
                return;
            }

            // If you later want to only load on certain pages,
            // you can add conditional checks here (e.g. has_shortcode()).

            wp_enqueue_script( 'eckohaus-vol-viewer' );
            wp_enqueue_style( 'eckohaus-vol-style' );
        }
    }
}
