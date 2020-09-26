<?php

class GW2arm_shortcode
{
  private $shortcode_atts;
  private $embedding;
  private $gw2arm_error;

  public function parse_attributes($input_atts){

    $output_atts = format_atts($input_atts);

    if (has_valid_type($output_atts)) {
      $this->shortcode_atts = $output_atts;
    } else {
      $this->error('type not supported');
    }
  }

  private function format_atts($raw_atts){
    $raw_atts = array_change_key_case((array) $raw_atts, CASE_LOWER);

    // WP-function to prepare attr. and evtl. set defaults
    $form_atts = shortcode_atts(
        array(
      'type' => 'skills',
      'id' => '-1',
      'text' => '',
      'traits' => '',
      'inline' => '',
      'size' => '',
      'blank' => '',
    ),
        $raw_atts
    );

    // eliminate spaces between ids
    $form_atts['id'] = preg_replace('/\s+/', '', $form_atts['id']);
    $form_atts['traits'] = preg_replace('/\s+/', '', $form_atts['traits']);

    // filter empty keys
    $form_atts = array_filter($form_atts);

    return $form_atts;
  }

  private function has_valid_type($with){
    if (in_array($with['type'], array('skills', 'spec', 'items', 'amulets'))) {
        return true;
    } else {
        return false;
    }
  }

  public function get_embedding(){
    if ($shortcode_atts['type'] != 'spec') {
        if (2 === sizeof($shortcode_atts)) {
            $builder = new GW2arm_embed_basic();
        } else {
            $builder = new GW2arm_embed_default();
        }
    } else {
        $builder = new GW2arm_embed_spec();
    }
    $builder->set_values($shortcode_atts);
    $this->embedding = $builder->create_embedding();
  }

  private function error($string){
    $message = '<p style="display:inline; color:red;">~~ Shortcode error with <i>"'.$string.'"</i> ~~ </p>';
    $this->error = $message;

  }
}
