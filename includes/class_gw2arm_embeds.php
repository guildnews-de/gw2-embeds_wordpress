<?php
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
            if (GW2arm_Snippets::PRIMARY[$key]) {
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

    protected function append_additional()
    {
        $this->span->setAttribute(GW2arm_Snippets::get_Snippet('type'), 'specializations');

        if (isset($this->output_array['traits'])) {
            $id = explode(',', $this->output_array['id']);
            $traits = explode(';', $this->output_array['traits']);
            for ($i=0; $i < sizeof($id); $i++) {
                $i_id = $id[$i];
                $i_tr = isset($traits[$i]) ? $traits[$i] : '';

                $this->span->setAttribute(GW2arm_Snippets::get_items($i_id, 'traits'), $i_tr);
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
    'infusions' => ''
    );

    protected function append_additional()
    {
      $upgrade_handler = new GW2arm_item_upgrade;
      $upgrade_handler->set_id_string($output_array['id']);

      foreach ($output_array as $key => $value) {
        $upgrade_handler->parse_item_addition($key,$value);
      }

    }

}

class GW2arm_item_upgrade
{
  private $array_ids;


  private $output_array;

  public function set_id_string($string){
    $this->array_ids = explode(',',$string);
  }

  public function parse_item_addition($attr_type, $value)
  {
    switch ($attr_type) {
      case 'skin':
      case 'stat':
      case 'infusions':
      case 'traits':
        parse_attribute($attr_type,$value);
        break;
      case 'upgrades':
        parse_upgrade($attr_type,$value);
        break;
      default:
        // code...
        break;
    }
  }

  private function parse_upgrade($att,$value)
  {
    $items = explode(';', $value);

    foreach ($items as $key1 => $val1) {
      if (strpbrk($val1,'+')) {
        $items2 = explode(',',$val1);
        foreach ($items2 as $key2 => $val2) {
          if (strpbrk($val2,'+')) {
            $count_a = explode('+',$val2);
            $count_s = '{"'.$count_a['0'].'": '.$count_a['1'].'}';

            push_item_adds('count',$val1,$count_s);

            $items2[$key2] = $count_a['0'];
          }
        }
        $items[$key1] = implode(',',$items2);
        push_item_adds('upgrade',$val1,$items[$key1]);
      }
    }
  }

  private function parse_attribute($att,$value)
  {
    $items = explode(';', $value);

    foreach ($this->$array_ids as $key => $val) {
      if (isset($items[$key])) {
        push_item_adds($att, $val, $items[$key]);
      }
    }
  }

  private function push_item_adds($attr_type,$item_id,$value){
    $attribute = GW2arm_Snippets::get_item_snippet($item_id, $attr_type);
    $this->output_array[$attribute] = $value;
  }

  public function get_atts_array(){
    return $this->output_array;
  }
}
