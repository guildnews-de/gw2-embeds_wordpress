<?php

class GW2arm_shortcode
{
  private $shortAtts;
  private $embedding;
  private $gw2armError;

  public function parseParams($inAtts){

    $outAtts = formatAtts($inAtts);

    if (validType()) {
      $this->shortAtts = $outAtts;
    } else {
      $this->error('type');
    }
  }

  private function formatAtts($rawAtts){
    $rawAtts = array_change_key_case((array) $rawAtts, CASE_LOWER);

    // WP-function to prepare attr. and evtl. set defaults
    $formAtts = shortcode_atts(
        array(
      'type' => 'skills',
      'id' => '-1',
      'text' => '',
      'traits' => '',
      'inline' => '',
      'size' => '',
      'blank' => '',
    ),
        $rawAtts
    );

    // eliminate spaces between ids
    $formAtts['id'] = preg_replace('/\s+/', '', $formAtts['id']);
    $formAtts['traits'] = preg_replace('/\s+/', '', $formAtts['traits']);

    // filter empty keys
    $formAtts = array_filter($formAtts);

    return $formAtts;
  }

  private function validType($with){
    if (in_array($with['type'], array('skills', 'spec', 'items', 'amulets'))) {
        return true;
    } else {
        return false;
    }
  }

  public function createEmbedding(){
    if ($shortAtts['type'] != 'spec') {
        if (sizeof($shortAtts) == 2) {
            $builder = new GW2arm_embedBasic();
        } else {
            $builder = new GW2arm_embedDefault();
        }
    } else {
        $builder = new GW2arm_embedsSpec();
    }
    $builder->setValues($shortAtts);
    $this->embedding = $builder->getEmbed();
  }

  private function error($string){
    $message = '<p style="display:inline; color:red;">~~ Shortcode error with <i>"'.$string.'"</i> ~~ </p>';
    $this->error = $message;

  }
}
