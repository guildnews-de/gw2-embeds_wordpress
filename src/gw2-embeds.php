<?php
/**
 * Plugin Name:       GW2 Embeds
 * Description:       Adds shortcodes to show various GW2 info in WordPress
 * Version:           2.0.beta21
 * Author:            guildnews.de
 * Author URI:        https://guildnews.de
 * License:           BSD-3 or later
 * License URI:       https://opensource.org/licenses/BSD-3-Clause
 *
 * @package GW2Embeds
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 *  Some checks during plugin activation
 */
function gw2emb_activate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-gw2emb-activator.php';
	GW2Emb_Activator::activate();
}

register_activation_hook( __FILE__, 'gw2emb_activate' );

/**
 *  Triggers the main plugin class
 */
function gw2emb_run() {
	// main plugin class.
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-gw2embeds.php';

	$plugin = new GW2Embeds( __FILE__ );
}

gw2emb_run();
