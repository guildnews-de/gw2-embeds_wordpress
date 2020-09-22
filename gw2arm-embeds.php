<?php
/**
 * Plugin Name:       GW2arm-Embeds
 * Description:       Implements a shortcode for simplyfied use of GW2 Armory embeds
 * Version:           0.6
 * Author:            guildnews.de
 * Author URI:        https://guildnews.de
 * License:           BSD-3 or later
 * License URI:       https://opensource.org/licenses/BSD-3-Clause
 */

class GW2arm_embedBasic {

  public $type;
  public $id;
  protected $dom;
  protected $span;

  public function setValues($confArray){
    $this->type = $confArray['type'];
    $this->id = $confArray['id'];
  }

  protected function createEmbed(){
    // create new <div>
    $this->dom = new DOMDocument();
    $this->span = $this->dom->createElement('span');
    // set GW2armory config
    $this->span->setAttribute('data-armory-embed',$this->type);
    $this->span->setAttribute('data-armory-ids',$this->id);
  }

  public function getEmbed(){
    $this->createEmbed();

    $this->dom->appendChild($this->span);
    return $this->dom->saveHTML();
  }
}

class GW2arm_embedDefault extends GW2arm_embedBasic {
  public $text;
  public $blank;
  public $size;
  public $inline;

  public function setValues($confArray){
    foreach ($confArray as $key => $value) {
      switch ($key) {
        case 'type':
          $this->type = $value;
          break;
        case 'id':
          $this->id = $value;
          break;
        case 'text':
          $this->text = $value;
          break;
        case 'blank':
          $this->blank = $value;
          break;
        case 'size':
          $this->size = $value;
          break;
        case 'inline':
          if ($value = '1') {
            $this->inline = TRUE;
            if (!isset($confArray['size'])) {
              $this->size = '20';
            }
          }
          break;
        default:
          break;
      }
    }
  }

  protected function setConfig(){
    if (isset($this->text)) {
      $this->span->setAttribute('data-armory-inline-text',$this->text);
    }
    if (isset($this->blank)) {
      $this->span->setAttribute('data-armory-blank-text',$this->blank);
    }
    if (isset($this->size)) {
      $this->span->setAttribute('data-armory-size',$this->size);
    }
    if (isset($this->inline)) {
      $this->span->setAttribute('style','display: inline-block; vertical-align: bottom;');
    }
  }

  public function getEmbed(){
    $this->createEmbed();
    $this->setConfig();

    $this->dom->appendChild($this->span);
    return $this->dom->saveHTML();
  }

}

class GW2arm_embedsSpec extends GW2arm_embedBasic {
  public $traits;

  public function setValues($confArray){
    $this->type = 'specializations';
    $this->id = $confArray['id'];
    $this->traits = $confArray['traits'];
  }

  protected function setConfig(){
    if (isset($this->traits)) {
      $this->span->setAttribute('data-armory-'.$this->id.'-traits',$this->traits);
    }
  }

  public function getEmbed(){
    $this->createEmbed();
    $this->setConfig();

    $this->dom->appendChild($this->span);
    return $this->dom->saveHTML();
  }
}


// main function called by WP with sc attributes
function gw2arm_shortcode($atts=[]){

  /*
   *  porperly format and filter input sc attributes
   */

  $atts = array_change_key_case( (array) $atts, CASE_LOWER );

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
    ), $atts
  );

  // filter empty keys
  $checked_atts = array_filter($checked_atts);

  /*
   *  trigger create-embedding functions
   */

  if (gw2arm_check_type($checked_atts)) {

    if ($checked_atts['type'] != 'spec') {
      $shortcode = new GW2arm_embedDefault();
    } else {
      $shortcode = new GW2arm_embedsSpec();
    }
    $shortcode->setValues($checked_atts);
    $embed = $shortcode->getEmbed();
  } else {
    $embed = '<p style="display:inline; color:red;"> ~~ unsupported shortcode type <i>"'.$atts['type'].'"</i> ~~ </p>';
  }

  /*
   *  Final Steps
   */

  // check if scripts are added
  wp_enqueue_script( 'armory-embeds.js', "https://unpkg.com/armory-embeds@^0.x.x/armory-embeds.js",NULL,NULL, true );
  wp_enqueue_script( 'GW2arm-Embeds.js', plugins_url("gw2arm-embeds/gw2arm-embeds.js"),NULL,NULL,NULL);

  // give attributes to embed-build-function and return it
  return $embed;

}

// check the sc for valid type
function gw2arm_check_type($with){
  if (in_array($with['type'], array('skills', 'spec', 'items', 'amulets'))) {
    return true;
  } else {
    return false;
  }
}

/**
* Central location to create all shortcodes.
*/
function gw2arm_shortcodes_init() {
  add_shortcode('gw2arm','GW2arm_shortcode');
}

add_action( 'init', 'gw2arm_shortcodes_init' );
