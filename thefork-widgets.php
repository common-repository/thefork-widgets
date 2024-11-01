<?php
/*
Plugin Name: TheFork Widgets
Plugin URI: https://github.com/thefork-widgets
Description: Install the Thefork reservation widget by shortcodes
Author: TheFork widget installers
Version: 2.0.7
Author URI: https://theforkmanager.com/widgets
Text Domain: thefork-widgets

*/

defined('ABSPATH') or die("Bye bye");

define('TFW_PATH', plugin_dir_path(__FILE__));
define( 'TFW_URL', esc_url( plugin_dir_url( __FILE__ ) ) );



include(TFW_PATH.'/includes/admin.php');
include(TFW_PATH . '/includes/shortcodes.php');
include(TFW_PATH . '/includes/button.php');




