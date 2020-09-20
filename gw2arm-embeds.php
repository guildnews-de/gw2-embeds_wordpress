<?php
/**
 * Plugin Name:       GW2arm-Embeds
 * Description:       Implements a shortcode for simplyfied use of GW2 Armory embeds
 * Version:           0.4.1
 * Author:            guildnews.de
 * Author URI:        https://guildnews.de
 * License:           BSD-3 or later
 * License URI:       https://opensource.org/licenses/BSD-3-Clause
 */

function gw2arm_shortcode($atts=[]){
  // normalize attribute keys, lowercase
  $atts = array_change_key_case( (array) $atts, CASE_LOWER );

  // override default attributes with user attributes
  $gw2arm_atts = shortcode_atts(
    array(
      'type' => 'skills',
      'id' => '-1',
      'text' => '',
      'traits' => '',
      'inline' => '',
      'size' => '',
    ), $atts
  );

  // check if scripts are added
  wp_enqueue_script( 'armory-embeds.js', "https://unpkg.com/armory-embeds@^0.x.x/armory-embeds.js",NULL,NULL, true );
  wp_enqueue_script( 'GW2arm-Embeds.js', plugins_url("gw2arm-embeds/gw2arm-embeds.js"),NULL,NULL,NULL);

  // give attributes to embed-build-function and return it
  return gw2arm_buildembed($gw2arm_atts);

}

// take shortcode attributes puzzle the embed html
function gw2arm_buildembed($atts){
  $embed = '<div';
  foreach($atts as $with => $val){
    switch ($with) {
      case $val === '':
        break;
      case 'type' :
        $embed .= ' data-armory-embed='.$val;
        break;

      case 'id' :
        $embed .= ' data-armory-ids='.$val;
        break;
      // view inline-title
      case 'text' :
        $embed .= ' data-armory-inline-text="wiki"';
        break;

      case 'traits' :
        $embed .= ' data-armory-'.$atts['id'].'-traits='.$val;
        break;
      // custom mods to view embeds inline
      case 'inline' :
        $embed .= ' style="display: inline-block; vertical-align: bottom;"';
        if ($atts['size'] === '') {
          $embed .= 'data-armory-size="20"';
        }
        break;
      // use custom icon mcrypt_enc_get_supported_key_sizes
      case 'size' :
        $embed .= ' data-armory-size='.$val;
        break;

      default:
        $embed .= '<p> someting went wrong with the embed </p>';
        break;
    }
  }
  // close the div and return to parent
  $embed .='></div>';
  return $embed;
}

/**
* Central location to create all shortcodes.
*/
function gw2arm_shortcodes_init() {
  add_shortcode('gw2arm','GW2arm_shortcode');
}

add_action( 'init', 'gw2arm_shortcodes_init' );
