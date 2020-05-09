<?php

/**
 * Helper plugin for Oxygen Builder.
 * 
 * @wordpress-plugin
 * Plugin Name: 	Customize Oxygen Builder
 * Plugin URI: 		https://www.paulchinmoy.com
 * Description: 	A helper plugin to customize the Oxygen Builder site
 * Author: 			Paul Chinmoy
 * Author URI: 		https://www.paulchinmoy.com
 *
 * Version: 		1.0
 *
 * License: 		GPLv2 or later
 * License URI: 	http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Text Domain: 	paulc-edit-oxybuilder
 * Domain Path: 	languages  
 */

/**
 * Copyright (c) 2020 Paul Chinmoy. All rights reserved.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 */

//* Prevent direct access to the plugin
if ( !defined( 'ABSPATH' ) ) {
  wp_die( __( "Sorry, you are not allowed to access this page directly.", 'paulc-edit-oxybuilder' ) );
}

//* Define constants
define( 'PWP_VERSION', 	'1.0' );
define( 'PWP_FILE', 	trailingslashit( dirname( __FILE__ ) ) . 'paulc-edit-oxybuilder.php' );
define( 'PWP_DIR', 		plugin_dir_path( PWP_FILE ) );
define( 'PWP_URL', 		plugins_url( '/', PWP_FILE ) );

//* Activate plugin
register_activation_hook( __FILE__, 'pauloxyb_activate' );

add_action( 'plugins_loaded', 		'pauloxyb_load_textdomain' );
add_action( 'admin_init', 			'pauloxyb_activate' );
add_action( 'switch_theme', 		'pauloxyb_activate' );

/**
 * Activate plugin
 */ 
function pauloxyb_activate()
{
	if ( ! class_exists('OxygenElement') )
	{
		//* Deactivate ourself
		deactivate_plugins( __FILE__ );
		add_action( 'admin_notices', 			'pauloxyb_admin_notice_message' );
		add_action( 'network_admin_notices', 	'pauloxyb_admin_notice_message' );
		return;	
	}
}

/**
 * Shows an admin notice if you're not using the Oxygen Builder Plugin.
 */
function pauloxyb_admin_notice_message()
{
	if ( ! is_admin() ) {
		return;
	}
	else if ( ! is_user_logged_in() ) {
		return;
	}
	else if ( ! current_user_can( 'update_core' ) ) {
		return;
	}

	$error = __( 'Sorry, you can\'t use the Customize Oxygen Builder plugin unless the Oxygen Builder Plugin is active. The plugin has been deactivated.', 'paulc-edit-oxybuilder' );

	echo '<div class="error"><p>' . $error . '</p></div>';

	if ( isset( $_GET['activate'] ) )
	{
		unset( $_GET['activate'] );
	}
}


/**
 * Loads text domain.
 */ 
function pauloxyb_load_textdomain()
{
	//* Load textdomain for translation 
	load_plugin_textdomain( 'paulc-edit-oxybuilder', false, basename( PWP_DIR ) . '/languages' );
}
