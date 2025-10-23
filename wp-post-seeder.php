<?php
/**
 * Plugin Name: WP Post Seeder
 * Description: A lightweight WordPress plugin that seeds posts for development and testing.
 * Version: 1.0.0
 * Author: Yan Yedomakha
 * Author URI: https://github.com/YedomakhaDev
 * Text Domain: wp-post-seeder
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Define constants.
$plugin_data = get_file_data( __FILE__, [ 'Version' => 'Version' ], 'plugin' );

define( 'WPPS_VERSION', $plugin_data['Version'] ?? '1.0.0' );
define( 'WPPS_PATH', plugin_dir_path( __FILE__ ) );
define( 'WPPS_URL', plugin_dir_url( __FILE__ ) );

// Autoload via Composer.
require_once WPPS_PATH . 'vendor/autoload.php';

// Load helper functions (if you have global helpers).
require_once WPPS_PATH . 'includes/helpers.php';

// Initialize plugin after all plugins are loaded.
add_action( 'plugins_loaded', [ 'WPPS\Core\\Loader', 'init' ] );