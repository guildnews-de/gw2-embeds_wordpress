<?php
/**
 * Plugin Name:       GW2 Embeddings
 * Description:       Implements a shortcode for simplyfied use of the GW2 Armory embeddings
 * Version:           1.0
 * Author:            guildnews.de
 * Author URI:        https://guildnews.de
 * License:           BSD-3 or later
 * License URI:       https://opensource.org/licenses/BSD-3-Clause
 */

if (! defined('WPINC'))
{
    die;
}


/*
 *  some checks during plugin activation
 */

function activate_gw2_embeddings()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class_gw2_emb_activator.php';
    GW2_Embeddings_Activator::activate();
}

register_activation_hook(__FILE__, 'activate_gw2_embeddings');


/*
 *  triggers the main plugin class
 */

function run_gw2_embeddings()
{
    // helper-class with code fragments and som shortcuts
    require_once plugin_dir_path(__FILE__) . 'includes/class_gw2_emb_snip.php';
    // main plugin class
    require_once plugin_dir_path(__FILE__) . 'includes/class_gw2_embeddings.php';

    $plugin = new GW2_Embeddings(__FILE__);
}

run_gw2_embeddings();
