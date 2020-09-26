<?php
/**
 * Plugin Name:       GW2arm-Embeds
 * Description:       Implements a shortcode for simplyfied use of GW2 Armory embeds
 * Version:           0.6.1
 * Author:            guildnews.de
 * Author URI:        https://guildnews.de
 * License:           BSD-3 or later
 * License URI:       https://opensource.org/licenses/BSD-3-Clause
 */


include 'gw2arm_class_main.php';
include 'gw2arm_class_embeds.php';

/*
 *  main function called by WP with sc attributes
 */

function gw2arm_shortcode($atts=[])
{

    // porperly format and filter input sc attributes

    $atts = array_change_key_case((array) $atts, CASE_LOWER);

    // WP-function to prepare attr. and evtl. set defaults
    $checked_atts = shortcode_atts(
        array(
      'type' => 'skills',
      'id' => '-1',
      'text' => '',
      'traits' => '',
      'inline' => '',
      'size' => '',
      'blank' => '',
    ),
        $atts
    );

    // filter empty keys
    $checked_atts = array_filter($checked_atts);

    if (!gw2arm_check_type($checked_atts)) {
        $error = '<p style="display:inline; color:red;"> ~~ unexpected shortcode type <i>"'.$atts['type'].'"</i> ~~ </p>';
        return $error;
    }


    //  trigger create-embedding functions


    if ($checked_atts['type'] != 'spec') {
        if (sizeof($checked_atts) == 2) {
            $shortcode = new GW2arm_embedBasic();
        } else {
            $shortcode = new GW2arm_embedDefault();
        }
    } else {
        $shortcode = new GW2arm_embedsSpec();
    }
    $shortcode->setValues($checked_atts);
    $embed = $shortcode->getEmbed();



    //  Final Steps


    // check if scripts are added
    wp_enqueue_script('armory-embeds.js', "https://unpkg.com/armory-embeds@^0.x.x/armory-embeds.js", null, null, true);
    wp_enqueue_script('GW2arm-Embeds.js', plugins_url("gw2arm-embeds/gw2arm-embeds.js"), null, null, null);

    // give attributes to embed-build-function and return it
    return $embed;
}

// check the sc for valid type
function gw2arm_check_type($with)
{
    if (in_array($with['type'], array('skills', 'spec', 'items', 'amulets'))) {
        return true;
    } else {
        return false;
    }
}

/**
* Central location to create all shortcodes.
*/
function gw2arm_shortcodes_init()
{
    add_shortcode('gw2arm', 'GW2arm_shortcode');
}

add_action('init', 'gw2arm_shortcodes_init');
