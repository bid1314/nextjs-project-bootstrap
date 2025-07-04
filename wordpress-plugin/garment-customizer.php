<?php
/*
Plugin Name: Garment Customizer
Description: A WordPress plugin to customize garments with layers, colors, logos, and text.
Version: 0.1.0
Author: Your Name
Text Domain: garment-customizer
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// Include custom post types
require_once plugin_dir_path( __FILE__ ) . 'includes/custom-post-types.php';

// Include REST API handlers
require_once plugin_dir_path( __FILE__ ) . 'includes/rest-api.php';

// Enqueue scripts and styles
function gc_enqueue_scripts() {
    wp_enqueue_style( 'gc-tailwind', plugin_dir_url( __FILE__ ) . 'assets/css/tailwind.css', array(), '3.4.1' );
    wp_enqueue_script( 'gc-react-app', plugin_dir_url( __FILE__ ) . 'assets/js/customizer.js', array( 'wp-element' ), '0.1.0', true );
}
add_action( 'wp_enqueue_scripts', 'gc_enqueue_scripts' );

// Register shortcode for frontend React app
function gc_customizer_shortcode() {
    return '<div id="gc-customizer-root"></div>';
}
add_shortcode( 'garment_customizer', 'gc_customizer_shortcode' );

// REST API routes and handlers will be added here


?>
