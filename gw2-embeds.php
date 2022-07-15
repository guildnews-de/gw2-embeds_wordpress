<?php
/**
 * Plugin Name:       GW2 Embeddings
 * Description:       Implements a shortcode for simplyfied use of the GW2 Armory embeddings
 * Version:           1.0.1
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
	GW2_Embeddings_Activator::activate();
}

register_activation_hook( __FILE__, 'gw2emb_activate' );


/**
 *  Triggers the main plugin class
 */
function gw2emb_run() {
	// helper-class with code fragments and som shortcuts.
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-gw2emb-snip.php';
	// main plugin class.
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-gw2emb-main.php';

	$plugin = new GW2_Embeddings( __FILE__ );
}

gw2emb_run();
