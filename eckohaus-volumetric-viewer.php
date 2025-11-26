<?php
/**
 * Plugin Name:       Eckohaus Volumetric Viewer
 * Description:       Volumetric JSON viewer integration for Eckohaus projects.
 * Version:           0.1.0
 * Author:            Eckohaus Ltd
 * Text Domain:       eckohaus-volumetric-viewer
 *
 * @package Eckohaus_Volumetric_Viewer
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// -----------------------------------------------------------------------------
// Plugin constants
// -----------------------------------------------------------------------------

if ( ! defined( 'ECKOHAUS_VOL_VERSION' ) ) {
    define( 'ECKOHAUS_VOL_VERSION', '0.1.0' );
}

if ( ! defined( 'ECKOHAUS_VOL_PLUGIN_DIR' ) ) {
    define( 'ECKOHAUS_VOL_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'ECKOHAUS_VOL_PLUGIN_URL' ) ) {
    define( 'ECKOHAUS_VOL_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

// -----------------------------------------------------------------------------
// Includes
// -----------------------------------------------------------------------------

require_once ECKOHAUS_VOL_PLUGIN_DIR . 'includes/class-eckohaus-vol-assets.php';

// If you already have these, keep them; if names differ, just adjust.
if ( file_exists( ECKOHAUS_VOL_PLUGIN_DIR . 'includes/class-eckohaus-vol-fetcher.php' ) ) {
    require_once ECKOHAUS_VOL_PLUGIN_DIR . 'includes/class-eckohaus-vol-fetcher.php';
}

if ( file_exists( ECKOHAUS_VOL_PLUGIN_DIR . 'includes/class-eckohaus-vol-renderer.php' ) ) {
    require_once ECKOHAUS_VOL_PLUGIN_DIR . 'includes/class-eckohaus-vol-renderer.php';
}

if ( file_exists( ECKOHAUS_VOL_PLUGIN_DIR . 'includes/class-eckohaus-vol-shortcode.php' ) ) {
    require_once ECKOHAUS_VOL_PLUGIN_DIR . 'includes/class-eckohaus-vol-shortcode.php';
}

// -----------------------------------------------------------------------------
// Bootstrap
// -----------------------------------------------------------------------------

function eckohaus_vol_bootstrap() {

    // Assets loader.
    if ( class_exists( 'Eckohaus_Vol_Assets' ) ) {
        Eckohaus_Vol_Assets::init();
    }

    // If your other classes expose static init() methods, call them here:
    if ( class_exists( 'Eckohaus_Vol_Shortcode' ) && method_exists( 'Eckohaus_Vol_Shortcode', 'init' ) ) {
        Eckohaus_Vol_Shortcode::init();
    }

    if ( class_exists( 'Eckohaus_Vol_Fetcher' ) && method_exists( 'Eckohaus_Vol_Fetcher', 'init' ) ) {
        Eckohaus_Vol_Fetcher::init();
    }

    if ( class_exists( 'Eckohaus_Vol_Renderer' ) && method_exists( 'Eckohaus_Vol_Renderer', 'init' ) ) {
        Eckohaus_Vol_Renderer::init();
    }
}
add_action( 'plugins_loaded', 'eckohaus_vol_bootstrap' );
