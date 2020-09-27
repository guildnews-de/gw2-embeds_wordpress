<?php

class GW2arm_Snippets
{
    const PREFIX = 'data-armory-';

    const SNIPPET = array(
  'type' => 'embed',
  'id' => 'ids',
  'text' => 'inline-text',
  'size' => 'size',
  'blank' => 'blank-text',
  'style' => 'style'
  );

    const UPGRADES = array(
  'traits' => '-traits',
  'skin' => '-skin',
  'stat' => '-stat',
  'upgrades' => '-upgrades',
  'infusions' => '-infusions'
  );

    const COUNT = '-upgrade-count';

    public static function get_prefix()
    {
        return self::PREFIX;
    }

    public static function get_snippet($key)
    {
        $snippet = self::PREFIX . self::SNIPPET[$key];
        return $snippet;
    }

    public static function get_upgrades($id,$type)
    {
        $snippet = self::PREFIX . $id . self::UPGRADES[$type];
        return $snippet;
    }

    public static function get_upgr_count($id){
      $snippet = self::PREFIX . $id . self::COUNT;
      return $snippet;
    }
}

class GW2arm_embed_default
{
    protected $filter_array = array(
      'type' => 'skills',
      'id' => '-1',
      'text' => '',
      'style' => '',
      'size' => '',
      'blank' => '',
      );

    protected $output_array;

    protected $dom;
    protected $span;

    // prepare empty html-element
    public function __construct()
    {
        $this->dom = new DOMDocument();
        $this->span = $this->dom->createElement('span');
    }

    // hand over the shortcode attributes to the class
    public function set_values($given_atts)
    {

        $process_array = $this->do_filter_array($given_atts);

        // evaluate inline-view additions
        if ($process_array['style'] === 'inline') {
            $process_array['style'] = 'display: inline-block; vertical-align: bottom;';
            if (!isset($process_array['size'])) {
              $process_array['size'] = '20';
            }
        }

        $this->output_array = $process_array;

    }

    public function debugView($array){

    }

    // filter unsupported or empty keys and beautify
    protected function do_filter_array($raw_array)
    {
        // filter unsupported attributes
        $form_array = shortcode_atts($this->filter_array, $raw_array);

        // filter empty keys
        $form_array = array_filter($form_array);

        return $form_array;
    }

    // add additonal attributes to html-element
    protected function append_atts()
    {
        foreach ($this->output_array as $key => $value) {
          //echo $key.' > '.$value." ~~ ";
            if (GW2arm_Snippets::SNIPPET[$key]) {
                $this->span->setAttribute(GW2arm_Snippets::get_Snippet($key), $value);
            }

        }
        $this->append_additional();
    }

    protected function append_additional()
    {
        // none in default class
    }

    // execute html-building functions and return element
    public function create_embedding()
    {
        if (isset($this->output_array)) {
            $this->append_atts();

        } else {
            return 'attributes not set';
        }

        $this->dom->appendChild($this->span);
        return $this->dom->saveHTML();
    }
}

class GW2arm_embed_spec extends GW2arm_embed_default
{
    protected $filter_array = array(
  'type' => 'spec',
  'id' => '-1',
  'traits' => '',
  );

  public function debugView($array){
    print_r($array);
  }

  protected function append_additional()
  {
    $this->span->setAttribute(GW2arm_Snippets::get_Snippet('type'), 'specializations');

      if (isset($this->output_array['traits'])) {
        $id = explode(',',$this->output_array['id']);
        $traits = explode(';',$this->output_array['traits']);
        for ($i=0; $i < sizeof($id); $i++) {
          $i_id = $id[$i];
          $i_tr = isset($traits[$i]) ? $traits[$i] : '';

          $this->span->setAttribute(GW2arm_Snippets::get_upgrades($i_id,'traits'), $i_tr);
        }
      }
  }
}

class GW2arm_embed_items extends GW2arm_embed_default
{
  protected $filter_array = array(
    'type' => 'items',
    'id' => '-1',
    'text' => '',
    'style' => '',
    'size' => '',
    'blank' => '',
    'skin' => '',
    'stat' => '',
    'upgrades' => '',
    'count' => '',
    'infusions' => ''
    );

    protected function append_additional()
    {
        $id = explode(',',$this->output_array['id']);
        foreach ($this->output_array as $key => $value) {
            if (GW2arm_Snippets::UPGRADES[$key]) {
              $upgrades = explode(';',$value);
              for ($i=0; $i < sizeof($id); $i++) {
                $i_id = $id[$i];
                $i_upgr = isset($upgrades[$i]) ? $upgrades[$i] : '';
                $this->span->setAttribute(GW2arm_Snippets::get_upgrades($i_id,$key), $value);
              }
            }
            if ($key === 'count') {
              $upgrades = explode(';',$value);
              for ($i=0; $i < sizeof($id); $i++) {
                $i_id = $id[$i];
                $i_upgr = isset($upgrades[$i]) ? explode(',',$upgrades[$i]) : '';
                echo $i_upgr['0'].' and '.$i_upgr['1'];
                $this->span->setAttribute(GW2arm_Snippets::get_upgr_count($i_id), '{"'.$i_upgr['0'].'": '.$i_upgr['1'].'}');
              }
            }
        }
    }
}
