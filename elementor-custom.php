<?php
/**
 * @link https://theomartin.fr
 * @since 1.0.0
 * @package LOPA
 *
 * Plugin Name: Elementor Custom
 * Plugin URI: https://theomartin.fr/
 * Description: Bloc customisé pour Elementor Pro.
 * Author: Théo Martin
 * Author URI: https://theomartin.fr/
 * Version: 1.0
 * License: GPL2+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) exit;
define('ECW_PLUGIN_PLUGIN_PATH', plugin_dir_path( __FILE__ ));


// plug it in
add_action('plugins_loaded', 'ecw_require_files');
function ecw_require_files() {
    require_once ECW_PLUGIN_PLUGIN_PATH.'modules.php';
}


// enqueue your custom style/script as your requirements
// add_action( 'wp_enqueue_scripts', 'ecw_enqueue_styles', 25);
function ecw_enqueue_styles() {
    wp_enqueue_style( 'elementor-custom-editor', ECW_PLUGIN_PLUGIN_PATH( __FILE__ ) . 'assets/css/editor.css');
}