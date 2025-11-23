<?php
/**
 * Plugin Name: Eckohaus Volumetric Viewer
 * Plugin URI: https://github.com/Eckohaus/eckohaus-wp
 * Description: Renders 3D volumetric data exported from Eckohaus scientific repos.
 * Version: 0.1.0
 * Author: Eckohaus
 * License: MIT
 *
 * This plugin is part of the Eckohaus WP Framework. Scientific content displayed
 * via this plugin remains © Eckohaus. External datasets retain original licences.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'ECKOHAUS_VOL_VIEWER_PATH', plugin_dir_path( __FILE__ ) );
define( 'ECKOHAUS_VOL_VIEWER_URL', plugin_dir_url( __FILE__ ) );

// Load dependencies
require_once ECKOHAUS_VOL_VIEWER_PATH . 'includes/class-eckohaus-vol-shortcode.php';
require_once ECKOHAUS_VOL_VIEWER_PATH . 'includes/class-eckohaus-vol-fetcher.php';
require_once ECKOHAUS_VOL_VIEWER_PATH . 'includes/class-eckohaus-vol-renderer.php';

// Init shortcode
add_action( 'plugins_loaded', function() {
    new Eckohaus_Vol_Shortcode();
});
