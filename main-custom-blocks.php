<?php
/**
 * Plugin Name: Dermatology Affiliates Custom Blocks
 * Description: A collection of custom Gutenberg blocks using ACF.
 * Version:     2.4.0
 * Author:      DIGITAL ATLAS
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'DAGB_VERSION', '2.4.0' );
define( 'DAGB_FILE', __FILE__ );
define( 'DAGB_DIR', plugin_dir_path( __FILE__ ) );

// Updates from GitHub Releases (see includes/updater.php).
require_once DAGB_DIR . 'includes/updater.php';

// ==========================================
// THIS IS STEP 2: Dynamically register all blocks
// ==========================================
add_action( 'init', 'register_my_custom_plugin_blocks' );
function register_my_custom_plugin_blocks() {
    if ( ! function_exists( 'register_block_type' ) ) {
        return;
    }

    // Find all subdirectories inside the /blocks/ folder
    $blocks_dir = __DIR__ . '/blocks/';
    $blocks     = glob( $blocks_dir . '*', GLOB_ONLYDIR );

    // Loop through each folder and register the block
    if ( $blocks ) {
        foreach ( $blocks as $block ) {
            register_block_type( $block );
        }
    }
}

// ==========================================
// ACF JSON LOAD FILTER
// ==========================================
add_filter('acf/settings/load_json', 'my_custom_blocks_load_json');
function my_custom_blocks_load_json( $paths ) {
    // Append the plugin's acf-json folder to the paths array
    $paths[] = plugin_dir_path( __FILE__ ) . 'acf-json';
    return $paths;
}
// ==========================================
// ACF UI TEXT TWEAKS
// ==========================================
// ACF's link field hard-codes the "Select Link" button label. Shorten it so it
// fits when a block's fields are shown in the narrow editor sidebar.
add_filter( 'gettext', 'my_custom_blocks_acf_link_label', 10, 3 );
function my_custom_blocks_acf_link_label( $translated, $text, $domain ) {
    if ( 'acf' === $domain && 'Select Link' === $text ) {
        return 'Link';
    }
    return $translated;
}
