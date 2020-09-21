<?php
/**
 * Plugin Name:       GW2arm-Embeds
 * Description:       Implements a shortcode for simplyfied use of GW2 Armory embeds
 * Version:           0.4.2
 * Author:            guildnews.de
 * Author URI:        https://guildnews.de
 * License:           BSD-3 or later
 * License URI:       https://opensource.org/licenses/BSD-3-Clause
 */


// main function called by WP with sc attributes
function gw2arm_shortcode($atts=[]){
  // normalize attribute keys, lowercase
  $atts = array_change_key_case( (array) $atts, CASE_LOWER );

  // dummy embed code
  $embed = '<p> ~~dummy~~ </p>';

  if (validate_type($atts)) {
    // WP-function to prepare attr. and evtl. set defaults
    $gw2arm_atts = shortcode_atts(
      array(
        'type' => 'empty',
        'id' => '-1',
        'text' => '',
        'traits' => '',
        'inline' => '',
        'size' => '',
      ), $atts
    );
    $gw2arm_atts = array_filter($gw2arm_atts);
    $embed = gw2arm_embed_puzz($gw2arm_atts);
  } else {
    $embed = '<p style="display:inline; color:red;"> ~~shortcode type <i>"'.$atts['type'].'"</i> not supported~~ </p>';
  }

  // check if scripts are added
  wp_enqueue_script( 'armory-embeds.js', "https://unpkg.com/armory-embeds@^0.x.x/armory-embeds.js",NULL,NULL, true );
  wp_enqueue_script( 'GW2arm-Embeds.js', plugins_url("gw2arm-embeds/gw2arm-embeds.js"),NULL,NULL,NULL);

  // give attributes to embed-build-function and return it
  return wp_kses_post($embed);

}

// check the sc for valid type
function validate_type($with){
  if (in_array($with['type'], array('skills', 'specializations', 'items', 'amulets'))) {
    return true;
  } else {
    return false;
  }
}

// take shortcode-attributes to puzzle the embed html
function gw2arm_embed_puzz($atts){
  $puzzle = '<div';
  foreach($atts as $with => $val){
    switch ($with) {
      case $val === '':
        break;
      case 'type' :
        $puzzle .= ' data-armory-embed='.$val;
        break;

      case 'id' :
        $puzzle .= ' data-armory-ids='.$val;
        break;
      // view inline-title
      case 'text' :
        $puzzle .= ' data-armory-inline-text="wiki"';
        break;

      case 'traits' :
        $puzzle .= ' data-armory-'.$atts['id'].'-traits='.$val;
        break;
      // custom mods to view embeds inline
      case 'inline' :
        $puzzle .= ' style="display: inline-block; vertical-align: bottom;"';
        if (!$atts['size']) {
          $puzzle .= 'data-armory-size="20"';
        }
        break;
      // use custom icon size
      case 'size' :
        $puzzle .= ' data-armory-size='.$val;
        break;

      default:
        break;
    }
  }
  // close the div and return to parent
  $puzzle .='></div>';
  return $puzzle;
}

/**
* Central location to create all shortcodes.
*/
function gw2arm_shortcodes_init() {
  add_shortcode('gw2arm','GW2arm_shortcode');
}

add_action( 'init', 'gw2arm_shortcodes_init' );
